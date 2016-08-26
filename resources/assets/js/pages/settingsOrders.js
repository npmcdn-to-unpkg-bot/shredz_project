
init();
settingsMobileNav();

function init(){
    $('.mobile-settings-nav h2').html('Order History <span class="turny droparrownav"></span>');
    $("#my_orders_p").addClass("active");
    $(".mobile-settings-nav h2").on("click", function(){
        $(this).find(".turny").toggleClass("turned");
    });

    // getOrders();
}//init

/*
*
* clone sections of the DOM to dynamically build orders without using strings
* */
// function getOrders()
// {
//     //grab template pieces from DOM
//     var template = $("#template");
//     var order_t = template.find(".order")[0].cloneNode(false);
//     var basic_t = template.find(".order .basic").clone();
//     var expanded_t = template.find(".order .expanded")[0].cloneNode(false);
//     var item_s = template.find(".order .expanded .item:eq(0)").clone();
//     var item_m = template.find(".order .expanded .item:eq(1)").clone();
//     var line = template.find(".order .expanded .ghLine").clone();
//     //dispose of template
//     template.remove();

//     $.ajax({
//         url : '/ajax/v1/user/orders',
//         success : function(res) {
//             // console.log(res);

//             for(var i = 0;i < res.data.length;i++)
//             {
//                 //create the basic information down to the expanded info and return the expanded info
//                 $(".order-history")
//                     .append(order_t.cloneNode(false)).find(".order:eq("+i+")")
//                     .append(basic_t.clone())
//                     .append(expanded_t.cloneNode(false)).find(".expanded");

//                 var order = $(".order:eq("+i+")");
//                 order.attr('data-uid', res.data[i].uid);
//                 order.find(".basic .place-date p").html(res.data[i].date);
//                 order.find(".basic .tid p").html(res.data[i].transaction_id);
//                 order.find(".basic .total p").html('$'+res.data[i].total);

//                 order.on("click", function(){
//                     var self = $(this);
//                     console.log(self.data('loaded'));
//                     if(self.data('loaded') == true)
//                     {
//                         return;
//                     }
//                     if(self.find(".spinny").length == 0)
//                     {
//                         self.find('.expanded').append('<img style="display: block; margin: auto;" class="spinny" src="'+loadingImg+'">');
//                     }

//                     $.ajax({
//                         url : '/ajax/v1/user/orders/' + $(this).data('uid'),
//                         success : function(res2) {
//                             self.find(".spinny").remove();
//                             if(self.data('loaded') == true)
//                             {
//                                 return;
//                             }
//                             console.log(res2.data.items);
//                             self.attr('data-loaded', 'true');
//                             var expanded = self.find(".expanded");
//                             for(var j = 0;j < res2.data.items.length;j++)
//                             {
//                                 var nItem;
//                                 //clone the first item
//                                 if(j == 0)
//                                 {
//                                     nItem = item_s.clone();
//                                 }
//                                 //clone an additional item (different top margins than first item)
//                                 else
//                                 {
//                                     nItem = item_m.clone();
//                                 }

//                                 nItem.find(".left p").html(res2.data.items[j].name);
//                                 nItem.find(".number-holder .price").html('$'+Math.floor(res2.data.items[j].total / res2.data.items[j].quantity));
//                                 nItem.find('.number-holder .quantity').html(res2.data.items[j].quantity);
//                                 nItem.find('.number-holder .total').html('$'+res2.data.items[j].total);
//                                 nItem.find('.left img').attr('src', res2.data.items[j].asset_location + 'primaryimage_01.jpg');

//                                 expanded.append(nItem);
//                             }//for j
//                         }
//                     });
//                 });
//             }//for i

//             //bind click after loading orders
//             $(".order .basic").on("click", function(){
//                 $(this).parent().toggleClass("active");

//                 var op = !$(this).data('open');

//                 $(this).data('open', op);

//                 if($(this).data('open'))
//                 {
//                     $(this).find("img").css({
//                         'transform' : 'rotate(180deg)'
//                     });
//                 }
//                 else
//                 {
//                     $(this).find("img").css({
//                         'transform' : 'rotate(0deg)'
//                     });
//                 }
//             });
//         }//success
//     });
// }//fake orders


/**
 * Store Grid Controller
 * @author John Cui <j.cui@shredz.com>
 */
