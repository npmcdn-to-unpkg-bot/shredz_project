@extends('themes.default.layout')

@section('content')

    <main class="shipbill">
        <div class="container">
            <div class="edit row">
                <div class="right">
                    <img src="{{ asset('images/comodo-icon.png') }}">
                </div>
                <div class="left">
                    <a href="/checkout"><p>< EDIT CONTACT INFORMATION</p></a>
                </div>
            </div>
            <div class="shipping">

                <form id="shipping" autocomplete="on">
                    <h2>SHIPPING DETAILS</h2>
                    <div class="row">
                        <p>First Name*</p><input class="input text-input" type="text" placeholder="First Name*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>Last Name*</p><input class="input text-input" type="text" placeholder="Last Name*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>Address*</p><input class="input text-input" type="text" placeholder="Address*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>Address Line 2</p><input class="input text-input" type="text" placeholder="Address Line 2" class="c">
                    </div>
                    <div class="row">
                        <p>Country*</p><input class="input text-input" type="text" placeholder="Country*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>State/Province*</p><input class="input text-input" type="text" placeholder="State/Province*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>City*</p><input class="input text-input" type="text" placeholder="City*" class="req_field shipi">
                    </div>
                    <div class="row">
                        <p>Zip/Postal Code*</p><input class="input text-input" type="text" placeholder="Zip/Postal Code*" class="req_field shipi">
                    </div>
                </form>
            </div><!-- shipping -->
            <div class="copy" style="margin-top: 28px; margin-bottom: 28px;">
                <input type="checkbox" style="top: 0;">
                <label style="top: 0;">My billing address is the same as my shipping address.</label>
                <!-- <a href="/checkoutReview"><button>REVIEW ORDER</button></a> -->
            </div>
            <div class="billing">
                <h2>BILLING DETAILS</h2>
                <form id="billing" autocomplete="on">
                    <div class="row">
                        <p>First Name*</p><input class="input text-input" type="text" placeholder="First Name*" class="req_field">
                    </div>
                    <div class="row">
                        <p>Last Name*</p><input class="input text-input" type="text" placeholder="Last Name*" class="req_field">
                    </div>
                    <div class="row">
                        <p>Address*</p><input class="input text-input" type="text" placeholder="Address*" class="req_field">
                    </div>
                    <div class="row">
                        <p>Address Line 2</p><input class="input text-input" type="text" placeholder="Address Line 2" class="c">
                    </div>
                    <div class="row">
                        <p>Country*</p><input class="input text-input" type="text" placeholder="Country*" class="req_field">
                    </div>
                    <div class="row">
                        <p>State/Province*</p><input class="input text-input" type="text" placeholder="State/Province*" class="req_field">
                    </div>
                    <div class="row">
                        <p>City*</p><input class="input text-input" type="text" placeholder="City*" class="req_field">
                    </div>
                    <div class="row">
                        <p>Zip/Postal Code*</p><input class="input text-input" type="text" placeholder="Zip/Postal Code*" class="req_field">
                    </div>
            </div><!-- billing -->
            </form>
            <div class="copy">
                <button class="btn blue-btn" id="review_order_button" onclick="review()">REVIEW ORDER</button>
            </div>
        </div><!-- container -->
    </main>
@stop