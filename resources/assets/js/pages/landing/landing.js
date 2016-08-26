///////////////////////////////////////////////////////////////////////////////////////
//  GLOBAL VARIABLES
///////////////////////////////////////////////////////////////////////////////////////

var documentHeight = $(document).height();
var assetBase;


///////////////////////////////////////////////////////////////////////////////////////
//  return asset from meta
///////////////////////////////////////////////////////////////////////////////////////

function asset(path) {
    return assetBase.replace(/^(.*)\/?$/, '$1') + '/' + path.replace(/^\/(.*)$/, '$1');
}

///////////////////////////////////////////////////////////////////////////////////////
//  DOCUMENT ON READY
///////////////////////////////////////////////////////////////////////////////////////

$(function() {
    onDocumentReady();
});


///////////////////////////////////////////////////////////////////////////////////////
//  onDocumentReady() fires after document load
///////////////////////////////////////////////////////////////////////////////////////

function onDocumentReady() {
	//GET ALL ASSETS
    assetBase = $("meta[name=asset-base]").attr('content');

    //SET FRAME CAROUSEL OPTIONS
    var frameCarouselOpitons = {
        frame: asset("images/landing/ipad.png"),
        collapseThreshold: 319,
        frameSize: [{
            width: 290,
            height: 345,
            maxScreenWidth: 320
        }, {
            width: 320,
            height: 380,
            minScreenWidth: 321,
            maxScreenWidth: 479
        }, {
            width: 400,
            height: 476,
            minScreenWidth: 480,
            maxScreenWidth: 1199
        },  {
            width: 500,
            height: 595,
            minScreenWidth: 1200
        }],

        boundingBox: {
            left: '19.7%',
            top: '5.48%',
            width: '60.4%',
            height: '60.4%'
        },

        images: [
            asset("images/landing/slider-images/1.jpg"),
            asset("images/landing/slider-images/2.jpg"),
            asset("images/landing/slider-images/3.jpg"),
            asset("images/landing/slider-images/4.jpg"),
        ]
    }

    //INITIALIZE FRAMECAROUSEL 
    $('.fc-ipad').frameCarousel(frameCarouselOpitons);


    //calls onFormSubmit() after form submit
    $("#7day-subscription").submit({formIdentifier: "7day-subscription"},onFormSubmit);
    $("#modal-7day-subscription").submit({formIdentifier: "modal-7day-subscription"},onFormSubmit);
}

///////////////////////////////////////////////////////////////////////////////////////
//  onFormSubmit() fires after email subscription form submission
///////////////////////////////////////////////////////////////////////////////////////
function onFormSubmit(evt) {
    if (evt.data.formIdentifier == "7day-subscription") {
    	$("#7day-subscription").hide();
        $(".spinner-main").show();
    } else {
        $(".spinner-modal").show();
    }
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
            "email": $(this).find('.7day-email-sub').val(),
            "fromWhere": $(this).find(".7day-dentifier").val()
        }),
        success: function(response, status, jqxhr) {
            $(".spinner").hide();
            if(evt.data.formIdentifier == "7day-subscription"){
                $('.email-sub-success').show();
                $('.email-sub-error').hide();
            }
            else{
                $('.email-sub-success-modal').show();
                $('.email-sub-error-modal').hide();
            }
            $("#7day-subscription, #modal-7day-subscription").remove();
            setTimeout(function() {
                $(".email-sub-success, .email-sub-success-modal").hide();
            }, 5000);
            var fbq = window.fbq || function() {};
            fbq('track', 'Lead');
        },
        error: function() {
    		$("#7day-subscription").show();
            $(".spinner").hide();
            if(evt.data.formIdentifier == "7day-subscription"){
            	$(".email-sub-error").show().text(evt.responseJSON.warnings.email[0]);
            }
            else{
            	$(".email-sub-error-modal").show().text(evt.responseJSON.warnings.email[0]);
            }
            $('.email-sub-success').hide();
        }
    });
}