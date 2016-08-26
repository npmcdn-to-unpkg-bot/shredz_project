/**
 * Product Page Controller
 * @author John Cui <j.cui@shredz.com>
 * @comment
 *      Combustion made a big mess with this!
 */
!(function(window, undefined) {
    'use strict';

    var TYPE_SHREDZ_API = 'ShredzAPI';
    var TYPE_JQUERY = 'JQuery';
    var TYPE_STRING = 'String';
    var TYPE_OBJECT = 'Object';
    var TYPE_MATH = 'Math';
    var TYPE_HANDLEBARS = 'Handlebars';

    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var noop = function () {};
    var $ = window[TYPE_JQUERY] || window.$ || {};
    var String = window[TYPE_STRING];
    var Object = window[TYPE_OBJECT];
    var Math = window[TYPE_MATH];
    var ShredzAPI = window[TYPE_SHREDZ_API];
    var Handlebars = window[TYPE_HANDLEBARS];
    var $cart = ShredzAPI.CartFactory.make();
    var track = !$('meta[name="debug"]').length;

    var fbq = window.fbq || function() {};

    var _templates = {};

    //which variant to load
    var params = {};
    var variants = [];
    var product = {};
    var button_text_map = [];
    //sku of the product
    var sku = "";
    //clock for dotd products
    var clock;
    //so we know the product gender
    var product_gender;
    //product id
    var product_id;
    //the product slug
    var product_slug;
    //variant options
    var poptions = [];
    //the product name of the sku
    var product_name;
    //variants product main image
    var main_variant_image;
    //the type of product we are loading
    var product_type;
    var activeVariant;

    /////////////////////
    //  H E L P E R S  //
    /////////////////////

    function loadTemplates() {
        $('script[type="text/x-handlebars-template"]').each(function() {
            var $this = $(this);
            _templates[$this.attr('name')] = Handlebars.compile($this.html());
        });
    }

    function registerHandlebarsHelpers() {
        Handlebars.registerHelper('join', function(collection, delimiter) {
            delimiter = delimiter && delimiter.constructor.name === 'String' && delimiter || ' ';
            return collection.join(delimiter) ;
        });
        Handlebars.registerHelper('lcase', function (str) {
            return str.trim().toLowerCase();
        });
        Handlebars.registerHelper('sale', function (price, msrp) {
            return Math.floor((msrp - price) / msrp * 100);
        });
        Handlebars.registerHelper('in', function (collection, item, options) {
            if (collection[item] || collection.indexOf(item) + 1) {
                return options.fn(this);
            }
        });
        Handlebars.registerHelper('if-gt', function (val1, val2, options) {
            if (val1 > val2) {
                return options.fn(this);
            } else {
                return options.inverse(this);
            }
        });

        Handlebars.registerHelper('splitTitle', function(title) {
            var t = title.split(" ");
            return t[0] + '<br />' + t[1];
        });
    }

    /*select product if window hash matches a sku*/
    function isValidHashSku() {
        var hash = window.location.hash.substr(1);

        for (var i = 0; i < variants.length; i++) {
            if (variants[i].sku == hash) {
                return i;
            }
        }

        return 0;
    }

    /*
     *
     * -set user selections to currently selected options
     * -fixes bug from finding a variant when an invalid selection is made
     * */
    function overrideParams(sel) {
        for (var key in sel) {
            if (sel.hasOwnProperty(key)) {
                params[key] = sel[key];
            }
        }
    }

    /*
     *
     * Pass in a text and replace codes with corresponding values
     * Parameters
     *   op - true to replace character with code, false to replace code with character
     * */
    function specialCharacters(text, op) {
        var charMap = [{
            code: '#00',
            char: '"'
        }, {
            code: '#01',
            char: '\''
        }];

        var i;
        var regex;

        if (op) {
            for (i = 0; i < charMap.length; i++) {
                regex = new RegExp(charMap[i].char, "g");
                text = text.replace(regex, charMap[i].code);
            }
        }
        else {
            for (i = 0; i < charMap.length; i++) {
                regex = new RegExp(charMap[i].code, "g");
                text = text.replace(regex, charMap[i].char);
            }
        }

        return text;
    }

    function removequotes(s) {
        var result = "";
        for (var i = 0; i < s.length; i++) {
            if (s.substr(i, 1) != "'") {
                result += s.substr(i, 1);
            }
        }

        return result;
    }

    function containsValue(obj, value) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key) && obj[key] == value) {
                return true;
            }
        }

        return false;
    }

    /////////////////////////
    //  C O M P O S E R S  //
    /////////////////////////

    function initSlick() {
        $("#transformations").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            swipe: true,
            draggable: false,
            autoplay: true,
            autoplaySpeed: 5000,
            variableWidth: true,
            centerMode: true
        });
    }

    function initAddToCartModal() {
        $('#addToCart').modal();
    }

    function getCouponFromApi(){
        var coupon = $cart.details().discounts;
        $('#discount').html(_templates['discounts']({ discounts: coupon }));
    }

    function showAddToCartModal() {
        $('#addToCartModal .modal-header .product-image img').attr('src', main_variant_image);
        $('#addToCartModal .modal-header .product-name').text(product_name);
        ShredzAPI
        .getProducts({ productSetId: product_gender === 'male' ? 133 : 134 })
        .then(function (res) {
            $('#addToCartModal .modal-body .products').html(_templates['a2c-product']({ products: res.data }));
            updateAddToCartButtons();
        })
        .then(function () {
            $('#addToCartModal').modal('show');
        });
    }

    function removeSpinner() {
        $(".spinner").remove();
    }

    function setGenderAttributes(gender) {
        $(".gender_link").addClass(gender);
        $(".male").css("color", "#C00");
        $(".female").css("color", "#ff0095");
        $(".offer .options button,.userReviews,.products .title,.reviews:eq(0),.preview,.special h2, #discount .discount-value-holder,#discount ul").addClass(gender);
        $("button.male.gender_link").css("color", "white");
        $("button.female.gender_link").css("color", "white");

        $(".male.usLabel").css({
            "color": "#C00",
            "border": "1px solid #C00"
        });

        $(".male.intLabel").css({
            "border": "1px solid #C00",
            "background-color": "#C00"
        });

        $(".female.usLabel").css("color", "#ff0095");

        //male default
        if (gender == "male") {
            $(".gender_link").removeClass("female");
            $("#man_fee_c").html("MEN");
            $('#questionsImg').attr('src', '/images/products/mPhone.png');
            $(".benefits img").each(function() {
                $(this).attr("src", redCheckUrl)
            });
            $(".challenge").css({
                "background-image": "url(/images/redgym.jpg)",
            })
        }
        else {
            $("#what_inc_title").addClass("female_text");

        }


    }

    function doProductTypeStuff(prod_type) {
        if (prod_type == "supplement" || prod_type == "supplement-stack") {
            addSupplementContent();
        }
        else if (prod_type == "accessory" || prod_type == "apparel") {

            addAccessoryContent(prod_type);
        }
        else if (prod_type == "custom-ebook") {
            addEbookContent();
        }
        else {
            addSupplementContent();
            setupGrid(product_gender);
        }
    }

    function addAccessoryContent(prod_type) {
        $(".athlete_testimonial, .prop65").hide(0);

        $('#testimonialVideo,#testimonial_warning,.transformations,.challenge,#prodDesc,#last_button').hide(0).remove();
        $('figure.sizing_chart').each(function() {
            $(this).remove();
        });
        if (product_gender == "female" && prod_type == "apparel") {
            $("#whatsInc").append(
                '<figure class="sizing_chart" style="text-align: center;vertical-align: top;margin:auto;">' +
                '<img src="' + sizingChartFemaleUrl + '">' +
                '</figure>');
        }

        $("#prodDesc").html("");
    }

    function addSupplementContent() {
        var playerInstance = jwplayer("testimonialVideo");
        playerInstance.setup({
            file: getVideo(product.variants[0].gender.toLowerCase()),
            width: "100%",
            aspectratio: "4:3",
            title: 'Shredz Testimonial Video',
            description: 'Shredz Testimonial',
            image: "../images/transformposter.png",
            mediaid: '123456'
        });
        setTimeout(function() {
            setupGrid(product_gender);
        }, 1000);

        var playerInstance_mobile = jwplayer("testimonialVideo_mobile");
        playerInstance_mobile.setup({
            file: getVideo(product.variants[0].gender.toLowerCase()),
            width: "100%",
            aspectratio: "4:3",
            title: 'Shredz Testimonial Video',
            description: 'Shredz Testimonial',
            image: "../images/transformposter.png",
            mediaid: '123456'
        });
        setTimeout(function() {
            setupGrid(product_gender);
        }, 1000);

    }

    //still have to clean up
    function addEbookContent() {
        $(".athlete_testimonial").hide(0);
        var img = imgMaleUrl;
        var img2 = img2MaleUrl;
        var img3 = img3MaleUrl;
        var img4 = img4MaleUrl;
        var img5 = img5MaleUrl;
        var img6 = img6MaleUrl;

        var img7 = img7MaleUrl;
        var img8 = img8MaleUrl;
        var img9 = img9MaleUrl;
        var img10 = img10MaleUrl;
        var img11 = img11MaleUrl;
        var img12 = img12MaleUrl;
        var img13 = img13MaleUrl;
        var img14 = img14MaleUrl;
        var img15 = img15MaleUrl;
        var img16 = img16MaleUrl;
        if (product_gender == 'female') {
            img = imgFemaleUrl;
            img2 = img2FemaleUrl;
            img3 = img3FemaleUrl;
            img4 = img4FemaleUrl;
            img5 = img5FemaleUrl;
            img6 = img6FemaleUrl;

            img7 = img7FemaleUrl;
            img8 = img8FemaleUrl;
            img9 = img9FemaleUrl;
            img10 = img10FemaleUrl;
            img11 = img11FemaleUrl;
            img12 = img12FemaleUrl;
            img13 = img13FemaleUrl;
            img14 = img14FemaleUrl;
            img15 = img15FemaleUrl;
            img16 = img16FemaleUrl;
        }


        $("#last_button").css({
            "margin-top": "40px"
        });

        $("#options").append("<div id='green_warning'>*Personal and Dietary Information will be requested after purchase to Build your Custom Plan</div>");


        /*added wrapper div to dynamic content to rmeove it when the next variant is loaded*/
        $('#remove-fix').remove();
        $("#whatsInc").append(
            '<div id="remove-fix">' +
            '<h2>PLAN PREVIEW</h2>' +
            '<img id="prev_one" class="ebook_preview_image" src="' + img5 + '"/><img class="ebook_preview_image" id="prev_two" src="' + img6 + '"/>' +
            '<h3 class="whywork">WHY SHREDZ WORKS</h3>' +
            '<p>Not only will you receive your own dedicated coaches, <b>workout programs</b>, and <b>diet plan</b>; you will also be provided a <b>FREE scale</b>, a <b>10 piece meal-prep container set</b>, and <b>e-book!</b> With the perfect blend of information, accountability, and tools to prepare, weigh, and carry your meals, your best body is just a click away!</p>' +
            '<h3 class="whywork">DESCRIPTION</h3>' +
            '<div class="dietrow"><img class="dietimaage" src="' + img + '" style="">' +
            '    <div class="group"><p>' +
            '        You\'ve tried countless diets. They seem simple enough. You drop calories impossibly low, see a quick weigh' +
            '        t loss only to put back on MORE weight than when you started. Well those days of quick fixes are over. It\'s' +
            '        time to put down the yo-yo diets and quit playing around. Today, you are 30 days away from SUCCESS!' +
            '    </p>' +
            '    <p>' +
            '        With your personalized <b>SHREDZ Custom Diet and Training program</b> you will learn how your body works, get in' +
            '        the BEST shape of your life, and without starving yourself!' +
            '    </p>' +
            '    <ul>' +
            '        <li><b>Custom diet plans hand crafted to transform your body</b></li>' +
            '        <li><b>A dedicated nutrition and exercise specialist</b></li>' +
            '        <li><b>Weekly check-ins</b></li>' +
            '        <li><b>Target specific weak points and problem areas</b></li>' +
            '        <li><b>Decrease stubborn fat deposits</b></li>' +
            '    </ul></div></div><!-- group -->' +
            '    <h2>ABOUT OUR CUSTOM DIET PLANS</h2>' +
            '<div class="dietrow"><img class="dietimaage" src="' + img2 + '" style="">' +
            '    <div class="group"><p>' +
            '        When you sign up for diet coaching from SHREDZ, you will be working closely with your own <b>dedicated nutrition' +
            '        specialist</b> who will map out every bite youll take in the next month to achieve your goals.' +
            '    </p>' +
            '    <p>' +
            '        Each diet program is designed using your height, weight, age, and specific goals. Our coaches will adjust' +
            '        your calorie intake, protein, carbs, and fats to ensure you are getting the most out of each day of your program.' +
            '    </p>' +
            '    <p>' +
            '        All you have to do is fill out the provided form where you can choose from your favorite foods. This will' +
            '        ensure that your diet is made up of foods that you want to eat, making <b>getting in shape</b> easy and delicious.' +
            '        No more scarfing down Brussel sprouts because your diet said so!' +
            '    </p></div></div>' +
            '    <h3 class="whywork">TAILORED WORKOUT PROGRAMS</h3>' +
            '<div class="dietrow"><img class="dietimaage"  src="' + img3 + '" style="">' +
            '    <div class="group"><p>' +
            '        Based on your goals, you will receive a <b>tailored workout program</b> complete with warm up, cool downs, and' +
            '        everything you need to slim down, build up muscle, or anything in between. Each workout is customized to' +
            '        your goals, to help build upon your weak points and tone where necessary. These programs are far from' +
            '        ordinary and will challenge you with workouts that change both daily and weekly. We promise youll never' +
            '        be bored in the gym again! When used in tandem with our custom diet plan, you will be amazed at what' +
            '        you can <b>achieve in as little as 30 days</b>.' +
            '    </p></div></div>' +
            '    <h3 class="whywork">1 ON 1 COACHING</h3>' +
            '<div class="dietrow"><img  class="dietimaage" src="' + img4 + '" style="">' +
            '    <div class="group"><p>' +
            '       Have a question about your workouts? Wondering if you can eat something slightly off your plan? Or maybe you' +
            '        just need the assurance that you\'re on the right track. Our <b>dedicated nutrition and exercise coaches</b>' +
            '        are there to answer all of your questions and guide you along your transformation! You will be in' +
            '        <i>constant contact</i> with your coach to ensure you are on track, <i>adjust</i> your plan if necessary,' +
            '        and give you the <i>feedback</i> you need to optimize your transformation. ' +
            '    </p></div></div>' +
            '<h3 class="whywork">BEFORE AND AFTERS</h3>' +
            '<div class="bandaleft"><img id="himg" src="' + img7 + '"/><img id="" src="' + img8 + '"/></div> <div class="bandaright"><img id="" src="' + img9 + '"/><img id="" src="' + img10 + '"/></div>' +
            '<div class="bandaleft"><img id="" src="' + img11 + '"/><img id="" src="' + img12 + '"/></div><div class="bandaright"><img id="" src="' + img13 + '"/><img id="" src="' + img14 + '"/></div>' +
            '<div class="bandaleft"><img id="" src="' + img15 + '"/><img id="" src="' + img16 + '"/></div>' +
            '</div>'
        );
        $("#prodDesc").html("");
    }

    function setLightbox(url) {
        $("body").css("overflow", "hidden");
        $("body").after(
            '<div class="overlay store_lightbox">' +
            '<img src="' + url + '">' +
            '</div>'
        );
        $(".overlay").on("click", function() {
            $("body").css("overflow", "");
            $(this).remove();
        });
    }

    function reset() {
        $('.offer .includes').html('<h2>Includes:</h2>');
        $(".offer .special p,.offer .special h3,.offer .special h2,#options,#products,#description-buttons,#target").html('');

        $(".info .row").each(function() {
            if ($(this).index() > 0) {
                $(this).remove();
            }
        });
    }

    function createClock() {
        /*flip clock*/
        var today = new Date();
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(0);
        tomorrow.setSeconds(0);
        tomorrow.setMinutes(0);

        var seconds = (tomorrow - today) / 1000;

        clock = $(".fclock").FlipClock();
        clock.setCountdown(true);
        clock.setTime(seconds);
    }

    function updateCartQuantity() {
        var $cartQuantity = $(".cart-quantity");
        $cartQuantity.html($cart && $cart.data().item_count || 0);
    }

    function updateAddToCartButtons() {
      var skus = {};
      var count;

      count = $('#addToCartModal button[data-sku]')
      .html('ADD TO CART')
      .removeClass('in-cart')
      .data('updated', false)
      .each(function () {
        var sku = $(this).data('sku');
        if (sku) {
          skus[sku] = this;
        }
      }).length;

      for (var items = $cart.items(), item, i = 0, l = items.length; count > 0 && i < l; i++) {
        item = skus[items[i].sku];

        if (item) {
          $(item).addClass('in-cart').html('<b class="fa fa-fw fa-check"></b>ADDED TO CART');
          count--;
        }
      }
    }

    ///////////////////////
    //  H A N D L E R S  //
    ///////////////////////

    function onDocumentReady() {
        //so we don't see any gender specific stuff until the products load
        $("main").hide(0);
        getData();
        getCouponFromApi();
        $("#discount").on("click", ".discount-value-holder", onCouponButtonClicked);
        
    }

    function animateIt(selector) {
        var delay = 0;
        $(selector).find(".animated").each(function() {
            var $this = $(this);
            var animation = $this.data("animate");
            setTimeout(function() {
                $this.addClass(animation);
            }, delay += 200); // delay 200 ms

        });
    }

    function onBtnScrollToTopClick() {
        $("html, body").animate({
            scrollTop: 0
        });
    }

    function onBtnAddToCartClick(e) {
        addToCart();
        showAddToCartModal();

        if (e && e.preventDefault()) {
            e.preventDefault();
            e.returnValue = false;
        }
    }

    function onBtnDescriptionsClick() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        var description = $('body .info .row[sku=' + $(this).attr('sku') + ']');
        description.siblings().removeClass('active');
        description.addClass('active');
    }

    function onProductLoaded(res) {
        $('#disclaimer-neutral').html(_templates['disclaimerNeutral']({ disclaimerneutral: res.data }));
        if(res.data.id == "1100" || res.data.id == "1106"){
            $('#meal-plan-section').html(_templates['meal-plan']({ res: res.data }));
            // $("#custom-diet-plan .icon-wrapper, #dedicated-coach .chat-wrapper .chat, #custom-workout-plan .icon-wrapper").inViewport(function(px) {
            // if (px) {
            //       animateIt($(this));
            //     }
            // });
            $("#custom-diet-plan .view-more button").on("click", function(){
            onViewMoreButtonClicked("#favorite-foods");
            });
            $("#favorite-foods .hide-info button").on("click", function(){
                onHideInfoButtonClicked("#favorite-foods", "#custom-diet-plan");
            });

            $("#custom-workout-plan .view-more button").on("click", function(){
                onViewMoreButtonClicked("#favorite-workouts");
            });
            $("#favorite-workouts .hide-info button").on("click", function(){
                onHideInfoButtonClicked("#favorite-workouts", "#custom-workout-plan");
            });

            $("#dedicated-coach .view-more button").on("click", function(){
                onViewMoreButtonClicked("#meet-coaches");
            });
            $("#meet-coaches .hide-info button").on("click", function(){
                onHideInfoButtonClicked("#meet-coaches", "#dedicated-coach");
            });
            }
            $("#product_name_top").html(res['data']['name']) ;
            $("#product_subtitle").html(res['data']['description']) ;
        product = res.data;
        //if the product is a deal of the day product we want to show the clock
        //if(lProductId == 553 || lProductId == 554)
        if (lProductId == 733 || lProductId == 738 || lProductId == 554 || lProductId == 553) //new dotd ids
        {
            $(".fclock").css("display", "");
            createClock();
        }

        var prefix;
        var i;

        //remove apostrophes from variants - temporarily fixes certain variants deleting the info section
        for (i = 0; i < product.variants.length; i++) {

            for (var sel in product.variants[i].selected_options) {
                prefix = sel.replace(/\s/g, '');

                if (product.variants[i].selected_options.hasOwnProperty(sel)) {

                    product.variants[i].selected_options[sel] = specialCharacters(product.variants[i].selected_options[sel], true);
                    product.variants[i].selected_options[sel] = prefix + "-" + product.variants[i].selected_options[sel];


                }
            }
        }

        variants = product.variants;
        poptions = product.options;

        for (var ind in poptions) {
            if (poptions.hasOwnProperty(ind)) {
                prefix = ind.replace(/\s/g, '');
                for (i = 0; i < poptions[ind].length; i++) {
                    //neeed to make a special function that will strip all special characters and change them to a map of special strings to later revert
                    poptions[ind][i] = specialCharacters(poptions[ind][i], true);
                    poptions[ind][i] = prefix + "-" + poptions[ind][i];
                }
            }
        }

        loadVariant(isValidHashSku(), "no");

        //set button text to fix occasional data bug
        $(".offer .options button").each(function(n) {
            $(this).html(button_text_map[n]);
        });

        //removes loading spinner
        removeSpinner();

        //set inline to avoid visual bugs
        $("main").css("display", "");
    }


    function checkifMobile(){
        if($(window).width()<768){
            return true;
        } else{
            return false;
        }
    }

    function onViewMoreButtonClicked(selector){
        $(selector).slideDown().show();
        $('html, body').animate({scrollTop: $(selector).offset().top-70}, 500);
    }


     function onHideInfoButtonClicked(selector, id){
        $(selector).slideUp();
        if(checkifMobile()){
            $('html, body').animate({scrollTop: $(id).offset().top-70}, 500);
        } else{
            $('html, body').animate({scrollTop: $(id).offset().top-90}, 500);
        }
    }

    function onAddToCartModalLinkClick(e) {
        var $this = $(this);

        $('#addToCartModal').modal('hide');

        if ($this.attr('target') === 'cart') {
            goToCart();
        }
        else if ($this.attr('href') !== '#') {
            e = null;
        }

        if (e && e.preventDefault) {
            e.preventDefault();
            e.returnValue = false;
        }
    }


     $.fn.inViewport = function(cb) {
        return this.each(function(i, el) {
            function visPx() {
                var elH = $(el).outerHeight(),
                    H = $(window).height(),
                    r = el.getBoundingClientRect(),
                    t = r.top,
                    b = r.bottom;
                return cb.call(el, Math.max(0, t > 0 ? Math.min(elH, H - t) : (b < H ? b : H)));
            }
            visPx();
            $(window).on("resize scroll", visPx);
        });
    };
    
    function onAddToCartModalButtonClick(e) {
        var $this = $(this);
        var sku = $this.data('sku');
        var price = $this.data('price');

        if ($this.is('.in-cart')) {
          $cart.removeItem(sku);
        } else {
          $cart.addItem(sku);
          triggerFacebookAddToCart(sku, price);
        }

        $cart
        .promise()
        .then(function () {
          updateAddToCartButtons();
          updateCartQuantity();
        });
    }

    function onHashChange(e) {
      triggerFacebookViewContent();
    }

    function onCouponButtonClicked(evt){
        $(this).parent().hide();
        $(this).parent().parent().find(".applied").show();
    }

    /////////////////////
    //  A C T I O N S  //
    /////////////////////

    function getData() {
        ShredzAPI
        .getProducts(String(lProductId))
        .then(onProductLoaded);
    }

    //loads a random video based on gender. going to be switched to product mapping
    function getVideo(gender) {
        var maleVideos = ["TESTIMONIAL_MINIMAL_Calzone85.mp4", "TRANSFORMATION_4.mp4", "TRANSFORMATION_Aaron_Mcloughlin_LQ.mp4", "TRANSFORMATION_AnthonyX125_LQ.mp4", "TRANSFORMATION_BHULBS_LQ.mp4", "TRANSFORMATION_DERRICKBARELA_LQ.mp4", "TRANSFORMATION_FITTED2_LQ.mp4", "TRANSFORMATION_PETERXPHYSIQUE_LQ.mp4"];
        var femaleVideos = ["TESTIMONIAL_MINIMAL_Chulzbarajas.mp4", "TESTIMONIAL_MINIMAL_emilygeorgiadis.mp4", "TESTIMONIAL_MINIMAL_FITBOSNIAN.mp4", "TESTIMONIAL_MINIMAL_HELENHAZARDUS_MMA.mp4", "TESTIMONIAL_MINIMAL_Xtina872ip.mp4", "TRANSFORMATION_BENOSJOURNEY_HQ.mp4", "TRANSFORMATION_BIIONCA_HQ.mp4", "TRANSFORMATION_BNBLM32_LQ.mp4"];
        if (gender === "male") {
            var rand = Math.floor((Math.random() * maleVideos.length));
            return "/videos/testimonial/male/" + maleVideos[rand];
        }
        var rand = Math.floor((Math.random() * femaleVideos.length));
        return "/videos/testimonial/female/" + femaleVideos[rand];
    }

    function showTransformations(gender) {
        var $transformations = $('#transformations');
    }

    function triggerFacebookViewContent () {
      track && activeVariant && fbq('track', 'ViewContent', {
        'content_type'  : 'product',
        'content_ids'   : [ activeVariant.sku ],
        'value'         : activeVariant.price,
        'currency'      : 'USD'
      });
  }

    function triggerFacebookAddToCart (sku, price){
      track && fbq('track', 'AddToCart', {
        'content_type'  : 'product',
        'content_ids'   : [ sku ],
        'value'         : price,
        'currency'      : 'USD'
      });
    }

    function loadVariant(index, opt) {
        activeVariant = variants[index];
        //name of the variant
        product_name = variants[index].name;
        //main image of the variant
        main_variant_image = product.variants[index].asset_location + 'primaryimage_new.jpg';
        //gender of the product
        product_gender = product.variants[0].gender.toLowerCase();
        //sku of the variant
        sku = variants[index].sku;
        if (document.location.hash.replace('#', '') === '' && document.location.replace) {
            document.location.replace((document.location.origin || document.location.protocol + '//' +document.location.host) + document.location.pathname + '#' + sku);
        } else {
            document.location.hash = sku;
        }

        //type of product the variant is
        product_type = variants[index].product_type.slug;

        $("#product-img").off("click");
        $(".bread p b, #prod-name-p").html(product_name);

        //sets the main picture of the image of the
        $("#product-img").attr('src', main_variant_image);
        $("#fancybox-bigimage").attr('href', main_variant_image);


        //sets the lightbox of the image
        $("#product-img").css("cursor", "pointer").on("click", function() {
            $("#fancybox-bigimage").trigger("click");
            // setLightbox(product.variants[index].asset_location + '#primaryimage_01.jpg');
        });

        //the percent off of the product
        var prctOff = Math.floor((product.variants[index].msrp - product.variants[index].price) / product.variants[index].msrp * 100);

        var prod_price = product.variants[index].price;
        if (prod_price >= 100) {
            $(".shipping_text").html("GET IT NOW WITH FREE USA SHIPPING!");
        }
        else {
            $(".shipping_text").html("FREE USA SHIPPING FOR ORDERS ABOVE $100");
        }

        //sets the numbers for the price and the "deal" price of the variant
        if (prctOff) {
            $(".offer .special p").html("<s>REGULAR PRICE $" + product.variants[index].msrp + "</s>");
            // $(".offer .special h2").html("TODAY'S OFFER $" + product.variants[index].price + '<span class="percentOff"> (' + prctOff + '% OFF) </span>');
            $(".offer .special h2").html("TODAY'S OFFER $" + product.variants[index].price);
        }
        else {
            $(".offer .special p").html('');
            $(".offer .special h2").html("TODAY'S OFFER $" + product.variants[index].price);
        }

        //sets all the components for the variant of the specific product
        parse_components(product.components, product.options, product.variants[index]);


        for (var key in poptions) {
            var false_count = 0;
            for (var i = 0; i < poptions[key].length; i++) {
                var b = false;
                for (var op in variants[index].selected_options) {
                    if (variants[index].selected_options[op] == poptions[key][i]) {
                        b = true;
                    }
                }
                if (!b) {
                    false_count++;
                }



                var trimmed = removequotes(poptions[key][i]);

                if (!b) {
                    var el = $(".options button[data-option='" + trimmed + "']");

                    ///need to change this to a function that will create all special characters and revert them to the special chars

                    var text = el.text();
                    el.html(text);

                    var color = "#ff0095";

                    if (product_gender == "male") {
                        color = "#cc0000";
                    }
                    el.removeClass("active").css({
                        "border": "1px solid " + color

                    });

                }
                else {

                    var myel = $(".options button[data-option='" + trimmed + "']");

                    //fix for highlight
                    if (myel.hasClass("active") == false) {
                        myel.addClass("active");
                    }



                }
            }

            if (false_count == poptions[key].length) {
                $(".options [id='" + key + "'] button").each(function() {
                    $(this).css({
                        color: "#c0c0c0",
                        border: "1px solid #c0c0c0"
                    });
                });
            }
        }

        doProductTypeStuff(product_type);


        if (product.flags.indexOf('30-day') + 1) {
            $('[id^="how-it-works-"]').hide();
            $('#how-it-works-' + product_gender).show();
        }

        $("_r");
        setGenderAttributes(product_gender);
    }

    //iterate through variant select_options and choose closest match
    function selectVariant() {
        var index = -1;
        for (var i = 0; i < variants.length; i++) {

            var match = true;
            for (var key in variants[i].selected_options) {


                var test = variants[i].selected_options.hasOwnProperty(key) && params.hasOwnProperty(key) && params[key] == variants[i].selected_options[key];

                if (test == false) {
                    match = false;
                    break;
                }
            }

            if (match) {
                index = i;
                break;
            }
        }

        return index;
    }

    //get information from product.components
    function parse_components(obj, options, variant) {

        var row = '<div class="row">';
        var count = 0;
        var el = "";

        // Change Add to Cart to Subscribe & Save
        if (variant.subscription_plan != null) {
            $(".about-subs").show();
            $(".addToCart").html("SUBSCRIBE & SAVE");
        } else {
            $(".about-subs").hide();
            $(".addToCart").html("ADD TO CART");
        }


        //HIDE DOSAGE, DETAILS, LABELS HEADING FOR EBOOKS
        if(variant.product_type.slug == "ebook"){
            $(".show-for-ebooks").show();
            $(".hide-for-ebooks").hide();
        }
        //ENDS HERE
        for (var i = 0; i < variant.includes.length; i++) {
            el = '<p>';
            var key = variant.includes[i].sku;


            //includes section
            /*if(obj[key].price == 0)
             {
             el += '<span class="pink">FREE </span>';
             }
             el += obj[key].name.toUpperCase()+' <span class="light">($'+obj[key].msrp+' VALUE)</span></p>'; */


            if (variant.includes[i].badge == 'new') {
                if (!variant.gender || variant.gender.toLowerCase() == "male") {
                    el += '<span class="male" style="color:#CC0000;">+ NEW </span>';
                }
                else {
                    el += '<span class="pink" style="color:#ff0095;">+ NEW </span>';
                }
            }

            else if (variant.includes[i].badge == 'free') {
                if (!variant.gender || variant.gender.toLowerCase() == "male") {
                    el += '<span class="male" style="color:#CC0000;">+ FREE </span>';
                }
                else {
                    el += '<span class="pink">+ FREE </span>';
                }
            }

            else {
                el += '<span>&#10004 </span>';
            }
            if(obj[key].msrp){
                el += obj[key].name.toUpperCase() + ' <span class="light">($' + obj[key].msrp + ' VALUE)</span></p>';
            }
            else{
                el += obj[key].name.toUpperCase() + '</p>';
            }
            $(".offer .includes").append(el);

            if (i == 0) {
                $(".desc p:eq(0)").html(variant.description);
                $(".desc p:eq(0)").prepend("<div id='left_prod_image'><img src='" + variant.asset_location + "primaryimage_new.jpg'</div>");

                $(".30daychallenge").hide(0);
            }
            //description


            //how it works section
            if (obj[key].how_it_works || obj[key].dosage_instructions) {
                $(".info").append(
                    '                <div class="row' + '" sku="' + key + '">' +
                    '                    <div class="left">' +
                    '                           <h3>HOW IT WORKS</h2>' +
                    '                           ' + obj[key].how_it_works +
                    '                    </div>' +
                    '                    <div class="center">' +
                    '                        <h2></h2>' +
                    '                        <div class="top">' +
                    '                            ' + obj[key].dosage_instructions +
                    '                        </div>' +
                    '                    </div>' +
                    '                    <div class="right">' +
                    '                        <h2></h2>' +
                    '                        <button class="gender_link usLabel" data-label="' + obj[key].asset_location + 'usalabel.jpg">VIEW USA LABEL</button>' +
                    '                        <button class="gender_link intLabel" data-label="' + obj[key].asset_location + 'intlabel.jpg">VIEW INTL LABEL</button>' +
                    '                    </div>' +
                    '                </div><!-- row -->'
                );

                var descriptionButton = '<button ' + ' sku="' + key + '">' + obj[key].name.toUpperCase() + '</button>';
                $('#description-buttons').append(descriptionButton);
            }

            if (gender == "male") {
                $(".desc > p > li > a").css({
                    "color": "#cc0000"
                });
            }
            else {
                $(".desc > p > a").css({
                    "color": "#ff0095"
                });
            }

            var figure = '<figure class="product no_hover_product">' +
                '<img class="whats_incld_img" src="' + obj[key].asset_location + 'whatyouget_01.jpg">' +
                '</figure>';

            //check to see if there are multiple assets for the image

            var what = obj[key];

            var extra_assets = obj[key].assets;

            var gender = variant.gender;
            var link = "";
            if (gender == "Female") {
                link = lookInsideFemaleUrl;
            }
            else {
                link = lookInsideMaleUrl;
            }


            if (what.product_type.slug == "ebook") {
                figure = '<a class="product yes_hover_product fancybox" rel="' + key + '" href="' + obj[key].asset_location + 'whatyouget_01.jpg' + '" class="product">' +
                    '<img class="look_inside_banner" src="' + link + '"/>' + '<img class="whats_incld_img" src="' + obj[key].asset_location + 'whatyouget_01.jpg">' +
                    '</a>';


                for (var k = 0; k < extra_assets.length; k++) {
                    if (extra_assets[k].indexOf("whatyouget") > -1) {
                        continue;
                    }

                    figure += '<a class="fancybox" rel="' + key + '" href="' + obj[key].asset_location + extra_assets[k] + '"> </a>';

                }


            }


            var prevLen = extra_assets.length;

            $('#products').append(figure);



        } //for

        $('a.fancybox').fancybox({
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 600,
            'speedOut': 200,
            'overlayShow': false
        });

        $('body').on("swipeleft", '.fancybox-opened', function() {
            $.fancybox.next()
        });

        $('body').on("swiperight", '.fancybox-opened', function() {
            $.fancybox.prev()
        });

        //element correction
        $(".info strong").each(function() {
            $(this).replaceWith(
                '<b>' + $(this).text() + '</b>'
            );
        });

        //buttons
        $(".info .right").each(function() {
            //usa label
            $(this).find("button:eq(0)").on("click", function() {
                var win = window.open($(this).data("label"), "_blank");
                win.focus();
            });

            //intl label
            $(this).find("button:eq(1)").on("click", function() {
                var win = window.open($(this).data("label"), "_blank");
                win.focus();
            });
        });


        if (count != 3) {
            row += '</div>';
            $("#target").append(row);
        }

        //options

        for (key in options) {
            if (options.hasOwnProperty(key)) {
                if (!params[key]) {
                    params[key] = options[key][0];
                }
                if (options[key].length > 1) {
                    el = '<div class="row" id="' + key + '">' +
                        '<h2>' + key + '</h2>' +
                        '<div class="buttons">';

                    for (i = 0; i < options[key].length; i++) {
                        //trim quotes
                        var s = removequotes(options[key][i]);
                        var button_text = options[key][i].substr(options[key][i].indexOf("-") + 1);
                        button_text_map.push(specialCharacters(button_text, false));

                        //working on this
                        el += '<button data-option="' + s + '" title="' + key + '">' + button_text + '</button>';
                    }

                    el += '</div></div>';

                    el = $(el);

                    $(".offer .options").append(el);
                }
            }
        }

        $(".product").css({
            "opacity": "1"
        });


        //button margins & highlights
        $(".offer .options .row").each(function() {
            var row = $(this);
            row.find("button").each(function() {
                var button = $(this);
                if (button.index() == 0) {
                    button.css("margin-right", "20px");
                }
                else if (button.is(":last-child")) {
                    button.css("margin-left", "0px");
                }
                else {
                    button.css({
                        "margin-left": "0px",
                        "margin-right": "20px"
                    });
                }

                button.css("margin-bottom", "5px");
                if (containsValue(params, $(this).text())) {
                    $(this).addClass("active");
                }
            });
        });

        //button bindings
        $(".offer .options .row").each(function() {
            var row = $(this);
            row.find("button").each(function(n) {
                var button = $(this);
                $(this).on("click", function() {
                    var current = selectVariant();
                    params[button.parent().parent().attr("id")] = button.data("option");
                    var next = selectVariant();
                    if ((current != next) && next != -1) {
                        reset();
                        loadVariant(next, "no");
                    }
                    else {
                        var choice = -1;

                        for (var i = 0; i < variants.length; i++) {
                            if (choice != -1) {
                                break;
                            }
                            for (var key in variants[i].selected_options) {
                                if (variants[i].selected_options.hasOwnProperty(key) && button.data("option") == variants[i].selected_options[key]) {
                                    choice = i;
                                    break;
                                }
                            }
                        }

                        reset();
                        overrideParams(variants[choice].selected_options);
                        loadVariant(choice, $(this).attr("title"));
                    } //selected invalid choice
                });
            });
        });

        $(".offer .options .row button").each(function() {
            $(this).text(specialCharacters($(this).text(), false));
        });
    }

    function addToCart() {
        $cart
        .addItem(sku)
        .promise()
        .then(function() {
            updateCartQuantity();
            triggerFacebookAddToCart(activeVariant.sku, activeVariant.price);
        });
    }

    function goToCart() {
        var origin = window.btoa && '_store=' + window.btoa(window.document.location.origin) || 'store=' + window.document.location.origin;
        var apiBaseUrl = $('meta[name="api-base"]').attr('content');
        var cart = window.open(apiBaseUrl + '/cart');
        cart.focus();
    }

    function bindEvents() {
        $(window).on('hashchange', onHashChange);
        $(document).on("ready", onDocumentReady);
        $(".toTop, .backToTop").on("click", onBtnScrollToTopClick);
        $('button.addToCart').on('click', onBtnAddToCartClick);
        $('body').on('click', '#description-buttons button', onBtnDescriptionsClick);
        $('#addToCartModal').on('click', 'a', onAddToCartModalLinkClick)
        $('#addToCartModal').on('click', 'button', onAddToCartModalButtonClick)
    }

    function boot() {
        loadTemplates();
        registerHandlebarsHelpers();
        initSlick();
        initAddToCartModal();
        bindEvents();
    }

    boot(); // Start the module
})(window);
