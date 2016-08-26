    <section style="background-color: white;" class="hidden-xs">
        <div class="disclaimer">
            <p>
                STATEMENTS ON THIS SITE HAVE NOT BEEN EVALUATED BY THE FDA. PRODUCTS LISTED ARE NOT INTENDED TO DIAGNOSE, TREAT, CURE, OR PREVENT ANY DISEASE.
            </p>
            </div><!-- disclaimer -->
            </section><!-- section -->
<footer class="desktop-footer hidden-xs">
            <div class="container">
                <div class="col-xs-12 col-sm-3">
                    <h2>Products</h2>
                    <ul>
                        <li><a href="{{ route('shop', ['#weight-loss-supplements+recovery+health-wellness+build-muscle']) }}">Supplements</a></li>
                        <li><a href="{{ route('shop', ['#meal-plan']) }}">Diet / Trainings</a></li>
                        <li><a href="{{ route('shop', ['#accessories+bottoms+looks+stringers+t-shirts+tanktops+tops']) }}">Apparel</a></li>
                        <li><a href="{{ route('shop', ['#accessories']) }}">Accessories</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <h2>Featured</h2>
                    <ul>
                        <li><a href="{{ route('shop', ['#sale']) }}">Sale</a></li>
                        <li><a href="{{ route('shop', ['#+low-to-high']) }}">Under $75</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <h2>Support</h2>
                    <ul>
                        <!-- <li><a href="#">Chat with us</a></li> -->
                        <li><a href="{{ route('help') }}">Customer Service</a></li>
                        <li><a href="{{ route('help') }}">Shipping</a></li>
                        <li><a href="{{ route('help') }}">FAQ</a></li>
                        <li><a href="{{ route('help') }}">Send us email</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <h2>Company Info</h2>
                    <ul>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('termsAndConditions') }}">Terms of use</a></li>
                        <li><a href="{{ route('privacyPolicy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('returnPolicy') }}">Return Policy</a></li>
                    </ul>
                </div>
            </div>
            <section class="copyright-footer">
                <div class="copyright container-fluid">
                    <div class="row">
                        <ul class="list-inline social-networks desktop-social">
                            <li>
                                <a href="https://www.instagram.com/shredz/" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/ShredzSupplements/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/shredzarmy" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/user/shredztv" target="_blank">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/shredz-supplements" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.pinterest.com/shredzarmy/" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://shredzsupplements.tumblr.com/" target="_blank">
                                    <i class="fa fa-tumblr"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul class="list-inline footer-desktop">
                            <li><span class="icon"><img src="{{ asset('images/flag-icon.png') }}"></span>&nbsp;United States</li>
                            <li class="border-left-desktop">Copyright &copy; 2016 SHREDZ® Supplements</li>
                            <li class="border-left-desktop">All Rights Reserved</li>
                            <li class="border-left-desktop">Secure Shopping with Certified SSL<i class="fa fa-lock"></i></li>
                        </ul>
                    </div>
                </div>
            </section>
        </footer>
        @section('scripts')
        <script>
        $("#emailsub").on("keypress",function(e){
        if (e.which == 13) {
        $("#subscribeForm").trigger("click");
        }
        });
        $('#subscribeForm').submit(function(evt){
        $(".spinner").show();
        evt.preventDefault();
        //console.log({"email":$('#emailsub').val()});
        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
        type:$(this).attr('method'),
        url:$(this).attr('action'),
        contentType:'application/json',
        data:JSON.stringify({
        "email":$('#emailsub').val(),
        "fromWhere":$("#vip-identifier").val()
        }),
        success:function(response){
        $(".spinner").hide();
        $('#success').show();
        $('#error').hide();
        $("#emailsub").val("");
        var fbq = window.fbq || function() {};
        fbq('track', 'Lead');
        },
        error:function(e){
        $(".spinner").hide();
        $("#error").show().text(e.responseJSON.warnings.email[0]);
        $('#success').hide();
        console.log(e);
        }
        });
        });
        $('.secure').click(function(){
        $('body').append('<div class="overlay">' +
            '<div class="popup">' +
                '<h2>Secure Shopping</h2>' +
                '<p>We implement a variety of security measures to maintain the safety of your personal information when you place an order or enter, submit, or access any information on our website. We incorporate physical, electronic, and administrative procedures to safeguard the confidentiality of your personal information, including Secure Sockets Layer (SSL) for the encryption of all financial transactions through the website. We use industry-standard, 256bit SSL encryption to protect your personal information online, and we also take several steps to protect your personal information in our facilities. For example, when you visit the website, you access servers that are kept in a secure physical environment, behind a locked cage and a hardware firewall. After a transaction, your credit card information is not stored on our servers.</p>' +
            '<button title="Close (Esc)" type="button" class="close">×</button></div></div>');
            $('.overlay').on('click', function(e) {
            if( e.target == this ) {
            $(this).remove();
            }
            });
            $('.close').click(function(){
            $(this).parent().parent().remove();
            });
            });
            </script>
            @append