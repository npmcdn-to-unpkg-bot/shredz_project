@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') new-homepage @stop
@section('content')
<!-- Slider -->
<section id="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="home-slider">
                    <div class="slide">
                        <a href="{{ route('shop') }}"><img class="img-responsive hidden-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/desktop/burner_max.jpg"></a>
                        <a href="{{ route('shop') }}"><img class="img-responsive visible-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/mobile/burner_max.jpg"></a>
                    </div>
                    <div class="slide">
                        <a href="{{ route('coaching') }}"><img class="img-responsive hidden-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/desktop/custom_diet.jpg"></a>
                        <a href="{{ route('coaching') }}"><img class="img-responsive visible-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/mobile/custom_diet.jpg"></a>
                    </div>
                    <div class="slide">
                        <a href="{{ route('fitclub-signup') }}"><img class="img-responsive hidden-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/desktop/fit_club.jpg"></a>
                        <a  href="{{ route('fitclub-signup') }}"><img class="img-responsive visible-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/mobile/fit_club.jpg"></a>
                    </div>
                    <div class="slide">
                        <a href="{{ route('results') }}"><img class="img-responsive hidden-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/desktop/success_story.jpg"></a>
                        <a href="{{ route('results') }}"><img class="img-responsive visible-xs" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banners/mobile/success_story.jpg"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Build your own -->
<!-- <section id="build-your-own">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Shredz 30 day plan</h1>
                <h2>build your own <span>custom</span> plan</h2>
                <p>accomplish in 4 simple steps</p>
            </div>
            <ul>
                <li>
                    <h3><i class="icon icon-goal"></i></h3>
                    <h3>choose your goal</h3>
                </li>
                <li>
                    <h3><i class="icon icon-home-bottle"></i></h3>
                    <h3>choose your supplements</h3>
                </li>
                <li>
                    <h3><i class="icon icon-dumbblle"></i></h3>
                    <h3>choose your workout plan</h3>
                </li>
                <li>
                    <h3><i class="icon icon-home-apparel"></i></h3>
                    <h3>choose your apparel</h3>
                </li>
            </ul>
            {{-- <a href="{{ route('30-day-supplement-workout-plan') }}"><button class="btn large-button center-block">start now</button></a> --}}
        </div>
    </div>
</section> -->
<section id="build-your-own">
    <div class="black-background">
        <div class="container">
            <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-1">
                <h2> Shredz Online Store</h2>
                <h3>Explore all <span>shredz</span> products</h3>
                <!-- <p class="hidden-xs">Or choose by kind</p> -->
                <!-- <i class="icon icon-arrow-right"></i> -->
            </div>
            <div class="col-xs-12 col-sm-3 hidden-xs">
                <a href="{{ route('shop') }}"><button class="btn large-button">Shop now</button></a>
            </div>
        </div>
    </div>
   <!--  <div class="container-fluid gray-background">
        <div class="row">
            <div class="col-xs-0 col-sm-2"></div>
            <div class="col-xs-12 col-sm-8">
                <div class="row text-center">
                    <div class="col-xs-4">
                        <a href="{{ route('30-day-supplement-workout-plan') }}">
                            <img class="alpha-image img-responsive" src="{{ asset('images/home/alpha_male.png') }}">
                            <p class="step">Step 1</p>
                            <p>choose <span class="hidden-xs">your</span> supplements</p>
                        </a>
                        <i class="fa fa-angle-right hidden-xs"></i>
                    </div>
                    <div class="col-xs-4">
                        <a href="{{ route('30-day-supplement-workout-plan') }}">
                            <img class="img-responsive" src="{{ asset('images/home/ebooks.png') }}">
                            <p class="step">Step 2</p>
                            <p>choose <span class="hidden-xs">your</span> workout</p>
                        </a>
                        <i class="fa fa-angle-right hidden-xs"></i>
                    </div>
                    <div class="col-xs-4">
                        <a href="{{ route('30-day-supplement-workout-plan') }}">
                            <img class="img-responsive" src="{{ asset('images/home/apparel.png') }}">
                            <p class="step">Step 3</p>
                            <p>choose <span class="hidden-xs">your</span> apparel</p>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 visible-xs">
                    <button class="btn large-button">Start now</button>
                </div>
            </div>
            <div class="col-xs-0 col-sm-2"></div>
        </div>
    </div> -->
