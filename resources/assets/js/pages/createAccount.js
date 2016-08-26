

$(document).on("ready", function() {
    // $('.success-message-create').hide();
    // $('.error-message').hide();
    initialSetup();

    $('#login-modal').on('hidden.bs.modal', function () {
        $("#signUpSuccess").hide();
    });
});//document ready

/*
* initialization of various controls on the page - custom radio buttons and selects
* */
function initialSetup() {
    $("#signup").on("click", function(evt){
        evt.preventDefault();
        go();
    });
    $("#social-signup").on("click", function(evt){
        evt.preventDefault();
        socialSignUp();
    });
    initSelect();
    $(".select").each(function(){
        defenestrate($(this));
    });
    initRadio();
    $("#go").on("click", go);
}//initial setup

//initialize and bind custom radio buttons
function initRadio()
{
    //microwave a group to have all .radio children linked
    microwave($(".numeric .gender .radio"));//microwave - makes radio active
    microwave($("#height .radio"));
    microwave($("#weight .radio"));
    //individually microwaved radio buttons will function as toggles
    $(".goals .radio").each(function(){
        microwave($(this));
    });

    //bind #height .radio click events
    $("#height .radio").each(function(n){
        if(n == 0)
        {
            $(this).on("click", function(){selectHeightUS(true);});
        }
        else if(n == 1)
        {
            $(this).on("click", selectHeightMetric);
        }
    });

    //show and hide different weight selects based on unit
    $("#weight-select-kg").css("display", "none");
    $("#lb").on("click", function(){
        if($("#weight-select").hasClass("vis") == false)
        {
            $("#weight-select").css("display", "").addClass("vis");
            $("#weight-select-kg").css("display", "none").removeClass("vis");
        }
    });
    $("#kg").on("click", function(){
        if($("#weight-select-kg").hasClass("vis") == false)
        {
            $("#weight-select").css("display", "none").removeClass("vis");
            $("#weight-select-kg").css("display", "").addClass("vis");
        }
    });
}//init radio

function initSelect()
{

    //remove outer margin from first and last elements
    $(".select:first").css("margin-left", "0");
    $(".select:last").css("margin-right", "0");

    //select functionality of clicking off the active element
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

    for(var i = 0;i < 12;i++)
    {
        $("#month").append(
            '<p data-dv="'+i+'">'+(i+1)+'</p>'
        );
    }

    for(i = 0;i < 31;i++)
    {
        $("#day").append(
            '<p data-dv="'+i+'">'+(i+1)+'</p>'
        );
    }

    var cyear = new Date().getFullYear();
    for(i = 0;i < 200;i++)
    {
        $("#year").append(
            '<p data-dv="'+i+'">'+(cyear - 18 - i)+'</p>'
        );
    }

    selectHeightUS(false);
}//init select

//show dropdowns for US units
function selectHeightUS(b)
{
    if($("#height #foot")[0])
    {
        return;
    }
    $("#centi").remove();
    $("#height p:eq(0)").after(
        '<div id="foot" class="select"></div>' +
        '<div id="inch" class="select"></div>'
    );

    for(var i = 4; i <= 7; i++)
    {
        $("#foot").append('<p>'+(i)+'</p>');
    }

    for(i = 0; i <= 12; i++)
    {
        $("#inch").append('<p>'+(i)+'</p>');
    }

    //initialize selects if not yet initialized
    if(b)
    {
        defenestrate($("#inch"));
        defenestrate($("#foot"));
    }
}//select height us

//show dropdowns for non-US units
function selectHeightMetric()
{
    if($("#height #centi")[0])
    {
        return;
    }

    $("#foot").remove();
    $("#inch").remove();
    $("#height p:eq(0)").after(
        '<div id="centi" class="select"></div>'
    );

    for(var i = 0;i < 220;i++)
    {
        $("#centi").append(
            '<p>'+(120+i)+'</p>'
        );
    }

    defenestrate($("#centi"));
}//select height metric


function showOverlay(){
  $("#overlay").show();
}


function hideOverlay(){
  $("#overlay").hide();
}


