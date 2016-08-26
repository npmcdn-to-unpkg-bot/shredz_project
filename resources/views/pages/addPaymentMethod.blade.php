@extends('themes.default.layout')

@section('content')
    <main class="settings">
        <div class="bread">
            <div class="content">
                <p><a href="/">HOME</a> / <b>ACCOUNT</b></p>
            </div>
        </div>
    <div class="content">
        @include('includes.settings-nav')
        <div class="pages">
            <div class="account">
                @if(session('successMessage'))
                    <div class="alert alert-success success-message-create" role="alert">{{ session('successMessage') }}</div>
                @endif
                <div class="alert alert-success success-message-create" role="alert" style="display: none"><span></span></div>
                <div class="alert alert-danger success-message-create" role="alert" style="display: none"><span></span></div>
                <a href="/settings" class="tab">Account <span class="hidden-xs">information</span></a><a href="/settings/payments" class="active tab">Payment <span class="hidden-xs">information</span></a><a href="/settings/addresses" class="tab"><span class="hidden-xs">Address information</span><span class="visible-xs">Addresses</span></a>
                <div class="account-info">
                    <div class="account-box">

                        <h5>Add Credit Card</h5>

                        <div>
                        </div>
                        <div>
                            <input id="card_number" class="cc-number" placeholder="Card Number" type="text">
                        </div>
                        <div>
                            <input id="expiration_date" class="cc-exp" placeholder="Expiration date (mm/yy)" type="text">
                        </div>
                        <div>
                            <input id="card_cvc" class="cc-cvc" placeholder="Card CVC" type="text">
                        </div>
                        <div>
                            <input id="cc-postal-code" placeholder="Billing Zip Code" type="text">
                        </div>
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default active">
                            <input type="radio" checked="checked" name="new-cc-primary" value="0" /> Additional
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="new-cc-primary" value="1" /> Primary
                          </label>
                        </div>
                    </div>
                    <div class="action">
                        <!-- <button>DISCARD</button> -->
                        <button id="newCcButton" class="saveNewAddress save">SAVE CREDIT CARD</button>
                    </div>
                </div>
            </div><!-- pages -->
            <div class="overlay" style="display:none;"><img src="{{ asset('images/small-loading.gif') }}" ></div>
        </div><!-- content -->
    </main>
    @stop

@section('scripts')
<script>

    $("#my_account_p").addClass("active");
    /*blade variables*/
    var userimg = "{{ $user["image_url"]["url"] }}";

    if(!userimg)
    {
        userimg = "{{ asset('images/default-photo.png') }}";
    }

    var goals = {!! $user["fitness_goals"] !!};
    var user_l = {!! $user !!};
    var height = "{{ $user['height'] }}";
    var height_unit = "{{ $user['height_measurement_type'] }}";

    var weight = "{{ $user['weight'] }}";
    var weight_unit = "{{ $user['weight_measurement_type'] }}";
    var gender = "{{$user['gender']}}";
    var dob = "{{$user['date_of_birth']}}";

    var locations = [
        {
            "country" : "United States",
            "states" : [
                "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado",
                "Connecticut", "Delaware", "District of Columbia", "Florida", "Georgia",
                "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky",
                "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota",
                "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire",
                "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota",
                "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina",
                "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
                "West Virginia", "Wisconsin", "Wyoming"
            ]
        },
        {
            "country" : "Country",
            "states" : [
                    "state 1", "state 2", "state 3", "state 4"
            ]
        }
    ];
</script>

@if(isset($user))
<script rel="script" type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script src="http://getshredz.foo/js/payment.min.js"></script>
<script src="https://js.braintreegateway.com/js/braintree-2.20.0.min.js"></script>
 <script>
 (function(){

    $('.cc-exp').mask('00/00');

    var addresses = {{ json_encode(isset($user) ? $user->addresses : '') }};
    var clientToken = $('meta[name="btClientToken"]').attr('content');
    var braintreeClient = new braintree.api.Client({
            clientToken: clientToken
    });

    //make sure payment details are not empty before sending to braintree
    function validatePaymentDetails(data) {
        var valid = true;
        var emptyFields = [];
        for(index in data){
            if(data[index] === ''){
                emptyFields.push(data[index]);
            }
        }
        if(emptyFields.length){
            valid = false;
        }
        return valid;
    }

    
    //clicking the button to save a new credit card
    $('#newCcButton').click(function(){
        $(this).hide();
        var data = {};
        $('.overlay').show();
        data.card_type = $.payment.cardType($('.cc-number').val());
        data.cc_number = $('.cc-number').val().trim().replace(/\s/g, '');
        data.cc_exp = $('.cc-exp').val().trim().replace(/\s/g, '');
        data.cc_cvc = $('.cc-cvc').val();
        data.nonce_token = 'token';
              console.log(data.cc_exp);
        new_cc_primary = $("input[name='new-cc-primary']:checked").val();
        if(validatePaymentDetails(data)){
          braintreeClient.tokenizeCard({
              number: data.cc_number,
              expirationDate: data.cc_exp
          }, function(error, nonce){
              var formData = {};
              formData.nonce_token = nonce;
              formData.primary = ((new_cc_primary==1) ? true : false);
              formData.postal_code = $('#cc-postal-code').val();
               if(error){
                  $('#newCcButton').show();
                  $('.overlay').hide();
                  $(".alert-danger span").text(error.message);
                  $(".alert-danger").alert();
                  $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
                  return false;
              }
              createPaymentProfilePost(formData);
          });
        }else{
          $('#newCcButton').show();
          $('.overlay').hide();
          $(".alert-danger span").text('Please fill out the credit card information.');
          $(".alert-danger").alert();
          $(".alert-danger").fadeTo(4000, 500).slideUp(500); 
        }
        return false;
    });

    function createPaymentProfilePost(data){
      console.log('dados enviados:');
      console.log(data);
        //send a request to create a new payment method
        $.ajax({
            type: 'POST',
            'url': '/settings/payments/{{ isset($user) ? $user->id : '' }}/ccnumber',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: data
        })
        .done(function(data){
            console.log(data);
            if(data.success){

              sendData = {
                  'type'              : data.type,
                  'last_four'         : data.last_four,
                  'creditcard_type'   : data.creditcard_type,
                  'billing_reference' : data.billing_reference,
                  'expiration_date'   : data.expiration_date,
                  'billing_zip'       : data.billing_zip,
                  'primary'           : data.primary,
              }

              ShredzAPI
                  .request('POST', 'v1/customer/payment_profiles/', null, null, sendData)
                  .then(function (res) {
                      $('.overlay').hide();
                      console.log(res);
                      $(".alert-success span").text(data.success);
                      $(".alert-success").alert();
                      $(".alert-success").fadeTo(4000, 500).slideUp(500); 
                      window.location = '/settings/payments';
                  });
            }
        })
        .fail(function(error){
          var errorList = '';

          $('#newCcButton').show();
          $.each(error.responseJSON.errors.customer, function(index, errorMsg){
            errorList += errorMsg;
          });

          $('.overlay').hide();
          $(".alert-danger span").text(errorList);
          $(".alert-danger").alert();
          $(".alert-danger").fadeTo(4000, 500).slideUp(500); 

          return false;
        });
    }

})();
</script>
@endif
@append