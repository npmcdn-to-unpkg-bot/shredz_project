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
                <a href="/settings" class="tab">Account <span class="hidden-xs">information</span></a><a href="/settings/payments" class="active tab">Payment <span class="hidden-xs">information</span></a><a href="/settings/addresses" class="tab"><span class="hidden-xs">Address information</span><span class="visible-xs">Addresses</span></a>
                <div class="account-info">
                    <div class="payment-list">
                      <!-- <h5>My Payments Methods</h5> -->
                      <img src="{{ asset('images/small-loading.gif') }}" class="loading-img">
                      <table class="cc-table">
                        <tr class="cc-table-header">
                            <th>Credit Card</th>
                            <th>Card Number</th>
                            <th>Expiration</th>
                            <th></th>
                        </tr>
                        <tr class="payment_row" style="display:none;">
                          <td class="payment-info">1 Evertrust Plaza, Suite 901, Jersey City NJ, 07302 NJ</td>
                          <td class="payment-btn"></td>
                          <td class="payment-btn"></td>
                          <td class="payment-btn"><a href="./delete" class="delete-btn" rel="">Delete</a></td>
                        </tr>
                      </table>
                    </div>
                    <div class="add-item">
                      <a href="/settings/payments/add">
                      Add Credit Card
                      </a>
                    </div>
                </div>
            </div><!-- pages -->

        </div><!-- content -->
    </main>
    @stop

@section('scripts')
<script>

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

<script rel="script" type="text/javascript" src="{{asset('js/pages/paymentMethods.js')}}"></script>
@append