!(function (window, undefined) {
    var TYPE_SHREDZ_API     = 'ShredzAPI';
    var TYPE_JQUERY         = 'JQuery';
    var TYPE_STRING         = 'String';
    var TYPE_OBJECT         = 'Object';
    var TYPE_MATH           = 'Math';
    var TYPE_HANDLEBARS     = 'Handlebars';

    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var document = window.document;
    var $ = window[TYPE_JQUERY] || window.$ || {};
    var String      = window[TYPE_STRING];
    var Object      = window[TYPE_OBJECT];
    var Math        = window[TYPE_MATH];
    var ShredzAPI   = window[TYPE_SHREDZ_API];




    ///////////////////////
    //  H A N D L E R S  //
    ///////////////////////


    function onAllApiDataLoaded() {
        $(".spinner").remove();
    }


    function onDocumentReady() {
    }

    function requestCustomer() {
        return ShredzAPI
        .getCustomer()
        .then(onCustomerLoaded);
    }

    function requestOrders() {
        return ShredzAPI
        .getOrders()
        .then(onOrdersLoaded);
    }

    function requestApiData() {
        return Promise.all([
            requestCustomer()
        ]);
    }

    function onCustomerLoaded(response){
        //grab template pieces from DOM
        var template = $("#template");
        var orderTemplate = template.find(".order")[0].cloneNode(false);
        var basicTemplate = template.find(".order .basic").clone();

        var expandedTemplate = template.find(".order .expanded")[0].cloneNode(false);
        var singleItem = template.find(".order .expanded .item:eq(0)").clone();
        var multipleItems = template.find(".order .expanded .item:eq(1)").clone();
        var line = template.find(".order .expanded .ghLine").clone();
        var shipment = template.find(".order .shipment").clone();
        
        //dispose of template
        template.remove();

        if(response.data.orders.length){
            for(var i = 0;i < response.data.orders.length;i++){
                //create the basic information down to the expanded info and return the expanded info
                $(".order-history")
                    .append(orderTemplate.cloneNode(false)).find(".order:eq("+i+")")
                    .append(basicTemplate.clone())
                    .append(expandedTemplate.cloneNode(false)).find(".expanded");

                var order = $(".order:eq("+i+")");
       
                order.attr('href', response.data.orders[i]._href);
                order.find(".basic .place-date p").html(response.data.orders[i].date);
                order.find(".basic .tid p").html(response.data.orders[i].transaction_id);
                order.find(".basic .total p").html('$'+response.data.orders[i].total);
            }
        }
        else{
            $('.order-history').append('<div class="content" style="margin-top: 20px;font-size:16px;">You haven\'t placed any order yet!</div>');
        }

        $(".order").click(function(){
            var $this = $(this);
            var findExpandContainer = $this.find(".expanded");
            $(this).toggleClass("active");
            $(this).find('.icon-position').toggleClass("fa-caret-up");
            if($this.data('loaded') == true)
            {
                return;
            }
            if($this.find(".spinny").length == 0)
            {
                $this.find('.expanded').append('<img style="display: block; margin: auto;" class="spinny" src="'+loadingImg+'">');
            }
            $this.attr('data-loaded', 'true');
            var getOrderUrl = $this.attr('href');
            var getOrderUrlArray = getOrderUrl.split("/");
            var token = getOrderUrlArray[getOrderUrlArray.length && getOrderUrlArray.length - 1];

            ShredzAPI
            .request('GET', 'v1/customer/orders/'+token)
            .then(function (res) {
                var expanded = $this.find(".expanded");
                for(var j = 0;j < res.data.items.length;j++)
                {
                    var newItem;
                    //clone the first item
                    if(j == 0)
                    {
                        newItem = singleItem.clone();
                    }
                    //clone an additional item (different top margins than first item)
                    else
                    {
                        newItem = multipleItems.clone();
                    }

                    newItem.find(".left p").html(res.data.items[j].name);
                    newItem.find(".number-holder .price").html('$'+Math.floor(res.data.items[j].total / res.data.items[j].quantity));
                    newItem.find('.number-holder .quantity').html(res.data.items[j].quantity);
                    newItem.find('.number-holder .total').html('$'+res.data.items[j].total);
                    newItem.find('.left img').attr('src', res.data.items[j].asset_location + 'primaryimage_01.jpg');

                    expanded.append(newItem);
                }

                for(var n = 0; n < res.data.shipments.length; n++){
                    newShipment = shipment.clone();
                    newShipment.find('.tracking h4').html(newShipment.find('.tracking h4').html().concat(' (', res.data.shipments[n].carrier, ')'));
                    newShipment.find('.tracking a').html(res.data.shipments[n].tracking_code);
                    newShipment.find('.tracking a').attr('href', newShipment.find('.tracking a').attr('href') + res.data.shipments[n].tracking_code);
                    newShipment.find('.tracking a').click(function(event){
                        event.stopImmediatePropagation();
                        event.stopPropagation();
                    });
                    expanded.append(newShipment);
                }

                $this.find(".spinny").remove();
            });
        })
    }
    /////////////////////
    //  A C T I O N S  //
    /////////////////////

    function bindEvents() {
        $(document).on('ready', onDocumentReady);
    }

    function boot() {
        bindEvents();
        // Start pulling the data from the API
        requestApiData()
        .then(onAllApiDataLoaded);
    }

    boot(); // Start the module
})(window);
