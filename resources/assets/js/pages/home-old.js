$(document).on("ready", function() {

    homeInit();
});//document ready

//various setup code to run
function homeInit()
{
    //slick carousel assets
    // for(var i = 0;i < 20;i++)
    // {
    //     var n = i+1;
    //     if(n < 10)
    //     {
    //         n = "0"+(i+1);
    //     }
    //     var l = publicAssetUrl + "images/" + n + "_shredzhome_transformation.jpg";
    //     $(".transformations .con").append(
    //         '                <a href=" ' + reviewsUrl + '"> <img class="transformation" src="'+l+'"> </a> '
    //     );
    // }

    var slidesToScroll = 2;//slick variable

    $(".con:eq(0)").slick({
        infinite : true,
        slidesToShow : 4,
        slidesToScroll : 1,
        swipe:true,
        draggable : false,
        autoplay : true,
        autoplaySpeed : 5000,
        variableWidth: true,
        centerMode: true
    });

    // $(".reviews:eq(0)").slick({
    //     infinite : true,
    //     slidesToShow : 6,
    //     slidesToScroll : 1,
    //     swipe:true,
    //     draggable : false,
    //     autoplay : false,
    //     autoplaySpeed : 2000,
    //     variableWidth: true,
    //     centerMode: true
    // });
    $(".reviews").slick({
        infinite: true,
        slidesToShow : 7,
        slidesToScroll : 1,
        swipe: true,
        draggable: true,
        centerMode: true,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true
          }
        },
      ]
    })
}



// Minified version of isMobile included in the HTML since it's <1kb
(function(i){var e=/iPhone/i,n=/iPod/i,o=/iPad/i,t=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,r=/Android/i,d=/BlackBerry/i,s=/Opera Mini/i,a=/IEMobile/i,b=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,h=RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),c=function(i,e){return i.test(e)},l=function(i){var l=i||navigator.userAgent;this.apple={phone:c(e,l),ipod:c(n,l),tablet:c(o,l),device:c(e,l)||c(n,l)||c(o,l)},this.android={phone:c(t,l),tablet:!c(t,l)&&c(r,l),device:c(t,l)||c(r,l)},this.other={blackberry:c(d,l),opera:c(s,l),windows:c(a,l),firefox:c(b,l),device:c(d,l)||c(s,l)||c(a,l)||c(b,l)},this.seven_inch=c(h,l),this.any=this.apple.device||this.android.device||this.other.device||this.seven_inch},v=i.isMobile=new l;v.Class=l})(window);


// My own arbitrary use of isMobile, as an example
(function () {
    var MOBILE_SITE = '/mobile/index.html', // site to redirect to
        NO_REDIRECT = 'noredirect'; // cookie to prevent redirect

    // I only want to redirect iPhones, Android phones and a handful of 7" devices
    if (isMobile.any) {
        $(".review,.transformation").width($("body").width());
        $(".review h2").width($("body").width() *.9).css({
            "margin-left":"auto",
            "margin-right":"auto",
        });
        ismobile = true;

    }
    else
    {
        ismobile = false;
        //$(".review").width($("body").width());
    }
    $(".reviews")      
    .on('afterChange init', function(event, slick, direction){            
         // find current slide   
        for (var i = 0; i < slick.$slides.length; i++){     
            var $slide = $(slick.$slides[i]);     
            if ($slide.hasClass('slick-current')) {   
                $slide.find("a").attr({"href" : "/results/"});
                break;        
            }     
        }     
    })     
    .on('beforeChange', function(event, slick) {            
    // remove all href     
        slick.$slides.find("a").removeAttr("href");    
    })
})();

!(function (window, undefined) {

    var TYPE_SHREDZ_API     = 'ShredzAPI';
    var TYPE_JQUERY         = 'JQuery';
    var TYPE_STRING         = 'String';
    var TYPE_OBJECT         = 'Object';
    var TYPE_MATH           = 'Math';
    var TYPE_HANDLEBARS     = 'Handlebars';

    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var document = window.document;
    var $ = window[TYPE_JQUERY] || window.$ || {};
    var String      = window[TYPE_STRING];
    var Object      = window[TYPE_OBJECT];
    var Math        = window[TYPE_MATH];
    var ShredzAPI   = window[TYPE_SHREDZ_API];
    var Handlebars  = window[TYPE_HANDLEBARS];

    var _templates = {};
    var _filters = [];

    /////////////////////
    //  H E L P E R S  //
    /////////////////////

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
        Handlebars.registerHelper('limit', function (arr, limit) {
          if (!_.isArray(arr)) { return []; } // remove this line if you don't want the lodash/underscore dependency
          return arr.slice(0, limit);
        });  

        // Handlebars.registerHelper('grouped_each', function(every, context, options) {
        //     var out = "", subcontext = [], i;
        //     if (context && context.length > 0) {
        //         for (i = 0; i < context.length; i++) {
        //             if (i > 0 && i % every === 0) {
        //                 out += options.fn(subcontext);
        //                 subcontext = [];
        //             }
        //             subcontext.push(context[i]);
        //         }
        //         out += options.fn(subcontext);
        //     }
        //     return out;
        // });
    }

    function loadTemplates() {
        $('script[type="text/x-handlebars-template"]').each(function () {
            var $this = $(this);
            _templates[$this.attr('name')] = Handlebars.compile($this.html());
        });
    }

    function loadProductGrid(products) {
        // var rows=0;
        // if($(window).width()<=768){
        //     $('#featured-product-grid')
        //     .html(_templates.products({ products: products, rows: 2 }));
        // }
        // else{
            $('#featured-product-grid')
            .html(_templates.products({ products: products /*, rows: 4*/ }));
        // }
    }

    function onProductsLoaded(response) {
        loadProductGrid(response.data);
    }


    function requestProducts() {
        return ShredzAPI
        .getProducts({ pageSize: 8})
        .then(onProductsLoaded);
    }

    function requestApiData() {
        return Promise.all([
            requestProducts()
        ])
    }

    function onAllApiDataLoaded() {
        $(".spinner").remove();
    }

    function boot() {
        registerHandlebarsHelpers();
        loadTemplates();
        // Start pulling the data from the API
        requestApiData()
        .then(onAllApiDataLoaded);
    }

    boot(); // Start the module
})(window);
