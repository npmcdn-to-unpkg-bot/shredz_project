/**
 * Store Grid Controller
 * @author John Cui <j.cui@shredz.com>
 */
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

  /**
   * @var array     _sliders
   * @description   Persistent storage for sliders pulled from API (if any)
   */
  var _sliders = [];

  /**
   * @var  object   _categories
   * @description   Define what categories to show on the UI
   */
  var _categories = {
      unisex: {
        'weight-loss-supplements+recovery+health-wellness+build-muscle': 'Supplements',
        'performance': 'performance',
        'meal-plan': 'Diet/Training',
        'accessories+stringers+looks+tops+tanktops+t-shirts+bottoms': 'Apparel'
      },
      male: {
        'weight-loss-supplements+recovery+health-wellness+build-muscle': 'Supplements',
        'performance': 'performance',
        'meal-plan': 'Diet/Training',
        'accessories+stringers+looks+tops+tanktops+t-shirts+bottoms': 'Apparel'
      },
      female: {
        'weight-loss-supplements+recovery+health-wellness+build-muscle': 'Supplements',
        'performance': 'performance',
        'meal-plan': 'Diet/Training',
        'accessories+stringers+looks+tops+tanktops+t-shirts+bottoms': 'Apparel'
      }
    };
  /**
   * @var  object   _flgas
   * @description   Define what flags to show on the UI
   */
  // var _flags = {
  //     'under-75': 'Under $75'
  //   };

  /////////////////////
  //  H E L P E R S  //
  /////////////////////

  /**
   * Register Handlebars templates used in the shop page
   * @return void
   */
  function registerHandlebarsHelpers() {
    Handlebars.registerHelper('join', function(collection, delimiter) {
      delimiter = delimiter && delimiter.constructor.name === 'String' && delimiter || ' ';
      return collection.join(delimiter) ;
    });
    Handlebars.registerHelper('lcase', function (str) {
      return str.trim().toLowerCase();
    });
    Handlebars.registerHelper('sale', function (price, msrp) {
      var sale = Math.floor((msrp - price) / msrp * 100);
      return sale > 0 ? sale : 0;
    });
    Handlebars.registerHelper('in', function (collection, item, options) {
      if (collection[item] || collection.indexOf(item) + 1) {
        return options.fn(this);
      }
    });
    
    Handlebars.registerHelper('if-meal-plan', function (productId, id) { 
      if(productId == id){
        return true;
      } else{
        return false;
      }
    });

    Handlebars.registerHelper('if-gt', function (val1, val2, options) {
      if (val1 > val2) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });
    Handlebars.registerHelper('if-sale', function (price, msrp, min) {
      return Math.floor((msrp - price) / msrp * 100) > (arguments.length > 3 && min || 0);
    });
    Handlebars.registerHelper('if-under', function (price, value) {
      return price < value;
    });
    Handlebars.registerHelper('if-eq', function(a, b, options) {
      if(a == b){
        return true;
      } else{
        return false;
      }
    });
    Handlebars.registerHelper('each-sorted', function (context, asc, options) {
      var isArray = typeof context === 'object' && String(context.constructor).indexOf('Array') === 9;
      var keys =  isArray ? context : Object.keys(context);
      var output = '';

      if (options === undefined) {
        options = asc;
        asc = true;
      }

      if (!asc) {
        keys = keys.reverse();
      }

      if (isArray) {
        for (var i = 0, l = keys.length; i < l; i++) {
          output += output.fn.call(keys[i], {index: i, value: keys[i]});
        }
      } else {
        for (var key, i = 0, l = keys.length; i < l; i++) {
          key = keys[i];
          output += options.fn.call(context[key], {key: key, value: context[key]});
        }
      }

      return output;
    });
  }

  /**
   * Auto load Handlebars templtates defined on the DOM
   * @return void
   */
  function loadTemplates() {
    $('script[type="text/x-handlebars-template"]').each(function () {
      var $this = $(this);
      _templates[$this.attr('name')] = Handlebars.compile($this.html());
    });
  }

  /**
   * Display the product grid UI
   * @param  products   products  Context object for the template
   * @return void
   */
  function displayProductGridUI(products) {
    $('#product-grid')
    .html(_templates.products({ products: products }));
    lazyLoading();
  }

  /**
   * Initialize lazy loader
   * @return void
   */
  function lazyLoading(){
    $("img.lazy").lazyload({
      threshold : 150,
      skip_invisible : true,
      effect : "fadeIn",
      failure_limit : 10
    });
  }

  /**
   * Display product filters UI
   * @param  object   categories  Context object for the template
   * @return void
   */
  function loadProductFilters(categories) {
    $('.product-categories')
    .html(_templates.categories({ categories: categories }));
  }

  /**
   * Explode filter array into it's components
   * @param  array    [filters=null]
   * @return object
   */
  function explodeFilters(filters) {
    var pos;
    var gender;
    var flags = [];

    filters = filters || getFiltersFromHash() || [];

    if (1 + (pos = filters.indexOf('gender-all'))) {
      gender = null;
      filters.splice(pos, 1);
    }
    if (1 + (pos = filters.indexOf('gender-male'))) {
      gender = 'male';
      filters.splice(pos, 1);
    }
    if (1 + (pos = filters.indexOf('gender-female'))) {
      gender = 'female';
      filters.splice(pos, 1);
    }

    // $.each(_flags, function (val, index) {
    //   if (1 + (pos = filters.indexOf(val))) {
    //     flags.push(val);
    //     filters.splice(pos, 1);
    //   }
    // });

    return {
      gender: gender,
      flags: flags,
      categories: filters
    }
  }

  /**
   * Get filter string from a given url hash
   * @param  string   [hash = null]
   * @param  boolean  [exploded = false]
   * @return mixed    exploded ? object : array
   */
  function getFiltersFromHash(hash, exploded) {
    
    var filters;
    exploded = typeof exploded === 'undefined' && typeof hash !== 'string' && !!hash;
    hash = typeof hash === 'string' && hash || window.location.hash.replace(/^#!?\/?/, '');
    hash = hash.replace('++', '+').replace(/^\+*(.*)\+*$/, '$1');

    filters = hash.length && hash.split('+') || [];

   
    if (window.location.hash.indexOf('low-to-high') != -1 || window.location.hash.indexOf('under-50') != -1) {
      for (var i=filters.length-1; i>=0; i--) {
        if (filters[i] === 'low-to-high' || filters[i] === 'under-50') {
          filters.splice(i, 1);  
        }
      }      
    }

    // console.log(filters)

    return exploded && explodeFilters(filters) || filters;
  }

  /**
   * Set hash from filters or exploded filters
   * @param  mixed  filters   array of filters or xfilters object
   * @return void
   */
  function setHashFromFilters(filters) {
    var xfilters;

    if (typeof filters === 'object' && filters.categories) {
      xfilters = filters;

      filters = [].concat(xfilters.categories, xfilters.flags);

      xfilters.gender && filters.unshift('gender-' + xfilters.gender);
    }

    filters = filters.length && $.unique(filters).join('+') || '';
    filters = filters.replace('++', '+').replace(/^\+*(.*)\+*$/, '$1');

    window.location.hash = filters;
  }

  /////////////////////////
  //  C O M P O S E R S  //
  /////////////////////////

  /**
   * Fade a group of elemets in with staggering
   * @comment Combustion Group Implementation
   * @return void
   */
  function fadeMeIn(offset, elm) {
    setTimeout(function(){
      $(elm).css({
        "opacity":"1"
      });

    },20 * offset);
  }

  /**
   * Filter the product grid given a filter selection
   * @param  array    filters
   * @param  boolean  animate
   * @return array
   */
  function filterProducts(filters, animate) {

    $('#product-grid div.item-product').removeClass("visible-product");


    var xfilters = explodeFilters($.unique(filters));

    var allSelector = '#product-grid div.item-product';
    var baseGender = [];
    var baseQuery = '';
    var $active;

    // build AND component
    // gender + sale + under-75
    baseQuery = $.map(xfilters.flags, function (value) {
      return typeof value === 'string' ? '[data-flags~="' + value + '"]' : null;
    }).join('');

    baseQuery
    = xfilters.gender
    &&  [
          allSelector + '[data-gender~="' + xfilters.gender + '"]' + baseQuery,
          allSelector + '[data-gender~="unisex"]' + baseQuery
        ].join(', ')
    || allSelector + baseQuery;

    $active = $(baseQuery);

    baseQuery = $.map(xfilters.categories, function (value) {
      return typeof value === 'string' ? '[data-categories~="' + value + '"]' : null;
    }).join(', ');

    if (xfilters.categories.length) {
      $active = $active.filter(baseQuery);
    }

    $('#product-grid div.item-product').hide();
    $('#product-grid div.item-product').hide();

    $('.product-filters').slideDown(200);
    $active.fadeIn(200).addClass("visible-product");

    activateGenderUI(xfilters.gender);
    activateCategoryItemsUI(xfilters.categories);
    // activateFlagItemsUI(xfilters.flags);

    $(window).trigger('scroll');

    return $active;
  }

  /**
   * Scroll the product grid into view
   * @param  boolean  animate
   * @return void
   */
  function scrollProductsToView(animate) {
    var $html = $('html, body');
    var scrollTop = $('.gender-nav').position().top - 92; // 92px is height of sticky header

    if (animate) {
      $html.animate({ scrollTop: scrollTop});
    } else {
      $html.scrollTop( scrollTop );
    }
  }

  /**
   * Activate the UI specified by gender
   * @param  string   gender
   * @return void
   */
  function activateGenderUI(gender) {
    var categories = $.extend({}, _categories.unisex);

    $('.nav-item[data-gender]')
    .removeClass('active');
    $('.product-filters')
    .removeClass('gender-male')
    .removeClass('gender-female')

    if (gender === 'male') {
      $('.product-filters').addClass('gender-male');
      $('.nav-item[data-gender="male"]').addClass('active');
      $.extend(categories, _categories.male);
    } else if (gender === 'female') {
      $('.product-filters').addClass('gender-female');
      $('.nav-item[data-gender="female"]').addClass('active');
      $.extend(categories, _categories.female);
    } else {
      $('.nav-item[data-gender=""]').addClass('active');
      $.extend(categories, _categories.female, _categories.male);
    }

    loadProductFilters(categories);
  }

  /**
   * Activate the UI specified by the categories list
   * @param  array    categories
   * @return void
   */
function activateCategoryItemsUI(categories) {
    $('.product-categories .product-category.active').removeClass('active');
    $.each(categories, function (idx, category) {
      if( category === "accessories" ){
        $('.product-categories .product-category[data-category^="accessories"]').addClass('active');
      } else if (category === "weight-loss-supplements"){
        $('.product-categories .product-category[data-category^="weight-loss-supplements"]').addClass('active');
      } else {
        $('.product-categories .product-category[data-category="'+category+'"]').addClass('active');
      }


    });
  }


  /**
   * Activate the UI specified by the flags list
   * @param  array    flags
   * @return void
   */
  // function activateFlagItemsUI(flags) {
  //   $('.product-flags .product-flag.active').removeClass('active');
  //   $.each(flags, function (idx, flag) {
  //     $('.product-flags .product-flag[data-flag="'+flag+'"]').addClass('active');
  //   });
  // }

  /**
   * Build the DOM structure for the slider carousel
   * @return Promise
   */
  function buildSliderCarousel() {
    var $carousel = $('.carousel-wrapper');

    return new Promise(function (resolve) {
      $carousel
      .on('init', resolve)
      .html(_templates.sliders({ sliders: _sliders }))
      .slick({
        infinite: true,         // keep scrolling beyond number of images
        variableWidth: true,    // use css rules for image containers
        centerMode: true,       // show partial image next to current one
        autoplay: true,         //
        autoplaySpeed: 5000,    //
        centerPadding: '60px',   //
        responsive: [
          {
            breakpoint: 1280,
            settings: {
              variableWidth: false,    // use css rules for image containers
            }
          },
          {
            breakpoint: 600,
            settings: {
              variableWidth: false,    // use css rules for image containers
              centerPadding: '6%',   //
            }
          }
        ]
      })
      .hide();
    })
    .then(function () {
      $carousel.slick('slickNext');
    })
  }

  /**
   * Show the carousel
   * @return Promise
   */
  function showCarousel() {
    var $carousel = $('.carousel-wrapper');
    var initialized, imagesLoaded;

    if (!$carousel.is(':visible') && _sliders.length) {
      initialized = buildSliderCarousel();
    } else {
      initialized = Promise.resolve();
    }

    imagesLoaded = new Promise(function (resolve) {
      $carousel
      .imagesLoaded()
      .done(resolve);
    });

    return Promise.all([
      initialized,
      imagesLoaded
    ])
    .then(function () {
      $carousel.show();
    });
  }

  /**
   * Hide the carousel
   * @return void
   */
  function hideCarousel() {
    var $carousel = $('.carousel-wrapper');

    $carousel.hide();
  }

  ///////////////////////
  //  H A N D L E R S  //
  ///////////////////////

  /**
   * Destroy isotope
   * @param  none
   * @return void
   */

  function destroyIsotope(){
    $(".products-container").isotope("destroy");
    $(".sort li a").removeClass("active");
    $(".sort .show-all").addClass("active");
    $(".products-container").removeClass("isotope");
  }
  /**
   * When products are loaded from the API
   * @param  object   Ajax response object
   * @return void
   */
  function onProductsLoaded(response) {
    // console.log(response.data);
    displayProductGridUI(response.data);

  }

  /**
   * When the store information is loaded from the API
   * @param  object   Ajax response object
   * @return void
   */
  function onStoreInfoLoaded(res) {
    _sliders = res.data.sliders;
  }

  /**
   * When all API requests are completed
   * @return void
   */
  function onAllApiDataLoaded() {
    $(".spinner").remove();
  }

  /**
   * When a product grid item is clicked
   * @param  event    e
   * @return void
   */
  function onItemProductClicked(e) {
    var href = $(this).data('href');

    window.location = href;
  }

  /**
   * When the location hash value changes
   * @param  event    e
   * @return void
   */
  function onHashChanged(e) {
    var isEvent = !!e.preventDefault;     // detecte if function called as an event
    var filters = getFiltersFromHash();
    // onHashChanged is called as a non-event only when
    // products are loaded for the first time
    // The is the place where we should determine whether
    // or not to show or hide the carousel
    if (isEvent) {
      // hideCarousel();
      scrollProductsToView();
    } else if (!filters.length) {
      // showCarousel();
    }

    filterProducts(filters, !!e.preventDefault);

    if (window.location.hash.indexOf('low-to-high') != -1) {
      $(".sort li a").removeClass("active");
      $(".low-to-high").addClass("active");
      $(".products-container").addClass("isotope");
      sortingHandler("lowToHigh", true);
      $(window).trigger('resize');   
    }

    // if (window.location.hash.indexOf('under-50') != -1) {
    //   $(".sort li a").removeClass("active");
    //   $(".products-container").addClass("isotope");
    //   filteringHandler();   
    // }
   
  }

  /**
   * When the gender nav item is clicked
   * @param  event    e
   * @return void
   */
  function onGenderNavItemClicked(e) {
    if ($(".products-container").hasClass('isotope')) { 
      destroyIsotope();
    }
    setGenderFilter($(this).data('gender'));
  }

  /**
   * When a product category is clicked
   * @param  event    e
   * @return void
   */
  function onProductCategoryClicked (e) {
    if ($(".products-container").hasClass('isotope')) { 
      destroyIsotope();
    }
    var $this = $(this);
    var category = $this.data('category');
    var xfilters = getFiltersFromHash(true);
    // if (xfilters.categories.indexOf(category)+1) {
    //   removeCategory(category);
    // } else {
    //   addCategory(category);
    // }
    
    var activeGender = $('.nav-item.active').attr("data-gender");
    
    if (activeGender != ''){
      window.location.hash =  'gender-' + activeGender;
    } else{
      window.location.hash = '';
    }

    addCategory(category);
  }

  /**
   * When a product flag is clicked
   * @param  event    e
   * @return void
   */
  function onProductFlagClicked (e) {
    var $this = $(this);
    var flag = $this.data('flag');
    var xfilters = getFiltersFromHash(true);

    if ($(".products-container").hasClass('isotope')) { 
      destroyIsotope();
    }

    if (xfilters.flags.indexOf(flag)+1) {
      removeFlag(flag);
    } else {
      addFlag(flag);
    }
  }

  /**
   * When the document is ready
   * @param  event    e
   * @return void
   */
  function onDocumentReady(e) {

    $products = $(".products-container");

    $(".sort-mobile").on("click", function(){
      $(".sorting-list").slideToggle();
    });

    $(".sort .featured").on("click",  function(){
      $products.addClass("isotope");
      $(".sort li a").removeClass("active");
      $(".featured").addClass("active");
      // if($products.find(".featured-sale.visible-product").length>0){
      //   $products.isotope({filter: '.featured-sale.visible-product'});
      // }
      sortingHandler("featured", false);
    })

    $(".sort .show-all").on("click", function(){
      $(".sort li a").removeClass("active");
      $(".show-all").addClass("active");
      $products.isotope({filter: '.visible-product'}); 
    })

    $(".sort").on("click", ".low-to-high", function(){
      $(".sort li a").removeClass("active");
      $(".low-to-high").addClass("active");
      $products.addClass("isotope");
      sortingHandler("lowToHigh", true);
    });


    $(".sort").on("click", ".high-to-low", function(){
      $(".sort li a").removeClass("active");
      $(".high-to-low").addClass("active");
      $products.addClass("isotope");
      sortingHandler("highToLow", false);
    })
  }

  ///////////////////////
  //  H A N D L E R S  //
  ///////////////////////

  /**
   * Sort visible products
   * @return void
   */
  function sortingHandler(method, ascending){
    $products = $(".products-container");
    $products.isotope({
      itemSelector: '.item-product.visible-product',
      getSortData: {
        lowToHigh: function( $item ) {
          var $price = $($item).data('price');
          // convert to number
          return parseFloat( $price );
        },
        highToLow: function( $item ) {
          var $price = $($item).data('price');
          // convert to number
          return parseFloat( $price );
        },
        featured: function($item){
          var $featured = $($item).data('featured');
          return $featured; 
        }
      }
    });
    $products.isotope({
      // transitionDuration: 0,
      filter: "*",
      sortBy: method,
      sortAscending : ascending
    });
  } 


  // function filteringHandler(){

  //   $products = $(".products-container");
  //   $products.isotope({
  //     itemSelector: '.item-product.visible-product',
  //   });

  //   // filter functions
  //   var filterFns = {
  //     // show if number is greater than 50
  //     under50: function($item) {
  //       var $price = $($item).data('price');
  //       return parseInt( $price, 10 ) < 50;
  //     }
  //   };

  //   // bind filter button click
    
  //     var filterValue = "under50";
  //     // use filterFn if matches value
  //     filterValue = filterFns[ filterValue ] || filterValue;
  //     $products.isotope({ filter: filterValue });
  // } 

  /////////////////////
  //  A C T I O N S  //
  /////////////////////

  /**
   * Action to request product listing form the API
   * @return Promise
   */
  function requestProducts() {
    return ShredzAPI
    .getProducts({'pageSize' : 1000})
    .then(onProductsLoaded);
  }

  /**
   * Action to request store information from the API
   * @return Promise
   */
  function requestStoreInfo() {
    return ShredzAPI
    .getStore()
    .then(onStoreInfoLoaded);
  }

  /**
   * Action to group desired request for information from the API
   * @return Promise
   */
  function requestApiData() {
    return Promise.all([
      requestStoreInfo(),
      requestProducts()
    ])
    .then(onHashChanged);
  }

  /**
   * Action to set the gender as a filter
   * @param  string   gender
   * @return void
   */
  function setGenderFilter(gender) {
    var xfilters = getFiltersFromHash(true);
    xfilters.gender = gender;
    xfilters.categories = [];
    setHashFromFilters(xfilters);
  }

  /**
   * Action to add a category to the product grid filter
   * @param  string   category
   * @return void
   */
  function addCategory(category) {
    var xfilters = getFiltersFromHash(true);
    var found = xfilters.categories.indexOf(category);

    !(found+1) && xfilters.categories.push(category) && setHashFromFilters(xfilters);
  }

  /**
   * Action to remove a category from the product grid filter
   * @param  string   category
   * @return void
   */
  function removeCategory(category) {
    var xfilters = getFiltersFromHash(true);
    var found = xfilters.categories.indexOf(category);

    (found+1) && xfilters.categories.splice(found, 1);

    setHashFromFilters(xfilters);
  }

  /**
   * Action to add a flag from the product grid filter
   * @param stirng    flag
   * @return void
   */
  function addFlag(flag) {
    var xfilters = getFiltersFromHash(true);
    var found = xfilters.flags.indexOf(flag);

    !(found+1) && xfilters.flags.push(flag) && setHashFromFilters(xfilters);
  }

  /**
   * Action to remove a flag from the product grid filter
   * @param string    flag
   * @return void
   */
  function removeFlag(flag) {
    var xfilters = getFiltersFromHash(true);
    var found = xfilters.flags.indexOf(flag);

    (found+1) && xfilters.flags.splice(found, 1);

    setHashFromFilters(xfilters);
  }

  /**
   * Action to sort the product grid items by price
   * Set to null to sort by it's predefined order
   * @param  boolean    [asc = null]
   * @return void
   */
  function sortProducts(asc) {
    var $grid = $('#product-grid .product');
    var dataAttr = (asc === undefined) ? 'sort-id' : 'price';

    $grid.sort(function (elm1, elm2) {
      var data1 = window.parseFloat($(elm1).data(dataAttr));
      var data2 = window.parseFloat($(elm2).data(dataAttr));

      if (asc !== false) {
        return (data2 > data1) ? -1 : (data1 > data2) ? 1 : 0;
      } else {
        return (data1 > data2) ? -1 : (data2 > data1) ? 1 : 0;
      }
    }).detach().appendTo('#product-grid');
  }

  /**
   * Action to bind DOM events with an event handler
   * @return void
   */
  function bindEvents() {
    // Bind hash changes to
    $(window).on('hashchange', onHashChanged);
    $(document).on('ready', onDocumentReady);
    $('.gender-nav').on('click', '.nav-item', onGenderNavItemClicked);
    $('.product-categories').on('click', '> .product-category', onProductCategoryClicked);
    $('.product-flags').on('click', '> .product-flag', onProductFlagClicked);
    $('#product-grid').on('click', '.item-product', onItemProductClicked);
  }

  /**
   * Action to bootstrap the module
   * @return void
   */
  function boot() {
    registerHandlebarsHelpers();
    loadTemplates();
    bindEvents();
    // Start pulling the data from the API
    requestApiData()
    .then(onAllApiDataLoaded);
  }

  ///////////////////////////////////
  //                               //
  //  I N I T I A L I Z A T I O N  //
  //                               //
  ///////////////////////////////////

  boot(); // Start the module

})(window);
