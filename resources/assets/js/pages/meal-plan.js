(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;
    var track = !$('meta[name="debug"]').length;
    // var fbq = window.fbq || function() {};

    // UTILITY
    var inViewFocus, inViewAttention, inViewAlertness = false;

    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top + 100;
        var elemBottom = elemTop + $(elem).height() + 100;
        return ((elemTop <= docViewBottom) && (elemBottom >= docViewTop));
    }

    // INITIALIZATION

    function initializeSlick() {
        $(".how-it-works-slider").slick({
            dots: true,
        });
    }

    function initVideoPopUp() {
        $('.video-popup').magnificPopup({
            type: 'iframe',
        });
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

    function fixDiv() {
        var $div = $(".add-to-cart-dropdown");
        if ($(window).scrollTop() > $div.data("top")) { 
            $div.removeClass("relative-add-to-cart").addClass("fixed-add-to-cart"); 
        }
        else {
            $div.removeClass("fixed-add-to-cart").addClass("relative-add-to-cart").css({});
        }
    }

    // EVENT HANDLER

    function onDocumentReady() {
        initializeSlick();
        initVideoPopUp();

        $('.page-scroll').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 60
                    }, 500);
                    return false;
                }
            }
        });

        if($(".add-to-cart-dropdown").length > 0){
            $(".add-to-cart-dropdown").data("top", $(".add-to-cart-dropdown").offset().top); // set original position on load
            $(window).scroll(fixDiv);
        }
 

        //Stop Video When Modal Closes
        $('.result-modal-1, .result-modal-2, .result-modal-3').on('hidden.bs.modal', function(e) {
            $(this).find('iframe').attr("src", $(this).find('iframe').attr("src"));
        });

        $("#custom-diet-plan .icon-wrapper, #dedicated-coach .chat-wrapper .chat, #custom-workout-plan .icon-wrapper").inViewport(function(px) {
            if (px) {
              animateIt($(this));
            }
        });

        $("#best-price .right, #best-price .next").on("click", function(){
            swipeLeft(shredzPlan);
        });

        $("#best-price .left, #best-price .prev").on("click", function(){
            swipeRight(shredzPlan);
        });

        var shredzPlan = document.getElementById("shredz-plan");

        function swipeRight(shredzPlan){
            var dataSwipe = $(shredzPlan).attr("data-swipe");
            if (dataSwipe && dataSwipe == "left") {
                $(shredzPlan).removeClass("swipe-left col-xs-6").addClass("col-xs-4").attr("data-swipe", "");
                $("#best-price .left, #best-price .right").removeClass("col-xs-6").addClass("col-xs-4");
                $("#best-price .left").removeClass("fadeOut").addClass("fadeIn");
                $("#shredz-plan").css({"margin-left": "-10%"});


            } else {
                $(shredzPlan).addClass("swipe-right col-xs-6").removeClass("swipe-left col-xs-4").attr("data-swipe", "right");
                $("#best-price .right").removeClass("col-xs-6 fadeIn").addClass("col-xs-4 fadeOut");
                $("#best-price .left").removeClass("col-xs-4").addClass("col-xs-6");
                $("#shredz-plan").css({"margin-left": "0%"});
            }
        }

        function swipeLeft(shredzPlan){
            var dataSwipe = $(shredzPlan).attr("data-swipe");
            if (dataSwipe && dataSwipe == "right") {
                $("#best-price .left, #best-price .right").removeClass("col-xs-6").addClass("col-xs-4");
                $(shredzPlan).removeClass("swipe-right col-xs-6").addClass("col-xs-4").attr("data-swipe", "");
                $("#best-price .right").removeClass("fadeOut").addClass("fadeIn");
                $("#shredz-plan").css({"margin-left": "-10%"});
                

            } else {
                $("#best-price .left").removeClass("col-xs-6 fadeIn").addClass("col-xs-4 fadeOut");
                $("#best-price .right").removeClass("col-xs-4").addClass("col-xs-6");
                $(shredzPlan).addClass("swipe-left col-xs-6").removeClass("swipe-right col-xs-4").attr("data-swipe", "left");
                $("#shredz-plan").css({"margin-left": "0%"});
            }
        }

        Hammer(shredzPlan).on("swiperight", function(event) {
            swipeRight(shredzPlan);
        });

        Hammer(shredzPlan).on("swipeleft", function(event) {
            swipeLeft(shredzPlan);
        });

        $(".add-to-cart-button").on("click", onAddToCartButtonClick);


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

    function onAddToCartButtonClick(evt) {
        $this = $(this);
        var productSku = $this.data("sku");
        sendToCart(productSku);
        // triggerFacebookAddToCart (productSku)
    }


    // ACTIONS

    function sendToCart(sku) {
        var cartFactory = ShredzAPI.CartFactory.make();

        cartFactory
            .addItem(sku)
            .promise()
            .then(function() {
                var url = $("meta[name='api-base']").attr('content') + "/cart";
                window.location = url;
            });
    }

    function bindEvents() {
        $(document).on("ready", onDocumentReady);
    }

    function dynamicPrice(product){
        var productVariant = product.data.variants[0];
        var msrp = productVariant.msrp;
        var price = productVariant.price;
        $('.dynamic-msrp').text('$'+msrp);
        $('.dynamic-price').text('$'+price);
    }
    function boot() {
        bindEvents();
        var productFactory =  ShredzAPI.getProducts(String(1102))
                              .then(dynamicPrice);
       
    };

    boot();

})(window);