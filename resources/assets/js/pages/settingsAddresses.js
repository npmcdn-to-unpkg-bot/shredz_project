
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

        var countries_select = $('#addr_country_code');
        var states_select    = $('#addr_state');

        ShredzAPI
            .request('GET', 'v1/customer/addresses')
            .then(function (address_list) {
                console.log(address_list);
                $('.address_row').remove();
                if(address_list.data.length){
                    $.each(address_list.data, function(index, addr){
                        address_row.find('td:eq(0)').text(addr.address_street+', '+addr.address_city+', '+addr.address_state+' - '+addr.address_zip);
                        address_row.find('td:eq(1) a').attr('href','/settings/addresses/'+addr.uid+'/edit');
                        address_row.find('td:eq(2) a').attr('rel',addr.uid);
                        // address_row.find('td:eq(2)').attr('delete');
                        $('table').append(address_row.clone());

                    });
                }
                else{
                    $('.address-list').append('<div class="content" style="margin-top: 10px;">No addresses found!</div>');
                }

                $('.loading-img').hide();
                $('.address_row').show();
                $('.add-item').show();

                $('a.delete-btn').on('click', function(){
                    
                    var del_btn = $(this);
                    var addr_uid = del_btn.attr('rel');

                    if(confirm('Are you sure?')){
                        $('.overlay').show();
                        ShredzAPI
                            .request('DELETE', 'v1/customer/addresses/'+addr_uid)
                            .then(function (res) {

                                del_btn.closest('tr').slideUp(500);
                                $('.overlay').hide();
                                $(".alert-success span").text('The address was deleted successfully.');
                                $(".alert-success").alert();
                                $(".alert-success").fadeTo(4000, 500).slideUp(500); 

                            })
                            .catch(function(error){
                                console.log(error);
                                $('.action .saveNewAddress').show();
                                $('.overlay').hide();
                                $(".alert-danger span").text(error.errors.message);
                                $(".alert-danger").alert();
                                $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                            });
                    }
                    return false;
                });

        });

        $('.action .saveNewAddress').click(function(){
            $(this).hide();
            $('.overlay').show();

            sendData = {
                'address_name'         : $('#addr_name').val(),
                'address_street'       : $('#addr_street').val(),
                'address_city'         : $('#addr_city').val(),
                'address_state'        : $('#addr_state').val(),
                'address_zip'          : $('#addr_zip').val(),
                'address_country_code' : $('#addr_country_code').val(),
                'address_phone'        : $('#addr_phone').val()
            }

            ShredzAPI
                .request('POST', 'v1/customer/addresses', null, null, sendData)
                .then(function (res) {
                    console.log(res);
                    window.location = '/settings/addresses'

                })
                .catch(function(error){
                    console.log(error);
                    $('.action .saveNewAddress').show();
                    $('.overlay').hide();
                    // $(".alert-danger span").text(error.errors.message);
                    $(".alert-danger span").text('Fill all fields!');
                    $(".alert-danger").alert();
                    $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                });

        });


        if($('#addr_uid').val()){

            ShredzAPI
                .request('GET', 'v1/customer/addresses')
                .then(function (address_list) {
                    console.log(address_list);
                    $('.address_row').remove();
                    $.each(address_list.data, function(index, addr){
                        address_row.find('td:eq(0)').text(addr.address_street+', '+addr.address_city+', '+addr.address_state+' - '+addr.address_zip);
                        address_row.find('td:eq(1) a').attr('href','/settings/addresses/'+addr.uid+'/edit');
                        // address_row.find('td:eq(2)').attr('delete');
                        $('table').append(address_row.clone());
                    });
                    $('.loading-img').hide();
                    $('.address_row').show();
                    $('.add-item').show();

                });

        }

        ShredzAPI
            .request('GET', 'v1/countries')
            .then(function (countries_list) {
                $.each(countries_list.data, function(index, country){
                    countries_select.append('<option value="'+country.code+'">'+country.name+'</option>');
                });
            });

        countries_select.on('change',function(){
            states_select.html('<option selected="selected" value="">Choose State:</option>');
            ShredzAPI
                .request('GET', 'v1/countries/'+countries_select.val())
                .then(function (states_list) {
                    $('#addr_state').show();

                    $.each(states_list.data.regions, function(index, state){
                        // console.log(index);
                        states_select.append('<option value="'+index+'">'+state+'</option>');
                    });
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
