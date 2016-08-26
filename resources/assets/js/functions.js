var cart = new CartModule();
cart.init();
function validEmail(v)
{
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}//valid email

//regex test given zip code
function isValidZip(zip)
{
    var isValidZip = /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip);
    return isValidZip;
}//is valid zip


function checkIfNull(str)
{
    //check if null or undefined
    if (str == null || str == undefined) {
        return "";
    }
    return str;
}//check if null

$.fn.scrollTo = function( target, options, callback ){
    if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
    var settings = $.extend({
        scrollTarget  : target,
        offsetTop     : 50,
        duration      : 500,
        easing        : 'swing'
    }, options);
    return this.each(function(){
        var scrollPane = $(this);
        var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
        var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
        scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
            if (typeof callback == 'function') { callback.call(this); }
        });
    });
};

//iterate over required fields in a given form and check for valid input
function validateForm(idOfForm) {
    $("#error_holder").empty();
    var iserror = false;
    var errorArray = [];

    $(".req_field").each(function()
    {
        if ($(this).hasClass("req_field"))
        {
            var len = $(this).val().trim().length;

            if (len == 0)
            {
                if (!$(this).hasClass("input_error")) {
                    $(this).addClass("input_error");
                }

                var text = $(this).attr("name");
                errorArray.push(
                    '<p>-'+  text +   ' Cannot Be Empty </p>'

                );
                iserror = true;
            }
            else
            {
                $(this).removeClass("input_error");

            }
        }
    });//.req_field each

    if (!validEmail($(".email_field").val().trim()) ){

      var len =   $(".email_field").val().length;

        $("#email").addClass("input_error");
        iserror = true;


        if(len > 0)
        {

            errorArray.push(
                '        <p>-Invalid Email Address</p>'


            );
        }



    }//invalid email

    var country = $("#country");
    if(country.length > 0)
    {
        country = country.val().trim();
    }
    else
    {
        country = null;
    }

    if (country != null && country == "US"  && !isValidZip($("#zip_code").val())) {
        $("#zip_code").addClass("input_error");
        iserror = true;
        errorArray.push(
            '                  <p>-Invalid Zip Code </p>'

        );
    }//valid US zip codeß


    if (errorArray.length > 0) {
        $("#error_holder").append('<div class="alert alert-danger"></div>');

        $(".alert-danger").html(errorArray);

        return false;
    }

    return true;

}//validate form

function settingsMobileNav()
{
    $('.mobile-settings-nav h2').click(function(){
        $(this).next('ul').slideToggle();
    });

    $('.mobile-settings-nav li').click(function(){
        $(this).parent().hide();
    });
}//settings mobile nav


function commas(n)
{
    var s = n.toString();
    var a = s.split(".");

    a[0] = a[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    if(a[1])
    {
        if(a[1].length == 1)
        {
            a[1] += "0";
        }
        a[1] = a[1].substr(0,2);
    }
    else
    {
        a[1] = "00";
    }

    return a[0] +"."+ a[1];
}//commas

function headerModals()
{
    //show modal when they click the login header link and the  cart login page
    $('.auth-login', '#login_text').click(function(){
        $('.error-list').hide();
        $('.success-message').hide();
         $( "input[name='payer_email']").val("");
        $( "input[name='password']").val("");
    });

    $('.forgot_password_text').click(function(){
        $('.error-list').hide();
    });

    $('.error-list').hide();
    $('.success-message').hide();
    //Login the user
    $('#login-form').submit(handleFormSubmission);
    $('#forgot_password_form').submit(handleFormSubmission);

    function handleFormSubmission(){
        var form = $(this);
        var url = form.prop('action');
        var method = 'POST';
        var email = $( "input[name='payer_email']" ).val();
        var formData = {
            payer_email: form.find('input[name=payer_email]').val(),
            password: form.find('input[name=password]').val()
        };
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url : url,
            type : method,
            data : formData
        })
        .done(function(data){
            if(data.success){
                if(form.prop('id') === "login-form"){
                    window.location.href = '/settings';
                }
                $('.success-message').html('<p>'+data.success+'</p>');
                $('.error-list').hide();
                $('.success-message').show();
                $( "input[name='payer_email']").val("");
                $( "input[name='password']").val("");
            }
        })
        .fail(function(error){
            var parsed = JSON.parse(error.responseText);
            if($.inArray('unverified', parsed.payer_email) > -1){
                var errorList = '<p>You have not verified your email. Please check your inbox and follow the verification steps. Can\'t find the email? <a href="/email/sendverify/'+email+'">Click here to resend</a>.</p>';
                $('.error-list').html(errorList);
                $('.error-list').show();
                return false;
            }
            var errorList = '<ul>';
            if(Object.keys(parsed).length > 1){
                $.each(parsed, function(i, val){
                    errorList += '<li>'+val[0]+'</li>';
                });
            }else{
                 $.each(parsed, function(i, val){
                    if(Array.isArray(val)){
                        errorList += '<li>'+val[0]+'</li>';
                    }else{
                        errorList += '<li>'+val+'</li>';
                    }
                });
            }
                errorList += '</ul>';
                $('.error-list').html(errorList);
                $('.error-list').show();
        });
        return false;
    }
}

