(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;
    var _category = $('meta[name="category"]').attr('content');

    function initLazyLoader() {
        $("img.lazy").lazyload({
            skip_invisible: false,
            effect: "fadeIn"
        });
    }

    function initVideoPopUp() {
        $('.video-popup').magnificPopup({
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '<div class="mfp-title" style="position: absolute; top:0; font-size: 20px; color: white;">Bench press</div>' +
                    '</div>'
            },
            // other options
        });
    }

    function onDocumentReady() {
        $('.box-style').click(function(e) {
            $('.box-style.active').removeClass('active');
            var $this = $(this);
            $(this).addClass("active");
        });

        // Scroll to Container
        var checkIfScroll = false;
        $(".smooth-scroll-icons").on('click', function(e) {
            // prevent default anchor click behavior
            e.preventDefault();
            // animate
            if (!checkIfScroll) {
                if ($(window).width() < 1076) {
                    $('html, body').animate({
                        scrollTop: $("#icons-holder").offset().top - 80
                    }, 500);
                } else {
                    $('html, body').animate({
                        scrollTop: $("#icons-holder").offset().top - 90
                    }, 500);
                }
                checkIfScroll = true;
            }
        });
        $(window).on("scroll", function() {
            if (checkIfScroll) {
                checkIfScroll = false;
            }
        });

        $(".signup-post").on("click", function() {
            postRegister();
        });


        initVideoPopUp();
    }

    function bindEvents() {
        $(document).on('ready', onDocumentReady);
    }

    function boot() {
        bindEvents();
        // setNavCategory();
    };

    boot();

})(window);