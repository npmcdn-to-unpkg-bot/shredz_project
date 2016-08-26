/**
 * FG-REST-API: Orders route definition
 * @author  John Cui <j.cui@shredz.com>
 */
 !(function (window, undefined) {
    'use strict';

    var API_NAME = 'ShredzAPI';
    var ShredzAPI = window.require && window.require(API_NAME) || window[API_NAME];

    if (!ShredzAPI) {
        throw new Error(API_NAME + ' not found.');
    }

    ShredzAPI.route('customer', {
        url: 'v1/customer'
    });
    ShredzAPI.route('customerSubscriptions', {
        url: 'v1/customer/subscriptions',
        methods: [ShredzAPI.METHOD_DELETE]
    });
    ShredzAPI.route('customerOrders', {
        url: 'v1/customer/orders'
    });
 })(window);