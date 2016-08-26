/**
 * FG-REST-API: Products route definition
 * @author  Rahul Singh <rahul@shredz.com>
 */
!(function (window, undefined) {
    'use strict';

    var API_NAME = 'ShredzAPI';
    var ShredzAPI = window.require && window.require(API_NAME) || window[API_NAME];

    if (!ShredzAPI) {
        throw new Error(API_NAME + ' not found.');
    }

    ShredzAPI.route('videos', {
        url: 'v1/members/videos',
    });

 })(window)