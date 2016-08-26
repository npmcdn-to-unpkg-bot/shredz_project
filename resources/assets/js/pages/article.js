!(function(window, undefined) {
    var TYPE_SHREDZ_API = 'ShredzAPI';
    var TYPE_JQUERY = 'JQuery';
    var TYPE_STRING = 'String';
    var TYPE_OBJECT = 'Object';
    var TYPE_MATH = 'Math';
    var TYPE_HANDLEBARS = 'Handlebars';

    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var document = window.document;
    var $ = window[TYPE_JQUERY] || window.$ || {};
    var String = window[TYPE_STRING];
    var Object = window[TYPE_OBJECT];
    var Math = window[TYPE_MATH];
    var ShredzAPI = window[TYPE_SHREDZ_API];
    var Handlebars = window[TYPE_HANDLEBARS];

    var _templates = {};
    var _filters = [];

    /////////////////////
    //  H E L P E R S  //
    /////////////////////

    function registerHandlebarsHelpers() {
        Handlebars.registerHelper('join', function(collection, delimiter) {
            delimiter = delimiter && delimiter.constructor.name === 'String' && delimiter || ' ';
            return collection.join(delimiter);
        });
        Handlebars.registerHelper('lcase', function(str) {
            return str.trim().toLowerCase();
        });
        Handlebars.registerHelper('sale', function(price, msrp) {
            return Math.floor((msrp - price) / msrp * 100);
        });
        Handlebars.registerHelper('in', function(collection, item, options) {
            if (collection[item] || collection.indexOf(item) + 1) {
                return options.fn(this);
            }
        });
        Handlebars.registerHelper('if-gt', function(val1, val2, options) {
            if (val1 > val2) {
                return options.fn(this);
            } else {
                return options.inverse(this);
            }
        });
    }

    function loadTemplates() {
        $('script[type="text/x-handlebars-template"]').each(function() {
            var $this = $(this);
            _templates[$this.attr('name')] = Handlebars.compile($this.html());
        });
    }

    function loadProductGrid(products) {
        $('#product-grid-ads')
            .html(_templates.productsAds({
                products: products
            }));
    }

    function getUrl() {
        var url;
        url = window.location.href;
        return url;
    }

    ///////////////////////
    //  H A N D L E R S  //
    ///////////////////////

    function onProductsLoaded(response) {
        // loadProductGrid(response.data);
    }

    function setNavCategory() {
        var category = $('meta[name="category"]').attr('content');
        $('.left-navbar a.' + category).addClass('active');
    }

    function onSocialShareButtonsClick(e) {
        var $this = $(this);
        var url = $this.attr('href');
        var target = $this.attr('target');
        var win;

        e.preventDefault();
        e.returnValue = false;

        win = window.open(url, target, 'width=500,height=480');
        win.focus();
    }

    function requestProducts() {
        return ShredzAPI
            .getProducts({
                'pageSize': 4
            })
            .then(onProductsLoaded);
    }

    function requestApiData() {
        return Promise.all([
            requestProducts()
        ]);
    }

    function onDocumentReady(e) {
      // var socialOffsetTop = $(".share-button-holder").offset().top;
      // $(window).on("scroll", function(){
      //   if($(window).scrollTop() > socialOffsetTop){
      //     console.log("kjlsd");
      //     $(".share-button-holder").addClass("sticky-social-button");
      //   }
      //   else{
      //     console.log("no");
      //     $(".share-button-holder").removeClass("sticky-social-button");
      //   }
      // });
    }


    ///////////////////// 
    //  A C T I O N S  //
    /////////////////////

    function bindEvents() {
        $('ul.social-share-buttons').on('click', 'a', onSocialShareButtonsClick);
        $(document).on('ready', onDocumentReady);
    }

    function boot() {
        // registerHandlebarsHelpers();
        // loadTemplates();
        bindEvents();
        setNavCategory();
        howItWorks();
        // Start pulling the data from the API
        // requestApiData();
    }

    // "How It Works" Slider - only for Mobile
    function howItWorks(){
          $slick_slider = $('.mobile-slider');
          settings = {
            dots: true,
            infinite: false
          }
          $slick_slider.slick(settings);

          // reslick only if it's not slick()
            if ($(window).width() > 995) {
              if ($slick_slider.hasClass('slick-initialized')) {
                $slick_slider.slick('unslick');
              }
              return
            }

            if (!$slick_slider.hasClass('slick-initialized')) {
              return $slick_slider.slick(settings);
            }
    }

    boot(); // Start the module
})(window);