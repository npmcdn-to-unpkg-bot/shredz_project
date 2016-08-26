@extends('themes.default.layout')
@section('root-class') meal-plan @stop
@section('styles')
<link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@stop
@section('main-content-class') {{$queryString}} @stop

@section('content')
<section id="banner">
    <div class="container-fluid">
        <div class="row">
              <div class="cover-image">
            </div>
        </div>
    </div>
</section>
<section id="meal-plan-info">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-sm-6 vertical-center">
                @if($queryString == "female")
                    <img  class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shredz-plan-bundle-female.png">
                @else
                    <img  class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shred-plan-bundle.png">
                @endif

                <div class="ratings">
                    <h6>average customer reviews</h6>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star-half-o"></span>
                    <span>
                        @if($queryString == "female")
                        4.7 / 5
                        @else
                        4.5 / 5
                        @endif
                    </span>
                </div>
            </div><!--
            --><div class="col-xs-12 col-sm-6 vertical-center">
                <div class="name-price">
                    <h1>4 week shred program</h1>
                    <h3>Personalized Meal &amp; Training Plan</h3>
                    <hr class="hidden-xs">
                    <h3 class="price"><del class="dynamic-msrp"></del>&nbsp;<span class="dynamic-price"></span>&nbsp;ONLY TODAY</h3>
                    <hr class="hidden-xs">
                </div>
                <div class="info hidden-xs">
                    <p>With our 4 WEEK SHRED PLAN, you will be working closely with your own dedicated nutrition specialist who will map out every bite you'll take in the next month to achieve your goals.</p>
                    {{-- <a class="page-scroll" href="#become-yourself">Learn More &nbsp;<i class="fa fa-angle-down"></i></a> --}}
                </div>
                <div class="benefits">
                    <ul>
                        <li><i class="fa fa-check"></i>&nbsp; custom diet plan</li>
                        <li><i class="fa fa-check"></i>&nbsp; custom workout plan</li>
                        <li><i class="fa fa-check"></i>&nbsp; meal prep containers</li>
                        <li><i class="fa fa-check"></i>&nbsp; shredz food scale</li>
                        <li><i class="fa fa-check"></i>&nbsp; diet, nutrition, &amp; workout e-books</li>
                    </ul>
                </div>
                <div class="info visible-xs">
                    <p>With our 4 WEEK SHRED PLAN, you will be working closely with your own dedicated fitness specialist who will create your workout plan and map out every bite you'll take in the next month to achieve your goals.</p>
                    {{-- <a class="page-scroll" href="#become-yourself">Learn More &nbsp;<i class="fa fa-angle-down"></i></a> --}}
                </div>
                <hr>
                <div class="col-xs-12 add-to-cart">
                    @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                    Start my plan</button>
                    <p><img class="box" src="{{ asset('images/products/box.png') }}">free usa shipping for orders above $100</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="real-stories">
    <div class="container">
        <div class="row">
            @if($queryString == "female")
            <div class="col-xs-12 col-sm-6 katyann">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/katyann.png" alt="Katyann Coulter - I lost 37 lbs and 6 pant size in 4 week">
            </div>
            @else
            <div class="col-xs-12 col-sm-6 eric">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/eric.png" alt="Eric Lanier - I lost 47 lbs and 8 pant size in 4 week">
            </div>
            @endif
            <div class="col-xs-12 visible-xs">
                <p class="instruction">*EXERCISE AND PROPER DIET ARE NECESSARY TO MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT</p>
            </div>
            @if($queryString == "female")
            <div class="col-xs-12 col-sm-6 geneva">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/geneva.png" alt="Geneva Brainard - I lost 15 lbs and 4 pant size in 4 weeks">
            </div>
            @else
            <div class="col-xs-12 col-sm-6 johnbellmore">
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/johnbellmore.png" alt="John Bellmore - I lost 37 lbs and 6 pant size in 4 weeks">
            </div>
            @endif
            <div class="col-xs-12 visible-xs">
                <p class="instruction">*EXERCISE AND PROPER DIET ARE NECESSARY TO MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT</p>
            </div>
            <div class="col-xs-12 add-to-cart visible-xs">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
    <div class="container-fluid no-gutter hidden-xs">
        <div class="row">
            <div class="col-xs-12">
                <p class="instruction">*EXERCISE AND PROPER DIET ARE NECESSARY TO MAINTAIN WEIGHT LOSS. RESULTS VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT</p>
            </div>
            <div class="col-xs-12 add-to-cart">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
