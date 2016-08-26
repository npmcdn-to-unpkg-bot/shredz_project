@extends('themes.default.layout')
@inject('api', 'App\Tools\ShredzAPI')
@section('root-class') product-page @stop
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@stop
@section('metas')
    <link rel="canonical" href="{{ route('products', [$id => $id]) }}">
@append

@section('content')

<div class="spinner">
    <img style="display: block; margin: auto; padding: 100px 0;" src="{{ asset('images/loading.gif') }}">
</div>
<main class="productPage product-details" style="display: none">
    {{-- ## BREADCRUMB ## --}}
    <div class="container-fluid">
        <div class="bread content" style="margin-bottom:0px;">
            <p><a href="/">HOME</a> / <a href="{{ route('shop') }}">SHOP</a> / <b>30 Day Quick Weight Loss Plan + Supplements for Men + FREE Testosterone</b></p>
        </div>
        <h1 id="product_name_top"></h1>
        <h2 class="text-center" id="product_subtitle"></span>


    </div>

    {{-- ## PRODUCT INFO ## --}}
    <section class=" container">
        <section class="row offer product">
            <div class="col-sm-5 images">
                <a href="" class="fancybox" id="fancybox-bigimage"><img id="product-img" /></a>
                <p id="testimonial_warning">EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, TIME AND EFFORT.</p>

                {{-- ## TESTIMONIAL VIDEO DESKTOP ## --}}
                <div class="hidden-sm hidden-xs">
                    <div class="videoPlaceholder" id="testimonialVideo"></div>
                </div>

                <div class="questions">
                    <p class="gender_link pink" id="questionsText"><b>HAVE QUESTIONS?</b></p>
                    <p class="right"><img id="questionsImg" class="phone" src="{{asset('images/products/phone.png')}}" /> (908) 514-4546</p>
                </div>
                <h3 class="paymentMethods_h">PAYMENT METHODS ACCEPTED:</h3>
                <img class="paymentOptions" src="{{asset('images/products/paymentOptions.png')}}" />
            </div>
            <div class="col-sm-7 plan">
                <div class="special">
                    <p><s></s></p>
                    <h2></h2>
                    <div id="discount">
                    </div>
                    <h3><i></i></h3>
                </div>
                <!-- special -->
                <div style="display: none;" class="fclock"></div>
                <div class="includes" id="includes">
                    <h2 class="gender_link">Includes:</h2>

                </div>
                <!--includes-->
                <div id="disclaimer-neutral">
                </div>
                <div class="options" id="options">

                </div>
                <button class="btn addToCart gender_link">ADD TO CART</button>

                <p class="about-subs">Monthly Re-occuring subscription. See <a href="/terms-and-conditions">Terms and Conditions.</a></p>

                <p class="free-us-shipping"><img class="box" src="{{asset('images/products/box.png')}}" /> <span class="shipping_text">GET IT NOW WITH FREE USA SHIPPING!</span></p>
                 <div class="questions visible-xs visible-sm text-center">
                    <p class="gender_link pink inline-block" id="questionsText"><b>HAVE QUESTIONS?</b></p>
                    <p class="mobile-left inline-block"><img id="questionsImg" class="phone" src="{{asset('images/products/phone.png')}}" /> (908) 514-4546</p>

                </div>
            </div>
        </section>
    </section>

<div id="meal-plan-section"></div>

    {{-- ## TRANSFORMATIONS MOBILE ## --}}
                <section class="container-fluid">

                    <section class="row">
                                <div class="transformations">
                                    <h2 class="text-center">CUSTOMER TRANSFORMATIONS</h2>
                                    <div class="con-wrapper">
                                        <div class="con slider" id="transformations">
                                            @for($i = 0; $i < 5; $i++)
                                                @if (!empty(@$femaleImages[$i]))
                                                <a href="/results"> <img class="transformation" src="{{ $femaleImages[$i] }}"></a>
                                                @endif
                                                @if (!empty(@$maleImages[$i]))
                                                <a href="/results"> <img class="transformation" src="{{ $maleImages[$i] }}"></a>
                                                @endif
                                            @endfor

                                        </div>
                                <p class="transformation-disclaimer">EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, TIME AND EFFORT.</p>

                                    </div>
                                </div>
                                <!-- transformations -->
                            </section>
                </section>

    {{-- ## HOW IT WORKS SECTION FOR FEMALE ## --}}
    <section class="container" id="how-it-works-female" style="display: none">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>How It Works!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" >
                <h2 class="select-goal select-goal-margin" style="color: black;">Select your goal</h1>
            </div>
        </div >
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
                        <p>Follow the exercise guides provided in your bundle to learn the best weight loss methods and workout routines to reach your goals!</p>
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
                        <p>Visit <a href="{{ url('challenge') }}" target="_blank;">www.shredz.com/challenge</a> to enter! If you are selected, you'll be featured on Instagram, our website, and win a cash prize! Plus, you'll look and feel better than ever!</a>
                        </p>
                    </div>
                    <div class="col-xs-3">
                        <img class="image-inside-container" src="{{asset('images/trophy.png')}}">
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- ## HOW IT WORKS SECTION FOR MALE ## --}}
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
                        <p>Follow the exercise guides provided in your bundle to learn the best weight loss methods and workout routines to reach your goals!</p>
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
                        <p>Visit <a href="{{ url('challenge') }}" target="_blank;">www.shredz.com/challenge</a> to enter! If you are selected, you'll be featured on Instagram, our website, and win a cash prize! Plus, you'll look and feel better than ever!</a>
                        </p>
                    </div>
                    <div class="col-xs-3">
                        <img class="image-inside-container" src="{{asset('images/how-it-works-male/trophy.png')}}">
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- ## WHAT"S INCLUDED ## --}}
    <section class="container store inside-section-margin" id="whatsInc">
        <div class="title">
            <p id="prod-name-p" class="prod_name_title_p"></p>
            <h2 id="what_inc_title" class="gender_link">WHAT'S INCLUDED</h2>
        </div>
        <div class="row products prod-page-prod" id="products">

        </div>
        <div class="row">
            <button class="btn addToCart gender_link" data-toggle="modal" data-target="#addToCartModal" style="display:block;margin-left:auto;margin-right:auto;margin-top:40px;">ADD TO CART</button>
        </div>
    </section>

    {{-- ## PRODUCT DESCRIPTION ## --}}
    <section id="prodDesc" class="ltGreyBg container-fluid">
        <section class="container">
            <div class="middle content">
                <div class="desc">
                    <h2 class="gender_link">PRODUCT DESCRIPTION</h2>

                    <p></p>

                </div>
                <!-- desc -->
                <!-- <div class="benefits">
                    <h2>DESIGNED TO PROVIDE BENEFITS LIKE</h2>
                    <ul class="benefits-list">
                        <div class="container">
                            <div class="row hide-for-ebooks">
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">WEIGHT LOSS</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">REACH GOALS</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">QUICK WORKOUTS</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">PRIME SUPPLEMENTS</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">HOLISTIC FITNESS LIFESTYLE</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">EASY TO FOLLOW</li>
                                <li class="col-xs-12 last-li gender_link"><img src="{{asset('images/pinkCheck.png')}}">EFFECTIVE EXERCISES</li>
                            </div>
                            <div class="row show-for-ebooks" style="display: none;">
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">EXERCISES EXPLAINED</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">EASY TO FOLLOW</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">RESULTS</li>
                                <li class="col-xs-12 col-sm-6 gender_link "><img src="{{asset('images/pinkCheck.png')}}">AVAILABLE ON MOBILE</li>
                            </div>
                        </div>
                    </ul>
                </div> -->
                <!-- benefits -->
                <div class="mobile-description-selectors">
                    <h1>SELECT PRODUCT FOR INFO</h1>
                    <div class="button-wrapper" id="description-buttons">
                    </div>
                </div>
                <div class="info hide-for-ebooks">
                    <div class="row">
                        <div class="left">
                            <h2 class="gender_link">DETAILS</h2></div>
                        <div class="center">
                            <h2 class="gender_link">DIRECTIONS</h2></div>
                        <div class="right">
                            <h2 class="gender_link">LABELS</h2></div>
                    </div>
                </div>
                <!-- info -->
                <p class="warning-directions">Always reference the ingredients and directions on the product label for the product(s) you receive for the most up to date and accurate information</p>
            </div>
            <!-- middle -->
        </section>
    </section>
    <button id="last_button" style="margin-right: auto;margin-left:auto; display: block;" data-toggle="modal" data-target="#addToCartModal" class="addToCart gender_link btn">ADD TO CART</button>

     {{-- ## TESTIMONIAL VIDEO MOBILE ## --}}
     <div class="visible-sm visible-xs container video-mobile">
        <div class="videoPlaceholder"  id="testimonialVideo_mobile"></div>
     </div>

    {{-- ## ENDORSEMENTS ## --}}
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
    </section>

    <div id="back_to_top_holder">
        <img class="backToTop" src="{{asset('images/arrows/backToTop.png')}}" />
        <p class="backToTop">BACK TO TOP</p>
    </div>
</main>
<div class="prop65">California residents: <a href="#" data-toggle="modal" data-target="#prop65">click here</a> for Proposition 65 warning.</div>
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

@append

@section('modals')
<!--ADD TO CART MODAL -->
<div id="addToCartModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <div class="modal-title text-center"><i class="fa fa-check fa-fw"></i>&nbsp;ADDED TO CART!</div>
                <div class="text-center clearfix">
                    <div class="product-image">
                        <img src="">
                    </div>
                    <div class="product-details">
                        <h3 class="product-name"></h3>
                        <div class="product-description"></div>
                    </div>
                </div>
                <div class="visible-xs cart-link"><a href="{{ $api->getBaseUrl() }}/cart" target="cart">Continue to Checkout</a></div>
            </div>
            <div class="modal-body frequently-bought-product-section">
                <h3 class="text-center">DISCOUNTED ADD-ON ITEMS</h3>
                <div class="products clearfix"></div>
            </div>
            <div class="modal-footer">
                <a href="#" class="text-left pull-left"><b class="fa fa-fw fa-chevron-left"></b>Back to Shop</a>
                <a href="{{ $api->getBaseUrl() }}/cart" target="cart" class="text-right pull-right">Continue to Checkout<b class="fa fa-fw fa-chevron-right"></b></a>
            </div>
        </div>
    </div>
</div>

<!-- Prop 65 Modal -->
<div id="prop65" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">California's Proposition 65</h2>
            </div>
            <div class="modal-body">
                    <div class="content">
                    <p>California's Proposition 65 entitles California consumers to special warnings for products that contain chemicals known to the state of California to cause birth defects or other reproductive harm if those products expose consumers to such chemicals above certain threshold levels. We care about our customers' safety and hope that the information below helps with your buying decisions.</p>
                    <p>WARNING: This product contains chemicals known to the State of California to cause birth defects or other reproductive harm.</p>                                    
                </div>
            </div>
        </div>
    </div>
</div>
@append

@section('templates')
<script name="disclaimerNeutral" type="text/x-handlebars-template">
    @{{#in disclaimerneutral.flags 'disclaimer-protein'}}
        <div class="disclaimer-neutral">
            Due to high demand, this item ships in 7-10 days.
        </div>
    @{{/in}}
</script>


{{-- <div class="disclaimer-neutral">
                    Due to high demand, this item ships in 7-10 days.
                </div>
 --}}

<script name="transformations" type="text/x-handlebars-template">
    @{{#each transformations}}
    <img class="transformation" src="{{ asset('images') }}/@{{ @this }}">
    @{{/each}}
</script>
<script name="a2c-product" type="text/x-handlebars-template">
    @{{#each products }}
    <div class="product clearfix gender-@{{ lcase base_variant.gender }}">
        <div class="product-image">
            <img class="" src="@{{ asset_location }}primaryimage_new.jpg">
        </div>
        <div class="product-details">
            <div class="product-name">@{{ name }}</div>
            <div class="product-price">
                <span class="price-value">$@{{ base_variant.price }}</span>
                <span class="discount-value">(@{{ sale base_variant.price base_variant.msrp }}% OFF)</span>
            </div>
            <div>
                <button class="product-link btn btn-sm btn-default" data-sku="@{{ base_variant.sku }}" data-price="@{{ base_variant.price }}">ADD TO CART</button>
            </div>
        </div>
    </div>
    @{{/each}}
</script>

<script name="discounts" type="text/x-handlebars-template">
    @{{#each discounts}}
    <ul class="list-inline not-applied">
        <li>
            <h4>Apply Promo Code: <span class="code">@{{ code }} </span></h4>
            <h5>Applies in checkout</h5>
            <h5 class="min-text">Min Amount: <span class="min-amount">$@{{ terms.min_amount }}</span></h5>
        </li>
        <li class="discount-value-holder">
            <h1>@{{{splitTitle terms.name }}}</h1>
        </li>
    </ul>
    <ul class="list-inline applied" style="display: none">
        <li>
            <h4>Coupon Applied!</h4>
            <h5>View discounted price at checkout.</h5>
        </li>
        <li class="discount-value-holder">
            <h1><i class="fa fa-check-circle"></i></h1>
        </li>
    </ul>
    @{{/each}}
</script>

<script name="meal-plan" type="text/x-handlebars-template">
<section id="custom-diet-plan">
    <h1>step 1</h1>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>custom diet plan</h2>
                <h3>Choose your favorite foods and set goals…</h3>
            </div>
            <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-1 image-container vertical-center">
                <div class="row">
                    <div class="col-xs-12">
                        <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/food.png">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 visible-xs content">
                        <p>Do you want to lose weight or gain muscle? We have solutions for every body, every need.</p>
                    </div>
                </div>
            </div><!--
            --><div class="col-xs-12 col-sm-5 logo-container vertical-center">
                <div class="row icon-wrapper">
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/tailored.png"></li><!--
                            --><li class="vertical-center">
                                <p>100% Tailored</p>
                                <small>to your needs and goals</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/eatingstyles.png"></li><!--
                            --><li class="vertical-center">
                                <p>20+ Eating Styles</p>
                                <small>(Paleo, Vegan, Etc.)</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/cookingguides.png"></li><!--
                            --><li>
                                <p>Cooking Guides</p>
                                <small>to prep delicious food</small>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 view-more visible-xs">
                    <button class="btn btn-xs center-block">View more information</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 hidden-xs view-more">
                <p>Do you want to loose weight or gain muscle? We have solutions for every body, every need.</p>
                <button class="btn btn-xs center-block view">View more information</button>
            </div>
        </div>
    </div>
</section>
<section id="favorite-foods">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h4>20+ Diet Types</h4>
                <p>We tailor your custom plan to any dietary preference and offer many styles, including but not limited to:</p>
            </div>
            <div class="col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-6 food-option vertical-center">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><i class="icon icon-gluten-free"></i><span>Gluten Free</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-paleo"></i><span>Paleo</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-low-carb"></i><span>Low Carb</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-low-fat"></i><span>Low Fat</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-vegetarian"></i><span>Vegetarian</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-diabetic-friendly"></i><span>Diabetic Friendly<br> (Type 1 and 2)</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-vegan"></i><span>Vegan</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-pescatarian"></i><span>Pescatarian</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-dairy"></i><span>Dairy Free</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-reverse-dieting"></i><span>Reverse Dieting</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-show-prep"></i><span>Show Prep</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-mediterranean"></i><span>Mediterranean</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-pre-post-natal"></i><span>Pre and Post Natal</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-acid-reflux"></i><span>Acid Reflux</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-cholesterol"></i><span>Cholesterol Friendly</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-organic"></i><span>Organic/No Additives</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-anti-inflamatory"></i><span>Anti-Inflammatory</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-dash"></i><span>DASH</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-high-fiber"></i><span>Low Sodium, High Fiber</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-ketogenic"></i><span>Ketogenic</span></td>
                        </tr>
                    </tbody>
                </table>
            </div><!--
            --><div class="image-wrapper col-sm-6 col-xs-12 vertical-center">
                <h4>Know exactly what you'll need to prep your meals so you can compile your grocery list ahead of time!</h4>
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/grocery-list.png">
            </div>
            <div class="col-xs-12 hide-info">
                <button class="btn btn-xs center-block">Hide information</button>
            </div>
        </div>
    </div>
</section>
<section id="custom-workout-plan">
    <h1>step 2</h1>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>custom workout plan</h2>
                <h3>Choose your target area and set goals...</h3>
            </div>
            <div class="col-xs-12 col-sm-6 col-sm-pull-1 image-wrapper vertical-center">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/workoutsample-male.jpg" alt="SHREDZ workout male">
                <p class="visible-xs">Do you want to lose weight? Gain muscle? Have more energy? Get stronger? We have solutions for every body and every need.</p>
            </div><!--
            --><div class="col-xs-12 col-sm-5 icon-wrapper vertical-center">
                 <div class="row">
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul class="list-inline">
                            <li class="vertical-center hidden-xs">
                                <h4>At gym</h4>
                            </li><!--
                            --><li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/atgym.png"></li>
                            <li class="vertical-center visible-xs">
                                <h4>At gym</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul class="list-inline">
                            <li class="vertical-center hidden-xs">
                                <h4>At home</h4>
                            </li><!--
                            --><li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/athome.png"></li>
                            <li class="vertical-center visible-xs">
                                <h4>At home</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul class="list-inline">
                             <li class="vertical-center hidden-xs">
                                <h4>outdoors</h4>
                            </li><!--
                            --><li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/outdoors.png"></li>
                            <li class="vertical-center visible-xs">
                                <h4>outdoors</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 view-more">
                <p class="hidden-xs">Do you want to lose weight? Gain muscle? Have more energy? Get stronger? We have solutions for every body and every need.</p>
                <button class="btn btn-xs center-block">View more information</button>
            </div>
        </div>
    </div>
</section>
<section id="favorite-workouts">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h4>20+ Workout Types</h4>
                <p>Comfortable with a specific style of workout? No problem! We cater to any kind, including but not limited to:</p>
            </div>
            <div class="col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-6 workout-option vertical-center">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><i class="icon icon-cross-training"></i><span>Cross Training</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-tabata"></i><span>Tabata</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-circuit-training"></i><span>Circuit Training</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-powerlifting"></i><span>Powerlifting</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-peak-week"></i><span>Peak Week</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-olympic-lifting"></i><span>Olympic Lifting</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-functional"></i><span>Functional</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-basic-fat-loss"></i><span>Basic Fat Loss</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-body-building"></i><span>Body building</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-hybrid"></i><span>Hybrid</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-athletic-sport"></i><span>Athletic Sport Specific</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-plyometric"></i><span>Plyometric</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-speed-training"></i><span>Speed Training</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-trx"></i><span>TRX</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-high-intensity-training"></i><span>HIIT (High Intensity <br>Interval Training)</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-swimming"></i><span>Swimming</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-dance"></i><span>Dance</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-in-home"></i><span>In Home</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-body-weight"></i><span>Body Weight</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-kettle-bell"></i><span>Kettle Bell</span></td>
                        </tr>
                        <tr>
                            <td><i class="icon icon-postural-corrective-training"></i><span>Postural/Athletic <br>Corrective Training</span></td>
                        </tr>
                    </tbody>
                </table>
            </div><!--
            --><div class="image-wrapper col-sm-6 col-xs-12 vertical-center">
                <h4>Receive a custom workout plan which is not only designed specifically for your body, but one that fits your schedule.</h4>
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/workout-section-male.jpg" alt="shredz workout male meal plan page">
            </div>
            <div class="col-xs-12 hide-info">
                <button class="btn btn-xs center-block">Hide information</button>
            </div>
        </div>
    </div>
</section>
<section id="dedicated-coach">
    <h1>Step 3</h1>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 heading">
                <h2>dedicated certified coach</h2>
                <h3>Your personal certified fitness and nutrition expert…</h3>
            </div>
            <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-1 vertical-center">
                <div class="row">
                    <div class="col-xs-12 image-container">
                        <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/certified-coaches.png">
                    </div>
                    <div class="col-xs-12 visible-xs view-more">
                        <p>The SHREDZ Online Coaching team is a diverse crew of fitness professionals with a history of success in designing effective diet and training programs for clients ranging from nationally qualified bodybuilders, Olympic athletes, bikini competitors, NFL athletes, and now you.</p>
                        {{-- <button class="btn btn-xs center-block">View more information</button> --}}
                    </div>
                </div>
            </div><!--
            --><div class="col-xs-12 col-sm-5 logo-container vertical-center">
                <div class="row icon-wrapper">
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/certified.png"></li><!--
                            --><li class="vertical-center">
                                <p>Certified Expert</p>
                                <small>Dedicated to get you the results you want</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/oneonone.png"></li><!--
                            --><li class="vertical-center">
                                <p>1-ON-1 Check-ins</p>
                                <small>Weekly email check-ins to keep you on track</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/motivation.png"></li><!--
                            --><li class="vertical-center">
                                <p>Motivation</p>
                                <small>Encouragement and inspiration for success</small>
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="view-more visible-xs">
                    <button class="btn btn-xs center-block">Meet your coaches</button>  
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 hidden-xs view-more">
                <p>The SHREDZ Online Coaching team is a diverse crew of fitness professionals with a history of success in designing effective diet and training programs for clients ranging from nationally qualified bodybuilders, Olympic athletes, bikini competitors, NFL athletes, and now you.</p>
                <div class="view-more hidden-xs">
                    <button class="btn btn-xs center-block">Meet your coaches</button>  
                </div>
                {{-- <button class="btn btn-xs center-block">View more information</button> --}}
            </div>
        </div>
    </div>
</section>
<section id="meet-coaches">
    <div class="container visible-xs">
        <div class="row">
            <div class="col-xs-12">
                <div class="heading">
                    <h2>Our certified experts</h2>
                    {{-- <p>The Shredz online coaching team is a diverse crew of fitness professionals with a history of success in designing effective diet and training programs for clients ranging from nationally qualified bodybuilders, Olympic athletes, bikini competitors, NFL athletes, and now you.</p> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid coaches">
        <div class="row cover-image">
            <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="heading hidden-xs">
                    <h2>Meet your coaches</h2>
                    <p>The Shredz online coaching team is a diverse crew of fitness professionals with a history of success in designing effective diet and training programs for clients ranging from nationally qualified bodybuilders, Olympic athletes, bikini competitors, NFL athletes, and now you.</p>
                </div>
                <div class="row">
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalJason">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/jason.jpg">
                            <div class="name">
                                <h6>Jason Dooney</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalDina">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach7.png">
                            <div class="name">
                                <h6>Dina Aronson</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalHerb">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach3.png">
                            <div class="name">
                                <h6>Herb Olsen</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalKingsley">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach9.png">
                            <div class="name">
                                <h6>Kingsley Asiegbulem</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalMelany">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach8.png">
                            <div class="name">
                                <h6>Melany Soares</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalJake">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach6.png">
                            <div class="name">
                                <h6>Jake Crispo</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalShealyn">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach5.png">
                            <div class="name">
                                <h6>Shealyn Coyle</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalDan">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach4.png">
                            <div class="name">
                                <h6>Dan Dexter</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalCassandra">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach2.png">
                            <div class="name">
                                <h6>Cassandra Luby</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-2 col">
                        <div class="coach" data-toggle="modal" data-target="#modalAlyssa">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/alyssa.jpg">
                            <div class="name">
                                <h6>Alyssa Reyes</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xs-4 col">
                        <div class="coach" data-toggle="modal" data-target="#modalDanVella">
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/dan.jpg">
                            <div class="name">
                                <h6>Dan Vella</h6><p>view profile <i class="fa fa-angle-right" aria-hidden="true"></i></p>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-xs-12 hide-info">
                        <button class="btn btn-xs center-block">Hide information</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<!-- Jason -->
<div id="modalJason" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Jason Dooney</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/jason.png" alt="">
<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <p>BS in Biology</p>
    <p>NAFC Nutrition Coach</p>
    <p>2014 OCB Men's Physique National Champion</p>
    <p>IFPA Pro Natural Men's Physique Competitor</p>
    <p>Masters Candidate of Applied Nutrition: Nutrition and Fitness</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Jason’s competition and biology background aids him in developing structured weight loss and nutrition plans to achieve desired body fat ranges.  As a competitor, he is experienced in restoring metabolism after extended dieting to avoid rebound weight gain.  Proficient in macronutrient based and flexible dieting protocols, Jason believes that the best dietary approach is the one that fits your lifestyle.</p>
</div>
<div class="about">
    <h3>ABOUT JASON</h2>
    <p>Following a power/hypertrophy hybrid program and If It Fits Your Macros Diet. Jason’s 2016 year goal is to qualify for the IFPA Natural World Championships for Men’s Physique.</p>
</div>
</div>
</div>

<div class="modal-cta">
<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Cassandra -->
<div id="modalCassandra" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Cassandra Luby</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach2.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <p>Certified Personal Trainer</p>
    <p>Certified Group Fitness Class Instructor</p>
    <p>Nationally Qualified NPC Bikini Competitor</p>
    <p>Former Competitive Cheerleader and Coach</p>
    <p>Diet Tech/Counselor for Teens with Eating Disorders</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Cassandra has professional experience working with all types of individuals from young women struggling with eating disorders, those with disabilities, to men competing in bodybuilding.  Her knowledge and expertise includes macro tracking, carb cycling, bodybuilding, prep, stage presence and supplementation. Having struggled in the past with eating and poor body image, Cassandra has been able to turn my life around with the introduction of weight training and macro tracking. </p>
</div>
<div class="about">
    <h3>ABOUT CASSANDRA</h2>
    <p>Cassandra takes her job in the fitness industry outside of the office. This is a lifestyle that she teaches but also lives herself. Her personal style of training is combination of Hypertrophy and Metabolic Training. Cassandra believes in following the “if it fits your macros” approach to nutrition. No foods should be off limit, you should live your life with balance and moderation. Cassandra’s 2016 goal would be to take the National NPC stage and continue to work towards her Pro Card.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Herb -->
<div id="modalHerb" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Herb Olsen</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach3.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>B.A. Health and Exercise Science: Health Promotion and Fitness Management</p>
    <p>M.S. Candidate Exercise Science: Performance Enhancement and Injury Prevention</p>
    <p>National Association of Speed and Explosion-SES</p>
    <p>BAC Behavior Analyst Certification</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Herb takes a scientific approach to training, programming, and diet for each of his clients.  Working with some of the top training facilities in the northeast, Herb has practical experience in program development for high school, collegiate and professional athletes in football, baseball, tennis, soccer, track and field.  With a diverse background in theoretical and functional training, Herb likes to develop programs to correct postural imbalances, limited range of movement patterns, and improve performance. Herb further leverages his knowledge to create optimal training and nutrition program development for amateur and professional body building, physique, and bikini competitors. Herb’s knowledge of exercise physiology encompasses functional movements, including post and prenatal training to prevent and correct the "jumping" issue and physical restoration in women post pregnancy.</p>
</div>
<div class="about">
    <h3>ABOUT HERB</h2>
    <p>Herb never sticks to one training style, he believes each discipline/theory has it's own purpose and usefulness. He uses a base style of hybrid training while alternating between a power building and an athletic building style of training; mixing in various other training disciplines for their specific use and goals. His diet style more simple, IIFYM. In 1 year’s time he hopes to have completed his M.S. in Performance enhancement and Injury Prevention.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Dan -->
<div id="modalDan" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Dan Dexter</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach4.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>B.S. Exercise Science</p>
    <p>American College of Sports medicine Health and Fitness Specialist</p>
    <p>Specialized in sports rehabilitation, corrective exercise</p>
    <p>Advanced in calisthenic training</p>
    <p>Professional Wilamena Model</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Dan uses his experience in rehabilitative care and athletic background to help clients in injury prevention, rehabilitation, and relative body movements.  As a competitive wrestler and gymnast, Dan understands the specific needs of athletes and those looking to regain functionality due to muscular imbalances.  He is advanced in callisthenic training, sports performance and physique competitions. </p>
</div>
<div class="about">
    <h3>ABOUT DAN</h2>
    <p>Dan’s style of dieting is carb cycling to maintain a lean, photoshoot ready physique year round. His training style is a mix of high volume weight training and calisthenics to maintain strength and achieve an aesthetic look. Dan’s 2016 goal is to book a magazine cover through his modeling company.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>

<!-- Dan Vella -->
<div id="modalDanVella" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Dan Vella</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/dan.jpg" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>B.S. Exercise Science</p>
    <p>4 years of experience managing, supplying, and advertising in supplement industry</p>
    <p>Certified Personal Trainer</p>
    <p>NPC Classic Physique Competitor</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Dan uses his competition experience to design customized programs for clients to achieve their ideal aesthetics. A firm believer in eating simple foods for your goals, Dan likes to help fans of traditional dieting tailor their food intake to their training style. Dan has trained under IFBB pros who have taught him diverse tips and exercise modalities to specifically target muscle groups. He has extensive knowledge on exercise science and sports nutrition which he combines with his bodybuilding background to create extremely personalized plans to achieve client’s specific goals. </p>
</div>
<div class="about">
    <h3>ABOUT DAN</h2>
    <p>Dan is an ambassador for 6 Pack Fitness &amp; Violate the Dress Code clothing line. He follows a strict clean eating diet year round along and trains with an emphasis on hypertrophy. Dan’s 2016 year goal is to qualify for a National level NPC show and win his IFBB Pro Card.</p>
</div>
</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>

<!-- Alyssa -->
<div id="modalAlyssa" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Alyssa Reyes</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/alyssa.jpg" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>B.S. in Foods and Nutrition</p>
    <p>Minor in Personal Fitness</p>
    <p>Master of Science in Nutrition</p>
    <p>Graduate Certificate in Sports Nutrition and Wellness</p>
    <p>Registered Dietitian</p>
    <p>Former Metabolic Coach and Technician</p>
    <p>Group Exercise and Dance Instructor</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Alyssa has a variety of experience from working at large fitness facilities conducting metabolic testing to being a Supermarket Dietitian to better the local community. She has worked with a diverse group of clients including weight loss, muscle gain, diabetes, heart disease, hypothyroidism, celiac disease, vegans, Paleolithic, anti- inflammatory, athletes, to general good health and wellness, she has helped them all reach their goals and feel better through good nutrition and good food.</p>
</div>
<div class="about">
    <h3>ABOUT ALYSSA</h2>
    <p>Alyssa believes nutritious food should taste good, so she loves to spend time in the kitchen making healthy food that’s filled with flavor and great nutrition to fuel her workouts. Alyssa was a dancer practicing ballet, tap, jazz, and hip hop for 16 years. She has been a competitive powerlift since August 2014, winning multiple silver and bronze medal in her weight class and qualified and went to USA Powerlifting Nationals in October 2015. Alyssa also boxes weekly and loves to cross train, switching up her workout styles whenever she can. She also is committed to making people feel more comfortable and confident in the gym so she teaches LesMills BodyPump and SH’BAM as well as other group exercise classes.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Shealyn -->
<div id="modalShealyn" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Shealyn Coyle</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach5.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>BS in Dietetics</p>
    <p>Served on the Delta Zeta Food Committee Standards Board</p>
    <p>Former Competitive Gymnast</p>
    <p>(SAND) Student Association of Nutrition and Dietetics</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Shea has a background in nutrition and likes taking on female clients who need motivation and help with weight loss. She takes a preventative approach to obesity by encouraging healthy and sustainable behaviors. Experienced in flexibility, core, and callisthenic training, Shea specializes in improving performance and body composition. </p>
</div>
<div class="about">
    <h3>ABOUT SHEA</h2>
    <p>Shea chooses to life a lifestyle with a traditional diet, making sure it is wholesome and balanced. She tries to add variety and new foods to keep her diet rich in micronutirents and enjoyable. Her workouts include strength training and HIIT. Shea’s 2016 goal is to help 200 people transform their lives. </p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Jake -->
<div id="modalJake" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Jake Crispo</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach6.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>BS in Exercise Science with a Concentration in Kinesiology</p>
    <p>Designed Strength and Exercise Programs for Division 1 Level Collegiate Athletes, Military Service Members & Olympic Level Competitors / Current Olympians</p>
    <p>Dry Land Coordinator for elite top 5 nationally ranked swimmers ages 10-18</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Developing structured strength and conditioning programs for athletes and competitors.  Training for substantial weight loss and improved performance. Jake has trained elite members of the army, navy, and marines to improve conditioning, endurance and functional strength for tactical scenarios. He has practical experience programming for athletes from beginners to the Olympic level.</p>
</div>
<div class="about">
    <h3>ABOUT JAKE</h2>
    <p>Following a powerlifting and power building program.  Dietary preferences are based in clean eating and If It Fits Your Macros. Jake’s 2016 goal is to be under 200 lbs and deadlift 750 lbs.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Dina -->
<div id="modalDina" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Dina L. Aronson</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach7.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>BS in Human Nutrition from Cornell University</p>
    <p>Masters in Nutrition from Tufts University</p>
    <p>Nutrition and Dietetics Internship at the Frances Stern Nutrition Program </p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Award-winning internationally-recognized expert in plant-based diets, fitness, natural and organic foods, food allergies, lifestyle management, and weight loss and maintenance. Dina specializes in health and wellness communications, therapeutic diets, digital health, and translating scientific research studies into practical, relevant information. Dina is co-author of four published nutrition books and hundreds of articles on healthy living.</p>
</div>
<div class="about">
    <h3>ABOUT DINA</h2>
    <p>An advocate of plant based diets, Dina helps people incorporate more health-supporting whole plant foods into their diets in creative, affordable, and delicious ways. Dina’s 2016 goal is to perform 8 consecutive, unassisted pull ups.</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Melany -->
<div id="modalMelany" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Melany Soares</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach8.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>BS in Nutrition with a concentration in Dietetics</p>
    <p>Former Women's Soccer Captain</p>
    <p>Certified Zumba Instructor</p>
    <p>2015 Miss Portugal Newark, NJ</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Melany draws upon her background as a dietetics major to create balanced programs that help people look good and feel great. She loves assisting people who have trouble gaining or losing weight.  Fluent in Portuguese, Melany has experience helping people of diverse social and cultural background achieve their goals. </p>
</div>
<div class="about">
    <h3>ABOUT MELANY</h2>
    <p>Melany loves to dance and uses a combination of modern and traditional dance to elevate her heart rate and stay in shape. She follows an overall traditional healthy diet and strongly believes that eating healthy and living a healthy lifestyle DOES NOT mean your food choices have to be boring. Melany’s 2016 goal is to incorporate more strength training and help people see that exercise can be fun!</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Melany -->
<div id="modalMelany" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Dina L. Aronson</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach8.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>BS in Nutrition with a concentration in Dietetics</p>
    <p>Former Women's Soccer Captain</p>
    <p>Certified Zumba Instructor</p>
    <p>2015 Miss Portugal Newark, NJ</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Melany draws upon her background as a dietetics major to create balanced programs that help people look good and feel great. She loves assisting people who have trouble gaining or losing weight.  Fluent in Portuguese, Melany has experience helping people of diverse social and cultural background achieve their goals. </p>
</div>
<div class="about">
    <h3>ABOUT MELANY</h2>
    <p>Melany loves to dance and uses a combination of modern and traditional dance to elevate her heart rate and stay in shape. She follows an overall traditional healthy diet and strongly believes that eating healthy and living a healthy lifestyle DOES NOT mean your food choices have to be boring. Melany’s 2016 goal is to incorporate more strength training and help people see that exercise can be fun!</p>
</div>

</div>
</div>

<div class="modal-cta">

<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
<!-- Melany -->
<div id="modalKingsley" class="modal fade modal-summary" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Kingsley Asiegbulem</h2>
</div>
<div class="modal-body row">
<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/coach9.png" alt="">

<div class="content">
<div class="credentials">
    <h3>CREDENTIALS</h2>
    <!-- <p>Performance / sports enhancement, fat loss, physique development, functional training, and corrective training.</p> -->
    <p>Academy of Allied Health Science graduate</p>
    <p>2017 Academy of Natural Health Sciences for Clinical Nutrition and Holistic Health</p>
    <p>Experienced as a Licensed Practical Nurse</p>
    <p>7 years of experience managing, supplying, and advising in supplement industry</p>
    <p>5+ years as a Certified Personal Trainer</p>
</div>
<div class="expertise">
    <h3>AREA OF EXPERTISE</h2>
    <p>Kingsley’s scientific background and experience in the supplement industry grants him prodigious knowledge of safe and effective supplementation to achieve good health, optimize athletic performance, enhance muscle building and weight loss.  Kingsley has an in depth and broad knowledge of the ketogenic diet and intermittent fasting protocols.  As such, he is exceptional at assisting clients in adapting to a low carb and/or busy lifestyle while achieving their desired goal.</p>
</div>
<div class="about">
    <h3>ABOUT KINGSLEY</h2>
    <p>Kingsley maintains a low carb, ketogenic diet for 6-8 months out of the year.  He combines intermittent fasting with low carb dieting to satiate his love of fatty foods that also works around his hectic schedule.  His workout style combines high volume drop sets training with intermittent stretching.</p>
</div>

</div>
</div>

<div class="modal-cta">
<div class="disclaimer">WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY</div>
</div>
</div>
</div>
</div>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="{{asset('js/athletes.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pages/products.js')}}"></script>


    <script type="text/javascript" src="{{asset('js/product.factory.js')}}"></script>
    {!! @$chatScript !!}
@append
