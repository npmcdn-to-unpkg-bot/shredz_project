@extends('themes.default.layout')

@section('content')
    <div class="banner" id="thankyou-banner">
        <h1>THANK YOU FOR YOUR PURCHASE</h1>
    </div>
    {{-- TODO add callback to get function in controller
    <div id="info-url" hidden="hidden">{{ $callback }}</div>
    --}}
    <main>
        <section class="row_con">
            <section id="progress_indicator">
                <div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Cart</div></div>
                <div class="indication_bar full"><span></span></div> <div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Shipping</div></div>
                <div class="indication_bar full"><span></span></div><div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Payment</div></div>

            </section>
        </section>
        <section class="information">
            <div class="user-information">
                <h2 id="customer-name">-</h2>
                <div>
                    <div class="transaction">
                        <h3>TRANSACTION ID</h3>
                        <p id="transaction-id">-</p>
                    </div>
                    <div class="order">
                        <h3>ORDER STATUS</h3>
                        <p id="order-status">-</p>
                    </div>
                </div>
            </div>
            <div class="shipping-information">
                <h3>SHIPPING ADDRESS</h3>
                <p id="customer-name-2">-</p>
                <p id="ship-street">[street]</p>
                <p id="ship-city">[city, state, zip]</p>
                <p id="ship-country">[country]</p>
            </div>
            <div class="frbuttons">
                <button id="track-package">TRACK YOUR PACKAGE</button>
                <button id="manage-account">CREATE ACCOUNT</button>
            </div>
        </section>
        <section class="cart">
            <section  id="top_summary">
                <span class="o_summary">ORDER SUMMARY</span>

                <section id="mini_summary_holder">
                <span class="mini_summary_title">
                    PRICE
                </span>
                 <span class="mini_summary_title">
                    QUANTITY
                </span>
                 <span class="mini_summary_title">
                    TOTAL
                </span>
                </section>
            </section><!--top summarry-->
            <div class="items"></div>
        </section>
        <section class="instructions">
            <h2>WHATS NEXT</h2>
            <p>Your order has just been sent the warehouse closest to you for processing and packaging. Within the next 1-2 business days a warehouse manager will process your package and you will receive an email from our warehouse that will match the information seen here and provide a few more details. From there you will receive a second email within 24 hours of the first email with detailed tracking information as soon as your package is scanned onto a truck!</p>
            <h3>DOSAGE INSTRUCTIONS</h3>

            </div>
        </section>
    </main><!-- .thanksPage -->
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/pages/thanks.js')}}"></script>
@append