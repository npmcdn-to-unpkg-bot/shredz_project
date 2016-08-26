@extends('themes.default.layout')

@section('content')
<main class="home">
<div class="dotd-block">
    <section class="container">
        <div id="country_banner" style="display:none;">
            <img src="{{ $countryBannerImage }}">
            <h5 style="color: {{ $countryBannerColor }}">{{ $countryBannerText }}</h5>
        </div>
        @if($page && !count(array_diff(['_left_featured_block', '_right_featured_block'], $page['meta_keys'])))
        <!-- PROMOS -->

        <div class="two-promos banner-v2">
            <a href="{{ url('30-day-supplement-workout-plan') }}">
            </a>
        </div>
        <div class="two-promos banner-v1">
            <figure class="col-md-6 promo-block">
                <a href="{{ url('products/' . @$page['_left_featured_link']) }}">
                    <img src="{{ $page['_left_featured_block'] }}">
                    <div class="button-cta {{ preg_match('/^f/i', @$page['_left_featured_gender']) ? 'wv' : '' }}">
                        LEARN MORE
                    </div>
                </a>
            </figure>
            <figure class="col-md-6 promo-block">
                <a href="{{ url('products/' . @$page['_right_featured_link']) }}">
                    <img src="{{ $page['_right_featured_block'] }}">
                    <div class="button-cta {{ preg_match('/^f/i', @$page['_right_featured_gender']) ? 'wv' : '' }}">
                        LEARN MORE
                    </div>
                </a>
            </figure>
        </div>
        <!-- END PROMOS -->
        @endif
    <div id="country_banner" style="">
        <img src="{{ $countryBannerImage }}">
        <h5 style="color: {{ $countryBannerColor }}">{{ $countryBannerText }}</h5>
    </div>
    </section>
