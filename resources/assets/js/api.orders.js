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

    ShredzAPI.route('orders', {
        url: 'v1/orders',
    });
 })(window);