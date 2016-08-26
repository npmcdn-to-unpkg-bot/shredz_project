var elixir = require('laravel-elixir');
var uglify =require('elixir-uglify');
var os = require('os');
var sprites = require('laravel-elixir-spritesmith');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // Dynamically set browser sync options for v2dev.shredz.com
    var bsOptions = {};


    if (os.hostname() === 'ip-172-31-28-218.ec2.internal') {
        bsOptions = {
            'proxy': 'v2dev.shredz.com',
        };
    } else if (os.hostname() === 'homestead') {
        bsOptions = {
            'proxy': 'http://shredz.foo'
        };
    } else if (os.hostname() === 'vagrant') {
        bsOptions = {
            'proxy': 'http://shredz.foo'
        };
    } else {
        console.log(os.hostname());
    }

    mix
    .spritesmith('resources/assets/sprites', {
        imgOutput: 'public/images',
        cssOutput: 'resources/styles'
    })
    .sass(
        'resources/assets/sass/app.scss',
        'public/css/app.css'
    )
    .sass(
        'resources/assets/sass/article.scss',
        'public/css/article.css'
    )
    // .copy(
    //     'resources/assets/js/pages/*.js',
    //     'public/js/pages'
    // )
    // .copy(
    //     'resources/assets/js/pages/**/*.js',
    //     'public/js/pages/'
    // )
    .sass(
        'resources/assets/sass/focus/focus.scss',
        'public/css/focus/focus.css'
    // .sass(
    //     'resources/assets/sass/focus/focus.scss',
    //     'public/css/focus/focus.css'
    // )
    // .copy(
    //     'resources/assets/js/pages/*.js',
    //     'public/js/pages'
    // )
    // .copy(
    //     'resources/assets/js/pages/*.js',
    //     'public/js/pages'
    )
    .copy(
        [
            'resources/assets/js/**/*.js',
            '!resources/assets/js/api.*.js',
            '!resources/assets/js/*.factory.js'
        ],
        'public/js'
    )
    .scripts(
        [
            'resources/assets/js/api.core.js',
            'resources/assets/js/api.products.js',
            'resources/assets/js/api.orders.js',
            'resources/assets/js/api.store.js',
            'resources/assets/js/api.cart.js',
            'resources/assets/js/api.customer.js',
            'resources/assets/js/cart.factory.js',
            'resources/assets/js/api.videos.js'
        ],
        'public/js/api.module.js'
    )
    .scripts(
        [
            './bower_components/console-polyfill/index.js',
            './node_modules/setimmediate/setImmediate.js',
            './node_modules/es6-promise-polyfill/promise.js'
        ],
        'public/js/polyfills.js'
    )
    .scripts(
        ['resources/assets/js/product.factory.js'],
        'public/js/product.factory.js'
    )
    .scripts(
        ['resources/assets/js/pages/wholesale.js'],
        'public/js/pages/wholesale.js'
    )
    .scripts(
        [
            './bower_components/jquery-bar-rating/jquery.barrating.js'
        ],
        'public/js/jquery.barrating.js'
    )
    .scripts(
        [
            './bower_components/jquery_lazyload/jquery.lazyload.js'
        ],
        'public/js/jquery.lazyload.js'
    )
    .scripts(
        [
            'resources/assets/js/pages/landing/jquery.frame-carousel.js'
        ],
        'public/js/pages/landing/jquery.frame-carousel.js'
    )
    .scripts(
        [
            'resources/assets/js/pages/landing/landing.js'
        ],
        'public/js/pages/landing/landing.js'
    )
    .scriptsIn("public/js")
        .uglify(
            "resources/assets/js/*.js",      
            "public/js/"              
        )
        .uglify(
            "resources/assets/js/pages/*.js",      
            "public/js/pages/"              
        )
        .uglify(
            "resources/assets/js/pages/fitclub/*.js",      
            "public/js/pages/fitclub/"              
        )
         .uglify(
            "resources/assets/js/pages/focus/*.js",      
            "public/js/pages/focus/"              
        )
          .uglify(
            "resources/assets/js/pages/landing/*.js",      
            "public/js/pages/landing/"              
        )
        .uglify(
            "public/js/api.module.js",      
            "public/js/"              
        )
        .uglify(
            "public/js/polyfills.js",      
            "public/js/"              
        )
    // .version(
    //     [
    //         'css/app.css',
    //         'js/**/*.js'
    //     ]
    // )
    .browserSync(bsOptions);
});