
init();
settingsMobileNav();

String.prototype.ucFirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function init()
{
    $('.mobile-settings-nav h2').html('Subscriptions <span class="turny droparrownav"></span>');
    // $("#my_sub_p").addClass("active");
    $(".mobile-settings-nav h2").on("click", function(){
        $(this).find(".turny").toggleClass("turned");
    });

}//init

function stateIndex(current_state, states_list){
    var state_found;
    $.each(states_list, function(index, state){
        if(current_state==state || current_state==index)
            state_found = index;
    });
    return state_found;
}//stateIndex

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

        var address_row = $('.address_row').clone();
        var editing_addr_uid = $('#editing_addr_uid').val();
        var editing_addr;

        $('#date_of_birth').mask('00/00/0000');
        
        $('.action .save').click(function(){
            $('.overlay').show();
            var action_value = $(this).val();
            if(action_value=='change-details'){

                sendData = {
                    'first_name'           : $('#first_name').val(),
                    'last_name'            : $('#last_name').val(),
                    'payer_email'          : $('#payer_email').val(),
                    'new_password'         : $('#new_password').val(),
                    'confirm_new_password' : $('#confirm_new_password').val(),
                    'current_password'     : $('#current_password').val(),
                    'contact_phone'        : $('#contact_phone').val(),
                    'date_of_birth'        : $('#date_of_birth').val(),
                    'gender'               : $('input[name="gender"]:checked').val()
                }
            }
            else if(action_value=='change-email'){

                sendData = {
                    'new_email'           : $('#new_email').val(),
                    'confirm_new_email'   : $('#confirm_new_email').val()
                }
            }
            console.log(sendData);
            ShredzAPI
                .request('PATCH', 'v1/customer/', null, null, sendData)
                .then(function (res) {
                    console.log(res);
                    $('.overlay').hide();
                    $(".alert-success span").text('Your information was updated successfully.');
                    $(".alert-success").alert();
                    $(".alert-success").fadeTo(4000, 500).slideUp(500); 
                    $('input[type="password"]').val('');

                    // reload page to refresh credentials
                    if(action_value=='change-email'){
                        location.reload();
                    }
                })
                .catch(function(error){
                  console.log(error);
                  $('.overlay').hide();
                  $(".alert-danger span").text(error.errors.message);
                  $(".alert-danger").alert();
                  $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                });

        });


        $('.change-email-btn').click(function(){
            var cur_email_box = $('.account-box:eq(0)');
            cur_email_box.find('h5').text('Current E-mail');
            cur_email_box.find('input:not(input[readonly="readonly"])').slideUp();
            $('.account-box:eq(1)').slideUp();
            $('.account-box:eq(2)').slideUp();
            $('.account-box:eq(3)').slideDown();
            $('.change-details-btn').show();
            $('.change-email-btn').hide();
            $('.save').val('change-email');
        });

        $('.change-details-btn').click(function(){
            var cur_email_box = $('.account-box:eq(0)');
            cur_email_box.find('h5').text('Costumer Information');
            cur_email_box.find('input:not(input[readonly="readonly"])').slideDown();
            $('.account-box:eq(1)').slideDown();
            $('.account-box:eq(2)').slideDown();
            $('.account-box:eq(3)').slideUp();
            $('.change-details-btn').hide();
            $('.change-email-btn').show();
            $('.save').val('change-details');
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