</section>

<section id="custom-diet-plan">
    {{-- <h1 class="custom">custom made for you</h1> --}}
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
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/tailoredfemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/tailored.png"></li>
                            @endif<!--
                            --><li class="vertical-center">
                                <p>100% Tailored</p>
                                <small>to your needs and goals</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/eatingstylesfemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/eatingstyles.png"></li>
                            @endif<!--
                            --><li class="vertical-center">
                                <p>20+ Eating Styles</p>
                                <small>(Paleo, Vegan, Etc.)</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/cookingguidesfemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/cookingguides.png"></li>
                            @endif<!--
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
                <p>Do you want to lose weight or gain muscle? We have solutions for every body, every need.</p>
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
                @if($queryString == "female")
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/workoutsample-female.jpg" alt="SHREDZ workout female">
                @else
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/workoutsample-male.jpg" alt="SHREDZ workout male">
                @endif
                <p class="visible-xs">Do you want to lose weight? Gain muscle? Have more energy? Get stronger? We have solutions for every body and every need.</p>
            </div><!--
            --><div class="col-xs-12 col-sm-5 icon-wrapper vertical-center">
                 <div class="row">
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul class="list-inline">
                            <li class="vertical-center hidden-xs">
                                <h4>At gym</h4>
                            </li><!--
                            -->@if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/atgym.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/atgym.png"></li>
                            @endif
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
                            -->@if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/athome.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/athome.png"></li>
                            @endif
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
                            -->@if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/outdoors.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/outdoors.png"></li>
                            @endif
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
                @if($queryString == "female")
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/workout-section-female.jpg" alt="shredz workout female meal plan page">
                @else
                <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male/workout-section-male.jpg" alt="shredz workout male meal plan page">
                @endif
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
                    </div>
                </div>
            </div><!--
            --><div class="col-xs-12 col-sm-5 logo-container vertical-center">
                <div class="row icon-wrapper">
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/certifiedfemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/certified.png"></li>
                            @endif<!--
                            --><li class="vertical-center">
                                <p>Certified Expert</p>
                                <small>Dedicated to get you the results you want</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/oneononefemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/oneonone.png"></li>
                            @endif<!--
                            --><li class="vertical-center">
                                <p>1-ON-1 Check-ins</p>
                                <small>Weekly email check-ins to keep you on track</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-12 icons">
                        <ul>
                            @if($queryString == "female")
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/motivationfemale.png"></li>
                            @else
                            <li class="vertical-center"><img class="img-responsive icon" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/png-icons/motivation.png"></li>
                            @endif<!--
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
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid coaches">
        <div class="row cover-image">
            <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="heading hidden-xs">
                    <h2>Our Certified Experts</h2>
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
                    <div class="col-xs-4 col-xs-offset-4 col">
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
<section id="button-holder">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 add-to-cart">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
</section>
<section id="best-price">
    <h1>Best value. best price.</h1>
    <div class="container plan-comparison hidden-xs">
        <div class="row">
            <div class="col-xs-4 col-others">
                <div class="plan">
                    <h4 class="others">others</h4>
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/compare-2-logo.jpg">
                    <hr >
                    <ul>
                        <li><i class="fa color-yellow fa-check"></i>One size fits all Meal Plan</li>
                        <li><i class="fa color-yellow fa-check"></i>One size fits all Workout</li>
                        <li><i class="fa color-yellow fa-times"></i>No dedicated coach</li>
                        <li><i class="fa color-yellow fa-times"></i>No registered Dietitian</li>
                        <li><i class="fa color-yellow fa-times"></i>No food scale</li>
                        <li><i class="fa color-yellow fa-times"></i>No Weekly Support</li>
                        <li><i class="fa color-yellow fa-times"></i>No recurring fee</li>
                        <li><i class="fa color-yellow fa-check"></i>Ordinary 99¢ Meal Containers</li>
                        <li><i class="fa color-yellow fa-check"></i>Generic Shaker Cup</li>
                    </ul>
                </div>
                <p class="price"><span>$150</span></p>
            </div><!--
            --><div class="col-xs-4 col-shredz">
                <div class="plan">
                    @if($queryString == "female")
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/4Week_Shred_Female_logo.png">
                    <img class="img-responsive" style="margin-top: 28px;" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shredz-plan-bundle-female.png">
                    @else
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/4_Week_Shred_Logo.png">
                    <img class="img-responsive" style="margin-top: 28px;" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shred-plan-bundle.png">
                    @endif
                    <hr >
                    <ul>
                        <li><i class="fa fa-check"></i>Custom meal plan</li>
                        <li><i class="fa fa-check"></i>Custom workout plan</li>
                        <li><i class="fa fa-check"></i>One-on-One coaching</li>
                        <li><i class="fa fa-check"></i>Dedicated workout coach</li>
                        <li><i class="fa fa-check"></i>Registered Dietitian</li>
                        <li><i class="fa fa-check"></i>Weekly Support</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ Food Scale</li>
                        <li><i class="fa fa-check"></i>No recurring fee</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ meal containers</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ Shaker Cup</li>
                    </ul>
                </div>
                <p class="price"><del class="dynamic-msrp"></del>&nbsp;<span class="dynamic-price"></span></p>
            </div><!--
            --><div class="col-xs-4 col-personal">
                <div class="plan">
                    <h4 class="contract">contracting</h4>
                    <h6>trainer + dietitian</h6>
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/compare-3-logo.jpg">
                    <hr >
                    <ul>
                        <li><i class="fa fa-check"></i>Custom Meal Plan</li>
                        <li><i class="fa fa-check"></i>Custom Workout Plan</li>
                        <li><i class="fa fa-check"></i>One-on-One coaching</li>
                        <li><i class="fa fa-check"></i>Dedicated Workout coach</li>
                        <li><i class="fa fa-check"></i>Registered Dietitian</li>
                        <li><i class="fa fa-times"></i>No Food Scale</li>
                        <li><i class="fa fa-check"></i>Recurring fee</li>
                        <li><i class="fa fa-times"></i>No meal prep containers</li>
                        <li><i class="fa fa-times"></i>No SHREDZ Shaker Cup</li>
                    </ul>
                </div>
                <p class="price"><span>$1,000+</span></p>
            </div>
        </div>
    </div>
    <div class="container-fluid plan-comparison visible-xs">
        <div class="next"></div>
        <div class="prev"></div>
        <div class="row">
            <div class="col-xs-4 vertical-center left col-plans">
                <div class="plan">
                    <h4 class="others">others</h4>
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/compare-2-logo.jpg">
                    <hr >
                    <ul>
                        <li><i class="fa color-yellow fa-check"></i>One size fits all Meal Plan</li>
                        <li><i class="fa color-yellow fa-check"></i>One size fits all Workout</li>
                        <li><i class="fa color-yellow fa-times"></i>No dedicated coach</li>
                        <li><i class="fa color-yellow fa-times"></i>No registered Dietitian</li>
                        <li><i class="fa color-yellow fa-times"></i>No food scale</li>
                        <li><i class="fa color-yellow fa-times"></i>No Weekly Support</li>
                        <li><i class="fa color-yellow fa-check"></i>No Contract</li>
                        <li><i class="fa color-yellow fa-check"></i>Ordinary 99c Meal Containers</li>
                        <li><i class="fa color-yellow fa-check"></i>Generic SHREDZ Cup</li>
                    </ul>
                </div>
                <p class="price"><span style="color: #896FAE;">$150</span></p>
            </div>
            <div class="col-xs-4 vertical-center middle col-plans" id="shredz-plan">
                <div class="plan">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/4_Week_Shred_Logo.png">
                    <img class="img-responsive" style="margin-top: 15px;"  src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shred-plan-bundle.png">
                    <hr >
                    <ul>
                        <li><i class="fa fa-check"></i>Custom meal plan</li>
                        <li><i class="fa fa-check"></i>Custom workout plan</li>
                        <li><i class="fa fa-check"></i>One-on-One coaching</li>
                        <li><i class="fa fa-check"></i>Dedicated workout coach</li>
                        <li><i class="fa fa-check"></i>Registered Dietitian</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ Food Scale</li>
                        <li><i class="fa fa-check"></i>No Contract</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ meal containers</li>
                        <li><i class="fa fa-check"></i>FREE SHREDZ Shaker Cup</li>
                    </ul>
                </div>
                <p class="price"><del class="dynamic-msrp"></del>&nbsp;<span class="dynamic-price"></span></p>
            </div>
            <div class="col-xs-4 right vertical-center col-plans">
                <div class="plan">
                    <h4 class="contract">contracting</h4>
                    <h6>trainer + dietitian</h6>
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/compare-3-logo.jpg">
                    <hr >
                    <ul>
                        <li><i class="fa fa-check"></i>Custom Meal Plan</li>
                        <li><i class="fa fa-check"></i>Custom Workout Plan</li>
                        <li><i class="fa fa-check"></i>One-on-One coaching</li>
                        <li><i class="fa fa-check"></i>Dedicated Workout coach</li>
                        <li><i class="fa fa-check"></i>Registered Dietitian</li>
                        <li><i class="fa fa-times"></i>No Food Scale</li>
                        <li><i class="fa fa-check"></i>Contract</li>
                        <li><i class="fa fa-times"></i>No meal prep containers</li>
                        <li><i class="fa fa-times"></i>No Shaker Cup</li>
                    </ul>
                </div>
                <p class="price"><span style="color: #36B6EC;">$1,000+</span></p>
            </div>
        </div>
    </div>
