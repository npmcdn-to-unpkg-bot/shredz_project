@extends('themes.default.layout')

@section('content')
    <main class="help">

        <div id="help_header">
            <h1>GET HELP</h1>
        </div>

        <div class="content">
            <div class="search" style="display: none;">
                <button>GET ME AN ANSWER</button>
            <span class="input_wrapper">
                <input type="text" placeholder="Type Your Question">
            </span>
            </div><!-- search -->


            <h2>FREQUENTLY ASKED QUESTIONS</h2>
            <div class="faqButtons">
                <div class="left">
                    <button class='h_button odd' id="help_shipping" name="shipping-faq">SHIPPING</button>
                    <button class='h_button even' id="help_dosage" name="dosage-faq">DOSAGE</button>
                    <button class='h_button odd' id="help_returns" name="help-faq">RETURNS</button>
                    <button class='h_button even' id="help_support" name="support-faq">GENERAL SUPPORT</button>
                </div>
            </div><!-- faq buttons -->

            <div id="faqLinks" class="faq_dropdown">
                <div style="display: none;" id="shipping-faq">
                    <h2>How do I know if my order has shipped?</h2>
                    <p>Once you have completed your order, you will receive a confirmation number and/or receipt number. Processing generally takes anywhere from 24-72 hours (please note extended processing time may occur during sale periods). Once your package has been picked up by our contracted carrier (USPS) you will receive tracking information via the email address used at checkout!
                    </p>
                    <h2>What if my order has been lost?</h2>
                    <p>Contact us at support@shredz.com, and a support specialist will gladly assist!</p>
                    <h2>Where is my order shipping from?</h2>
                    <p>Orders are shipped from our fulfillment center in Rahway, New Jersey. All domestic orders are shipped via USPS with priority shipping in 2-5 business days.</p>
                    <h2>I used an old address when I placed my order, what do I do?</h2>
                    <p>Lets face it, we all make mistakes! Shoot our support department an email at support@shredz.com, and we'll help you figure this out right away.</p>

                </div>

                <div style="display: none;" id="help-faq">
                    <h2>How do I go about returning an order?</h2>
                    <p>Any returns must be made within 14 days of the date of delivery. All products must be unopened and in the original packaging to be considered for a refund. Any apparel items that are returned will only be eligible for an exchange or SHREDZ store credit. If interested in a return, please contact a support specialist at support@shredz.com, and we will have a prepaid return label sent to your email address. *Please note that return labels for domestic orders only and will not be provided for international orders..
                    </p>
                    <h2>I purchased SHREDZ apparel and it doesn't fit properly. How do I go about an exchange?</h2>
                    <p> As per standard company policy, apparel purchased directly from SHREDZ may be exchanged or returned for SHREDZ store credit only. Please reach out to us at support@shredz.com, and we will gladly issue a prepaid return label to exchange the items.</p>

                </div>

                <div style="display: none;" id="support-faq">
                    <h2>I purchased an ebook bundle and the links no longer work. What do I do?</h2>
                    <p>The links you were emailed will expire in 12 days if not downloaded and saved to your device. Contact a support specialist at support@shredz.com, and we will gladly have your links resent!</p>
                    <h2>What is Prop 65?</h2>
                    <p>Prop 65 is a warning label that is legally required by the state of California for dietary supplements and many other products sold in that state since 1986. Other products that have the same warning include chocolate, fast food, and coffee shops.</p>
                    <h2>Why do people choose to take supplements?</h2>
                    <p>Sometimes just diet and exercise does not cut it, to get the results you are after, that is why we developed our supplements (i.e. SHREDZ Burner) to work synergistically with your diet and training to get you absolutely "shredded."</p>
                    <h2>Where are you products manufactured?</h2>
                    <p>All products are manufactured in the USA in GMP FDA Inspected Facilities</p>
                </div>


                <div style="display: none;" id="dosage-faq">
                    <h2>What supplement is right for me?</h2>
                    <p>Please feel free to chat with any of our online or phone Supplement Specialist for advice and tips for choosing the right stack for you! Our product descriptions are fairly detailed including usage, ingredients, and feedback from our customers; however, as with any nutritional supplement product, please check with your doctor or healthcare professional for guidance on potential side effects.</p>

                    <h2>How long can I take SHREDZ Burner for?</h2>
                    <p>We recommend taking a break from our SHREDZ Supplements after 3 consecutive months. We recommend contacting your doctor or physician as it varies per individual.</p>
                    <h2>How long can I take SHREDZ Testosterone for?</h2>
                    <p>We recommend taking a 30 day break after 90 consecutive days. However, if you're really concerned we recommend contacting your doctor or physician as it varies per individual.</p>
                    <h2>How long can I take SHREDZ Creatine for?</h2>
                    <p>We recommend taking a 30 day break after 90 consecutive days. However, if you're really concerned we recommend contacting your doctor or physician as it varies per individual.</p>
                    <h2>How long can I take SHREDZ Detox for?</h2>
                    <p>These impressive pills are known as a body cleanse or immune booster, and can even be considered a daily vitamin for some. Simply stated, there are no constraints to this product!</p>
                    <h2>Can I still drink coffee while taking SHREDZ?</h2>
                    <p>Yes, you can still drink coffee or order other products that contain caffeine with SHREDZ Burner For Her or our SHREDZ Burner For Him but you will want to separate the doses between the two by at least 2-4 hours.</p>
                    <h2>What if I don't see weightloss or results right away?</h2>
                    <p>It took time to pile it on it's going to take time to burn it off, if you are not seeing results fast enough you may need to reevaluate your diet and training regimen.</p>
                    <h2>What is the best way to take the Alpha Male Stack?</h2>
                    <p>We recommend taking one (1) SHREDZ Burner, two (2) SHREDZ Testosterone, one (1) SHREDZ Multivitamin in the morning. The morning dose is then followed by one (1) SHREDZ Burner, one (1) SHREDZ Testosterone, two (2) SHREDZ Creatine pre workout. After you have worked your body to the max at the gym, take two (2) SHREDZ Creatine post workout. Don't forget about recovery, let your body rest and take one (1) SHREDZ Multivitamin with your last meal of the day in the evening.</p>
                    <h2>How do I take the Alpha Female Stack if I work out in the morning? afternoon? evening? </h2>
                    <p>Morning Workout: Thirty (30) minutes before workout: one (1) SHREDZ Burner Made for Women, two (2) SHREDZ Toner Made for Women, one (1) SHREDZ Multivitamin Made for Women Post Workout: two (2) SHREDZ Toner Made for Women. six (6)- eight (8) hrs after: one (1) SHREDZ Burner Made for Women, one (1) SHREDZ Multivitamin Afternoon Workout: In the morning: one (1) SHREDZ Burner Made for Women, one (1) SHREDZ Multivitamin Made for Women Afternoon/Preworkout: one (1) SHREDZ Burner Made for Women, two (2) SHREDZ Toner, Post workout:two (2) SHREDZ Toner Made for Women Evening: one (1) SHREDZ Multivitamin Made for Women with last meal Evening Workout: In the morning: one (1) SHREDZ Burner Made for Women, one (1) SHREDZ Multivitamin Made for Women 6-8 hrs after: one (1) SHREDZ Burner Made for Women, one (1) Multivitamin Made for Women Evening/Pre Workout: two (2) SHREDZ Toner Made for Women, Post workout: two (2) SHREDZ Toner Made for Women</p>
                    <h2>Can I take supplements without diet & exercise and still see results?</h2>
                    <p>Yes, but to get the maximum benefit out of any fat burning supplement you need to have your diet and training in check, it is after all, a supplement.</p>
                    <h2>What if I miss a day when taking any of your supplements?</h2>
                    <p>Just continue taking it the next day. Missing one day won't make or break you.</p>
                    <h2>How fast can I expect to see results?</h2>
                    <p>It all depends on the individual. How bad do you want it. How hard are you willing to work?</p>
                </div>
            </div><!-- faqLinks -->

            <div class="ghLine"></div>

            <div class="track">

                <div class="_row">
                    <h2 id="typ">LOGIN TO TRACK YOUR PACKAGE</h2>
                    <!--    <input id="help_fname" type="text" placeholder="Email Address">
                        <input id="help_email" type="text" placeholder="Zip Code">
                        <h2>OR</h2>
                        <input type="text" placeholder="Transaction ID">
                        <button>GET ORDER UPDATE</button>
                    </div><!-- track -->

                    <button class="btn red-btn open-sign-in" data-toggle="modal" data-target="#login-modal" id="login_to_track">LOGIN</button>
                </div>
                <div class="_row">
                    <h2 id="ttyp">Don't have an account?</h2>

                    <a id ="cch" class="open-sign-up"> <button class="btn dark-grey-btn" data-toggle="modal" data-target="#login-modal"  id="sign_up_now">SIGN UP</button></a>
                </div>
            </div>
        </div><!-- content -->

        <div class="cus-wrapper">
            <div id="outer_cus">
                <div id="inner_cus">
                    <div class="cus">
                        <div class="left">
                            <p id="shq">STILL HAVE QUESTIONS? CONTACT CUSTOMER SUPPORT</p>
                            <div class="alert alert-danger support-error-list" role="alert" style="display: none"></div>
                            <div class="alert alert-success support-success-message" role="alert" style="display: none"></div>
                            <form id="support_ticket_form">
                                <input id="fullname" class="input text-input" type="text" placeholder="Full Name">
                                <input id="email" class="input text-input" type="text" placeholder="Email Address">
                                <input id="email_verify" class="input text-input" type="text" placeholder="Verify Email">
                                <textarea id="textarea" class="input textarea-input" placeholder="Message"></textarea>
                                <button class="btn black-btn" onclick="return false;">SUBMIT SUPPORT TICKET</button>
                            </form>
                        </div><!-- left -->
                        <div class="right">
                            <p>
                                Join the <b>#SHREDZARMY</b> by following us on your favorite social media account <i>and help us to change
                                    the industry and change the world!</i>
                            </p>
                            <div id="help_social_icons">
                                <a href="https://www.facebook.com/shredzarmy/" target="_blank">  <img src="{{asset('images/hfacebook.png')}}"></a>
                                <a href="https://www.instagram.com/shredz/" target="_blank">  <img src="{{asset('images/hinsta.png')}}"></a>
                                <a href="https://twitter.com/shredzarmy" target="_blank">  <img src="{{asset('images/htwitter.png')}}"></a>
                                <a href="https://www.linkedin.com/company/shredz-supplements" target="_blank">    <img src="{{asset('images/hlinkedin.png')}}"></a>
                                <a href="https://www.youtube.com/user/shredztv" target="_blank">      <img src="{{asset('images/hyoutube.png')}}"></a>
                            </div>

                            <div class="group">
                                <p><b>CUSTOMER SUPPORT</b></p>
                                <p>Please email support@shredz.com or call</p>
                                <p class="phone"><b>(908) 514-4546</b></p>

                            </div>
                            <div class="group">
                                <p><b>PUBLIC RELATIONS AND MEDIA OPPORTUNITIES</b></p>
                                <p>Please email pr@getshredz.com</p>
                            </div>
                            <div class="group">
                                <p><b>SHREDZ SHIPPING WAREHOUSES - North America</b></p>
                                <p class="phone" style="font-weight: 300;">
                                    Rahway, NJ (USA)
                                </p>
                                <p>Los Angeles, CA (USA - Coming Soon)</p>
                                <p>Toronto, ON (Canada)</p>
                            </div>
                            <div class="group">
                                <p><b>SHREDZ SHIPPING WAREHOUSES - International</b></p>
                                <p>Beverwijk, Netherlands (Europe)</p>
                                <p>Melbourne, Australia (AU - Coming Soon)</p>
                            </div>
                        </div><!-- right -->

                    </div><!-- customer support -->

                </div>
            </div>
        </div>

    </main>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/pages/help.js')}}"></script>
@append