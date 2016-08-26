
   function getCart() {


   cart.init({
            success : function() {



                cart.getCart({
                    success : function(data) {



                          if (data.data.tax)
                          {
                                     $("#tax_holder,.tax_holder").addClass("active");
                                    $("#tax_amount,.my_tax").html("$"+commas(data.data.tax));
                           }
                           else
                           {
                            $("#tax_holder,.tax_holder").removeClass("active");

                           }
                           if(data.data.shipping_fee > 0)
                                {
                                    $("#shipping_holder,.shipping_holder").addClass("active");



                                    $("#shipping_amount,.my_shipping").html("$"+commas(data.data.shipping_fee));
                                }

                        $(".cart .items h2").html("YOUR CART ("+data.data.item_count+")");

                        $("#total_subtotal,.my_subtotal").html("$"+commas(data.data.sub_total));
                        $(".checkout #tax span").html("$"+commas(data.data.tax));
                        $("#the_total,.my_total").html("$"+commas(data.data.total));

                        $("#right_order_sumamry").html("$"+commas(data.data.total));



                          doCartStuff(data.data.items);
                         addBillingInfo(data.data.billing);
                         addShippingInfo(data.data);
                          addCustomerInformation(data.data);
                        doDiscountStuff(data.data.discounts);
                        if(!hasSubscription(data.data.items)){
                            $('#use_paypal_div').show();
                            $("#full-click-paypal").on("click", function(){
                                $("#is_paypal_radio").trigger("click");
                            });
                        }
                    },//success
                    error : function(err) {
                        console.log("there was an error.");
                        console.log(err);
                    }//error
                });//get cart

            //    $("#checkout_button").text("PROCEED");
                  //after we init the cart and there is a url parameter lets add the subscription from the subscribe page

            }//success
        });//init

        bindPopup();

 //   });

       }

   function doDiscountStuff(discounts)
   {
       //console.log("discount");
       //console.log(discounts);
       var total = 0;
       for(var i = 0;i < discounts.length;i++)
       {
           total += discounts[i].applied_value;

           console.log(discounts[i]);
       }

       if(discounts.length != 0)
       {
           $("#discount_holder,.discount_holder").addClass("active").find("#discount_amount,.my_discount").html("-$"+total);
       }
   }//do discount stuff


        //load stuff from the cart - at the begeggind
    function doCartStuff(items) {
        disableCheckoutButton();

         getCartSize(items.length);
        for(var i = 0;i < items.length;i++)
        {



           if (items[i].sku == "subscription") {
                $(".items").append(
                    '<div class="item">' +
                    '<img src="/images/vipmembershipa.jpg">' +
                    '<div class="desc">' +
                    '<p class="first">SHREDZ VIP MEMBERSHIP</p>' +
                    '<div class="numbers_items_holder">'+
                        '<p class="base_price free_price">FREE</p>'+
                        '<p class="amount">'+commas(items[i].total)+'</p>' +
                        '<div class="quantity">' +
                            '   <p class="qn">Quantity</p>' +
                            '   <select class="quanselect" id="'+i+'s">' +
                            '       <option>1</option>' +
                            '   </select>' +
                            '   <p class="remove" id="'+items[i].sku+'"></p>' +
                        '</div>'+
                    '</div><!-- numers_items_holder -->' +//numbers_items_holder


                    '<div class="special_info">A subscription charge of $4.99 will apply for each month thereafter. See <a href="/terms-and-conditions">Subscription Policy</a></div>'+
                    '<div class="buttons buttons_in_list">' +

                    '' +
                    '</div><!-- buttons -->' +
                    '</div>' +
                    '</div>'
            );
           }
           else
           {

            $(".items").append(
                    '<div class="item">' +
                    '<img src="'+items[i].asset_location+'primaryimage_01.jpg">' +
                    '<div class="desc">' +
                    '<p class="first">'+items[i].name+'</p>' +
                    '<div class="numbers_items_holder">'+
                    '<p class="base_price">' +
                    '<span class="discount">' +
                    '<span class="base">$'+items[i].msrp+'</span><span class="actual_p ">   $'+items[i].price+'</span>' +
                    '<span class="perc">'+(Math.floor( 100 * (1 - items[i].price / items[i].msrp) ))+'% OFF</span>' +
                    '</span>' +//discount
                    '</p>'+
                    '<p class="amount">'+commas(items[i].total)+'</p>' +

                    '<div class="quantity">' +
                    '   <p class="qn">Quantity</p>' +
                    '   <select class="quanselect" id="'+i+'s">' +
                    '       <option>1</option>' +
                    '       <option>2</option>' +
                    '       <option>3</option>' +
                    '       <option>4</option>' +
                    '       <option>5</option>' +
                    '       <option>6</option>' +
                    '   </select> <p class="remove" id="'+items[i].sku+'"></p></div>' +
                    '</div>' +
                    '<p class="sku_item"><b>sku:</b> '+items[i].sku+'</p>' +
                    '<div class="buttons buttons_in_list">' +

                    '</div><!-- buttons -->' +
                    '</div>' +
                    '</div>'
            );

            }
            if (items[i].sku == "subscription") {
                    $("#"+i+"s").attr("disabled","true");
            }

            checkIfSubscription(items[i].sku);

            var ref = $(".items .item:eq("+i+")");
            var args = {
                "sku" : items[i].sku,
                "toDelete" : ref
            };
            var callbacks = {

                success : function(data) {



                                 if (data.data.tax && data.data.item_count > 1)
                                     {
                                               $("#tax_holder,.tax_holder").addClass("active");
                                              $("#tax_amount,.my_tax").html("$"+commas(data.data.tax));
                                     }
                                    else
                                    {
                                              $("#tax_holder,.tax_holder").removeClass("active");

                                    }
                                    if(data.data.shipping_fee > 0)
                                   {

                                         $("#shipFee").css("display", "");
                                          $("#shipFee span").html("$"+commas(data.data.shipping_fee));
                                   }

                    $(".cart .items h2").html("YOUR CART ("+data.data.item_count+")");
                    refreshCart(data.data.items, data.data.item_count, data.data.total);
                    $("#total_subtotal").html("$"+commas(data.data.sub_total));
                    $("#the_total").html("$"+commas(data.data.total));
                    $("#tax span").html("$"+data.data.tax);



                },
                error : function(err) {
                    console.log(err);
                    console.log("error removing item from cart");

                }


            };
            ref.find("select option:eq("+(items[i].quantity-1)+")").attr("selected", "selected");
            ref.find(".remove").on("click", {"args" : args, "callbacks" : callbacks} ,function(data){
               var id = $(this).attr("id");
                deleteSubscriptionFlagIfNeeded($(this).attr("id"));
                cart.removeFromCart(data.data["args"], data.data["callbacks"]);
            });//click delete
            ref.find("select").on(
                    "change",
                    {
                        "args" : {
                            "sku" : items[i].sku
                        },
                        "callbacks" : {
                            success : function(data) {


                                 if (data.data.tax && data.data.item_count > 1) {
                                    $("#tax_holder").addClass("active");
                                    $("#tax_amount").html("$"+commas(data.data.tax));
                                 }
                                $(".cart .items h2").html("YOUR CART ("+data.data.item_count+")");
                                $("#total_subtotal").html("$"+commas(data.data.sub_total));
                                $(".checkout #tax span").html("$"+commas(data.data.tax));
                                $("#the_total").html("$"+commas(data.data.total));

                                if(data.data.shipping_fee > 0)
                                {
                                    $("#shipping_holder").addClass("active");

                                     alert(data.data.shipping_fee);

                                    $("#shipping_amount").html("$"+commas(data.data.shipping_fee));
                                }
                                else
                                {

                                }



                                refreshCart(data.data.items, data.data.item_count, data.data.total);
                                //prev_count = data.data.item_count;
                            },
                            error : function(err) {
                                console.log("there was an error");
                                //$(".cart .items h2").html("YOUR CART ("+prev_count+")");
                            }
                        }//callbacks
                    },//data
                    function(data){
                        data.data.args.quantity = Number($(this).val());
                        cart.updateCart(data.data["args"], data.data["callbacks"]);
                    }
            );//update item quantity


        }


              enableCheckoutButton();
              updateCheckoutButton(items.length);

             if (myParam =="yes" && $("#checkout_button").text() !="PROCEED")
             {
                    addToCart();

                    //add find cart_item by sku_product
             }




    }//do cart stuff

   function checkIfSubscription(sku)
    {
        if (sku == "subscription")
        {
            subscriptionAddedToCart = true;
            $("#checkout_button").text("PROCEED");
        }
    }

