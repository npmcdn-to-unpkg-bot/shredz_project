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
                <a href="/settings" class="tab">Account <span class="hidden-xs">information</span></a><a href="/settings/payments" class="tab">Payment <span class="hidden-xs">information</span></a><a href="/settings/addresses" class="active tab"><span class="hidden-xs">Address information</span><span class="visible-xs">Addresses</span></a>
                <div class="account-info">
                  <div class="alert alert-danger" >
                      <span></span>
                  </div>
                    <div class="account-box">

                        <h5>Add New Address</h5>
                        <div>
                            <input id="addr_name" placeholder="Address Name" type="text">
                        </div>
                        <div>
                            <input id="addr_phone" placeholder="Address Phone" type="text">
                        </div>
                        <div>
                            <input id="addr_street" placeholder="Address Street" type="text">
                        </div>
                        <div>
                            <input id="addr_city" placeholder="City" type="text">
                        </div>
                        <div>
                            <input id="addr_zip" placeholder="Zip Code" type="text">
                        </div>
                        <div>
                            <select id="addr_country_code" name="addr_country_code">
                              <option value="">Choose a country:</option>
                            </select>
                        </div>
                        <div>
                            <select id="addr_state" name="addr_state" style="display:none;">
                              <option disabled>Choose the state:</option>
                              <option disabled>Choose the country first</option>
                            </select>
                        </div>
                    </div>
                    <div class="action">
                        <!-- <button>DISCARD</button> -->
                        <button class="saveNewAddress save">ADD ADDRESS</button>
                    </div>
                </div>
            </div><!-- pages -->
            <div class="overlay" style="display:none;"><img src="{{ asset('images/small-loading.gif') }}" ></div>
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
<script rel="script" type="text/javascript" src="{{asset('js/pages/settingsAddresses.js')}}"></script>
@append