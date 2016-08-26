(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;

	// UTILITY

    // INITIALIZATION
    function initializeSlick() {
        $(".home-slider").slick({
            autoplay: true,
            autoplaySpeed: 8000,
        });
        $(".home-slider").show();
    }

	// EVENT HANDLER

    function onDocumentReady() {	
        initializeSlick();
        $('.mobile').on('click', '.tab', addRemoveActiveClass);
    }	
    
    // ACTIONS

    function addRemoveActiveClass(e){
        var $this = $(this);
        $this.parent().children().removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    }

    function bindEvents() {
        $(document).on("ready", onDocumentReady);
    }
    
    function boot() {
    	bindEvents();
    };

    boot();

})(window);
