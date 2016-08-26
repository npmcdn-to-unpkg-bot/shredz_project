
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
        var check_addr = false;
        var user_have_addr = false;
        var editing_addr_uid = $('#editing_addr_uid').val();
        var editing_addr;

        var countries_select = $('#addr_country_code');
        var states_select    = $('#addr_state');

        // temporary array of states:
        var states_list = {"AK":"Alaska","AL":"Alabama","AS":"American Samoa","AZ":"Arizona","AR":"Arkansas","CA":"California","CO":"Colorado","CT":"Connecticut","DE":"Delaware","DC":"District of Columbia","FM":"Micronesia","FL":"Florida","GA":"Georgia","GU":"Guam","HI":"Hawaii","ID":"Idaho","IL":"Illinois","IN":"Indiana","IA":"Iowa","KS":"Kansas","KY":"Kentucky","LA":"Louisiana","ME":"Maine","MH":"Marshall Islands","MD":"Maryland","MA":"Massachusetts","MI":"Michigan","MN":"Minnesota","MS":"Mississippi","MO":"Missouri","MT":"Montana","NE":"Nebraska","NV":"Nevada","NH":"New Hampshire","NJ":"New Jersey","NM":"New Mexico","NY":"New York","NC":"North Carolina","ND":"North Dakota","MP":"Northern Mariana Islands","OH":"Ohio","OK":"Oklahoma","OR":"Oregon","PW":"Palau","PA":"Pennsylvania","PR":"Puerto Rico","RI":"Rhode Island","SC":"South Carolina","SD":"South Dakota","TN":"Tennessee","TX":"Texas","UT":"Utah","VT":"Vermont","VI":"Virgin Islands","VA":"Virginia","WA":"Washington","WV":"West Virginia","WI":"Wisconsin","WY":"Wyoming","AA":"Armed Forces Americas","AE":"Armed Forces Europe, Canada, Africa and Middle East","AP":"Armed Forces Pacific"}

        if(editing_addr_uid) check_addr = true;

        ShredzAPI
            .request('GET', 'v1/customer/addresses')
            .then(function (address_list) {
                $('.address_row').remove();

                if(address_list.data.length){
                    $.each(address_list.data, function(index, addr){
                        address_row.find('td:eq(0)').text(addr.address_street+', '+addr.address_city+', '+addr.address_state+' - '+addr.address_zip);
                        address_row.find('td:eq(1) a').attr('href','/settings/addresses/'+addr.uid+'/edit');
                        $('table').append(address_row.clone());

                        if(check_addr){
                            if(editing_addr_uid == addr.uid){
                                user_have_addr = true;
                                editing_addr = addr;
                            }
                        }
                    });
                }
                else{
                    $('.address-list').append('<div class="content" style="margin-top: 10px;">No addresses found!</div>');
                }
                // $('.loading-img').hide();
                $('.address_row').show();
                $('.add-item').show();
                
                if(user_have_addr){
                    $('#addr_name').val(editing_addr.address_name);
                    $('#addr_street').val(editing_addr.address_street);
                    $('#addr_city').val(editing_addr.address_city);

                    ShredzAPI
                        .request('GET', 'v1/countries')
                        .then(function (countries_list) {

                            $.each(countries_list.data, function(index, country){
                                countries_select.append('<option value="'+country.code+'">'+country.name+'</option>');
                            });
                            countries_select.val(editing_addr.address_country_code.trim());
                        });

                    ShredzAPI
                        .request('GET', 'v1/countries/'+editing_addr.address_country_code.trim())
                        .then(function (states_list) {
                            console.log(states_list);

                            $.each(states_list.data.regions, function(index, state){
                                states_select.append('<option value="'+index+'">'+state+'</option>');
                            });
        
                            states_select.val(stateIndex(editing_addr.address_state.trim(), states_list.data.regions));
                        });

                    $('#addr_zip').val(editing_addr.address_zip);
                    $('#addr_phone').val(editing_addr.address_phone);

                    $('.loading-img').hide();
                    $('.account-info.edit').find('input, select, button').show();
                }
                else{
                    $('.account-info.edit .account-box div:eq(0)').css('width','100%').text('Address not found');
                    $('.loading-img').hide();
                }

        });

        countries_select.on('change',function(){
            states_select.html('<option selected="selected" value="">Choose State:</option>');
            ShredzAPI
                .request('GET', 'v1/countries/'+countries_select.val())
                .then(function (states_list) {

                    $.each(states_list.data.regions, function(index, state){
                        states_select.append('<option value="'+index+'">'+state+'</option>');
                    });
                });

        });


        $('.action .saveNewAddress').click(function(){

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
                .request('PATCH', 'v1/customer/addresses/'+editing_addr_uid, null, null, sendData)
                .then(function (res) {
                    $(".alert-success span").text('The address was updated successfully.');
                    $(".alert-success").alert();
                    $(".alert-success").fadeTo(4000, 500).slideUp(500); 

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
