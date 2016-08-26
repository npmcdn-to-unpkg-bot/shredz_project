///////////////////////////////////////////////////////////////////////////////////////
//  GLOBAL VARIABLES
///////////////////////////////////////////////////////////////////////////////////////

var documentHeight = $(document).height();
var scrolledDocumentHeight = false;
var ifModalPoppedUp = false;
var showModal = false;
var scrollCalculation;
var ifCloseButtonClicked = false;

///////////////////////////////////////////////////////////////////////////////////////
//  DOCUMENT ON READY
///////////////////////////////////////////////////////////////////////////////////////

$(function() {
    onDocumentReady();
});


///////////////////////////////////////////////////////////////////////////////////////
//  onDocumentReady() fires after document load
///////////////////////////////////////////////////////////////////////////////////////

function onDocumentReady(){
    if(document.cookie){
        if(readCookie("blogSubscriptionCookie")=="ifSuccess"){
            $("#email-subscription").hide();
            $("#subscription-modal").hide();
        }
    }

    onWindowResize();   // fires on window resize
    onWindowScroll();   // fires on window scroll

    //show email subscription form after 45 secs
    setTimeout(function(){ 
        $("#email-subscription").fadeIn();
    }, 45000);

    //calls onFormSubmit() after form submit
    $("#blog-subscription").submit({formIdentifier: "blog-subscription"},onFormSubmit);
    $("#modal-blog-subscription").submit({formIdentifier: "modal-blog-subscription"},onFormSubmit);

    //hide email subscription form
    $(".close-button").click(function() {
        ifCloseButtonClicked = true;
        $(".email-sub-error, .email-sub-error").hide();
        $("#email-subscription").removeClass("show-subcription-form").addClass("hide-subcription-form");
        if($(window).width()<768){
            $("#email-subscription").removeClass("show-subcription-form").addClass("hide-subcription-form").css({"bottom": "-400px"});
        }
        if(document.cookie){
            if(readCookie("blogSubscriptionCookie") == "ifSuccess"){
                return;
            }
        }
        else{
            createCookie('blogSubscriptionCookie','ifClose',0.21);
        }
    });
}


///////////////////////////////////////////////////////////////////////////////////////
//  activateModal() BEING CALLED WHEN USER CLICK CLOSE BUTTON AND SCROLL UP
///////////////////////////////////////////////////////////////////////////////////////

function activateModal(evt){
    // var position = $(window).scrollTop();
    // $(window).scroll(function () {
    //     var scroll = $(window).scrollTop();
    //     if (scroll < position){
            if(!ifModalPoppedUp){
                setTimeout(function(){
                    $("#subscription-modal").show();
                    $("#subscriptionModal").modal('show');
                    // showModal = false;
                    ifModalPoppedUp = true;
                }, 90000);
            }
    //     }
    // });
}

///////////////////////////////////////////////////////////////////////////////////////
//  onWindowScroll() fires on window scroll
///////////////////////////////////////////////////////////////////////////////////////

function onWindowScroll(){
    $(window).on("scroll", addClassSlimmer);
    $(window).on("scroll", emailSubscriptionTransition);
    $(window).on("scroll", changeSidenavWidthOnDocumentReady);
}

///////////////////////////////////////////////////////////////////////////////////////
//  onWindowResize() fires on window resize
///////////////////////////////////////////////////////////////////////////////////////
function onWindowResize(){
    $(window).on("resize", changeSidenavWidthOnWindowResize);
}