</section>
<section id="customized">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="heading">
                    <h1>100% <span class="hidden-xs">customized</span></h1>
                    <h2 class="visible-xs">customized</h2>
                </div>
            </div>
        </div>
        <div class="row icon-wrapper">
            <div class="col-xs-12 col-sm-10 co-sm-offset-1 col-md-8 col-md-offset-3 text-center">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 icon-text">
                        <i class="icon icon-customized-your-taste vertical-center"></i>
                        <!-- <i class="icon icon-custom-meal-plan vertical-center"></i> -->
                        <span class="vertical-center">meal plan</span>
                    </div>
                    <div class="col-xs-12 col-sm-2 icon-text">
                        <i class="icon icon-custom-workout-plan vertical-center"></i><!--
                        --><span class="vertical-center">workout plan</span>
                    </div>
                    <div class="col-xs-12 col-sm-2 icon-text">
                        <i class="icon icon-customized-your-body vertical-center"></i><!--
                        --><span class="vertical-center">bonus gifts</span>
                    </div>
                    <div class="col-xs-12 col-sm-2 icon-text">
                        <i class="icon icon-dedicated-specialist vertical-center"></i><!--
                        --><span class="vertical-center">certified experts</span>
                    </div>
                    <div class="col-xs-12 col-sm-2 icon-text">
                        <i class="icon icon-weekly-checkins vertical-center"></i><!--
                        --><span class="vertical-center">weekly follow-ups</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 add-to-cart">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