</section>
<!-- Featured Products -->
<section id="featured-products">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
                <div class="col-xs-12">
                <a href="{{ route('shop') }}">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/sections/products.png">
                </a>
                </div>
                <h3>Products</h3>
                <p>We use complex formulations designed to improve energy and support healthy body composition. No matter your goal, get more from both your body and mind.</p>
                <a href="{{ route('shop') }}"><button class="btn small-button center-block">Shop now</button></a>
                <hr class="visible-xs">
            </div>
            <div class="col-xs-12 col-sm-4 text-center">
                <div class="col-xs-12">
                    <a href="{{ route('coaching')}}">
                        <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/sections/dietplans.png">
                    </a>
                </div>
                <h3>custom diet &amp; meal</h3>
                <p>Our online coaching team of diverse fitness professionals build programs designed for your goals and provide hands-on guidance to get you past your plateaus.</p>
                <a href="{{ route('coaching')}}"><button class="btn small-button center-block">start today</button></a>
                <hr class="visible-xs">
            </div>
            <div class="col-xs-12 col-sm-4 text-center">
                <div class="col-xs-12">
                    <a href="{{ route('shop', ['#accessories']) }}">
                        <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/sections/apparel.png">
                    </a>
                </div>
                <h3>apparel</h3>
                <p>Gym gear should be as stylish and resilient as you are. Our apparel is crafted to keep you comfortable during your next big set or your next progress selfie.</p>
                <a href="{{ route('shop', ['#accessories+bottoms+looks+stringers+t-shirts+tanktops+tops']) }}"><button class="btn small-button center-block">get stylish</button></a>
            </div>
        </div>
        
    </div>
</section>
<!-- Success Stories -->
<section id="success-stories">
    <div class="container-fluid">
        <div class="row">
            <div class="success-left col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1">
                <h2>shredz success stories</h2>
                <p>We've helped hundreds of thousands of people take control of their lives and become something they've always aspired to be.</p>
                <p>Take a look through our has tags #SHREDZ and #SHREDZARMY and use them to post your own transformation.</p>
                <a href="{{ route('results') }}"><button class="btn large-button center-block">success stories</button></a>
            </div>
            <div class="success-left col-xs-12 col-sm-5 col-md-4">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/banner.png">
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Post -->
<section id="latest-blog">
    <div class="container visible-xs mobile">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="horizontal-line">
                <span>latest shredz posts</span>
                </h2>
            </div>
        </div>
        <div class="row tab-menu-wrapper">
            <div href="#workouts" aria-controls="workouts" role="tab" data-toggle="tab" class="col-xs-4 tab active">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">WORKOUTS</h2>
                    </div>
                </div>
            </div>
            
            <div href="#nutrition" aria-controls="nutrition" role="tab" data-toggle="tab" class="col-xs-4 tab">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">NUTRITION</h2>
                    </div>
                </div>
            </div>
            <div href="#recipe" aria-controls="recipe" role="tab" data-toggle="tab" class="col-xs-4 tab">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">RECIPE</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="workouts">
                        <div class="row">
                            @if($pageComponent->blogs("workouts")[0])
                            <div class="col-xs-12 col-sm-4 image-text-container">
                                <div class="image-text-container">
                                    <a href="/blog/{{ @$pageComponent->blogs("workouts")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("workouts")[0]['assets']['primary_image'][0]['path'] }}"></a>
                                    <div class="row info-wrapper">
                                        <div class="col-xs-12">
                                            <h3>{{ @$pageComponent->blogs("workouts")[0]['title'] }}</h3>
                                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("workouts")[0]['publish_start']) }}</p>
                                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("workouts")[0]['_summary'], 100) !!}...</p>
                                            <a href="/blog/{{ @$pageComponent->blogs("workouts")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="nutrition">
                        <div class="row">
                            @if($pageComponent->blogs("nutrition")[0])
                            <div class="col-xs-12 col-sm-4 image-text-container">
                                <div class="image-text-container image-text-container">
                                    <a href="/blog/{{ @$pageComponent->blogs("nutrition")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("nutrition")[0]['assets']['primary_image'][0]['path'] }}"></a>
                                    <div class="row info-wrapper">
                                        <div class="col-xs-12">
                                            <h3>{{ @$pageComponent->blogs("nutrition")[0]['title'] }}</h3>
                                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("nutrition")[0]['publish_start']) }}</p>
                                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("nutrition")[0]['_summary'], 100) !!}...</p>
                                            <a href="/blog/{{ @$pageComponent->blogs("nutrition")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="recipe">
                        <div class="row">
                            @if($pageComponent->blogs("recipes")[0])
                            <div class="col-xs-12 col-sm-4 image-text-container">
                                <div class="image-text-container">
                                    <a href="/blog/{{ @$pageComponent->blogs("recipes")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("recipes")[0]['assets']['primary_image'][0]['path'] }}"></a>
                                    <div class="row info-wrapper">
                                        <div class="col-xs-12">
                                            <h3>{{ @$pageComponent->blogs("recipes")[0]['title'] }}</h3>
                                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("recipes")[0]['publish_start']) }}</p>
                                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("recipes")[0]['_summary'], 100) !!}...</p>
                                            <a href="/blog/{{ @$pageComponent->blogs("recipes")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container hidden-xs desktop">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="horizontal-line"><span>latest shredz posts</span></h2>
            </div>
            @if($pageComponent->blogs("workouts")[0])
            <div class="col-xs-12 col-sm-4">
                <h3>workouts</h3>
                <div class="image-text-container">
                    <a href="/blog/{{ @$pageComponent->blogs("workouts")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("workouts")[0]['assets']['primary_image'][0]['path'] }}"></a>
                    <div class="row info-wrapper">
                        <div class="col-xs-12">
                            <h4>{{ @$pageComponent->blogs("workouts")[0]['title'] }}</h4>
                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("workouts")[0]['publish_start']) }}</p>
                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("workouts")[0]['_summary'], 100) !!}...</p>
                            <a href="/blog/{{ @$pageComponent->blogs("workouts")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($pageComponent->blogs("nutrition")[0])
            <div class="col-xs-12 col-sm-4">
                <h3>nutrition</h3>
                <div class="image-text-container">
                    <a href="/blog/{{ @$pageComponent->blogs("nutrition")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("nutrition")[0]['assets']['primary_image'][0]['path'] }}"></a>
                    <div class="row info-wrapper">
                        <div class="col-xs-12">
                            <h4>{{ @$pageComponent->blogs("nutrition")[0]['title'] }}</h4>
                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("nutrition")[0]['publish_start']) }}</p>
                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("nutrition")[0]['_summary'], 100) !!}...</p>
                            <a href="/blog/{{ @$pageComponent->blogs("nutrition")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            @if($pageComponent->blogs("recipes")[0])
            <div class="col-xs-12 col-sm-4">
                <h3>recipes</h3>
                <div class="image-text-container">
                    <a href="/blog/{{ @$pageComponent->blogs("recipes")[0]['slug'] }}"><img class="img-responsive" src="{{ @$pageComponent->blogs("recipes")[0]['assets']['primary_image'][0]['path'] }}"></a>
                    <div class="row info-wrapper">
                        <div class="col-xs-12">
                            <h4>{{ @$pageComponent->blogs("recipes")[0]['title'] }}</h4>
                            <p class="date">{{ $pageComponent->formatDate(@$pageComponent->blogs("recipes")[0]['publish_start']) }}</p>
                            <p>{!! @$pageComponent->limitString(@$pageComponent->blogs("recipes")[0]['_summary'], 100) !!}...</p>
                            <a href="/blog/{{ @$pageComponent->blogs("recipes")[0]['slug'] }}">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- label -->
