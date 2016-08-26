(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;
    var _category = $('meta[name="category"]').attr('content');

    function setNavCategory() {
        var category = (_category && _category.length) ? _category : 'show-all';
        $('#left-container li a').removeClass('active');
        $('#left-container li a.' + category).addClass('active');
    }

    function initLazyLoader() {
        $("img.lazy").lazyload({
            skip_invisible: false,
            effect: "fadeIn"
        });
    }

    function ready() {
        // INITIALIZE LAZY LOADING
        initLazyLoader();
    }

    function boot() {
        setNavCategory();
    };

    $(document).on('ready', ready);
    boot();

})(window);