//attempt to sign up
function go()
{   
showOverlay();
var obj = {
    "email" : $("#signUpContent #create-email").val(),
    "first_name" : $("#signUpContent #f_name").val(),
    "last_name" : $("#signUpContent #l_name").val(),
    "password" : $("#signUpContent #pass").val(),
    "password_confirmation" : $("#signUpContent #confirm").val(),
};
console.log(obj);

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
});
$.ajax({
    type: 'POST',
    url: '/auth/register',
    data: obj
})
.done(function(data){
    if(data.success){
        $("#create-email").val('');
        $("#f_name").val('');
        $("#l_name").val('');
        $("#pass").val('');
        $("#confirm").val('');
        $('.error-message').hide();
        $("#first_name, #last_name, #email_address, #label_password, #confirm-password").hide();
        $(".login-wrapper, .top-tab").hide();
        $("#signUpSuccess").show();
        $("#login-modal").addClass("success-modal");
    }
    hideOverlay();
})
.fail(function(error){
    $(".error-list-login ul").remove();
    if(error.responseText){
        var parsed = JSON.parse(error.responseText);
        if(Object.keys(parsed).length > 0){
            if(parsed['first_name']){
                $("#signUpContent #first_name").show().text(parsed.first_name);
            }
            else{
                $("#signUpContent #first_name").hide();
            }
            if(parsed['last_name']){
                $("#signUpContent #last_name").show().text(parsed.last_name);
            }
            else{
                $("#signUpContent #last_name").hide();
            }
            if(parsed['email']){
                $("#signUpContent #email_address").show().text(parsed.email);
            }
            else{
                $("#signUpContent #email_address").hide();
            }
            if(parsed['password']){
                $("#signUpContent #label_password").show().text(parsed.password);
            }
            else{
                $("#signUpContent #label_password").hide();
            }
            if(parsed['password_confirmation']){
                $("#signUpContent #confirm-password").show().text(parsed.password_confirmation);
            }
            else{
                $("#signUpContent #confirm-password").hide();
            }
        }
        }
        hideOverlay();
    });
}//go


//attempt to sign up
function socialSignUp()
{       
        var obj = {
            "payer_email" : $("input#create_email").val(),
            "password" : $("#pass").val(),
            "password_confirmation" : $("#confirm").val(),
        };
        console.log(obj);

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            type: 'POST',
            url: 'oauth2/oauthcredentials',
            data: obj
        })
        .done(function(data){
            if(data.success){
                $("#create-email").val('');
                $("#pass").val('');
                $("#confirm").val('');
                $('.error-message').hide();
                $("#email_address, #confirm-password").hide();
                $('#welcome-modal .success-message-create').html('<p>Your account has been created.</p>').show();
                setTimeout(function(){
                    window.location = "/settings";
                }, 2000);
            }
        })
        .fail(function(error){
            $(".error-list-login ul").remove();
            if(error.responseText){
                var parsed = JSON.parse(error.responseText);
                var errorList = '<ul>';
                if(Object.keys(parsed).length > 0){
                    $.each(parsed, function(i, val){
                        console.log(val)
                        errorList += '<li>'+val[0]+'</li>';                                
                    });  
                }
                errorList += '</ul>';
            }
            $('#welcome-modal .error-list-login').append(errorList).show();
        });
}//go


//client side validation for create account page
function formValidated() {
    var ids = ["f_name","l_name","create-email","pass","confirm"];
    var alerts = [
        "First Name Cannot Be Empty",
        "Last Name Cannot Be Empty",
        "Email Cannot Be Empty",
        "Password Cannot Be Empty",
        "Please Confirm Your Password"
    ];


    for (i=0;i<ids.length;i++) {
        var ErrorMarkup = ''
        var id = ids[i];
        var len = $("#"+id).val().trim().length;
        //console.log(len);
        if (len == 0) {
            console.log($("#"+id));
            alert(alerts[i]);
            return false;
        }
        if (ids[i] == "create-email") {


            if (!validEmail($("#"+ids[i]).val().trim())) {

                alert("Not q Valid Email");
                return false;
            }

        }

        if (ids[i] == "confirm") {
            var pass = $("#pass").val().trim();
            var con = $("#confirm").val().trim();

            if (pass.length < 5) {
                alert("Password Must Be 5 Characters");
                return false;
            }

            if(pass != con){

                alert("Passwords Do Not Match");
                return false;
            }
        }
    }
    return true;
}//form validated

//disable signup button while waiting for ajax response
function morphSignupButton() {
    $("#signup").attr("disabled",true).text("LOADING").css({

        "background-size":"25px",
        "background-position":"right center",
        "background-repeat":"no-repeat"
    });
}//morph signup button

//redirect user after successful account creation
function signupSucess() {
    $("#signup").text("SUCCESS!").css({
        "transition":"background-color 0s",
        "background":"#64e864"
    });

    setTimeout(function(){
        window.location.href="/shop";

    },1000);
}//signup success

//enable signup button
function returnSignupButton() {
    $("#signup").removeAttr("disabled").removeAttr("style").text("SIGN UP");
}//return signup button
