

$(document).on("ready", function(){

    $("#track-package").on("click", function(){window.location.href = "/help"});
    $("#manage-account").on("click", function(){window.location.href = "/settings"});

    //wait until auth token is available to proceed
    var getAuth = setInterval(function(){
        if(cart.authToken)
        {
            getOrderInfo();
            clearInterval(getAuth);
        }
    }, 50);
});//document ready

//retrieve order information by sending url parameter to shredz api /orders
function getOrderInfo()
{
    cart.thanks(
        {
            //send order url to cart module to retrieve order information
            order : $("#info-url").html()
        },
        {
            success : function(res) {

                //display order information
                $("#transaction-id").text(res["data"]["transaction_id"]);
                $("#order-status").text(res["data"]["status"]);
                $("#customer-name").text(res["data"]["customer"]["first_name"] + ' ' + res["data"]["customer"]["last_name"]);
                $("#customer-name-2").text(res["data"]["customer"]["first_name"] + ' ' + res["data"]["customer"]["last_name"]);
                $("#ship-street").text(res["data"]["shipping"]["address_street"]);
                $("#ship-city").text(res["data"]["shipping"]["address_city"] + ', ' + res["data"]["shipping"]["address_state"] + ', ' + res["data"]["shipping"]["address_zip"]);
                $("#ship-country").text(res["data"]["shipping"]["address_country_code"]);

                addItemsToPage(res["data"]["items"]);
            },
            error : function(err) {

            }
        }
    );
}//get order info

//append order items and links to the page
function addItemsToPage(items)
{
    for(var i = 0;i < items.length;i++) {
        if (items[i].sku == "subscription") {
            $(".items").append(
                '<div class="item">' +
                '<img src="/images/vipmembershipa.jpg">' +
                '<div class="desc">' +
                '<p class="first">SHREDZ VIP MEMBERSHIP</p>' +
                '<div class="numbers_items_holder">' +
                '<p class="base_price">$4.99</p>' +
                '<p class="amount">' + commas(items[i].total) + '</p>' +


                '</div>' +
                '<p class="sku_item">sku: ' + items[i].sku + '</p>' +
                '<div class="special_info">A subscription charge of $4.99 will apply for each month thereafter. See <a href="/terms-and-conditions">Subscription Policy</a></div>' +
                '<div class="buttons buttons_in_list">' +

                '' +
                '</div><!-- buttons -->' +
                '</div>' +
                '</div>'
            );

            //don't show base price or total for subscription
            $(".numbers_items_holder:eq("+i+")").find(".base_price").text("").next(".amount").remove();
        }
        else {

            $(".instructions").append("<a href='/products/"+items[i].product_id+"'</a>"+items[i].name+"</a>");

            $(".items").append(
                '<div class="item">' +
                '<img src="' + items[i].asset_location + 'primaryimage_01.jpg">' +
                '<div class="desc">' +
                '<p class="first">' + items[i].name + '</p>' +
                '<div class="numbers_items_holder">' +
                '<p class="base_price">$' + Math.floor(items[i].total / items[i].quantity) + '</p>' +
                '<p class="count">'+items[i].quantity+'</p>' +
                '<p class="amount">' + commas(items[i].total) + '</p>' +
                '<p class="sku_item">sku: ' + items[i].sku + '</p>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        }
    }
}//add items to page