</div>

    <section class="container-fluid white-block">

        <div class="">
            <img id="full_as_seen_on" src="https://s3.amazonaws.com/shredz-com-v2/home/as_seen_on_full.png">
        </div>
        <section class="row">
            <div class="transformations">
                <div class="con-wrapper">
                    <h1>REAL PEOPLE | <span>REAL RESULTS</span></h1>
                    <div class="con slider">
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
    <!-- FEATURED PRODUCTS -->
    <section class="products container">
        <h2>FEATURED PRODUCTS</h2>
        {{-- <div id="products">
        </div> --}}
        <div id="featured-product-grid" ></div>
    </section>

    <!-- END FEATURED PRODUCTS -->
    <section class="container-fluid">
        <!-- LINK BOXES -->
        <section class="row link-blocks community">
            <a href="/athletes" class="col-md-3 col-sm-6 link-block" id="meetAthletes">
                <p>MEET THE ATHLETES</p>
                <p class="desc">Fitness. Motivation. Inspiration.</p>
                <div class="darken"></div>
            </a>
            <a href="{{ route('shop') }}" class="col-md-3 col-sm-6 link-block" id="shop">
                <p>SHOP NOW</p>
                <p class="desc">Start Your Transformation Today</p>
                <div class="darken"></div>
            </a>
            <a target="_blank" href="https://v2.zopim.com/widget/livechat.html?key=219N88usAAF5K4SUFlw2bWKPEpaX47c1" class="col-md-3 col-sm-6 link-block" id="chat">
                <p>LIVE CHAT</p>
                <p class="desc">24/7 support with a real expert</p>
                <div class="darken"></div>
            </a>
            <a href="{{ route('fitclub-signup') }}" class="col-md-3 col-sm-6 link-block" id="movement">
                <p>JOIN THE MOVEMENT</p>
                <p class="desc">Find out how</p>
                <div class="darken"></div>
            </a>
        </section>
        <!-- END LINK BOXES -->
    </section>
    <section class="container">
        <section class="quote" style="text-align: center;">
            <p>
                At <b>SHREDZ</b>, we believe that having both a fit body and mind will take you further than having only one.
                <br> That's why we believe in providing the best nutritional supplements and fitness information to our millions of followers in over 100 countries. </p>
            <p>
                <i>We've helped hundreds of thousands of people take control of their lives and become something
                they've always aspired to be.<br>
                </i>Take a look through our hashtags #SHREDZ and #SHREDZARMY and use them to post your own transformation.
            </p>
            <!-- <b style="font-family: montserrat; font-weight: 900; font-size: 28px; text-transform: uppercase; letter-spacing:-1px; text-align: center">Join the lifestyle - Join the movement - Join the army</b> -->
        </section>
        <div class="shredzBG">
            <a href="{{ route('shop') }}">
                <button class="btn red-btn bigRed">ENTER THE STORE</button>
            </a>
        </div>
    </section>
    <!-- REVIEWS -->
    <section id="review-slider" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-10 col-md-push-1">
            <div class="reviews">
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/review1.jpg')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Love my Alpha Male Stack!<i class="fa fa-quote-right"></i></h4>
                    <h3>JOHN</h3> 
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@misslaw.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Had an amazing transformation<i class="fa fa-quote-right"></i></h4>
                    <h3>LINDSAY</h3> 
                    <p style="display: none;">I had an amazing transformation with shredz! I couldn't have done it without you guys! I had such a difficult time trying to lose weight before, but shredz gave me the extra energy, & motivation!</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@Couponista101.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>An amazing product<i class="fa fa-quote-right"></i></h4> 
                    <h3>CHILLY</h3> 
                    <p style="display: none;">Shredz has definitely given me an extra boost in the gym and has helped me loose weight like no other supplement has done . Have already recommended to many of my friends. An amazing product.</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@Danuelle2887.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>My energy levels were fantastic<i class="fa fa-quote-right"></i></h4> 
                    <h3>DANIELLE</h3> 
                    <p style="display: none;">Shredz is amazing! The BCAA's are so tasty, and my energy levels were fantastic throughout my 30 day challenge. My soreness was kept to a minimum by using the Toner and my results were so great.</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/review3.jpg')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>I have changed in every way<i class="fa fa-quote-right"></i></h4>
                    <h3>OMAR</h3> 
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@JUSTPERLAPEREZ.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>I'm absolutely happy with the results<i class="fa fa-quote-right"></i></h4> 
                    <h3>PERLA</h3> 
                    <p style="display: none;">I've never seen fast results on my body as I did with the 30 day challenge program with Shredz. I'm absolutely happy with the results. Can't wait to see day 60! I only recommended because it works!!!</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@KellsBellz333.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star empty"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>My old clothes don't fit anymore<i class="fa fa-quote-right"></i></h4> 
                    <h3>KELLY</h3> 
                    <p style="display: none;">On the Shredz 30 day weight loss plan I lost 5lbs of body fat & gained lean muscle while losing up to 2" all over my body. My old clothes don't fit anymore & friends were complimenting my results just 3 days into the challenge! That's
                        when I knew that this product really works. I was able to push myself and stay motivated with the unique blend of supplement ingredients I had never thought to try before. I recommend this product to anyone wanting to sculpt their
                    body safely and get fast results.</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@Krys.Luvs.Shredz.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Just what I needed<i class="fa fa-quote-right"></i></h4> 
                    <h3>KRYSTAL</h3> 
                    <p style="display: none;">Shredz was just what I needed to kickstart my journey to fitness. I have used it consistently, with proper diet & exercise, and have achieved amazing results!</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@mattbrown1508.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Fat Burner worked amazingly<i class="fa fa-quote-right"></i></h4> 
                    <h3>MATTHEW</h3> 
                    <p style="display: none;">The fat burner worked amazingly, I had no end of energy throughout my workouts. Definitely recommend this company they have some of the best supplements</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@MonkeyButtAngel.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star empty"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>SHREDZ completely changed my life<i class="fa fa-quote-right"></i></h4> 
                    <h3>ANNA</h3> 
                    <p style="display: none;">I'm a mother of 3 kids that were all born c-section, softball size cyst removal from my stomach, and a hysterectomy. Shredz Supplements completely changed my life to be healthier, fit, and stronger!!</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/Joe.jpg')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star empty"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Loving the results<i class="fa fa-quote-right"></i></h4> 
                    <h3>JOE</h3> 
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@my_my_maya.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>You see the results<i class="fa fa-quote-right"></i></h4> 
                    <h3>MAYA</h3> 
                    <p style="display: none;">I would recommend SHREDZ to friends because its an amazing product and you see the results!</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@Mzdianak.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Definitely doing another 30 Day round<i class="fa fa-quote-right"></i></h4> 
                    <h3>DIANA</h3> 
                    <p style="display: none;">The supplements and workout guides were a HUGE help in losing 13 lbs! The chocolate protein and BCAA both tasted great too. I'll definitely be doing another 30 day round.</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/yousif.jpg')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>I definitely recommend it<i class="fa fa-quote-right"></i></h4> 
                    <h3>YOUSIF</h3> 
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@swolesarah.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                    </div>
                    <h4><i class="fa fa-quote-left"></i>Helped with meeting my nutrition goals<i class="fa fa-quote-right"></i></h4> 
                    <h3>SARAH</h3> 
                    <p style="display: none;">Went from fluffy powerlifter to competing in my first figure comp. Shredz protein helped with meeting my nutrition goals</p>
                </div>
                <div class="review">
                    <a><img class="img-responsive" src="{{asset('images/@themilnelife.png')}}" /></a>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star empty"></i>

                    </div>
                    <h4><i class="fa fa-quote-left"></i>Recommend SHREDZ to everyone<i class="fa fa-quote-right"></i></h4> 
                    <h3>TESSA</h3> 
                    <p style="display: none;">I would definitely recommend Shredz to everyone! I loved all the products I took! =) I started at 145lbs and now I'm at 135lbs!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END REVIEWS -->
