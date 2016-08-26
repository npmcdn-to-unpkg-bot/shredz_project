@extends('themes.default.layout')
@section('styles')

@append
@section('content')

    <main class="ceo-message">
        <div class="ceo-container">
            <div class="wrapper">
                <h2 class="large">CEO MESSAGE</h2>
                <h2 class="light">ARVIN LAL</h2>
            </div>
        </div>
        <div class="container">
            <div class="steps inside-section-margin">
                <h2 class="centered">HOW TO MAKE OVER $70K A YEAR!</h2>
                <p class="intro">
                    Every SHREDZ Master Coach has the opportunity to make a minimum of an
                    additional $70k to their current income
                </p>
                <div class="step inside-section-margin">
                    <i class="icon-style fa fa-download"></i>&nbsp;
                    <!-- <img class="icon-smartphone" src="{{asset('images/ceo-smartphone.png')}}"> -->
                    <div class="text">
                        <h2 class="red">STEP 1</h2>
                        <h3>DOWNLOAD THE APP</h3>
                    </div>
                    <p>
                        The app works on all iOS devices and is trending on iTunes.
                        Simply search for ‘SHREDZ Coach' in the App store or click any of the
                        download buttons on this website!
                    </p>
                </div>
                <div class="step">
                    <i class="icon-style fa fa-check"></i>&nbsp;&nbsp;
                    <!-- <img class="icon-check" src="{{asset('images/ceo-check.png')}}"> -->
                    <div class="text">
                        <h2 class="red">STEP 2</h2>
                        <h3>BECOME SHREDZ CERTIFIED</h3>
                    </div>
                    <p>
                        Our app allows you to take advantage of out FREE course which will get you apporved in hours.
                        If you’re already a certified coach we can fast track your approval!
                    </p>
                </div>
                <div class="step last">
                    <i class="icon-style fa fa-money"></i>&nbsp;&nbsp;
                    <!-- <img class="icon-money" src="{{asset('images/ceo-money.png')}}"> -->
                    <div class="text">
                        <h2 class="red">STEP 3</h2>
                        <h3>QUALIFY AS A MASTER COACH</h3>
                    </div>
                    <p>
                        The elite coaches are called our SHREDZ Master Coaches.This group is eligible for the
                        maximum payout on each and every client that becomes a supplement customer.
                    </p>
                </div>
            </div>

            <div class="row inside-section-margin">
                <div class="col-sm-6">
                    <a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank;"><button><i class="fa fa-apple"></i>&nbsp;HAVE AN IPHONE? CLICK HERE</button></a>
                </div>
                <div class="col-sm-6 col-lg-pull-1 col-sm-pull-0">
                    <a href="https://confirmsubscription.com/h/d/51438A7DB85502C9" target="_blank;"><button><i class="fa fa-android"></i>&nbsp;HAVE AN ANDROID? CLICK HERE</button></a>    
                </div>
            </div>
            <br />
            <!-- 16:9 aspect ratio -->
            <div class="inside-section-margin embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_O0slFM3Sxg" allowfullscreen></iframe>
            </div>
            <p class="slight-bold">
                As CEO and Co-Founder of SHREDZ® Supplements, a company that is fueled by passion and a relentless
                work ethic, I want to say welcome to the social media movement known as the #SHREDZARMY and thank you
                for choosing SHREDZ products for your fitness and lifestyle needs.
            </p>
            <hr >
            <p>
                Health and fitness is the world’s fastest growing industry and there are many options when choosing what
                supplement is right for you. We want you to know that we are dedicated to producing the finest products
                with top of the line ingredients and formulating blends specifically created with your health in mind.
                We will never sacrifice quality for quantity and your health and wellbeing will always be our top priority.
            </p>
            <p>
                SHREDZ® is on a mission for change. Not only are we transforming the fitness industry, but we’re out to
                change the world itself. Every single day, our team is innovating and building a movement powered by
                passion, discipline and an insane work ethic. If you give the movement and this company 100%, we will
                always give you 200% back.
            </p>
            <div class="inside-section-margin embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/1iDAMA20Tjg" allowfullscreen></iframe>
            </div>
            <h2 class="welcome">WELCOME TO THE SHREDZARMY</h2>
            <h3 class="thanks" style="font-family: Allura,Georgia,serif; font-style: italic;">Thank You for choosing Shredz Supplements!</h3>
            <!-- <h2 class="recommendation">ARVIN'S RECOMMENDED PRODUCTS</h2>
            <div class="products">
                <div class="product">
                    <img>
                    <button class="female">VIEW NOW</button>
                </div>
                <div class="product">
                    <img>
                    <button>VIEW NOW</button>
                </div>
            </div> -->
            <div class="center-wrap">
                <h2 class="follow">FOLLOW ARVIN</h2>
                <div class="flex-wrap">
                    <div class="social-media-icons">
                        <a href="https://www.facebook.com/arvinlall" target="_blank;"><img class="icon-facebook" src="{{asset('images/ceo-facebook.png')}}"></a>
                        <a href="https://twitter.com/ArvinsWorld" target="_blank;"><img class="icon-twitter" src="{{asset('images/ceo-twitter.png')}}"></a>
                        <a href="https://instagram.com/arvinsworld/" target="_blank;"><img class="icon-insta" src="{{asset('images/ceo-insta.png')}}"></a>
                        <a href="https://twitter.com/ArvinsWorld" target="_blank;"><img class="icon-pin" src="{{asset('images/ceo-pin.png')}}">
                    </div>
                </div>
            </div>
        </div><!-- wrapper -->
    </main>

@stop