<section id="label">
    <div class="container-fluid">
        <!-- <img class="img-responsive" src="https://s3.amazonaws.com/shredz-com-v2/home/as_seen_on_full.png"> -->
        <ul class="list-inline text-center">
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/flex.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/boston-globe.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/xm.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/itunes.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/business-insider.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/gnc.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/abc.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/miami.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/examiner.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/sports.png"></li>
            <li><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/logo/cbs.png"></li>
        </ul>
    </div>
</section>
<!-- online coaching -->
<section id="online-coaching">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 cover-image">
                <div class="text-holder">
                    <img class="img-responsive white-logo" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/white-logo.png">
                    <h1>online coaching</h1>
                    <h4>WE BUILD DIET &AMP; TRAINING PROGRAMS ENGINEERED TO GET YOU RESULTS</h4>
                    <img class="img-responsive change" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/change-divider.png">
                    <a href="{{ route('coaching') }}"><button class="btn small-button center-block">Learn more</button></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fitclub -->
<section id="fitclub">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 coming-soon">
                <p class="icon-text">
                    <i class="icon icon-arrow hidden-xs"></i>
                    <i class="icon icon-arrow-right visible-xs"></i>
                    <span>coming soon</span>&nbsp;Get Early Access
                </p>
                <a href="{{ route('fitclub-signup') }}">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/fitclub-devices.png">
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 image-text-container">
                <img class="hidden-xs img-responsive logo" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/fitclub-logo.png">
                <h2>workout anywhere</h2>
                <p> unlimited access 24/7 </p>
                <hr>
                <ul class="list-inline">
                    <li>
                        <span><i class="icon icon-play"></i></span>
                        <span>50+ Exercise Videos</span>
                    </li>
                    <li>
                        <span><i class="icon icon-tips"></i></span>
                        <span>Tips &amp; Tricks</span>
                    </li>
                    <li>
                        <span><i class="icon icon-free"></i></span>
                        <span>100% Free of Charge</span>
                    </li>
                </ul>
                <a href="{{ route('fitclub-signup') }}"><button class="btn small-button center-block">learn more</button></a>
            </div>
        </div>
    </div>
</section>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('js/pages/home.js') }}"></script>
@append