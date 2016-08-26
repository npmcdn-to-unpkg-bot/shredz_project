@extends('themes.default.layout')

@section('content')
    <div class="spinner">
        <img style="display: block; margin: auto; padding: 100px 0;" src="{{ asset('images/loading.gif') }}">
    </div>
    <main class="productPage product-details" style="display: none">
        <div class="container-fluid">
            <div class="bread content" style="margin-bottom:0px;">
                <p><a href="/">HOME</a> / <a href="{{ route('shop') }}">SHOP</a> / <b>30 Day Quick Weight Loss Plan + Supplements for Men + FREE Testosterone</b></p>
            </div><!-- bread -->
            <h1 id="product_name_top"></h1>
        </div>

        <section class=" container">
            <!--PRODUCT INFO -->
            <section class="row offer product">
                <div class="col-sm-5 images">
                    <img id="product-img"/>
                    <p id="testimonial_warning">EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT.</p>
                    <div class="videoPlaceholder" id="testimonialVideo">

                    </div>

                    <div class="questions">
                        <p class="gender_link pink" id="questionsText"><b>HAVE QUESTIONS?</b></p>
                        <p class="right"><img id="questionsImg" class="phone" src="{{asset('images/products/phone.png')}}"/> (908) 514-4546</p>

                    </div>
                    <h3 class="paymentMethods_h">PAYMENT METHODS ACCEPTED:</h3>
                    <img class="paymentOptions" src="{{asset('images/products/paymentOptions.png')}}"/>
                </div>
                <div class="col-sm-7 plan">
                    <div class="special">
                        <p><s></s></p>
                        <h2></h2>
                        <h3><i></i></h3>
                    </div><!-- special -->
                    <div style="display: none;" class="fclock"></div>
                    <div class="includes" id="includes">
                        <h2 class="gender_link">Includes:</h2>

                    </div><!--includes-->
                    <div class="options" id="options">

                    </div>
                    <button class="btn addToCart gender_link">ADD TO CART</button>
                    <p class="free-us-shipping"><img class="box" src="{{asset('images/products/box.png')}}"/> GET IT NOW WITH FREE USA SHIPPING!</p>
                </div>
            </section>
            <!-- END PRODUCT INFO-->
        </section>

        <!-- HOW IT WORKS SECTION FOR FEMALE -->
        <section class="container" id="how-it-works-female" style="display: none">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>How It Works!</h1>
                    <button type="button" class="btn how-it-works-button" value="Start Now">START NOW</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1 class="select-goal-margin" style="color: black;">Select your goal</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-2">
                    <img class="arrow left" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-3">
                    <img class="arrow" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-4">
                    <img class="arrow right" src="{{asset('images/arrow-pink.png')}}">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>Weight Loss</h2>
                </div>
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>Shape + Tone</h2>
                </div>
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>More Energy</h2>
                </div>
            </div>

            <div class="row">
            <div class="col-xs-12 col-sm-7 col-sm-push-2">
                <img class="img-responsive" src="{{asset('images/lines.png')}}">
            </div>

            </div>

            <div class="row inside-section-margin section-margin inside-section-margin-mobile">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">1.</span> Sign Up</h3>
                            <p>Purchase your 30 Day Challenge Weight Loss Plan + Supplements and start getting motivated for change!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/badge.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">2.</span> Supplements</h3>
                            <p>You should get your weight loss kit in 3-7 days from the time of purchase. When you get it, read all of the instructions and locate your DAY 1 and DAY 30 cards.</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/bottles.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hidden-sm hidden-md hidden-lg">
                <div class="col-xs-12">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">3.</span> Record Starting Point</h3>
                            <p>Tale a "before" pic from the front and the side and weigh yourself. Use your DAY 1 card and show your abs, legs and arms. Don't be shy! You'll look so different in 30 days!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/scale.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">4.</span> Exercise</h3>
                            <p>Follow the exercise guides provided in your bundle to learn the best weight loss methods  and workout routines to reach your goals!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/walking.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hidden-sm hidden-md hidden-lg">
                <div class="col-xs-12">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">5.</span> Balanced Eating</h3>
                            <p>Use the nutrition guides provided to adjust your current diet to set yourself up for success.</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/apple.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">6.</span> Record your Progress</h3>
                            <p>Take an "after" pic! Make sure it looks just like your "before" pic for a good comparison, and use your DAY 30 card that came with your supplements. Weight yourself, too!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container camera-size" src="{{asset('images/camera.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-2 col-sm-push-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/arrow-pink.png')}}">
                </div>
                <div class="col-sm-5 col-sm-push-2 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">7.</span> Submit Results to Win!</h3>
                            <p>Visit <a href="{{ url('challenge') }}" target="_blank;">www.shredz.com/challenge</a> to enter! If you are selected, you'll be featured on Instagram, our website, and win a cash prize! Plus, you'll look and feel better than ever!</a></p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/trophy.png')}}">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- END HOW IT WORKS SECTION FEMALE-->

        <!-- HOW IT WORKS SECTION FOR MALE -->
        <section class="container" id="how-it-works-male" style="display: none">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>How It Works!</h1>
                    <button type="button" class="btn how-it-works-button" value="Start Now">START NOW</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1 class="select-goal-margin" style="color: black;">Select your goal</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-2">
                    <img class="arrow left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-3">
                    <img class="arrow" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-xs-2 col-sm-2 col-sm-push-3 col-xs-push-4">
                    <img class="arrow right" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>Weight Loss</h2>
                </div>
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>Shape + Tone</h2>
                </div>
                <div class="col-xs-4 col-sm-3 col-sm-push-1 col-xs-push-0 border">
                    <h2>More Energy</h2>
                </div>
            </div>

            <div class="row">
            <div class="col-xs-12 col-sm-7 col-sm-push-2">
                <img class="img-responsive" src="{{asset('images/lines.png')}}">
            </div>

            </div>

            <div class="row inside-section-margin section-margin inside-section-margin-mobile">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">1.</span> Sign Up</h3>
                            <p>Purchase your 30 Day Challenge Weight Loss Plan + Supplements and start getting motivated for change!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/badge.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">2.</span> Supplements</h3>
                            <p>You should get your weight loss kit in 3-7 days from the time of purchase. When you get it, read all of the instructions and locate your DAY 1 and DAY 30 cards.</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/bottles.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hidden-sm hidden-md hidden-lg">
                <div class="col-xs-12">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">3.</span> Record Starting Point</h3>
                            <p>Tale a "before" pic from the front and the side and weigh yourself. Use your DAY 1 card and show your abs, legs and arms. Don't be shy! You'll look so different in 30 days!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/scale.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">4.</span> Exercise</h3>
                            <p>Follow the exercise guides provided in your bundle to learn the best weight loss methods  and workout routines to reach your goals!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/walking.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hidden-sm hidden-md hidden-lg">
                <div class="col-xs-12">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">5.</span> Balanced Eating</h3>
                            <p>Use the nutrition guides provided to adjust your current diet to set yourself up for success.</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/apple.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-sm-5 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">6.</span> Record your Progress</h3>
                            <p>Take an "after" pic! Make sure it looks just like your "before" pic for a good comparison, and use your DAY 30 card that came with your supplements. Weight yourself, too!</p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container camera-size" src="{{asset('images/how-it-works-male/camera.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-2 col-sm-push-2">
                    <img class="rotate-90 arrow arrow-margin-left" src="{{asset('images/how-it-works-male/arrow.png')}}">
                </div>
                <div class="col-sm-5 col-sm-push-2 border">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><span class="number-color">7.</span> Submit Results to Win!</h3>
                            <p>Visit <a href="{{ url('challenge') }}" target="_blank;">www.shredz.com/challenge</a> to enter! If you are selected, you'll be featured on Instagram, our website, and win a cash prize! Plus, you'll look and feel better than ever!</a></p>
                        </div>
                        <div class="col-xs-3">
                            <img class="image-inside-container" src="{{asset('images/how-it-works-male/trophy.png')}}">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- END HOW IT WORKS SECTION MALE-->


        <!--WHAT"S INCLUDED-->
        <section class="container store inside-section-margin" id="whatsInc">
            <div class="title">
                <p id="prod-name-p"></p>
                <h2 id="what_inc_title" class="gender_link">WHAT'S INCLUDED</h2>
            </div>
            <div class="row products prod-page-prod" id="products">

            </div>
            <div class="row">
                <button class="btn addToCart gender_link" style="display:block;margin-left:auto;margin-right:auto;margin-top:40px;">ADD TO CART</button>
            </div>
        </section>
        <!-- END WHAT"S INCLUDED-->

        <section class="container-fluid">
            <section class="row">
                <div class="transformations">
                    <!-- <div class="consult">
                        <div class="group">
                            <p><b>FREE DIET</b></p>
                            <p>CONSULTATION</p>
                        </div>
                        <button>BEGIN TODAY</button>
                    </div><!-- consult -->
                    <h2 class="text-center">CUSTOMER TRANSFORMATIONS</h2>
                    <div class="con-wrapper">
                        <div class="con slider" id="transformations">
                            <img class="transformation" src="{{asset('images/01_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/11_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/02_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/12_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/03_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/13_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/04_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/14_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/05_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/15_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/06_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/16_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/07_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/17_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/08_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/18_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/09_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/19_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/10_shredzhome_transformation.jpg')}}">
                            <img class="transformation" src="{{asset('images/20_shredzhome_transformation.jpg')}}">
                        </div>
                    </div>
                </div><!-- transformations -->
            </section>
        </section>

        <!--CHALLENGE-->
        <section class="challenge">
            <div class="container section-margin">
                <h2>SHREDZ<sup class="rights">®</sup> TRANSFORMATION CHALLENGE <span class=" gender_link" id="challengeAmt">$10,000</span> GRAND PRIZE!</h2>
                <ul>
                    <li class="man_fe_challenge">1) Purchase SHREDZ 30 DAY WEIGHT LOSS PLAN FOR <span id="man_fee_c">WOMEN</span> </li>
                    <li>2) Take a picture with "Day 1 Card" (included with your package)</li>
                    <li>3) Do the 30 day challenge; we provide you with a nutition guide, exercise guide, and the supplements</li>
                    <li>4) On day 30, take a picture with "Day 30 Card" (included with your package)</li>
                    <li>5) Submit your pictures to <a href="//shredz.com/challenge">http://shredz.com/challenge</a></li>
                    <li>6) The best transformation submitted will be our winner</li>
                </ul>
                <p class="last">Please review our <a class="rulesLink gender_link" id="challengeRulesLink" href="/shredz-30-day-weight-loss-challenge-official-rules">30 Day Weight Loss Challenge Official Rules</a>, which govern all Challenges and Challenge participation.</p>
            </div>
        </section>

        <!--END CHALLENGE -->

        <!-- PRODUCT DESCRIPTION -->
        <section id="prodDesc" class="ltGreyBg container-fluid">
            <section class="container">
                <div class="middle content">
                    <div class="desc">
                        <h3></h3>
                        <h2 class="gender_link">PRODUCT DESCRIPTION</h2>

                        <p></p>

                    </div><!-- desc -->
                    <div class="benefits">
                        <h2>DESIGNED TO PROVIDE BENEFITS LIKE</h2>
                        <ul class="benefits-list">
                            <div class="container">
                                <div class="row">
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">WEIGHT LOSS</li>
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">REACH GOALS</li>
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">QUICK WORKOUTS</li>
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">PRIME SUPPLEMENTS</li>
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">HOLISTIC FITNESS LIFESTYLE</li>
                                    <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">EASY TO FOLLOW</li>
                                    <li class="col-xs-12 last-li gender_link" ><img src="{{asset('images/pinkCheck.png')}}">EFFECTIVE EXERCISES</li>
                                </div>
                            </div>
                        </ul>
                    </div><!-- benefits -->
                    <div class="mobile-description-selectors">
                        <h1>SELECT PRODUCT FOR INFO</h1>
                        <div class="button-wrapper" id="description-buttons">
                        </div>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="left"><h2 class="gender_link">DETAILS</h2></div>
                            <div class="center"><h2 class="gender_link">DOSAGE</h2></div>
                            <div class="right"><h2 class="gender_link">LABELS</h2></div>
                        </div>
                    </div><!-- info -->
                </div><!-- middle -->
            </section>
        </section>
        <button id="last_button" style="margin-right: auto;margin-left:auto; display: block;" class="addToCart gender_link btn">ADD TO CART</button>
        <!-- END PRODUCT DESCRIPTION -->

            <section class="athlete_testimonial endorsements container-fluid" id="athlete_testimonial">
                <div class="darken">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="left_main_display_icon imgPlaceholder" id="left_main_display_icon">
                                    <img/>
                                </div>
                                <div class="athlete_testimonial_holder" id="athlete_testimonial_holder">
                                    <h4 class="athlete_testimonial_title">WHAT AINSELY RODRIGUEZ LIKES...</h4>
                                    <p class="athlete_testimonial_paragraph">Lorem ipsum dolroLorem ipsum dolroLorem ipsum dolroLorem ipsum dolro Lorem ipsum dolro</p>
                                </div>
                            </div>
                            <div class="right_athlete_section col-md-offset-2 col-md-6 boxes">
                                <div class="right_grid_images">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- ENDORSEMENTS -->

        <div id="back_to_top_holder">
            <img class="backToTop" src="{{asset('images/arrows/backToTop.png')}}"/>
            <p class="backToTop">BACK TO TOP</p>
        </div>


    </main><!-- product page -->
