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
                <div class="cart">
                    <div class="items"></div>
                    <section id="summary_holder">
                        <div id="coupon_code_holder"><div id="c_inner"><input id="promo_code"  class="promo_code" type="text" placeholder="Promo Code"/> <button class='btn no_pulsate enter_promo' id="enter_promo">APPLY</button></div></div>
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
                    <div class="circle_l_wrapper"><div class="step_circle finished"></div><div class="circle_label">Cart</div></div>   <div class="indication_bar semi_full"><span></span></div> <div class="circle_l_wrapper"><div class="step_circle">2</div><div class="circle_label">Shipping</div></div>
                    <div class="indication_bar"></div><div class="circle_l_wrapper"><div class="step_circle">3</div><div class="circle_label">Payment</div></div>

                </section>
            </section>

            <div id="error_holder"></div>

            <section class="container float-fix" id="checkout_contact_info">
                <section id="checkout_contact_info_inner">
                    <h2 class="icon" id="p_i_h">CUSTOMER INFORMATION</h2>
                    <section id="top_form">
                        <form id="ship_form">
                            <div class="hundred_grid"><input class="smart_placeholder full_input grey_input req_field email_field" data-position="top" type="email" name="E-mail" id="email"  placeholder="E-mail" autocomplete/></div>


                           
                               {{--  <p class="already_have">Already Have a SHREDZ Account?  <span id="login_text">Log In</span></p> --}}
                            

                            <p class="enter_insta">Enter instagram username for special promotions!</p>
                            <div class="row">
                                <div class="hundred_grid col-xs-12">   <input type="text" id="insta_handle" class="smart_placeholder full_input grey_input" placeholder="@ Instagram Username" data-position="top"/></div>
                                <div class="hundred_grid col-xs-12"><input type="text" id="contact_phone" class="smart_placeholder full_input grey_input" placeholder="Contact Phone Number" data-position="top"/></div>
                            </div>
                        </form>
                    </section>

                    <h2 class="icon" id="s_i_h">SHIPPING ADDRESS</h2>

                    <div class="bootstrap-no-lp bootstrap-pad-remove col-xs-12 fifty_grid left_grid bootstrap-fullw-override"><input type="text" name="First Name" id="fname" class="smart_placeholder grey_input half_input left_input req_field" placeholder="First Name" data-position="top" autocomplete/> </div>
                    <div class="bootstrap-no-lp bootstrap-pad-remove col-xs-12 fifty_grid right_grid bootstrap-fullw-override"><input type="text" name="Last Name" id="lname" class="smart_placeholder grey_input half_input req_field" placeholder="Last Name" data-position="top" autocomplete/> </div>
                    <div class="bootstrap-no-lp bootstrap-pad-remove col-xs-12 col-sm-8 seventy_grid"> <input type="text"  name="Address" id="addressone" class="smart_placeholder grey_input half_input left_input req_field" data-position="top" placeholder="Address" autocomplete/>  </div>
                    <div class="bootstrap-pad-remove col-xs-12 col-sm-4 thirty_grid bootstrap-addres2-override"> <input type="text" id="addresstwo" class="smart_placeholder grey_input half_input  " placeholder="Address Line 2" data-position="top" autocomplete/>  </div>
                    <div style="padding-right: 0;" class="bootstrap-no-lp bootstrap-pad-remove col-xs-12 hundred_grid"><input type="text"  name="City" id="city" class="smart_placeholder full_input grey_input req_field" data-position="top" placeholder="City"/></div>
                    <div class="bootstrap-no-lp bootstrap-pad-remove col-xs-12 col-sm-5 forty_grid">

                        <select  id="country" class="select location-select grey_input half_input left_input">
                            <option value="US"  >United States</option>
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
                            <option value="US" >United States</option>
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
                    <div class="col-sm-5 col-xs-12 forty_grid bootstrap-pad-remove"> <input type="text"  name="State" id="state" class="smart_placeholder grey_input half_input left_input req_field" placeholder="State" data-position="top" autocomplete/>  </div>
                    <div class="col-sm-2 col-xs-12 twenty_grid bootstrap-zip-override"> <input type="text"  name="Zip Code" id="zip_code" class="smart_placeholder grey_input half_input right_input req_field" placeholder="Zip Code" data-position="top" autocomplete/>  </div>

                </section>



            </section><!--contact info-->
            <a href="/cart/" id="continue_shopping"> EDIT CART </a>

            <button id="checkout_button_two"> CONTINUE </button>

            <input type="hidden" id="carrierCode" val="01"/>
        </div>
    </div>
        </main>
@stop

@section('scripts')

    <script  type="text/javascript" src="{{asset('js/jquery.smartPlaceholder.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/cart_items.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/checkout.js')}}"></script>
@append