///////////////////////////////////////////////////////////////////////////////////////
//  onFormSubmit() fires after email subscription form submission
///////////////////////////////////////////////////////////////////////////////////////
function onFormSubmit(evt){
    if(evt.data.formIdentifier == "blog-subscription"){
        $(".spinner-footer").show();
    }
    else{
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
            "email": $(this).find('.blog-email-sub').val(),
            "fromWhere":$(this).find(".blog-identifier").val()
        }),
        success: function(response, status, jqxhr) {
            $(".spinner").hide();
            $('.email-sub-success').show();
            $('.email-sub-error').hide();
            $(".blog-email-sub").val("");
            if(evt.data.formIdentifier == "blog-subscription"){
                $("#subscription-modal").remove();
                setTimeout(function(){
                $("#email-subscription").removeClass("show-subcription-form").addClass("hide-subcription-form");
                }, 7000);
                setTimeout(function(){
                    $("#email-subscription").remove();
                }, 7500); 
            var fbq = window.fbq || function() {};
            fbq('track', 'Lead');
            }

            if(evt.data.formIdentifier == "modal-blog-subscription"){
                $("#email-subscription").remove();
            }
            createCookie('blogSubscriptionCookie','ifSuccess',3650);
        },
        error: function(evt) {
            $(".spinner").hide();
            $(".email-sub-error").show().text(evt.responseJSON.warnings.email[0]);
            $('.email-sub-success').hide();
        }
    });
}

///////////////////////////////////////////////////////////////////////////////////////
//  changeSidenavWidthOnWindowResize() changes sidenavwidth on window resize
///////////////////////////////////////////////////////////////////////////////////////

function changeSidenavWidthOnWindowResize(){
    if ($(window).width() < 992) {
        $("#left-container ul").removeClass("fixed-sidenav-width").css({
            "width": "100% !important"
        });
        if (scrolledDocumentHeight) {
            $("#left-container ul").removeClass("absolute-sidenav-width");
        }
    } else {
        if (scrolledDocumentHeight) {
            $("#left-container ul").addClass("absolute-sidenav-width");
        }
        if (!scrolledDocumentHeight) {
            $("#left-container ul").removeClass("absolute-sidenav-width").css({
                "width": "16.66% !important"
            });
        }
    }
}


$("#email-subscription .close-button").on("click", function(){
    activateModal();
})

///////////////////////////////////////////////////////////////////////////////////////
//  changeSidenavWidthOnDocumentReady() changes sidenavwidth on document ready
///////////////////////////////////////////////////////////////////////////////////////

function changeSidenavWidthOnDocumentReady(){
    if ($(window).width() > 992) {
        if ($("body").scrollTop() > documentHeight / 3) {
            scrolledDocumentHeight = true;
            $("#left-container ul").removeClass("fixed-sidenav-width").addClass("absolute-sidenav-width").css({
                "top": documentHeight / 3
            });
        } else {
            scrolledDocumentHeight = false;
            $("#left-container ul").removeClass("absolute-sidenav-width").addClass("fixed-sidenav-width").css({
                "top": "93px"
            });
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  addClassSlimmer() fires when scroll down on mobile
//  Make header slimmer on mobile
///////////////////////////////////////////////////////////////////////////////////////

function addClassSlimmer(){
    if ($("body").scrollTop() > 5) {
        $("#left-container").addClass("slimmer");
    } else {
        $("#left-container").removeClass("slimmer");
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  emailSubscriptionTransition() fires when scroll down
//  Make email subscription form hide/show based on window scroll top position
///////////////////////////////////////////////////////////////////////////////////////

function emailSubscriptionTransition() {
    var footerOffset = $("footer").offset().top;
    if (!ifCloseButtonClicked) {
        if ($(window).scrollTop() > (footerOffset - 1500)) {
            $("#email-subscription").removeClass("show-subcription-form").addClass("hide-subcription-form");
        } else {
            $("#email-subscription").removeClass("hide-subcription-form").addClass("show-subcription-form");
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  createCookie() sets cookie
///////////////////////////////////////////////////////////////////////////////////////
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
        console.log(expires);
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
///////////////////////////////////////////////////////////////////////////////////////
//  readCookie() read cookie
///////////////////////////////////////////////////////////////////////////////////////
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

///////////////////////////////////////////////////////////////////////////////////////
//  eraseCookie() erase previosly set cookie
///////////////////////////////////////////////////////////////////////////////////////
function eraseCookie(name) {
    createCookie(name,"",-1);
}