

//checkbox on the free shipping popup
var checked = false;
//tells us if there is a subscription added to the cart
var subscriptionAddedToCart = false;
//the parameter that lets us know that there is a request to add a subscription to the cart
var myParam;

//in the event of the cart not updating
var prev_count;

$(document).on("ready", function(){
    //parameter that lets us know if there is a subscription request from the membership preview page
    myParam = location.search.split('addSub=')[1] ? location.search.split('addSub=')[1] : 'none';


    //this gets the cart items for the page
    getCart();

});

/*hook up bootstrap modal for vip offer*/
$("#become_vip_button").on("click", function(){
    addSubscribeItem();
});

/*
*
* when the user changes the quantity of an item or removes an item
* update the cart item quantity and the header cart count
* */
function refreshCart(items, count, total)
{


    var skuArray = [];
    //defined in header blade
    updateCartCount(count, total);
    for(var i = 0;i < items.length;i++)
    {
        $(".items .item:eq("+i+") .amount").html("" + commas(items[i].price * items[i].quantity));
        skuArray.push(items[i].sku);
    }


    //checks the number of items in the cart... if the item count is zero brings you back to shopping
    updateCheckoutButton(count);

}//refresh cart

/*
*
* change the checkout button text to reflect whether or not the user's cart contains items
* */
function updateCheckoutButton(count) {
    if (count == 0) {
        $("#checkout_button").text("ENTER STORE");
        addNoItemText();
    }
    else
    {
        removeNoItemText();
    }
    if (subscriptionAddedToCart) {
        $("#checkout_button").text("PROCEED");
    }

}//update checkout button


/*
*
*change the cart display to notify users that their cart is empty
* */
function addNoItemText()
{

    if ($("#no_item").length == 0) {
        $("#continue_shopping").hide(0);
        $(".items").append("<div id='the_cart_is_empty'><a href='/shop'><img id='the_cart_image' src='/images/cart_image.png'/><h1 id='no_item'>CART IS EMPTY<p id='csha'> Continue Shopping</p></h1></a></div>");
    }

}//add no item text

/*
*
* remove the empty cart message if it is present
* */
function removeNoItemText()
{
    $("#no_item").remove();
}//remove no item text

/*
*
* disable the checkout button
* */
function disableCheckoutButton()
{
    $("#checkout_button").attr("disabled","true");
}//disable checkout button

/*
*
* remove disabled attr of checkout button
* */
function enableCheckoutButton() {
    $("#checkout_button").removeAttr("disabled");
}//enable checkout button

/*
*
* close modal and re-enable scrolling - change to bootstrap modal functions
* */
function closePopup()
{
    $(".overlay").remove();
    $("body").css("overflow", "");
}//close popup

//open bootstrap modal
function bindPopup()
{
    $("#checkout_button").on("click", function(){
        //if there is something in the cart
        if ($(this).text().trim() =="CHECKOUT") {

            // $("#cart-vip-modal").modal("show");
        }
        else if ($(this).text() =="ENTER STORE")
        {
            window.location.href = "/shop";
            //nothing in the cart
        }
        else
        {
            window.location.href = "/checkout";
        }
    });
}//bindPopup



//adds the subscription item
function addSubscribeItem() {
    addToCart();
    closePopup();
    $("#checkout_button").text("PROCEED");
}//add subscribe item

//delegate function
function getCartSize(cartSize)
{

}

//adds a subscription item to the cart if we check yes for add a subscription
function addToCart()
{

    cart.addToCart(
        {
            "sku" : "subscription",
            "quantity" : 1
        },
        {
            success : function(data) {
                window.location.href="/cart";

            },
            error : function(err) {

            }
        }
    );
}//addToCart


//see if the sku that is added is a subscription
function checkIfSubscription(sku)
{
    if (sku == "subscription")
    {
        subscriptionAddedToCart = true;
        $("#checkout_button").text("PROCEED");
    }
}//check if subscription


//if the flag is a sku we are getting rid of the logic to let them "proceed"
function deleteSubscriptionFlagIfNeeded(sku) {

    if (sku == "subscription")
    {
        checkForChange();
        subscriptionAddedToCart = false;

    }
}//delete subscription flag if needed

//check to make sure that the prices we get from the API is not null
function checkNull(price) {
    if (price == null || isNaN(price)) {
        return "0";
    }

    return price;
}//check null

/*
*
* round number to given number of decimal places
* */
function floorFigure(figure, decimals){
    if (!decimals) decimals = 2;
    var d = Math.pow(10,decimals);
    return (parseInt(figure*d)/d).toFixed(decimals);
}//floor figure

/*
*
* used when removing subscription to check if it was the only item in the cart
* */
function checkForChange(args) {
    var count  = $(".item").length;

    if (count > 1) {
        $("#checkout_button").text("CHECKOUT");
    }
}//check for change

//not used delegate methods
function addBillingInfo(billing_info)
{

}
//not used delegate methods
function addShippingInfo(shipping_info)
{


}
//not used delegate methods
function addCustomerInformation(information)
{

}