@stop

@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css">
<style type="text/css">
    .transformation{
        width: 300px;
        margin: 5px 15px;
        box-shadow: 0 0 3px #bbb;
        cursor: pointer;
    }
    .slick-list{
        padding: 0px 38px;
    }
</style>
@append

@section('templates')
<script name="transformations" type="text/x-handlebars-template">
    @{{#each transformations}}
    <img class="transformation" src="{{ asset('images') }}/@{{ @this }}">
    @{{/each}}
</script>
@append

@section('scripts')
    @include('includes.lib.templating')
    <script>

    /*blade variables*/
    //!!  W A R N I N G  !!//
    // This is completely the wrong way to do this
    // Thanks Combustion Group!
    var lProductId = "{!! $id !!}";
    var redCheckUrl = "{{asset('images/redCheck.png')}}";
    var sizingChartFemaleUrl = "{{ asset('images/sizingChartFemale.png') }}";
    var lookInsideFemaleUrl = "{{ asset('images/lookinside-female.png') }}";
    var lookInsideMaleUrl = "{{ asset('images/LookInsideMale.png') }}";

    var imgMaleUrl = "{{ asset('images/products/mplan0.jpg') }}";
    var img2MaleUrl = "{{ asset('images/products/mplan1.jpg') }}";
    var img3MaleUrl = "{{ asset('images/products/mplan2.jpg') }}";
    var img4MaleUrl = "{{ asset('images/products/mplan3.jpg') }}";
    var img5MaleUrl = "{{ asset('images/mwlan_pone.jpg') }}";
    var img6MaleUrl = "{{ asset('images/mwlan_ptwo.jpg') }}";

    var img7MaleUrl = "{{ asset('images/1m.jpg') }}";
    var img8MaleUrl = "{{ asset('images/2m.jpg') }}";
    var img9MaleUrl = "{{ asset('images/3m.jpg') }}";
    var img10MaleUrl = "{{ asset('images/4m.jpg') }}";
    var img11MaleUrl = "{{ asset('images/5m.jpg') }}";
    var img12MaleUrl = "{{ asset('images/6m.jpg') }}";
    var img13MaleUrl = "{{ asset('images/7m.jpg') }}";
    var img14MaleUrl = "{{ asset('images/8m.jpg') }}";
    var img15MaleUrl = "{{ asset('images/9m.jpg') }}";
    var img16MaleUrl = "{{ asset('images/10m.jpg') }}";

    var imgFemaleUrl = "{{ asset('images/products/fplan0.jpg') }}";
    var img2FemaleUrl = "{{ asset('images/products/fplan1.jpg') }}";
    var img3FemaleUrl = "{{ asset('images/products/fplan2.jpg') }}";
    var img4FemaleUrl = "{{ asset('images/products/fplan3.jpg') }}";
    var img5FemaleUrl = "{{ asset('images/pwlan_pone.jpg') }}";
    var img6FemaleUrl = "{{ asset('images/780x483_female2.jpg') }}";

    var img7FemaleUrl = "{{ asset('images/1f.jpg') }}";
    var img8FemaleUrl = "{{ asset('images/2f.jpg') }}";
    var img9FemaleUrl = "{{ asset('images/3f.jpg') }}";
    var img10FemaleUrl = "{{ asset('images/4f.jpg') }}";
    var img11FemaleUrl = "{{ asset('images/5f.jpg') }}";
    var img12FemaleUrl = "{{ asset('images/6f.jpg') }}";
    var img13FemaleUrl = "{{ asset('images/7f.jpg') }}";
    var img14FemaleUrl = "{{ asset('images/8f.jpg') }}";
    var img15FemaleUrl = "{{ asset('images/9f.jpg') }}";
    var img16FemaleUrl = "{{ asset('images/10f.jpg') }}";

    var transformations = {
        male: [
            '11_shredzhome_transformation.jpg',
            '12_shredzhome_transformation.jpg',
            '13_shredzhome_transformation.jpg',
            '14_shredzhome_transformation.jpg',
            '15_shredzhome_transformation.jpg',
            '16_shredzhome_transformation.jpg',
            '17_shredzhome_transformation.jpg',
            '18_shredzhome_transformation.jpg',
            '19_shredzhome_transformation.jpg',
            '20_shredzhome_transformation.jpg'
        ],
        female: [
            '01_shredzhome_transformation.jpg',
            '02_shredzhome_transformation.jpg',
            '03_shredzhome_transformation.jpg',
            '04_shredzhome_transformation.jpg',
            '05_shredzhome_transformation.jpg',
            '06_shredzhome_transformation.jpg',
            '07_shredzhome_transformation.jpg',
            '08_shredzhome_transformation.jpg',
            '09_shredzhome_transformation.jpg',
            '10_shredzhome_transformation.jpg'
        ]
    }
	</script>
    {{--JWPlayer --}}
    <script rel="script" type="text/javascript" src="{{ asset('js/jwplayer.min.js') }}"></script>
    <script type="text/javascript">
      jwplayer.key='abNAI9Lgg7dNri7DE+SO1+Qri6J1f0KwXy7meQ==';
      jwplayer.defaults = {
          autostart: false,
          controls: true,
          displaydescription: false,
          displaytitle: false,
          flashplayer: "//ssl.p.jwpcdn.com/player/v/7.2.4/jwplayer.flash.swf",
          height: 270,
          ph: 1,
          plugins: {"//assets-jpcust.jwpsrv.com/player/6/6124956/ping.js": {"pixel": "//content.jwplatform.com/ping.gif"}},
          preload: "none",
          primary: "flash",
          repeat: false,
          stagevideo: false,
          stretching: "uniform",
          width: 480
      };
    </script>
    <script type="text/javascript">window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s= d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set. _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8'); $.src='//v2.zopim.com/?219N88usAAF5K4SUFlw2bWKPEpaX47c1';z.t=+new Date;$. type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');</script>
    <script type="text/javascript" src="//zopim.shredz.com"></script>
    <script type="text/javascript">$(document).bind("mobileinit", function(){$.extend(  $.mobile , {autoInitializePage: false})});</script>
    <script type="text/javascript" src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="{{asset('js/athletes.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/products.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/product.factory.js')}}"></script>
@append