</section>

<section id="gives-everything">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="heading">
                    <h2 class="title-light">THE 4 WEEK SHRED <strong>GIVES YOU EVERYTHING</strong> YOU NEED TO GET FIT AND HEALTHY</h2>
                    <br />
                    @if($queryString == "female")
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shredz-plan-bundle-female.png">
                    @else
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shred-plan-bundle.png">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section id="whats-included">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="heading">
                    <h2>what's included</h2>
                </div>
                <div class="item-wrapper">
                    <div class="item text-center">
                         <div class="col-xs-12 col-sm-4 col">
                            @if($queryString == "female")
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female-diet-plan-book.png">
                            @else
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/male-diet-plan-book.png">
                            @endif
                            <h4>Diet Plan</h4>
                            <p>Carefully crafted to work with your body type, food preferences, and specific goals to take the guesswork out of planning meals.</p>
                        </div>
                         <div class="col-xs-12 col-sm-4 col">
                            @if($queryString == "female")
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female-workout-plan-book.png">
                            @else
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/workout-plan.png">
                            @endif
                            <h4>Workout Plan</h4>
                            <p>No two bodies are the same. Our customized workout plans are designed with your schedule, your goals, and your body in mind.</p>
                        </div>
                         <div class="col-xs-12 col-sm-4 col">
                            @if($queryString == "female")
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/shealyn.png">
                            @else
                            <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/coaching/jason.png">
                            @endif
                            <h4>Certified Coach</h4>
                            <p>Whether you need the guidance, the motivation, or both, your coach will be there for support along the way.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="bonus-gift">
    <h1>+ bonus gifts</h1>
    <div class="container">
        <div class="row visible-xs">
            <div class="col-xs-12">
                <div class="gift">
                    @if($queryString == "female")
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/female/bonus-gifts-female.png">
                    @else
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/bonus-gifts-male.png">
                    @endif
                    <ul class="list-inline">
                        <li>Shaker cup</li>
                        <li><i class="fa fa-circle"></i></li>
                        <li>Food Containers</li>
                        <li><i class="fa fa-circle"></i></li>
                        <li>food scale</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row row-flex hidden-xs">
            <div class="col-xs-12 col-sm-4 col-flex">
                <div class="gift">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/scale.png">
                    <h4>food scale</h4>
                    <p>We recommend weighing out your assigned meal portions to ensure accuracy and get the results you’re looking for.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-flex">
                <div class="gift">
                    @if($queryString == "female")
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/containers-female.png">
                    @else
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/containers.png">
                    @endif
                    <h4>food containers</h4>
                    <p>These microwave and dishwasher safe locking containers keep your meals fresh so they’re ready when you are.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-flex">
                <div class="gift">
                    @if($queryString == "female")
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shaker-cup-female.png">
                    @else
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/mealplan/shaker-cup.png">
                    @endif
                    <h4>shaker cup</h4>
                    <p>This 20-ounce dual shaker separates two different liquids at one time, which is ideal for pre and post workout.</p>
                </div>
            </div>
            <div class="col-xs-12 add-to-cart hidden-xs">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
