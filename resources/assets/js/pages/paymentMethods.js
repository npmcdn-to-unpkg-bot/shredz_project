
init();
settingsMobileNav();

String.prototype.ucFirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function init()
{
    $('.mobile-settings-nav h2').html('Subscriptions <span class="turny droparrownav"></span>');
    $("#my_account_p").addClass("active");
    $(".mobile-settings-nav h2").on("click", function(){
        $(this).find(".turny").toggleClass("turned");
    });

}//init

function paym_method_type(paym){

        var credit_card_name = 'Credit Card';
        var credit_card_type = 'credit_card';
        var paypal_name = 'PayPal';
        var paypal_type = 'paypal';
        var unknown_name = 'Unknown';
        var unknown_type = 'unknown';
        var status_active = 'Active';
        var status_failed = 'Payment Failed';
        var status_cancelled = 'Cancelled';

        switch(paym.type) {
            case credit_card_type:
                return credit_card_name+' - '+paym.creditcard_type.ucFirst()+' (Final '+paym.last_four+')';
                break;
            case paypal_type:
                return paypal_name;
                break;
            default:
                return unknown_name;
                break;
        }
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

        var payment_row = $('.payment_row').clone();

        ShredzAPI
            .request('GET', 'v1/customer/payment_profiles')
            .then(function (paym_methods) {
                console.log(paym_methods);
                $('.payment_row').remove();
                if(paym_methods.data.length){
                    $.each(paym_methods.data, function(index, paym){
                        if(paym.type=='credit_card'){
                            var exp_date = paym.expiration_date.split('-');

                            payment_row.find('td:eq(0)').text(paym.creditcard_type.ucFirst());
                            payment_row.find('td:eq(1)').text('Final # '+paym.last_four);
                            payment_row.find('td:eq(2)').text(exp_date[1]+'/'+exp_date[0]);
                            payment_row.find('td:eq(3) a').attr('rel',paym.uid);
                            $('table').append(payment_row.clone());

                        }
                    });
                }
                else{
                    $('.payment-list').append('<div class="content" style="margin-top: 10px;">No payment methods found!</div>');
                }
                $('.loading-img').hide();
                $('.cc-table-header').show();
                $('.payment_row').show();
                $('.add-item').show();

            $('a.delete-btn').on('click', function(){
                
                var del_btn = $(this);
                var paym_uid = del_btn.attr('rel');

                if(confirm('Are you sure?')){
                    ShredzAPI
                        .request('DELETE', 'v1/customer/payment_profiles/'+paym_uid)
                        .then(function (res) {

                            del_btn.closest('tr').slideUp(500);
                            $(".alert-success span").text('The payment method was removed successfully.');
                            $(".alert-success").alert();
                            $(".alert-success").fadeTo(4000, 500).slideUp(500); 

                        });
                }
                return false;
            });

        });


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
