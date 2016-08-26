/**
 * FG-REST-API: Cart route definition
 * @author  John Cui <j.cui@shredz.com>
 */
 !(function (window, undefined) {
    'use strict';

    var API_NAME = 'ShredzAPI';
    var ShredzAPI = window.require && window.require(API_NAME) || window[API_NAME];

    if (!ShredzAPI) {
        throw new Error(API_NAME + ' not found.');
    }

    ShredzAPI
    .route('cart', {
        url: 'v1/cart',
    })
    .route('cartItems', {
        url: 'v1/cart/items',
        methods: [ShredzAPI.METHOD_POST, ShredzAPI.METHOD_PUT, ShredzAPI.METHOD_DELETE]
    })
    .route('cartDiscounts', {
        url: 'v1/cart/discounts',
        methods: [ShredzAPI.METHOD_POST, ShredzAPI.METHOD_DELETE]
    })
    .route('cartDetails', {
        url: 'v1/cart/details',
        methods: [ShredzAPI.METHOD_POST]
    })
    .route('cartCheckout', {
        url: 'v1/cart/checkout',
        methods: [ShredzAPI.METHOD_GET, ShredzAPI.METHOD_POST]
    });
 })(window);