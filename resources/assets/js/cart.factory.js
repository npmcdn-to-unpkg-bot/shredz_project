/**
 * Cart Factory
 * @author John Cui <j.cui@shredz.com>
 * @description genrate a cart object
 */
!(function ( window, undefined ) {
  'use strict';

  var TYPE_SHREDZ_API     = 'ShredzAPI';
  var TYPE_STRING         = 'String';
  var TYPE_OBJECT         = 'Object';
  var TYPE_MATH           = 'Math';
  var TYPE_LOCALSTORAGE   = 'localStorage';
  var TYPE_JSON           = 'JSON';
  var LOCALSTORAGE_KEY    = '__shredz_cart__';

  var E_EVENT_NAME        = 'Event name must be a string.';
  var E_EVENT_HANDLER     = 'Event handler must be a callable function.';

  var EVENT_SYNCING       = 'syncing';
  var EVENT_SYNCD         = 'syncd';
  var EVENT_SYNC_ERROR    = 'syncerror';


  /////////////////////
  //  G L O B A L S  //
  /////////////////////

  // var document    = window.document;
  var localStorage = window[TYPE_LOCALSTORAGE];
  var JSON        = window[TYPE_JSON];
  // var String      = window[TYPE_STRING];
  // var Object      = window[TYPE_OBJECT];
  var Math        = window[TYPE_MATH];
  var $$          = window[TYPE_SHREDZ_API];
  var _           = $$.helpers;

  if (!$$) {
    throw new Error(TYPE_SHREDZ_API + ' not found.');
  }

  /**
   * Cart Class
   * @class ShredzAPI.Cart
   */
  function Cart() {

    //  P R I V A T E   V A R S

    var _this_ = this;
    var $empty = {'contact_email':'','contact_handle':'','contact_phone':'','contact_firstname':'','contact_lastname':'','billing_firstname':'','billing_lastname':'','billing_address':'','billing_address2':'','billing_city':'','billing_state':'','billing_zip':'','billing_country':'','billing_phone':'','billing_email':'','shipping_firstname':'','shipping_lastname':'','shipping_address':'','shipping_address2':'','shipping_city':'','shipping_state':'','shipping_zip':'','shipping_country':'','shipping_phone':'','currency':'USD','tax_rate':0,'shipping_fee':0,'handling_fee':0,'item_count':0,'sub_total':0,'discounted_shipping':0,'discount_total':0,'tax':0,'total':0,'status':0,'uid':'','discounts':[],'items':[],'subscription':false};
    var $cart;
    var $lastPromise;
    var $lastSync = 0;
    var $meta = {};
    var $listeners = [];
    var $waitTime = 500; // ms
    var $resync;
    var $errors;
    var $paymentToken;

    //  U T I L I T I E S

    /**
     * Extract and normalize contact details
     * @param  object     [obj]
     * @return object
     */
    function extractContactData(obj) {
      obj = _.isDefined(obj) ? obj : $cart || {};

      return {
        email       : obj['contact_email'],
        fullName    : (obj['contact_firstname'] + ' ' + obj['contact_lastname']).trim(),
        firstName   : obj['contact_firstname'],
        lastName    : obj['contact_lastname'],
        instagram   : obj['contact_handle'],
        phone       : obj['contact_phone']
      };
    }

    /**
     * Compose submittable contact details
     * from it's normalized form
     * @param  object     data
     * @return object
     */
    function composeContactData(data) {
      return _.isObject(data) && {
        contact_email       : data['email'] || '',
        contact_firstname   : data['firstName'] || '',
        contact_lastname    : data['lastName'] || '',
        contact_handle      : data['instagram'] || '',
        contact_phone       : data['phone'] || ''
      }
    }

    /**
     * Extract and normalize shipping details
     * @param  object       [obj]
     * @return object
     */
    function extractShippingData(obj) {
      obj = _.isDefined(obj) ? obj : $cart || {};

      return {
        fullName    : (obj['shipping_firstname'] + ' ' + obj['shipping_lastname']).trim(),
        firstName   : obj['shipping_firstname'],
        lastName    : obj['shipping_lastname'],
        address     : obj['shipping_address'],
        address2    : obj['shipping_address2'],
        city        : obj['shipping_city'],
        state       : obj['shipping_state'],
        zip         : obj['shipping_zip'],
        country     : obj['shipping_country'],
        phone       : obj['shipping_phone']
      };
    }

    /**
     * Compose submittable shipping details
     * from it's normalized form
     * @param  object       data
     * @return object
     */
    function composeShippingData(data) {
      return _.isObject(data) && {
        shipping_firstname    : data['firstName'] || '',
        shipping_lastname     : data['lastName'] || '',
        shipping_address      : data['address'] || '',
        shipping_address2     : data['address2'] || '',
        shipping_city         : data['city'] || '',
        shipping_state        : data['state'] || '',
        shipping_zip          : data['zip'] || '',
        shipping_country      : data['country'] || '',
        shipping_phone        : data['phone'] || ''
      };
    }

    /**
     * Extract and normalize billing details
     * @param  object       [obj]
     * @return object
     */
    function extractBillingData(obj) {
      obj = _.isDefined(obj) ? obj : $cart || {};

      return {
        fullName    : (obj['billing_firstname'] + ' ' + obj['billing_lastname']).trim(),
        firstName   : obj['billing_firstname'],
        lastName    : obj['billing_lastname'],
        address     : obj['billing_address'],
        address2    : obj['billing_address2'],
        city        : obj['billing_city'],
        state       : obj['billing_state'],
        zip         : obj['billing_zip'],
        country     : obj['billing_country']
      };
    }

    /**
     * Compose submittable billing details
     * from it's normalized form
     * @param  object       data
     * @return object
     */
    function composeBillingData(data) {
      return _.isObject(data) && {
        billing_firstname    : data['firstName'] || '',
        billing_lastname     : data['lastName'] || '',
        billing_address      : data['address'] || '',
        billing_address2     : data['address2'] || '',
        billing_city         : data['city'] || '',
        billing_state        : data['state'] || '',
        billing_zip          : data['zip'] || '',
        billing_country      : data['country'] || ''
      };
    }

    /**
     * Extract and normalize item details
     * @param  object       [obj]
     * @return object
     */
    function extractItemsData(obj) {
      obj = _.isDefined(obj) ? obj : $cart || {};
      var obj_items = Array.isArray(obj.items) ? obj.items : ( (typeof obj.items === "object") && (obj.items !== null) ? obj.items : {} );
      return _.map(obj_items, function (index, item) {
        var item_discounts = item.discounts ? item.discounts : {};
        var discounts = _.map(item_discounts, function (i, discount) {
          var detail = obj.discounts ? obj.discounts[discount.code] : {};

          return {
            code          : discount.code,
            name          : detail.terms.name,
            applied_value : discount.applied_value,
            display       : detail.display && (detail.display == 1 && 'code') || (detail.display == 2 && 'name') || null
          };
        });

        return {
          sku             : item['sku'],
          name            : item['name'],
          asset           : item['asset_location'] + 'primaryimage_new.png',
          isSubscription  : item['is_subscription'],
          msrp            : item.msrp,
          price           : item.price || item.msrp,
          quantity        : item.quantity,
          total           : item.total,
          discounts       : discounts
        };
      });
    }

    /**
     * Extract and normalize discounts
     * @param  object       [obj]
     * @return object
     */
    function extractDiscountsData(obj) {
      obj = _.isDefined(obj) ? obj : $cart || {};
      var obj_discounts = Array.isArray(obj.discounts) ? obj.discounts : ( (typeof obj.discounts === "object") && (obj.discounts !== null) ? obj.discounts : {} );
      return _.map(obj_discounts, function (code, discount) {
        discount.display = discount.display && (discount.display == 1 && 'code') || (discount.display == 2 && 'name') || null;
        if (discount.type === 'deduction') {
          discount.applicable_value = discount.value;
          if (discount.applied_value === discount.applicable_value) {

          } else if (discount.applicable_value > discount.applied_value) {
            discount.remaining_value = discount.applicable_value - discount.applied_value;
          } else {
            discount.remaining_value = 0;
          }

          obj.discountRemaining += discount.remaining_value;
        } else {
          discount.applicable_value = discount.remaining_value = null;
        }


        return discount;
      });
    }

    /**
     * Transform cart raw data format into
     * a normzlied object form
     * @param  object       [obj]
     * @return object
     */
    function transformRawCartData(obj) {
      var cart;

      obj = _.isDefined(obj) ? obj : $cart || {};

      cart = {
        itemCount       : obj['item_count']                           || 0,
        subTotal        : obj['sub_total']                            || 0,
        discountTotal   : obj['discount_total']                       || 0,
        discountedTotal : (obj['sub_total'] - obj['discount_total'])  || 0,
        handlingFee     : obj['handling_fee']                         || 0,
        shippingFee     : obj['shipping_fee']                         || 0,
        taxRate         : obj['tax_rate']                             || 0,
        tax             : obj['tax']                                  || 0,
        total           : obj['total']                                || 0,
        items           : extractItemsData(),
        contact         : extractContactData(),
        shipping        : extractShippingData(),
        billing         : extractBillingData(),
        discounts       : extractDiscountsData(),
        meta            : meta()
      };

      return cart;
    }

    //  A C C E S S O R S

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
     * Get the raw cart data
     * @return object
     */
    function getCart() {
      return $cart;
    }

    /**
     * Add an item to the cart
     * @async
     * @param  string   sku
     * @param  integer  quantity
     * @return this
     */
    function addItem(sku, quantity) {
      quantity = _.isNumber(quantity) ? quantity : 1;

      $lastPromise = $$
      .postCartItems({
        sku: sku,
        quantity: quantity
      })
      .then(onSyncd);

      return _this_;
    }

    /**
     * Remove item from cart by it's sku
     * @param  string   sku
     * @return this
     */
    function removeItem(sku) {
      $lastPromise = $$
      .deleteCartItems({
        sku: sku
      })
      .then(onSyncd);

      return _this_;
    }

    /**
     * Update the quantity of an item in the cart
     * @async
     * @param  string   sku
     * @param  integer  quantity
     * @return this
     */
    function updateItem(sku, quantity) {
      quantity = _.isNumber(quantity) ? quantity : 1;

      $lastPromise = $$
      .updateCartItems({
        sku: sku,
        quantity: quantity
      })
      .then(onSyncd);

      return _this_;
    }

    /**
     * Clear all cart items
     * @async
     * @return this
     */
    function clearItems() {
      $lastPromise = $$
      .deleteCartItems()
      .then(onSyncd);

      return _this_;
    }

    /**
     * Get or set a list of cart items
     * @async  setter
     * @param  array  details
     * @return array|this
     */
    function items(details) {
      // TODO: Sync details for items;

      return $cart.items;
    }

    /**
     * Get last errors stored
     * @return object
     */
    function getErrors() {
      return $errors;
    }

    /**
     * Get a normalized form of the cart
     * @param  object   details
     * @return object
     */
    function details() {
      return transformRawCartData();
    }

    /**
     * Get or set the contact details
     * @async  setter
     * @param  object   details
     * @return object|this
     */
    function contact(details) {

      if (_.isObject(details)) {
        $lastPromise = $$
        .postCartDetails(composeContactData(details), { validates: 'contact' })
        .then(onSyncd);

        return _this_;
      }

      return extractContactData();
    }

    /**
     * Get or set the shipping details
     * @async  setter
     * @param  details
     * @return object|this
     */
    function shipping(details) {
      if (_.isObject(details)) {
        $lastPromise = $$
        .postCartDetails(composeShippingData(details), { validates: 'shipping' })
        .then(onSyncd);

        return _this_;
      }

      return extractShippingData();
    }

    /**
     * Get or set the billing details
     * @async  setter
     * @param  details
     * @return object|this
     */
    function billing(details) {
      if (_.isObject(details)) {
        $lastPromise = $$
        .postCartDetails(composeBillingData(details), { validates: 'billing' })
        .then(onSyncd);

        return _this_;
      }

      return extractBillingData();
    }

    /**
     * Get or set meta information for the cart
     * @param  string     key
     * @param  mixed      [value]
     * @return mixed
     */
    function meta(key, value) {
      if (_.isDefined(value)) {
        $meta[key] = value;
        storeCartToLocalStorage();
        return _this_;
      }

      return _.isDefined(key, true) ? $meta[key] || null : _.clone($meta);
    }

    /**
     * Authorize cart for checkout
     * Performs validations to determine checkout status
     * @return boolean
     */
    function authorize() {
      $paymentToken = null; // clear the payment token
      $lastPromise = $$
      .getCartCheckout()
      .then(function (response) {
        if (response.errors) {
          $errors = response.errors;
          throw new Error('Cart validation failed. User the `.errors()` method to see the validation errors.');
        } else if (response.data && response.data.token) {
          $paymentToken = response.data.token;
        }

        return $paymentToken;
      });

      return _this_;
    }

    /**
     * Checkout the cart with a payment nonce
     * @param  object   billing
     * @param  string   nonce
     * @param  string   deviceData    JSON string
     * @return this
     */
    function checkout(billing, nonce, deviceData) {
      if (!$paymentToken || $paymentToken.length === 0) {
        return Promise.reject(new Error('Cart not authorized for checkout. Use the `.authorize()` method to obtain authorization.'));
      } else {
        $lastPromise = $$
        .postCartCheckout(_.merge({
          nonce: nonce,
          device: deviceData,
          token: $paymentToken
        }, composeBillingData(billing)))
        .then(function (response) {
          if (response.errors) {
            $errors = response.errors;
            throw new Error('Cart validation failed. User the `.errors()` method to see the validation errors.');
          }

          return response;
        })
        .then(onSyncd);
      }

      return _this_;
    }

    /**
     * Attach a discount (coupon) code to the cart
     * @async
     * @param  string   code
     * @return this
     */
    function addCoupon(code) {
      if (_.isDefined(code)) {
        $lastPromise = $$
        .postCartDiscounts({ code: code })
        .then(onSyncd);
      }

      return _this_;
    }

    /**
     * Detach a discount (coupon) code from the cart
     * @async
     * @param  string   code
     * @return this
     */
    function removeCoupon(code) {
      if (_.isDefined(code)) {
        $lastPromise = $$
        .deleteCartDiscounts({ code: code })
        .then(onSyncd);
      }

      return _this_;
    }

    /**
     * Clear all coupons from the cart
     * @async
     * @return this
     */
    function clearCoupons() {
      $lastPromise = $$
      .deleteCartDiscounts()
      .then(onSyncd);

      return _this_;
    }

    /**
     * Register event listener
     * @param  string     event
     * @param  function   handler
     * @return this
     */
    function registerEventListener(event, handler) {
      if (!_.isString(event)) {
        throw new Error(E_EVENT_NAME);
      }

      if (!_.isFunction(handler)) {
        throw new Error(E_EVENT_HANDLER);
      }

      if (!$listeners[event]) {
        $listeners[event] = [];
      }

      $listeners[event].push(handler);

      return _this_;
    }

    /** Deregister an event listener
     * @param  string     event
     * @param  function   handler
     * @return this
     */
    function deregisterEventListner(event, handler) {
      if (!_.isString(event)) {
        throw new Error(E_EVENT_NAME);
      }

      if (!_.isFunction(handler)) {
        throw new Error(E_EVENT_HANDLER);
      }

      var found = $listeners[event] ? $listeners[event].indexOf(handler) : -1;

      if (found+1) {
        delete($listeners[event]);
        $listeners[event].splice(found, 1);
      }

      return _this_;
    }

    /**
     * Trigger an event and propagate
     * @param  string     event
     * @return this
     */
    function triggerEventListener(event, data) {
      if (!_.isString(event)) {
        throw new Error(E_EVENT_NAME);
      }

      _.each($listeners[event] || [], function (index, handler) {
        return handler.call(data, data);
      });

      return _this_;
    }

    //  E V E N T   H A N D L E R S

    /**
     * When cart object syncs with the API
     * @param  object   response
     * @return Promise
     */
    function onSyncd(response) {
      $lastSync = new Date().getTime();
      $waitTime = 500;
      $cart = response.data;

      $errors = response.errors;

      storeCartToLocalStorage();

      triggerEventListener(EVENT_SYNCD);
    }

    /**
     * When cart object fails to sync with the API
     * @param  object   error
     * @return Promise
     */
    function onSyncFailed(error) {
      triggerEventListener(EVENT_SYNC_ERROR);

      if ($waitTime > 120000) { // 2 minutes
        throw new Error('Maximum resync attempts exceeded.');
      }

      // Attempt to retry
      return new Promise(function (resolve, reject) {
        // console.info('Attempting to re-sync cart in ' + $waitTime + 'ms');
        setTimeout(function () {
          sync()
          .promise()
          .then(resolve, reject);
        }, $waitTime);

        $waitTime = Math.floor($waitTime * 1.2);
      });
    }

    //  A C T I O N S

    /**
     * Sync cart with localStorage data
     * @return this
     */
    function loadCartFromLocalStorage() {
      var data;

      if (localStorage && localStorage[LOCALSTORAGE_KEY]) {
        try {
          data = JSON.parse(localStorage[LOCALSTORAGE_KEY]);
          $cart = _.merge({}, data.cart || {});
          $lastSync = data.lastSync || 0;
          $meta = _.merge({}, data.meta || {});

          // console.info('Cart syncd with localStorage');
        } catch ($e) {
          $cart = _.merge({}, $empty);
          $lastSync = 0;

          // console.info('localStorage sync data not found.');
        }
      }

      return _this_;
    }

    /**
     * Store cart data to localStorage
     * @return this
     */
    function storeCartToLocalStorage() {
      if (localStorage) {
        localStorage[LOCALSTORAGE_KEY] = JSON.stringify({
          cart: $cart,
          lastSync: $lastSync,
          meta: $meta
        });

        // console.info('localStorage syncd to cart data.')
      }

      return _this_;
    }

    /**
     * Check sync state of cart and attempt resync if needed
     * @return this
     */
    function syncIfOld() {
      clearTimeout($resync);

      if ((new Date().getTime() - $lastSync) > 10000) { // 10 secs
        // console.warn('Cart Needs Resync... Resyncing');
        sync();
      }

      return _this_;
    }

    /**
     * Synchronize the cart object with the API
     * @async
     * @return this
     */
    function sync() {
      triggerEventListener(EVENT_SYNCING);

      $lastPromise = $$
      .getCart()
      .then(onSyncd, onSyncFailed);

      return _this_;
    }

    /**
     * Initialize the class
     * @return void
     */
    function init() {
      // console.info('Initializing Cart Module');

      loadCartFromLocalStorage();
      syncIfOld();
    }

    //  P U B L I S H E D

    this.data       = getCart;
    this.promise    = getLastPromise;
    this.errors     = getErrors;
    this.sync       = sync;
    this.addItem    = addItem;
    this.removeItem = removeItem;
    this.updateItem = updateItem;
    this.clearItems = clearItems;
    this.items      = items;
    this.details    = details;
    this.contact    = contact;
    this.shipping   = shipping;
    this.billing    = billing;
    this.meta       = meta;
    this.addCoupon  = addCoupon;
    this.removeCoupon = removeCoupon;
    this.clearCoupons = clearCoupons;
    this.authorize  = authorize;
    this.checkout   = checkout;
    this.on         = registerEventListener;
    this.off        = deregisterEventListner;

    //  I N I T I A L I Z A T I O N

    return init();

  }

  ///////////////////////////////
  //  R E G I S T R A T I O N  //
  ///////////////////////////////

  $$.factory('Cart', new Cart());

})(window);