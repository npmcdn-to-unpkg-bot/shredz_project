
@extends('themes.default.layout')

@section('content')

    <div id="cart-vip-modal" class="modal fade cart-vip-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset("images/popupmodel.png") }}" class="model">
                    <div class="wrapper">
                        <h2 class="title">BECOME A VIP FOR FREE SHIPPING</h2>
                        <p class="disclaimer">USA CUSTOMERS ONLY</p>
                        <div class="line">
                            <div class="check"></div>
                            <p>
                                EXCLUSIVE SHREDZ CONTENT
                            </p>
                        </div>
                        <div class="line">
                            <div class="check"></div>
                            <p>
                                VIP ACCESS TO NEW PRODUCT LAUNCHES
                            </p>
                        </div>
                        <div class="line">
                            <div class="check"></div>
                            <p>
                                HEALTYH RECIPES + NEW WORKOUTS
                            </p>
                        </div>
                        <div class="line">
                            <div class="check"></div>
                            <p>
                                HEALTYH RECIPES + NEW WORKOUTS
                            </p>
                        </div>
                        <div class="line">
                            <div class="check"></div>
                            <p>
                                FREE USA SHIPPING ON EVERY ORDER, EVERY TIME
                            </p>
                        </div>
                        <p class="notice"><i>
                                A subscription change of $4.99 will apply for
                                each month thereafter. See <span>Subscription Policy.</span>
                            </i></p>
                        <button id="become_vip_button" class="vip-button"></button>
                        <a href="/checkout" class="decline" >NO THANKS</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- cart vip modal -->

    <div id="cart-coupon-modal" class="modal fade cart-coupon-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="coupon_loader_icon" class="cl-icon" src="../images/i_image.png">
                    <p id="coupon_loader_message" class="cl-message">Applying Coupon</p>
                </div>
            </div>
        </div>
    </div><!-- cart coupon modal -->

    <main class="cart container">
        <section id="holder">
            <section id="holder_inner">
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

                <section id="items_holder" class="items">

                </section>


                <section id="summary_holder">
                    <div id="coupon_code_holder"><div id="c_inner"><input class="input text-input promo_code" id="promo_code" type="text" placeholder="Promo Code"/> <button class='enter_promo no_pulsate btn dark-grey-btn' id="enter_promo">APPLY</button></div></div>
                    <div id="number_total_holders">
                        <div id="sub_num_holder"><span class="subtotal_label">Subtotal</span>  <span id="original_price_strikeout">$0.00</span>  <span id="total_subtotal">$0.00</span> </div>
                        <div id="discount_holder">
                            <span class="subtotal_label">Discount</span>
                            <span id="discount_amount"></span>
                        </div>

                        <div id="shipping_holder">
                            <span class="subtotal_label">Shipping</span>
                            <span class="subtotal_label">Shipping</span>
                            <span id="shipping_amount"></span>
                        </div>
                        <div id="tax_holder">
                            <span class="subtotal_label">Tax</span>
                            <span id="tax_amount"></span>
                        </div>
                        <div id="total_num_sum"><span class="total_label">Total</span>    <span id="the_total">$0.00</span></div>
                    </div>

                </section>

                <section id="cart_nav_button_holder">

                    <button id="continue_shopping"><a href="{{ route('shop') }}">  CONTINUE SHOPPING </a></button>

                    <a href="{{ url('checkout') }}" class="btn red-btn" id="checkout_button">CHECKOUT</a>
                </section>
            </section><!--holderinner-->
        </section>

    </main><!-- cart -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/newcart.css')}}">
@stop

@section('scripts')
    <script>
        var pinkCheckUrl = "{{ asset('images/pinkCheck.png') }}";
        var popupModalUrl = "{{ asset("images/popupmodel.png") }}";
    </script>
    <script  type="text/javascript" src="{{asset('js/cart_items.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pages/cart.js')}}"></script>
@append