
init();
settingsMobileNav();

String.prototype.ucFirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function init()
{
    $('.mobile-settings-nav h2').html('Subscriptions <span class="turny droparrownav"></span>');
    $("#my_sub_p").addClass("active");
    $(".mobile-settings-nav h2").on("click", function(){
        $(this).find(".turny").toggleClass("turned");
    });

}//init

function scrollToAnchor(aid){
    var aTag = $(aid);
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}
/**
 * Store Grid Controller
 * @author John Cui <j.cui@shredz.com>
 */
!(function (window, undefined) {
    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var document = window.document;
    var $ = window['JQuery'] || window.$ || {};
    var ShredzAPI   = window['ShredzAPI'];

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

    function requestApiData() {
        return Promise.all([
            requestCustomer()
        ]);
    }

    function onCustomerLoaded(response){
        //grab template pieces from DOM
        var template = $("#template");
        var subscriptionTemplate = template.find(".subscription")[0].cloneNode(false);
        var basicTemplate = template.find(".subscription .basic").clone();
        var modalCancelSubscription = $(".modal-cancel-subscription").html();
        var modalChangePayment = $(".modal-change-content").html();

        var credit_card_name = 'Credit Card';
        var credit_card_type = 'credit_card';
        var paypal_name = 'PayPal';
        var paypal_type = 'paypal';
        var unknown_name = 'Unknown';
        var unknown_type = 'unknown';
        var status_active = 'Active';
        var status_failed = 'Payment Failed';
        var status_cancelled = 'Cancelled';

        //dispose of template
        template.remove();

        if(response.data.subscriptions.length){
            for(var i = 0;i < response.data.subscriptions.length;i++){
                //create the basic information down to the expanded info and return the expanded info
                $(".subscriptions")
                    .append(subscriptionTemplate.cloneNode(false)).find(".subscription:eq("+i+")")
                    .append(basicTemplate.clone());

                var subscription = $(".subscription:eq("+i+")");

                if(response.data.subscriptions[i].status != status_active)
                    subscription.find(".basic .next-billing-date p").html('<span style="color:#900">'+response.data.subscriptions[i].status+'</span>');
                else
                    subscription.find(".basic .next-billing-date p").html(response.data.subscriptions[i].billing_due_date.split(' ')[0]);
                subscription.find(".basic .product p").html(response.data.subscriptions[i].name);
                subscription.find(".basic .total p").html('$'+response.data.subscriptions[i].subscription_price);
                subscription.find(".basic .subscription-action").val(i);
                subscription.find(".basic .subscription-index").val(i);
            }
        }
        else{
            $('.subscriptions').append('<div class="content" style="margin-top: 20px;font-size:16px;">You don\'t have any subscriptions yet!</div>');
        }

        $('.loading-img').hide();

        $(".subscription").click(function(){
            // debugger;
            var $this = $(this);
            var findExpandContainer = $this.find(".subscription-details");
            var i = $this.find(".subscription-index").val();

            ShredzAPI
            .request('GET', 'v1/customer/subscriptions/'+response.data.subscriptions[i].uid)
            .then(function (res) {
                var addr = res.data.shipping_address;
                var paym = res.data.payment_profile;
                $this.find('.detail-box div:eq(0)').text(addr.address_street);
                $this.find('.detail-box div:eq(1)').text(addr.address_city+', '+addr.address_state+' - '+addr.address_zip);

                $this.find('.detail-box div:eq(4)').text(res.data.status);
                $this.find('.detail-box .current_payment_uid').val(paym.uid);
                $this.find('.detail-box .current_address_uid').val(addr.uid);

                if(res.data.status != status_cancelled){
                    $this.find('.subscription-action').show();
                }

                switch(paym.type) {
                    case credit_card_type:
                        $this.find('.detail-box div:eq(2)').text(credit_card_name+' - '+paym.creditcard_type.ucFirst());
                        $this.find('.detail-box div:eq(3)').text('xxxx xxxx xxxx '+paym.last_four);
                        break;
                    case paypal_type:
                        $this.find('.detail-box div:eq(2)').text(paypal_name);
                        $this.find('.detail-box div:eq(3)').text('');
                        break;
                    default:
                        $this.find('.detail-box div:eq(2)').text(unknown_name);
                        $this.find('.detail-box div:eq(3)').text('');
                        break;
                }

            })
            .catch(function(error){
                $(".alert-danger span").text(error.errors.message);
                $(".alert-danger").alert();
                $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
            });

            $(this).toggleClass("active");
            findExpandContainer.slideToggle();

        }).find(".subscription-details").click(function(e) {
          return false;
        }); 

        $('.subscription-action.cancel').click(function(){
            var $this = $(this);
            var subs = $this.closest('.subscription');
            i = $this.val();

            $(".modal-cancel-subscription").html(modalCancelSubscription);
            $(".modal-cancel-subscription").find('.cancel-product-name').text(response.data.subscriptions[i].name);
            $(".modal-cancel-subscription").find('.cancel-product-date').text(response.data.subscriptions[i].date);
            $(".cancelModal").modal("show");

            $('.confirm-cancellation').click(function(){
                $('.confirm-btn-group').hide();
                $('.reason-group').slideDown();

                $('.send-cancellation').click(function(){
                    //success case:  
                    ShredzAPI
                    .request('POST', 'v1/customer/subscriptions/'+response.data.subscriptions[i].uid+'/cancel', null, null, {'reason':$('.reason-textarea').val()})
                    .then(function (res) {
                        subs.find(".basic .next-billing-date p").html('<span style="color:#900">'+status_cancelled+'</span>');
                        subs.find('.detail-box div:eq(4)').text(status_cancelled);
                        $(".cancelModal").modal('hide');
                        subs.find('.subscription-action').hide();
                        $this.find('.detail-box div:eq(4)').text(status_cancelled);
                        $(".alert-success span").text('The subscription has been cancelled successfully.');
                        $(".alert-success").alert();
                        $(".alert-success").fadeTo(4000, 500).slideUp(500); 


                    })
                    .catch(function(error){
                        $(".alert-danger span").text(error.errors.message);
                        $(".alert-danger").alert();
                        $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                    });
                });

            });
        })


        $('.subscription-action.changePayment').click(function(){

            var $this = $(this);
            var subs = $this.closest('.subscription');
            var current_paym_uid = subs.find('.current_payment_uid').val();
            var modal = $('.modal-change-content');
            var template = modal.find('.change-detail-box:eq(0)');
            var payment_method_box = template.clone();

            i = $this.val();

            ShredzAPI
            .request('GET', 'v1/customer/payment_profiles')
            .then(function (payment_method_list) {

                modal.html(modalChangePayment);

                modal.find('h4.modal-title.name').text('CHANGE PAYMENT METHOD');
                modal.find('.subscription_description h3').text('Choose a new payment method to this subscription:');
                modal.find('.manage-this p a').attr('href','/settings/payments').text('Manage your payment methods.');

                modal.find('.cancel-product-name').text(response.data.subscriptions[i].name);
                modal.find('.cancel-product-date').text(response.data.subscriptions[i].date);
                modal.find('.change-detail-box').remove();

                $(".changeModal").modal("show");
                template.remove();

                $.each(payment_method_list.data, function(index, paym){

                    switch(paym.type) {
                        case credit_card_type:
                            payment_method_box.find('div:eq(0)').text(credit_card_name+' - '+paym.creditcard_type.ucFirst());
                            payment_method_box.find('div:eq(1)').text('xxxx xxxx xxxx '+paym.last_four);
                            break;
                        case paypal_type:
                            payment_method_box.find('div:eq(0)').text(paypal_name);
                            payment_method_box.find('div:eq(1)').text('');
                            break;
                        default:
                            payment_method_box.find('div:eq(0)').text(unknown_name);
                            payment_method_box.find('div:eq(1)').text('');
                            break;
                    }
                    payment_method_box.find('input[name="update_uid"]').val(paym.uid);

                    if(paym.uid == current_paym_uid){
                        payment_method_box.addClass('active');
                        payment_method_box.find('input').prop('checked', true);
                    }
                    else{
                        payment_method_box.removeClass('active');
                        payment_method_box.find('input').prop('checked', false);
                    }
                    if(paym.type!=unknown_type){
                        modal.find('.change-detail-list').append(payment_method_box.clone());
                    }
                });

                modal.find('.change-detail-list .loading-img').hide(); 
                modal.find('.change-detail-box').css('display', 'inline-block');

                
                $('.change-detail-box input[type=radio]').change(function() {
                    $('.change-detail-box').removeClass('active');
                    $(this).closest('.change-detail-box').addClass('active');
                });


                $('.confirm-change').click(function(){
                    var new_paym_profile_uid = $('input[name="update_uid"]:checked').val();
                    var subs_uid = response.data.subscriptions[i].uid;


                    console.log('Current paym: '+current_paym_uid);
                    console.log('New paym: '+new_paym_profile_uid);

                    //success case:  
                    ShredzAPI
                    .request('PUT','v1/customer/subscriptions/'+subs_uid+'/payment_profile_uid', null, null, {'uid':new_paym_profile_uid})
                    .then(function (res) {

                        var payment_method_box = $('input[name="update_uid"]:checked').closest('.change-detail-box');

                        subs.find('.detail-box .current_payment_uid').val(new_paym_profile_uid);

                        subs.find('.detail-box div:eq(2)').text(payment_method_box.find('div:eq(0)').text());
                        subs.find('.detail-box div:eq(3)').text(payment_method_box.find('div:eq(1)').text());
                        $(".alert-success span").text('The payment method has been updated successfully.');
                        $(".alert-success").alert();
                        $(".alert-success").fadeTo(4000, 500).slideUp(500); 

                    })
                    .catch(function(error){
                        
                        console.log('Erro: '+error);
                        $(".alert-danger").alert();
                        $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                    });

                    $(".changeModal").modal('hide');
                    scrollToAnchor('.content');
                });

            })
            .catch(function(error){
                $(".alert-danger span").text(error.errors.message);
                $(".alert-danger").alert();
                $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
            });
        })


        $('.subscription-action.changeAddress').click(function(){
            var $this = $(this);
            var subs = $this.closest('.subscription');
            var current_addr_uid = subs.find('.current_address_uid').val();
            var modal = $('.modal-change-content');
            var template = modal.find('.change-detail-box:eq(0)');
            var address_method_box = template.clone();
            i = $this.val();

            console.log('Current addr: '+current_addr_uid);

            ShredzAPI
            .request('GET', 'v1/customer/addresses')
            .then(function (address_list) {
                modal.html(modalChangePayment);

                modal.find('h4.modal-title.name').text('CHANGE SHIPPING ADDRESS');
                modal.find('.subscription_description h3').text('Choose a new shipping address to this subscription:');
                modal.find('.manage-this a').attr('href','/settings/addresses').text('Manage your addresses.');

                modal.find('.cancel-product-name').text(response.data.subscriptions[i].name);
                modal.find('.cancel-product-date').text(response.data.subscriptions[i].date);
                modal.find('.change-detail-box').remove();

                $(".changeModal").modal("show");
                
                template.remove();

                $.each(address_list.data, function(index, addr){

                    console.log('Update addr: '+addr.uid);
                    address_method_box.find('div:eq(0)').text(addr.address_street);
                    address_method_box.find('div:eq(1)').text(addr.address_city+', '+addr.address_state+' - '+addr.address_zip);
                    address_method_box.find('input[name="update_uid"]').val(addr.uid);

                    if(addr.uid == current_addr_uid){ 
                        address_method_box.addClass('active');
                        address_method_box.find('input').prop('checked', true);
                    }
                    else {
                        address_method_box.removeClass('active');
                        address_method_box.find('input').prop('checked', false);
                    }

                    modal.find('.change-detail-list').append(address_method_box.clone());
                });

                modal.find('.change-detail-list .loading-img').hide(); 
                modal.find('.change-detail-box').css('display', 'inline-block');

                
                $('.change-detail-box input[type=radio]').change(function() {
                    $('.change-detail-box').removeClass('active');
                    $(this).closest('.change-detail-box').addClass('active');
                });

                $('.confirm-change').click(function(){
                    var new_shipping_addr_uid = $('input[name="update_uid"]:checked').val();
                    var subs_uid = response.data.subscriptions[i].uid;

                    console.log('subs.uid = '+subs_uid);
                    console.log('paym.uid = '+new_shipping_addr_uid);

                    //success case:  
                    ShredzAPI
                    .request('PUT','v1/customer/subscriptions/'+subs_uid+'/shipping_address_uid', null, null,{'uid':new_shipping_addr_uid})
                    .then(function (res) {
                        var address_method_box = $('input[name="update_uid"]:checked').closest('.change-detail-box');

                        subs.find('.detail-box .current_address_uid').val(new_shipping_addr_uid);

                        subs.find('.detail-box div:eq(0)').text(address_method_box.find('div:eq(0)').text());
                        subs.find('.detail-box div:eq(1)').text(address_method_box.find('div:eq(1)').text());

                        $(".alert-success span").text('The address has been updated successfully.');
                        $(".alert-success").alert();
                        $(".alert-success").fadeTo(4000, 500).slideUp(500); 
                    })
                    .catch(function(error){

                        $(".changeAddressModal").modal('hide');
                        $(".alert-danger span").text(error.errors.message);
                        $(".alert-danger").alert();
                        $(".alert-danger").fadeTo(4000, 500).slideUp(500); 

                    });

                    $(".changeModal").modal('hide');
                    scrollToAnchor('.content');
                });
            })
            .catch(function(error){
                console.log('Erro: '+error);
                $(".alert-danger").alert();
                $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
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