</section>
<section id="button-holder" class="visible-xs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 add-to-cart">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
            </div>
        </div>
    </div>
</section>
<section id="question-answer">
    <div class="container">
        <div class="row">
            <h2>Questions &amp; answers</h2>
            <div class="qa-wrapper col-xs-12">
                <div class="qa col-xs-12">
                    <p class="question">When will I receive my 4 Week Shred Program?</p>
                    <p class="answer">After you fill out the questionnaire, our team needs 4-5 days to build you a customized diet and workout program specifically for you.</p>
                    <hr>
                </div>
                <div class="qa col-xs-12">
                    <p class="question">How is the plan sent to me?</p>
                    <p class="answer">It is emailed to you as a PDF. You can download and save the PDF file for printing and future use.</p>
                    <hr>
                </div>
                <div class="qa col-xs-12">
                    <p class="question">Will I be provided video instructions?</p>
                    <p class="answer">At this time we are not offering video instructions but you can join our FREE <a href="/fitclub-signup">SHREDZ Fit Club</a> for exclusive access to instructional videos and more.</p>
                    <hr>
                </div>
            </div>
            <div class="col-xs-12">
                <h6>Have more Questions?</h6>
                <a class="link" href="https://v2.zopim.com/widget/livechat.html?key=219N88usAAF5K4SUFlw2bWKPEpaX47c1" target="_blank">Chat with us <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</section>