/*setup code for the login and forgot password modals*/
// function headerModals()
// {
//     //login modal
//     bindEnterPress();

//     $("#login").on("click", function(){

//         $("#login").attr("disabled",true).text("LOADING");
//         $.ajax({
//             //url : "/auth/login?email="+$("#username").val()+"&password="+$("#password").val(),
//             url : "/auth/login",
//             type : "post",
//             data : {
//                 "email" : $("#username").val(),
//                 "password" : $("#password").val()
//             },
//             success : function(data) {
//                 if(data.data.auth)
//                 {

//                     $("#login").removeAttr("disabled").text("SUCCESS").css({
//                         "background-color":"#64e864"
//                     });
//                     setTimeout(function(){
//                         window.location.reload(true);
//                     },400);

//                 }
//                 else
//                 {
//                     console.log(data);
//                     fixButton();
//                     toast("Username/Password Incorrect", $('.login'));
//                 }
//             },
//             error : function(err) {
//                 console.log(err.responseText);
//                 fixButton();
//                 toast(err.responseText, $('.login'));
//             },
//             complete : function() {

//             }
//         });
//     });

//     //forgot password modal
// }//header modals

function bindEnterPress() {

    $("#password").keypress(function(e) {
        if(e.which == 13) {
            $("#login").trigger("click");
        }
        else
        {

        }

        $('input.login_input').bind('focusin focus', function(e){
            e.preventDefault();
        });
    });

}//bind enter press

function toast(text, appended) {
    appended.append("<div class='toast'>"+text+"</div>");
    $(".toast").css({
        "position":"absolute",
        "bottom":"10px",
        "width":"80%",
        "left":"10%",
        "background-color":"rgba(0,0,0,.8)",
        "color":"white",
        "padding":"10px 5px",
        "border-radius":"3px",
        "text-align":"center",
        "z-index":"1000",
        "border":"1px solid #cc0000"
    });

    setTimeout(function(){
        $(".toast").fadeOut(1000);

        setTimeout(function(){
            $(".toast").remove();
        },1000);

    },2000);
}

function fixButton() {
    $("#login").removeAttr("disabled").text("LOGIN");
}


//functions from the previous utility file

function defenestrate(el, selected)
{
    if(!selected)
    {
        selected = 0;
    }
    //console.log(selected);
    //console.log(el);

    var options = [];
    var largest = 0;
    el.find("p").each(function(){
        if($(this).width() > largest)
        {
            largest = $(this).width();
        }
        options.push($(this));
        $(this).remove();
    });
    el.width(largest + 48);

    if(options && options.length > 0){
        el.append('<p class="value">'+options[selected].text()+'</p>');
        options[selected].addClass("selected");
    }
    el.append('<img src="../images/droparrow.png">');

    $(el).on("click", function(){
        if(el.find(".drop").length != 0)
        {
            el.find(".drop").remove();
            el.removeClass("open");
        }
        else
        {
            el.append('<div class="drop"></div>');
            el.addClass("open");
            el.find(".drop").width(el.width());
            for(var i = 0;i < options.length;i++)
            {
                el.find(".drop").append(options[i]);

            }
            el.find(".drop").scrollTop(el.find(".drop .selected").position().top - 46);
            //click events in different scope
            el.find(".drop p").each(function(n){
                $(this).on("click", function(){
                    var val = $(this).text();
                    el.find(".value").html(
                        val +
                        '<img src="../images/droparrow.png">'
                    );
                    el.find(".selected").removeClass("selected");
                    $(this).addClass("selected");
                });
            });
        }
    });
}//defenestrate

//clicking off of a select will close any open ones
function initSelectFunctionality()
{
    $(document).on("click", function(event){
        var target = $(event.target);
        $(".select").each(function(){

            if($(this)[0] == target[0] || $(this)[0] == target.parent()[0] || $(this)[0] == target.parent().parent()[0])
            {
                //do nothing
            }
            else
            {
                $(this).find(".drop").remove();
                $(this).removeClass("open");
            }
        });
    });
}//init sleect functionality

function microwave(el)
{
    var l = el.length;
    el.each(function(n){
        $(this).append('<div></div>');
        if(n == 0 && l != 1)
        {
            $(this).addClass("active");
        }
        $(this).on("click", function(){
            if(l == 1)
            {
                $(this).toggleClass("active");
                if($(this).hasClass("active"))
                {
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }
            }
            else
            {
                $(this).parent().find(".active").removeClass("active");
                $(this).addClass("active");
            }
        });
    });
}//microwave
