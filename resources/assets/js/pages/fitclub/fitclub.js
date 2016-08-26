(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;

	// UTILITY

    // INITIALIZATION

    function initVideoPopUp() {
        $('.video-popup').magnificPopup({
            type: 'iframe',
            // iframe: {
            //     markup: '<div class="mfp-iframe-scaler">' +
            //         '<div class="mfp-close"></div>' +
            //         '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
            //         '<div class="mfp-title" style="position: absolute; top:0; font-size: 20px; color: white;">Bench press</div>' +
            //         '</div>'
            // },
            // other options
        });
    }


	// EVENT HANDLER

    function onDocumentReady() {	
    	initVideoPopUp();
    	$("#fitclub-signup-form").on("submit", onFormSubmit);

    	$('#signup-modal').on('hidden.bs.modal', function () {
    		$(".email-sub-success, .email-sub-error").hide();
		});
    }

    function onFormSubmit(evt){
		$(".spinner").show();
	    evt.preventDefault();
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        type: $(this).attr('method'),
	        url: $(this).attr('action'),
	        contentType: 'application/json',
	        data: JSON.stringify({
	            "email": $(this).find('#fitclub-email-sub').val(),
	            "fromWhere":$(this).find(".fitclub-identifier").val()
	        }),
	        success: function(response, status, jqxhr) {
	            $(".spinner").hide();
	            $('.email-sub-success').show();
	            $('.email-sub-error').hide();
	            $("#fitclub-email-sub").val("");
	            var fbq = window.fbq || function() {};
	            fbq('track', 'Lead');
	        },
	        error: function(evt) {
	            $(".spinner").hide();
	            $(".email-sub-error").show().text(evt.responseJSON.warnings.email[0]);
	            $('.email-sub-success').hide();
	        }
	    });
    }	
    
    // ACTIONS

    function bindEvents() {
        $(document).on("ready", onDocumentReady);
    }
    
    function boot() {
    	bindEvents();
    };

    boot();

})(window);