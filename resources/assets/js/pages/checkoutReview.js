
var myParam;
var payMethod = "cc";
$("document").ready(function(){
    initialFormatting();
    getCart();
    $(".smart_placeholder").smartPlaceholder();
});//document ready

//formance lib formatting for payment and billing information
function initialFormatting() {
      
      $('#cc_num').formance('format_credit_card_number');
      $('#cvv_code').formance('format_credit_card_cvc');
      $("#is_cc_radio,#is_same_bill").attr("checked",true);
    
        var height = $("#holds_cc_inf").height();
         $("#h_h").height(height);
         $("#hold_billing_diff").height(0);
}//initial formatting

//larger click area for radio buttons
$(".barrier_click").on('click',function(e){

    var child = $(this).siblings("input:radio");

    child.trigger("click");
});//barrier_click click

//remove input highlight on element focus
$("input,select").focus(function(){
    $(this).removeClass("input_error");
});//input, slect focus

//redirect users if cart is empty
function getCartSize(cartSize)
{
    if(cartSize == 0)
    {
        window.location.href = "/cart/";
    }
}//get cart size

//validate credit card number on every keystroke
$("#cc_num").on("keyup",function(){
    validateCard();
});//cc_num keyup

//show and hide credit card related information based on radio button selection
$(".top_c").on("change",function(){
    var myRadio = $('input[name=cc]');
    var checkedValue = myRadio.filter(':checked').val();

    if (checkedValue == "paypal")
    {
        $('#billing_addy_outer').animate({ height : 0 }, 550, function () {
            $("#billing_addy_outer").css({"overflow":"hidden"});
        });

        var theHeight = 0;
        $('#h_h').animate({ height : theHeight }, 550, function () {
        });
    }
    else
    {

        var h = $("#billing_addy_inner").outerHeight();
        $('#billing_addy_outer').animate({ height : h }, 550, function () {
            $("#billing_addy_outer").removeAttr("style");
        });

        var height = $("#holds_cc_inf").height();
        $("#h_h").height(0);  $('#h_h').animate({ height : height }, 550, function () {
        });
    }
});//top_c change

//show and hide shipping information based on radio button selection
$(".billing_c").on("change",function(){
    var myRadio = $('input[name=bill]');
    var checkedValue = myRadio.filter(':checked').val();
    if (checkedValue == "same")
    {
        var height = 0;
        $('#hold_billing_diff').animate({ height : height }, 550, function () {
        });
    }
    else
    {
        var height2 = $("#hold_billing_diff_inner").height();
        $('#hold_billing_diff').animate({ height : height2 }, 550, function () {
        });

        $("#billing_addy_outer").css({
            "height":"auto"
        });
    }
});//billing_c change


$(window).on("resize",function(){
    var myRadio = $('input[name=cc]');
    var checkedValue = myRadio.filter(':checked').val();
    if (checkedValue != "paypal" )
    {
        var height = $("#holds_cc_inf").height();
        $("#h_h").height(height);

    }

    var myRadio2= $('input[name=bill]');
    var checkedValue2 = myRadio2.filter(':checked').val();
    if (checkedValue2 != "same")
    {
        var height2 = $("#hold_billing_diff_inner").height();
        $("#hold_billing_diff").height(height2);
    }

});//window resize

//use formance credit card validation function and adjust highlight
function validateCard() {
    var isValid =  $('#cc_num').formance('validate_credit_card_number');
    if(isValid)
    {
        $("#cc_num").css({
            "border":"1px solid #4cd964",
            "-webkit-box-shadow": "0px 0px 5px 0px rgba(76,217,100,0.23)",
            "-moz-box-shadow": "0px 0px 5px 0px rgba(76,217,100,0.23)",
            "-box-shadow": "0px 0px 5px 0px rgba(76,217,100,0.23)",
            "background-color": "rgba(76, 217, 100,.1)"
        })
    }
    else
    {
        $("#cc_num").removeAttr("style");
    }
}//validate card

//expand clickable area for radio buttons
$("#the_ccards").on("click",function(){

    var myRadio = $('input[name=cc]');
    var checkedValue = myRadio.filter(':checked').val();

    if (checkedValue == "paypal")
    {
        $("#is_paypal_radio").attr("checked",false);
        $("#is_cc_radio").click();
    }
    else
    {
        $("#cc_num").addClass("pulsated");
        setTimeout(function(){
            $("#cc_num").removeClass("pulsated");
        },1600);
    }
});//the_ccards click

$("#is_paypal_radio").on("click", function(){
    payMethod = "paypal";
    $("#submit_payment_button").text("Pay with PayPal");
});//is_paypal_radio click

$("#is_cc_radio").on("click", function(){
    payMethod = "cc";
    $("#submit_payment_button").text("PLACE ORDER");
});//is_cc_radio click