$("#s_o_s_p").on("click",function(){

  toggleItemsList();
})

function toggleItemsList() {
        if (!$("#arrow").hasClass("open_arrow")) {

                 var h = $(".cart").outerHeight()   + $("#summary_holder").outerHeight() + 25;

               $("#right_order_sumamry").hide(0);
                $("#arrow").addClass("open_arrow");
                $("#show_order_summary").attr("class","openr").css({"height": h +"px"});
        }
        else
        {

              $("#arrow").removeClass("open_arrow");
              $("#show_order_summary").attr("class","closer").css({"height":"65px"});
              setTimeout(function(){
                   $("#right_order_sumamry").show(0);
              },500);

        }

}


function hasSubscription(items){
    for (var i = 0; i < items.length; i++){
        if(items[i].sku.toLowerCase() == "subscription"){
            return true;
        }
    }
    return false;
}


  $("#enter_promo").on("click",function(){
        applyCoupon($("#promo_code").val().trim());
    });

 $("#promo_code").on("keypress",function(e){
         if (e.which == 13) {
            $("#enter_promo").trigger("click");
         }
 });


  $("#enter_promo2").on("click",function(){
        applyCoupon($("#promo_code2").val().trim());
    });

 $("#promo_code2").on("keypress",function(e){
         if (e.which == 13) {
            $("#enter_promo2").trigger("click");
         }
 });

  function applyCoupon(val)
    {

        if($("#coupon_holder_overlay").length != 0)
        {
            return;
        }

    $("#enter_promo").attr("disabled",true);

    var t = new couponToast();
    t.applyToast();
        cart.applyDiscount(
                {
                    "code" : val
                },
                {
                    "success" : function(data) {

                       t.changeToastStatus("pass","Coupon Applied");


                             $("#enter_promo").removeAttr("disabled");

                        setTimeout(function(){
                            t.destroyToast(0);
                              window.location.reload();
                        },1000);

                    },
                    "error" : function(err) {
                       $("#enter_promo").removeAttr("disabled");
                            console.log(err);
                            //var e = JSON.parse(err);
                            //console.log(e.data);

                           t.changeToastStatus("fail","Coupon Not Applied");
                           setTimeout(function(){
                                       t.destroyToast(0);
                           },1000);


                    }
                }
        );
    }