</main>
@stop

@section('templates')
    <script name="products" type="text/x-handlebars-template">

        <div class="row">
            <!--@{{#each products}}
                --><div class="item-product col-md-3 col-sm-6 col-xs-6  product-@{{ lcase gender }}" data-price="@{{ base_variant.price }}" data-filters="@{{join categories }} gender-@{{ lcase gender }}" data-sort-id="@{{ @index }}">
                <a class="item_anchor" href="/products/@{{ slug }}">
                @{{#in flags 'featured-sale'}}
                @{{#if-gt base_variant.msrp base_variant.price }}
                <div class="discount-container">
                    <i class="iconmoon icon-discount"></i>
                    <span class="discount">@{{ sale base_variant.price base_variant.msrp }}</span>
                </div>
                </span>
                    <!-- <div class="special">
                    <p>@{{ sale base_variant.price base_variant.msrp }}</p>
                    <img class="" src="{{asset('images/yellowStarShadow.png')}}"/>
                    </div> -->
                @{{/if-gt}}
                @{{/in}}
            <img class="img-responsive pri_store_image" src="@{{ asset_location }}primaryimage_new.jpg">
            <!--<button class="redeem @{{ lcase gender }}">CLICK TO REDEEM <img src="{{ asset('images/button-cursor.png') }}"/></button>-->
            </a>

            <div class="gender-@{{ lcase gender }}" onclick="window.location='/products/@{{ slug }}'">
                <h3>@{{ name }}</h3>
                <h4>@{{ description }}</h4>
            </div>

            <p>
            @{{#if-gt base_variant.msrp base_variant.price }}
            <del class="msrp">$@{{ base_variant.msrp}}</del>
            @{{/if-gt}}
            <span class="base-price redeem @{{ lcase gender }}">$@{{ base_variant.price}}</span></p>
            </div><!--
            @{{/each}}-->
        </div>

        {{-- @{{#grouped_each rows products}} --}}

        {{--@{{/grouped_each}}--}}

    </script>
@append

@section('scripts')
@include('includes.lib.templating')
<script>
    /*blade variables*/
    var publicAssetUrl = '{{asset('')}}';
    var yellowStarShadowUrl = '{{asset('images/yellowStarShadow.png ')}}';
    var buttonCursorUrl = '{{asset('images/button-cursor.png ')}}';
    var product1Url = '{{asset('images/product1.png ')}}';
    var reviewsUrl = '{{ url('results ') }}';
</script>
@if(!App::environment('production'))
<script type="text/javascript" src="{{asset('js/pages/home-old.js')}}"></script>
@else
<script type="text/javascript" src="{{asset('js/pages/home-old.min.js')}}"></script>
@endif


@append