//some client side validation and an attempt to place the order
$("#submit_payment_button").on("click",function(){
    var creditCardValidation = lastValidate();

    if (payMethod == "paypal" || creditCardValidation)
    {
        var myRadio = $('input[name=bill]');
        var checkedValue = myRadio.filter(':checked').val();
        if (payMethod == "paypal" || checkedValue == "same")
        {
            placeOrder();
        }
        else
        {
            //billing address different so we have to update the address first
            updateBilling();
        }
    }
    else
    {
        $('body').scrollTo(0,{duration:'slow', offsetTop : '50'});
    }
});//submit_payment_button click

//send new shipping information and place order if the shipping address is updated
function updateBilling() {
    if(validateForm("alt_billing"))
    {

        cart.updateDetails(
            {

                "billing_firstname" : $("#bfname").val(),
                "billing_lastname" : $("#blname").val(),
                "billing_address" : $("#addressone").val(),
                "billing_address2" : $("#addresstwo").val(),
                "billing_country" : $("#country").val(),
                "billing_state" : $("#state").val(),
                "billing_city" : $("#city").val(),
                "billing_zip" : $("#zip_code").val()

            },
            {
                success : function(data) {
                    placeOrder();
                },
                error : function(err) {
                    /*error updating billing address*/
                    xhrValidationProblems(err.responseJSON.errors);
                }
            }//callbacks for cart update details
        );
    }
    else{

    }
}//update billing

//validate information for users checking out with a credit card
function lastValidate() {
    //skip validation for paypal users
    if(payMethod == "paypal")
    {
        return true;
    }
    removeErrorDiv();
    var iserror = false;

    var message_array = [];

    var isValid =  $('#cc_num').formance('validate_credit_card_number');
    var cvvVal = $('#cvv_code').formance('validate_credit_card_cvc');

  


    if (!isValid) {
        $("#cc_num").addClass("input_error");
        //message_array.push("<span>- Credit Card Incorrect</span>");
        message_array.push(
            //'                <div class="alert alert-danger">' +
            //'                    <a class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>' +
            '                    <p>-Credit Card Incorrect</p>'
            //'                </div>'
        );
        iserror = true;
    }



    var monthSet = $.isNumeric($("#cc_month").val());
    var yearSet = $.isNumeric($("#cc_year").val());

    if (!monthSet || !yearSet) {
        //message_array.push("<span>- Please Add Credit Card Expiration date</span>");
        message_array.push(
            //'                <div class="alert alert-danger">' +
            //'                    <a class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>' +
            '                    <p>-Please Add Credit Card Expiration Date</p>'
            //'                </div>'
        );
        iserror = true;
    }
    if (!monthSet) {
        $("#cc_month").addClass("input_error");
    }
    if (!yearSet) {
        $("#cc_year").addClass("input_error");
        iserror = true;
    }
    var d = new Date();
    var m = d.getMonth() + 1;
    var y = d.getFullYear();

    var selectedMonth = parseInt($("#cc_month").val());
    var selectedYear = parseInt($("#cc_year").val());
   
    var isGreaterDate = (selectedMonth >= m && selectedYear >= y) || selectedYear > y ;


    if(!isGreaterDate)
    {

        $("#cc_year").addClass("input_error");
        $("#cc_month").addClass("input_error");
        //message_array.push("<span>- Credit Card Expiration Date Expired</span>");
        message_array.push(
            //'                <div class="alert alert-danger">' +
            //'                    <a class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>' +
            '                    <p>-Credit Card Has Expired</p>'
            //'                </div>'
        );
        iserror = true;
    }



    if (!cvvVal)
    {

        $("#cvv_code").addClass("input_error");
        //message_array.push("<span>- CVC Code Incorrect</span>");
        message_array.push(
            //'                <div class="alert alert-danger">' +
            //'                    <a class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>' +
            '                    <p>-CVC Code Incorrect</p>'
            //'                </div>'
        );
        iserror = true;
    }

    if ($("#error_div").length == 0 && iserror) {

        $("#error_holder").append("<div class='alert alert-danger'></div>");
        $(".alert-danger").html(message_array.join(''));
    }

    if (iserror) {
        return false;
    }
    return true;

}//last validate

//if there is an error response from shredz api, show all errors to the user
function xhrValidationProblems(errors)
{
    $("#error_holder").html("");

    for(var error in errors)
    {
        if(errors.hasOwnProperty(error))
        {
            for(var i = 0;i < errors[error].length;i++)
            {
                /*$("#error_div").append(
                    '<span>- '+ errors[error][i] +'</span>'
                );*/
                $("#error_holder").append(
                    '                <div class="alert alert-danger">' +
                    '                    <a class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>' +
                    errors[error][i] +
                    '                </div>'
                );
            }
        }
    }

    $(window).scrollTop($("#error_holder").position().top);
}//xhr validation problems

