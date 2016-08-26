
var myParam;
$("document").ready(function(){
    getCart();

    $(".smart_placeholder").smartPlaceholder();


    $('#contact_phone').formance('format_phone_number');
});//document ready


//checks the cart size, if it is zero it will kick us out of the page and send us back to the main cart page
function getCartSize(cartSize)
{
    if(cartSize == 0)
    {
        window.location.href = "/cart/";
    }
}//get cart size

function unbindformance() {
    $('#contact_phone').unbind();
}

function bindFormance() {
    $('#contact_phone').unbind();
    $('#contact_phone').formance('format_phone_number');
    $("#contact_phone").val($("#contact_phone").val());
}

//only bind formance when the country is US
$("#country").on("change",function(){

    if ($(this).val() == "US") {
        bindFormance();
    }
    else

    {
        unbindformance();
    }

});//country change

//function delegates
function bindPopup() {

}

function disableCheckoutButton() {

}

function enableCheckoutButton() {

}

//use the quantity selector for display only beyond the cart page
function updateCheckoutButton() {
    $(".quanselect").attr("disabled",true);
}//update checkout button

//validate ship form, update customer information, scroll to top of page
$("#checkout_button_two").on("click",function(){

    var isValid = validateForm("ship_form");
    console.log(isValid);
    if (isValid) {

        updateCustomerInformation();
    }
    else
    {
        $('body').scrollTo(0,{duration:'slow', offsetTop : '50'});
    }
});//checkout button two click


//function delegate
function addBillingInfo(billing_info)
{

}


//fill in shipping information if it exists
function addShippingInfo(shipping_info) {
    console.log(shipping_info);
    //ids for shipping information html holders
    var inputIdArray = [
        "fname",
        "lname",
        "addressone",
        "addresstwo",
        "country",
        "state",
        "city",
        "zip_code",
        "insta_handle",
        "email",
        "contact_phone"
    ];

    //fields of shipping_info, parallel array to inputIdArray
    var valueArray = [
        "shipping_firstname",
        "shipping_lastname",
        "shipping_address",
        "shipping_address2",
        "billing_country",
        "shipping_state",
        "shipping_city",
        "shipping_zip",
        "contact_handle",
        "contact_email",
        "contact_phone"
    ];

    var i;
    for (i = 0; i < inputIdArray.length; i++) {
        if (inputIdArray[i] == "country") {
            var s = checkIfNull(shipping_info[valueArray[i]]);
            if (s.length == 0) {

                $("#country").val("US");
            }
            else {
                console.log(s);
                $("#country").val(s);
            }


        }
        else {
            $("#" + inputIdArray[i]).val(checkIfNull(shipping_info[valueArray[i]]));

        }


    }//add shipping info

}

//function delegate
function addCustomerInformation(information)
{

}


$("#login_text").on("click",function(){
    loginPopup();
});//login_text click

/*
*
* send customer information to shredz api
* */
function updateCustomerInformation() {
    cart.updateDetails(
        {
            "shipping_firstname" : $("#fname").val(),
            "shipping_lastname" : $("#lname").val(),
            "shipping_address" : $("#addressone").val(),
            "shipping_address2" : $("#addresstwo").val(),
            "shipping_country" : $("#country").val(),
            "shipping_state" : $("#state").val(),
            "shipping_city" : $("#city").val(),
            "shipping_zip" : $("#zip_code").val(),
            "contact_phone" : $("#contact_phone").val(),

            "contact_email" : $("#email").val(),
            "contact_handle" : $("#insta_handle").val(),

            "billing_firstname" : $("#fname").val(),
            "billing_lastname" : $("#lname").val(),
            "billing_address" : $("#addressone").val(),
            "billing_address2" : $("#addresstwo").val(),
            "billing_country" : $("#country").val(),
            "billing_state" : $("#state").val(),
            "billing_city" : $("#city").val(),
            "billing_zip" : $("#zip_code").val()
        },
        {
            success : function(data) {
                //direct user to the next route if the update is successful
                window.location.href="/checkoutReview";
            },
            error : function(err) {
                alert("there was an error sending user information");
            }
        }//callbacks for cart update details
    );
}//update customer information

$(".req_field").on("change keyup",function(){

    if ($(this).val().trim().length == 0)
    {
        $(this).addClass("input_error_other");
    }
    else
    {
        $(this).removeClass("input_error_other");
    }
});//req_field change || keyup