<section id="reviews">
<div class="container-fluid">
    <div class="row reviews-wrapper">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 vertical-center recent-reviews">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <h2>Customer Reviews</h2>
                    <p class="average-ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        @if($queryString == "female")
                        4.7 / 5
                        @else
                        4.5 / 5
                        @endif
                    </p>
                    <h3 class="horizontal-line visible-xs"><span>Latest Reviews</span></h3>
                    <hr class="hidden-xs">
                </div>
            </div>
            <div class="row">
                <div class="review col-xs-12 col-sm-6">
                    <div class="user-ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span class="heading">My confidence has increased 100%, I am no longer insecure about taking my shirt off anymore.</span>
                    </div>
                    <div class="full-review">
                        <p class="featuredReview">The goals I had were to have a summer body that I have always dreamed of. Ripped 6 pack abs. I achieve these goals by sticking to the diet plan and not cheating and telling myself I can do it. My confidence has increased 100% I am no longer insecure about taking my shirt off anymore and with how I look. And to get motivated just think in 3-4 months of hard work what the results will be.</p>
                        <p class="reviewer">
                            By <span class="name">Noah Parker</span> on <span class="date">
                        May 30, 2016</span>
                    </p>
                </div>
            </div>
            <div class="review col-xs-12 col-sm-6">
                <div class="user-ratings">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <span class="heading">All around I feel so much better!</span>
                </div>
                <div class="full-review">
                    <p class="featuredReview">All around I feel so much better! I am more confident, I am stronger, and healthier. It also helps when people notice too!</p>
                    <p class="reviewer">
                        By <span class="name">Rebecca Hamilton</span> on <span class="date">
                    March 26, 2016</span>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="review col-xs-12 col-sm-6">
            <div class="user-ratings">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span class="heading">This is an excellent program; I would recommend Shredz to anyone!</span>
            </div>
            <div class="full-review">
                <p class="featuredReview">When I started my waist was 46.5 inches and my hip was 48.75 inches, weight was 277 pounds. Now I’am 264 pounds and waist is 41.5 inches, my hips is at 43 inches. My weight lose is still on the decline. I feel stronger, faster and my performance has improved in Tae Kwon Do thanks to this program. This is an excellent program, I would recommend Shredz to anyone.</p>
                <p class="reviewer">
                    By <span class="name">Gerard Doret</span> on <span class="date">
                March 1, 2016</span>
            </p>
        </div>
    </div>
    <div class="review col-xs-12 col-sm-6">
        <div class="user-ratings">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <span class="heading">I have lost an inch and a half off my waist going from a 25.5 to a 24”.</span>
        </div>
        <div class="full-review">
            <p class="featuredReview">I have lost an inch and a half off my waist going from a 25.5 to a 24”. And gained 2 inches on my butt going from a 35 to a 37”.</p>
            <p class="reviewer">
                By <span class="name">Stefani Miller</span> on <span class="date">
            March 18, 2016</span>
        </p>
    </div>
</div>
</div>
<hr class="hidden-xs">
</div>
</div>
</div>
</section>
<section id="become-yourself">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Become your best self</h1>
                <p>With our <strong>4 Week Shred Program</strong>, the hassle is over.</p>
            </div>
            <div class="col-xs-12 add-to-cart">
                @if($queryString=='female') <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-MFW"> @else <button type="button" class="center-block add-to-cart-button" aria-haspopup="true" aria-expanded="false" data-sku="4WK-SP-CORE">  @endif
                Start my plan</button>
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
@stop
@section('scripts')
<script type="text/javascript" src="{{asset('js/product.factory.js')}}"></script>
<script type="text/javascript" src="{{asset('js/pages/meal-plan.js')}}"></script>
@append
