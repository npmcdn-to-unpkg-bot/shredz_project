@extends('themes.default.layout')



@section('content')

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

    <div id="payment-modal" class="cart-coupon-modal modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <img id="coupon_loader_icon" class="cl-icon" src="../images/i_image.png">
                <p id="coupon_loader_message" class="cl-message">Processing Payment</p>
            </div>
        </div>
    </div><!-- payment modal -->

    <main class="whitesmoke full_wide">
        <div id="holder" class="checkout">

            <div class="container2">
                <div class="edit row">
                    <div class="right">
                        <img class="lock" src="{{ asset('images/comodo-icon.png') }}">
                    </div>
                    <div class="left">
                        <!-- <a href="/cart"><p>< EDIT CART</p></a>-->
                    </div>
                </div>

                <section id="show_order_summary" class="closer">
                    <div id="left_order_summary"><img id="mini_lock" src=""/><p id="s_o_s_p">Show Order Summary <span id="arrow"></span></p></div>
                    <div id="right_order_sumamry"></div>
                    <div class="cart"> <div class="items"></div>
                        <section id="summary_holder">
                            <div id="coupon_code_holder"><div id="c_inner"><input class=" input text-input promo_code" id="promo_code" type="text" placeholder="Promo Code"/> <button class='btn dark-grey-btn no_pulsate enter_promo' id="enter_promo">APPLY</button></div></div>
                            <div id="number_total_holders">
                                <div id="sub_num_holder"><span class="subtotal_label">Subtotal</span>  <span id="original_price_strikeout">$0.00</span>  <span id="total_subtotal">$0.00</span> </div>
                                <div id="discount_holder">
                                    <span class="subtotal_label">Discount</span>
                                    <span id="discount_amount"></span>
                                </div>

                                <div id="shipping_holder">
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

                    </div>
                    <div id="orders_holder">

                    </div>
                </section>

                <section class="row_con">
                    <section id="progress_indicator">
                        <div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Cart</div></div>
                        <div class="indication_bar full"><span></span></div> <div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Shipping</div></div>
                        <div class="indication_bar semi_full"><span></span></div><div class="circle_l_wrapper"><div class="step_circle">3</div><div class="circle_label">Payment</div></div>

                    </section>
                </section>
                <div id="error_holder"></div>

                <section id="payment_method_wrapper container">
                    <section id="payment_method_inner" class="row">
                        <h1 class="payment_h1">PAYMENT METHOD</h1>
                        <h2 class="pay_type_h2">Secure Payment</h2>
                        <div class="check_toggles" id="use_cc"> <input type="radio" name="cc" value="cc" class="c_radio top_c" id="is_cc_radio"> <label for="is_cc_radio"></label> <h5 class="barrier_click" id="full-click-cc">Credit Card</h5> <div class="col-xs-12 barrier_click"></div> <img id="the_ccards" class="c_icons" src="{{ asset('images/cCardIcons.png') }}"/></div>
                        <div id="h_h"><div id="holds_cc_inf">
                                <!--   <div class="fifty_grid left_grid"> <input type="text" id="fname" class="grey_input half_input left_input" placeholder="First Name" /> </div>
                                   <div class="fifty_grid "><input type="text" id="lname" class="grey_input half_input t" placeholder="Last Name" autocomplete/> </div>-->
                                <div class="col-md-9 col-xs-12"> <input type="text" id="cc_num" x-autocompletetype="cc-number" class="smart_placeholder grey_input half_input left_input unknown" data-placeholder="top" placeholder="Card Number" />  </div>
                                <div class="mobile-margin-top col-md-3 col-xs-12"> <input type="text" id="cvv_code" class="grey_input half_input t" placeholder="CVV Code" />  </div>
                                <div class="col-md-6 col-xs-12 top-margin-form">
                                    <select id="cc_month" class="select-arrow-bg grey_input half_input left_input">
                                        <option value="" disabled selected>Expiration Month</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 top-margin-form"><select id="cc_year" class="select-arrow-bg grey_input half_input t" >
                                        <option value="" disabled selected>Expiration Year</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>
                                        <option>2024</option>
                                    </select>

                                </div>
                                <div class="fake_padding"></div>
                            </div>  <!--holds credit info--></div>
                        <div id="use_paypal_div" style="display: none;" class="check_toggles col-xs-12">
                            <input type="radio" name="cc" value="paypal" class="c_radio top_c" id="is_paypal_radio"> <label for="is_paypal_radio"></label>
                            <h5 id=full-click-paypal>Paypal</h5> <div class="barrier_click"></div>
                            <img class="c_icons" src="{{ asset('images/cpaypal.png') }}"/>
                        </div>
                    </section><!-- reverted -->

                    <div id="billing_addy_outer" class="container">
                        <section id="billing_addy_inner" class="row">
                            <h1 class="payment_h1">BILLING ADDRESS</h1>

                            <div class="grey-border"></div>

                            <div class="col-xs-12 check_toggles" id="same_billing_b">
                                <input type="radio" name="bill" value="same" class="c_radio billing_c" id="is_same_bill"> <label for="is_same_bill"></label>     <h5>Same as shipping address</h5>

                                <div class="barrier_click"></div>
                            </div>
                            <div class="col-xs-12 check_toggles" id="diff_billing_b">
                                <div class="barrier_click"></div>
                                <input type="radio" name="bill" value="not_same" class="c_radio billing_c" id="is_different_bill"> <label for="is_different_bill"></label>   <h5>Use a different billing address</h5>
                            </div>
                            <div id="hold_billing_diff"><div id="hold_billing_diff_inner">

                                    <form id="alt_billing">
                                        <div class="col-xs-12 col-md-6 fifty_grid left_grid"> <input type="text" id="bfname" name="First Name" class="grey_input half_input left_input req_field" placeholder="First Name" /> </div>
                                        <div class="col-xs-12 col-md-6 fifty_grid "><input type="text" name="Last Name" id="blname" class="grey_input half_input t req_field" placeholder="Last Name" autocomplete/> </div>
                                        <div class="col-md-8 col-xs-12 seventy_grid"> <input type="text" name="Address" id="addressone" class="grey_input half_input left_input req_field" placeholder="Address" autocomplete/>  </div>
                                        <div class="col-md-4 col-xs-12 thirty_grid"> <input type="text"  id="addresstwo" class="grey_input half_input t " placeholder="Address Line 2" autocomplete/>  </div>
                                        <div class="col-xs-12"><input name="City" type="text" id="city" class="full_input grey_input req_field" placeholder="City"/></div>
                                        <div class="col-md-4 col-xs-12 forty_grid top-margin-form">

                                            <select  id="country" class="grey_input half_input left_input">

                                                <option value="US"  selected>United States</option>
                                                <option value="CA" >Canada</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">&Aring;land</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BQ">Bonaire</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos [Keeling] Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Curacao</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="CD">Democratic Republic of the Congo</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="TL">East Timor</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="CI">Ivory Coast</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="XK">Kosovo</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao</option>
                                                <option value="MK">Macedonia</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar [Burma]</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="KP">North Korea</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestine</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn Islands</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="CG">Republic of the Congo</option>
                                                <option value="RE">R&eacute;union</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barth&eacute;lemy</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SX">Sint Maarten</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option value="KR">South Korea</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UM">U.S. Minor Outlying Islands</option>
                                                <option value="VI">U.S. Virgin Islands</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican City</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>

                                            </select>

                                        </div>
                                        <div class="col-xs-12 col-md-4 top-margin-form forty_grid"> <input name="State" type="text" id="state" class="grey_input half_input left_input req_field" placeholder="State" autocomplete/>  </div>
                                        <div class="col-xs-12 col-md-4 top-margin-form twenty_grid"> <input name="Zip Code" type="text" id="zip_code" class="grey_input half_input t req_field" placeholder="Zip/Postal Code" autocomplete/>  </div>
                                    </form>
                                </div></div><!--diff billing-->
                        </section></div>

                    <section id="summary_holder">
                        <div id="coupon_code_holder"><div id="c_inner"><input class="input text-input my_promo_code promo_code" id="promo_code2" type="text" placeholder="Promo Code"/> <button class='enter_promo  btn dark-grey-btn no_pulsate' id="enter_promo2">APPLY</button></div></div>
                        <div id="number_total_holders">
                            <div id="sub_num_holder"><span class="subtotal_label">Subtotal</span>  <span id="original_price_strikeout">$0.00</span>  <span id="total_subtotal" class='my_subtotal'>$0.00</span> </div>
                            <div class="discount_holder" id="discount_holder">
                                <span class="subtotal_label">Discount</span>
                                <span id="discount_amount" class='my_discount'></span>
                            </div>

                            <div class="shipping_holder" id="shipping_holder">
                                <span class="subtotal_label">Shipping</span>
                                <span id="shipping_amount" class='my_shipping'></span>
                            </div>
                            <div class="tax_holder" id="tax_holder">
                                <span class="subtotal_label">Tax</span>
                                <span id="tax_amount" class='my_tax'></span>
                            </div>
                            <div id="total_num_sum"><span class="total_label">Total</span>    <span id="the_total" class='my_total'>$0.00</span></div>
                        </div>

                    </section>

                    <!--  <div class="holder_for_sub">
                         <input type="checkbox" name="checkbox" id="checkbox_id" value="value">
                         <label for="checkbox_id">Subscribe to SHREDZ Newsletter  </label>
                      </div> -->


                    <a href="/checkout/">  <button id="continue_shopping"> EDIT INFORMATION </button></a>

                    <button class="btn red-btn" id="submit_payment_button"> PLACE ORDER </button>
                </section>
            </div>
        </div>
    </main>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.formance.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.creditCardValidator.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/awesome_form.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scale.fix.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/cart_items.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/jquery.smartPlaceholder.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/checkoutReview.js')}}"></script>
@append