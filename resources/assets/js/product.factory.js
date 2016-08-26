/**
 * Product Factory
 * @author John Cui <j.cui@shredz.com>
 * @description genrate a product object
 */
!(function ( window, undefined ) {
  'use strict';

  var TYPE_SHREDZ_API     = 'ShredzAPI';
  var TYPE_STRING         = 'String';
  var TYPE_OBJECT         = 'Object';
  var TYPE_MATH           = 'Math';
  var TYPE_ARRAY          = 'Array';

  /////////////////////
  //  G L O B A L S  //
  /////////////////////

  var document    = window.document;
  var String      = window[TYPE_STRING];
  var Object      = window[TYPE_OBJECT];
  var Math        = window[TYPE_MATH];
  var Array       = window[TYPE_ARRAY];
  var $$          = window[TYPE_SHREDZ_API];
  var _           = $$.helpers;
  var subscriptionOption;

  if (!$$) {
    throw new Error(TYPE_SHREDZ_API + ' not found.');
  }


  /////////////////////////
  //  U T I L I T I E S  //
  /////////////////////////

  /**
   * Get the current page slug
   * return string
   */
  function getPageSlug() {
    var slug = window.location.href.replace(/^.*?\/([\w-]*)(\/|\/[\w-]*\.[\w]+)?(\?.*|#.*)?$/i, '$1');
    return slug !== window.location.href && slug;
  }

  /**
   * Product Class
   * @class ShredzAPI.Product
   */
  function Product(_slug_) {

    //  P R I V A T E   V A R S

    var _this_ = this;
    var $product, $options, $components, $variations;
    var $activeIndex;
    var $lastPromise;
    var $withoutFallback = false;
    var $baseOption, $optionsMap = {}, $skuMap = {};
    var $optionBuilder = {}, $fromBaseOption = false;
    var $hasSubscription = false;
    var $errors;

    //  U T I L I T I E S

    /**
     * Get the identity matrix for a given option hash
     * or a partial option hash
     * @param  object   selection
     * @return object   matrix
     */
    function getOptionIdentityMatrix(selection) {
      selection = _.merge({}, $baseOption, selection);
      var mtx = {
      cols: getOptionMatrixWidth($options),
      data: []
      };
      _.each($options, function (key, option) {
      var idx = selection[key] ? option.indexOf(selection[key]) : -1;
      for (var i = 0; i < mtx.cols; i++) {
        mtx.data.push((i === idx) && 1 || 0);
      }
      });
      return mtx;
    }

    /**
     * slugify key-value pair object
     * @param  object   obj
     * @return object
     */
    function slugifyObject(obj) {
      var result = {};

      _.each(obj, function(key, value) {
        key = key.slugify();

        if (_.isArray(value)) {
          result[key] = [];
          _.each(value, function (i, v) {
            result[key].push(v.slugify());
          });

        } else {
          result[key] = value.slugify();
        }
      });

      return result;
    }

    /**
     * Find an option that represents a subscription product
     * by searching for the term subscription in the option values
     * This is an attempt to make this a dynamic procedure instaed
     * of hard-coding the value in the module
     * @param  object   options
     * @return object
     */
    function findSubscriptionOption() {
      _.each($options, function(key, values) {
        return _.each(values, function(index, value) {
          if (/subscription/i.test(value)) {
            subscriptionOption = {};
            subscriptionOption[key] = value;

            return false;
          }
        });
      });

      return subscriptionOption;
    }

    /**
     * Build a mapping form a variant's identity matrices to it's index
     * @return void
     */
    function buildSelectionMap() {
      _.each($variations, function (index, variant) {
        var mxid = getOptionIdentityMatrix(variant.selected_options);
        $optionsMap[mxid.data.join('')] = { index: index, data: mxid.data };
        $skuMap[variant.sku] = index;
        $hasSubscription = $hasSubscription || variant.subscription_plan;
      });
    }

    /**
     * Extract the base option from the product results
     * @return void
     */
    function extractBaseOption() {
      $baseOption = {};

      _.each($options, function (key, value) {
        $baseOption[key] = value[0];
      });
    }

    /**
     * Get the normalized of the option hash
     * @return integer
     */
    function getOptionMatrixWidth(options) {
      var max = 0;
      $.each(options, function (key, option) {
        max = option.length > max && option.length || max;
      });
      return max;
    }

    //  E V E N T   H A N D L E R S

    /**
     * When product details are fetched from API
     * @param  object   response    Ajax response object
     * @return this
     */
    function onProductFetched(response) {
      $errors = null;
      $product = response.data;
      $options = $product && $product.options;
      $components = $product && $product.components;
      $variations = $product && $product.variants;
      $activeIndex = $product && $product.variants.length ? 0 : -1;


      buildSelectionMap();
      extractBaseOption();
      findSubscriptionOption();

      return _this_;
    }

    /**
     * When a fetch error occurs
     * @param  ojbect   response    Ajax response object
     * @return this
     */
    function onProductFetchError(response) {
      $errors = response.errors;

      $product = $options = $components = $variations = null;
      $activeIndex = -1;

      throw new Error('Failed to fetch product');
    }

    //  A C C E S S O R S

    /**
     * Get the selected options from the current
     * active product variant
     * @return object
     */
    function getCurrentOption() {
      return _.isValidIndex($activeIndex, $variations) && $variations[$activeIndex].selected_options || null;
    }

    /**
     * Get the last promise made by the class
     * @return  Promise
     */
    function getLastPromise() {
      if ($lastPromise) {
        return $lastPromise;
      } else {
        return Promise.reject('No promises made.');
      }
    }

    /**
     * Retrieve the last error received from the api
     * @return  object
     */
    function getLastErrors() {
      return $errors;
    }

    /**
     * Get the product data payload from the last
     * successful API request
     * @return object
     */
    function getProduct() {
      return _.merge({}, $product);
    }

    /**
     * Get the product options from the last successful API request
     * @param  string   key
     * @return object
     */
    function getOptions(key) {
      var options = $product && _.merge({}, $product.options);

      return key ? options[key] : options;
    }

    /**
     * Get a meta attribute value
     * @param  string   key
     * @return object|string
     */
    function getMeta(key) {
      var meta = {};

      if ($product && $product.meta_keys) {
        _.each($product.meta_keys, function (index, key) {
          meta[key.substr(1)] = $product[key];
        });
      }

      return key ? meta[key] : meta;
    }

    /**
     * Get the complete product component values
     * from a given includes list
     * @return object
     */
    function getProductComponents(includes) {
      var components = [];

      includes = includes || [];

      for(var component, i = 0, l = includes.length; i < l; i++) {
        component = _.merge({}, $components[includes[i].sku], includes[i]);
        components.push(component);
      }

      return components;
    }

    /**
     * Get the complete product variant data
     * (with components) from a given index
     * @return object
     */
    function getProductVariant(index) {
      var variant = null;
      if (_.isValidIndex(index, $variations)) {
        variant = _.merge({}, $variations[index]);
      }

      if (variant) {
        variant.includes = getProductComponents(variant.includes);
      }

      return variant;
    }

    /**
     * Chainable method to suppress retrieving fallback
     * variants when searching by an option hash
     * @return this
     */
    function setWithoutFallback(yes) {
      $withoutFallback = _.isDefined(yes) ? yes : true;

      return _this_;
    }

    /**
     * Get the index of a given variant by it's sku
     * @param  string   sku
     * @return integer
     */
    function indexOfVariantBySku(sku) {
      return $skuMap[sku] || null;
    }

    /**
     * Get the index of a given variant by it's option hash
     * @param  object   option
     * @param  boolean  [withoutFallback = true]
     * @return integer
     */
    function indexOfVariantByOptions(option, baseOption, withoutFallback) {
      // var maxWeight = 0;
      var weightedMap = [];
      var selIndex = -1;
      var optMatrix0, optMatrix1, optMatrix2;

      // option = slugifyObject(option);
      // baseOption = slugifyObject(baseOption);

      // Single option
      optMatrix0 = getOptionIdentityMatrix(option);

      // normalize single value options
      option = _.merge({}, baseOption, option);

      // Current Option with changed option
      optMatrix1 = getOptionIdentityMatrix(option);

      if (_.isDefined($optionsMap[optMatrix1.data.join('')])) {
        selIndex = $optionsMap[optMatrix1.data.join('')].index;
      } else if (_.isUndefined(withoutFallback) || !withoutFallback) {
        // Diff option from current option and delete option with difference
        option = _.diff('strict', _.merge({}, baseOption), option);
        //
        optMatrix2 = getOptionIdentityMatrix(option);

        // console.info('%c--- Finding fallback matches ---', 'font-wegith:bold;color:#0000aa');
        _.each($optionsMap, function (key, value) {
          var matches = 0;
          for (var i = 0, l = value.data.length; i < l; i++) {
            matches += (optMatrix0.data[i] && optMatrix0.data[i] === value.data[i]) ? key.length : 0;
            matches += (optMatrix1.data[i] === value.data[i]) ? 2 : 0;
            matches += (optMatrix2.data[i] === value.data[i]) ? -1 : 0;
          }

          // if (matches > maxWeight) {
          //     maxWeight = matches;
          //     selIndex = value.index;
          // }

          weightedMap.push({
            'sku': $variations[value.index].sku,
            'index': value.index,
            'weight': matches
          });

          // console.info('%c'+$variations[value.index].sku + ': %c' + matches, 'font-weight:normal;color:#000', 'font-weight:bold');
        });

        weightedMap.sort(function(a, b) {
          if (a.weight < b.weight) {
            return 1;
          } else if (a.weight > b.weight) {
            return -1;
          } else if (a.index < b.index) {
            return -1;
          } else if (a.index > b.index) {
            return 1;
          } else {
            return 0;
          }
        });

        selIndex = weightedMap.length && weightedMap[0].index;

        // console.log('Best match: '+ $variations[selIndex].sku);
      }

      return selIndex;
    }

    /**
     * Get the index of a given variant by any of
     * either index, sku, or option hash
     * @param  mixed    mixed
     * @param  boolean  [withoutFallback = true]    Applies only when using option hash
     * @return integer
     */
    function indexOfVariant(mixed, withoutFallback) {
      var baseOption = $fromBaseOption ? $baseOption : getCurrentOption();
      var index = -1;

      // reset $fromBaseOption scope
      $fromBaseOption = false;

      if (_.isObject(mixed)) {
        // console.log('Finding variant with options: ', mixed);
        index = indexOfVariantByOptions(mixed, baseOption, withoutFallback);
      }
      else if (_.isString(mixed)) {
        // console.log('Finding variant with sku: ', mixed);
        index = indexOfVariantBySku(mixed);
      }

      return index;
    }

    /**
     * Chainable method for building up option selection
     * before calling the variant
     * @param  mixed    optionName    string or option object
     * @param  string   optionValue
     * @return this
     */
    function withOptions(optionName, optionValue) {
      if (_.isObject(optionName)) {
        $optionBuilder = {};
        _.each(optionName, function (key, value) {
          $optionBuilder[key] = value;
        });
      } else if ($options[optionName]) {
        $optionBuilder[optionName] = optionValue;
      }

      return _this_;
    }


    /**
     * Chainable method for unbuilding the option selection
     */
    function withoutOptions(keys) {

      if (_.isUndefined(keys)) {
        $optionBuilder = {};
      } else {
        keys = _.isArray(keys) && keys || Array.prototype.slice.call(arguments);

        for (var key, i = 0, l = keys.length; i < l; i++) {
          key = keys[i];
          if ($optionBuilder[key]) {
            delete $optionBuilder[key];
          }
        }
      }

      return _this_;
    }

    /**
     * Set flag to perform fallback comparisons from the base
     * option instead of the current option
     * @param  boolean    [yes = true]
     * @return this
     */
    function fromBaseOption(yes) {
      $fromBaseOption = _.isDefined(yes) ? yes : true;

      return _this_;
    }

    /**
     * Get the current active variant
     * or
     * Set the current active variant by it's index, sku, or option hash
     * @param  mixed    [mixed = null]
     * @return object
     */
    function getSetVariant(mixed) {
      var withoutFallback = $withoutFallback;
      var options = !_.isEmpty($optionBuilder) && $optionBuilder || null;
      var index;

      // reset fallback scope
      $withoutFallback = false;

      if (arguments.length) {
        if (_.isDefined(mixed)) {
          if (_.isNumber(mixed)) {
            index = mixed;
          } else {
            index = indexOfVariant(mixed, withoutFallback);
          }
        } else if (options) {
          // reset option builder
          $optionBuilder = {};

          index = indexOfVariant(options, withoutFallback);
        }

        if ($activeIndex !== index) {
          $activeIndex = _.isDefined(index, true) ? index : -1;
          // console.info('Setting active variant to: ', $activeIndex);
        } else {
          // console.warn('Current product already selected.');
        }
      }

      return getProductVariant($activeIndex);
    }

    /**
     * Get the subscription variant for the current selection
     * @return object
     */
    function getSubscriptionVariant() {
      var index = subscriptionOption && indexOfVariant(subscriptionOption, true);

      return index && getProductVariant(index);
    }

    //  A C T I O N S

    /**
     * Fetch the a product from the API via it's skug or id
     * @param  string   [slug = null]     Defaults to retrieving current page slug
     * @return this
     */
    function fetch(slug) {
      slug = slug || getPageSlug();
      $lastPromise = $$
      .getProducts(slug)
      .then(onProductFetched)
      .catch(onProductFetchError);

      return _this_;
    }

    /**
     * Initializes the current object
     * @return mixed    Returns null if not initialized
     */
    function init() {
      return _.isDefined(_slug_) && fetch(_slug_) || null;
    }

    //  P U B L I S H E D

    this.fetch            = fetch;
    this.promise          = getLastPromise;
    this.errors           = getLastErrors;
    this.data             = getProduct;
    this.options          = getOptions;
    this.withoutFallback  = setWithoutFallback;
    this.withOptions      = withOptions;
    this.withoutOptions   = withoutOptions;
    this.fromBaseOption   = fromBaseOption;
    this.indexOf          = indexOfVariant;
    this.variantAt        = getProductVariant;
    this.variant          = getSetVariant;
    this.subscriptionVariant = getSubscriptionVariant;
    this.meta             = getMeta;

    //  I N I T I A L I Z A T I O N

    return init();
  }

  ///////////////////////////////
  //  R E G I S T R A T I O N  //
  ///////////////////////////////

  $$.factory('Product', Product);

})(window);