//function delegates
function bindPopup() {

}

function disableCheckoutButton() {

}

function enableCheckoutButton() {

}
function updateCheckoutButton() {
    $(".quanselect").attr("disabled",true);
}


function addBillingInfo(billing_info)
{

}

//get & show all available shipping information
//fills in fields
function addShippingInfo(shipping_info)
{
    //elements being targeted
    var ids = [
        "bfname",
        "blname",
        "addressone",
        "same_billing_b > h5",
        "addresstwo",
        "country",
        "state",
        "city",
        "zip_code",
        "insta_handle",
        "email",
        "contact_phone"
    ];

    //parallel array of values for elements
    var values = [
        checkIfNull(shipping_info.shipping_firstname),
        checkIfNull(shipping_info.shipping_lastname),
        checkIfNull(shipping_info.shipping_address),
        '<span class="black"> (' + checkIfNull(shipping_info.shipping_firstname) +" "
            + checkIfNull(shipping_info.shipping_lastname) + "- "
            + checkIfNull(shipping_info.shipping_address) + " "
            + checkIfNull(shipping_info.shipping_city) + ", "
            + checkIfNull(shipping_info.shipping_state) + ")</span>",
        checkIfNull(shipping_info.shiping_address2),
        checkIfNull(shipping_info.shiping_country),
        checkIfNull(shipping_info.shiping_state),
        checkIfNull(shipping_info.shiping_city),
        checkIfNull(shipping_info.shiping_zip),
        checkIfNull(shipping_info.contact_handle),
        checkIfNull(shipping_info.contact_email),
        checkIfNull(shipping_info.contact_phone)
    ];

    for(var i = 0; i < ids.length ;i++)
    {
        //behavior unique to index 3
        if(i == 3)
        {
            $("#"+ids[i]).append(values[i]);
        }
        else
        {
            $("#"+ids[i]).val(values[i]);
        }
    }
}//add shipping info

function addCustomerInformation(information)
{

}

//remove error div if it exists
function removeErrorDiv() {
    if ($("#error_div")) {
        $("#error_div").remove();
    }
}//remove error div


/*
*
* handle order placement for credit card and paypal users
* */
var t;
function placeOrder()
{

    if (payMethod == "paypal" || lastValidate() ) {

        //send users to paypal approval url obtained from api
        if(payMethod == "paypal")
        {
            cart.payPal(
                {
                    success : function(data) {
                        if(data.data.approval_url)
                        {
                            window.location.href = data.data.approval_url;
                        }
                        else if(data.data.token)
                        {
                            /*send user to payment redirect page if they already have the token*/
                            window.location.href = cart.paypalReturnUrl;
                        }
                        else
                        {
                            /*error*/
                        }
                    },
                    error : function(err) {

                    }
                }
            );
        }
        else
        {
            if (t) {
                t = null;

            }
            t = new paymentToast();
            t.applyToast();
            cart.getPayToken(
                /*card sent info with payment token*/
                {
                    "card": {
                        "number": $("#cc_num").val().trim().replace(/ /g, ''),
                        "expiry_month": $("#cc_month").val(),
                        "expiry_year": $("#cc_year").val(),
                        "cvv": $("#cvv_code").val()
                    }
                },
                {
                    success : function(res) {

                        if(res.data.token)
                        {

                            cart.sendPayment(
                                {
                                    "card" : {
                                        "number": $("#cc_num").val().trim().replace(/ /g, ''),
                                        "expiry_month": $("#cc_month").val(),
                                        "expiry_year": $("#cc_year").val(),
                                        "cvv": $("#cvv_code").val()
                                    },
                                    "token" : res.data.token
                                },
                                {
                                    "success" : function(res) {

                                        t.changeToastStatus("success","Purchase Complete");
                                        t = null;

                                        window.location.href = "/thanks/" + res.meta["_self"].substr(res.meta["_self"].indexOf("/orders/")+8);


                                    },
                                    "error" : function(err) {
                                        //console.log(err);
                                        xhrValidationProblems(err.responseJSON.errors);
                                        t.changeToastStatus("fail","Payment Failed");
                                        setTimeout(function(){
                                            t.destroyToast(0);
                                            t = null;
                                        },1000);
                                    }
                                }
                            );
                        }
                    },//success
                    error : function(err) {
                        for(var error_msg in err.responseJSON.errors)
                        {
                            if(err.responseJSON.errors.hasOwnProperty(error_msg))
                            {

                                break;
                            }
                        }
                        t.changeToastStatus("fail","Payment Failed");
                        setTimeout(function(){
                            t.destroyToast(0);
                            t = null;
                        },1000);
                        xhrValidationProblems(err.responseJSON.errors);
                    }//error
                }
            );//get payment token
        }
    }
    else
    {
        //not validated
    }
}//place order

//unique to checkout pages

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