var couponToast = function()
{
         this.applyingImageLink = "../images/i_image.png";
         this.successImageLink = "../images/green_check.png";
         this.errorImageLink = "../images/deny.png";

         this.applyToast = function(){
                  var self = this;
                  /*$("body").append("<div id='coupon_holder_overlay'>"+
                                   "<div id='coupon_loader_inner'>"+
                                   "<img id='coupon_loader_icon' src='" + self.applyingImageLink + "'/>"+
                                   "<p id='coupon_loader_message'>Applying Coupon</p>"+
                                   "</div></div>"); */
             $("#cart-coupon-modal").modal({
                 'backdrop' : 'static',
                 'keyboard' : 'false'
             });
         };


         this.changeToastStatus = function(type,string)
         {
                  var self = this;

                  var message = "Coupon Applied";
                  if (string) {
                           message = string;

                  }
                  var im = self.successImageLink;

                  if (type == "fail") {
                           im = self.errorImageLink;
                  }

                  $("#cart-coupon-modal #coupon_loader_icon").attr("src",im);
                  $("#cart-coupon-modal #coupon_loader_message").text(message);




         };


         this.destroyToast = function(timeout)
         {

                    /*$("#coupon_holder_overlay").fadeOut(300);

                    setTimeout(function(){
                           $("#coupon_holder_overlay").remove();
                    },300); */
             $("#cart-coupon-modal").fadeOut(300);
             setTimeout(function(){
                 $("#cart-coupon-modal").modal("hide");
             }, 300);
         }

};



var paymentToast = function()
{
         this.applyingImageLink = "../images/paymentProcessing.png";
         this.successImageLink = "../images/green_check.png";
         this.errorImageLink = "../images/PaymentFailed.png";

         this.applyToast = function(){
                  var self = this;
             /*
             $("body").append("<div id='coupon_holder_overlay'>"+
                 "<div id='coupon_loader_inner'>"+
                 "<img id='coupon_loader_icon' src='" + self.applyingImageLink + "'/>"+
                 "<p id='coupon_loader_message'>Processing Payment</p>"+
                 "</div></div>"); */
             $("#payment-modal").modal({
                 'backdrop' : 'static',
                 'keyboard' : false
             });
         };


         this.changeToastStatus = function(type,string)
         {
                  var self = this;

             console.log(type, string);

                  var message = "Purchase Complete";
                  if (string) {
                           message = string;

                  }
                  var im = self.successImageLink;

                  if (type == "fail") {
                           im = self.errorImageLink;
                  }

                  $("#payment-modal #coupon_loader_icon").attr("src",im);
                  $("#payment-modal #coupon_loader_message").text(message);

         };


         this.destroyToast = function(timeout)
         {

                    /*$("#coupon_holder_overlay").fadeOut(300);

                    setTimeout(function(){
                           $("#coupon_holder_overlay").remove();
                    },300); */

             $("#payment-modal").fadeOut(300);
             setTimeout(function(){
                 $("#payment-modal").modal("hide");
             }, 300);
         };

}


$(".grey_input").on("blur",function(){
   if($(this).val().trim()>0)
   {
         $(this).removeClass("input_error");

   }
});
