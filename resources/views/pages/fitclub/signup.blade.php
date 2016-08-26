@extends('themes.default.layout')
@section('root-class') vip-signup @stop

@section('content')
    <section id="banner">
        <div class="container-fluid">
            <div class="row">
                <a href="#" class="hidden-xs" data-toggle="modal" data-target="#login-modal"><img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/fitclub/fit-club-banner.jpg" class="img-responsive"></a>
                 <a href="#" class="visible-xs" data-toggle="modal" data-target="#login-modal"><img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/fitclub/fit-club-banner-mobile.jpg" class="img-responsive"></a>
                {{-- <div class="hidden-xs col-sm-4 female text-right">
                    <img src="{{ asset('images/fitclub/female.png') }}">
                </div>
                <div class="col-xs-12 col-sm-4 logo">
                    <div>
                        <img class="img-responsive" src="{{ asset('images/fitclub/fitclub-logo.png') }}">
                        <button class="btn large-button center-block open-sign-up" data-toggle="modal" data-target="#login-modal">Sign Up Now</button>
                        <a class="already-user open-sign-in" data-toggle="modal" data-target="#login-modal">Already user? Login.</a>
                    </div>
                </div>
                <div class="hidden-xs col-sm-4 male text-left">
                    <img src="{{ asset('images/fitclub/male.png') }}">
                </div> --}}
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row world">
                <div class="text">
                    <h1>Workout anywhere</h1>
                    <h4>unlimited access 24/7</h4>
                </div>
                <img class="img-responsive" src="{{ asset('images/fitclub/world.jpg') }}">
            </div>
            <div class="row icon-text">
                <div class="col-xs-12 no-gutter">
                    <ul class="list-inline">
                        <li>
                            <i class="icon icon-tips"></i>
                            <p>Tips <span class="hidden-xs"> &amp; Tricks</span></p>
                            <p>Learn from <span class="hidden-xs">the</span> Athlete</p>
                        </li>
                        <li>
                            <i class="icon icon-play"></i>
                            <p>50+ <span class="hidden-xs">Exercise</span> Videos</p>
                            <p><span class="hidden-xs">From</span> Beginner to Expert</p>
                        </li>
                        <li>
                            <i class="icon icon-free"></i>
                            <p>No Commitments</p>
                            <p>100% free <span class="hidden-xs">of charge</span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container fitness-for-everyone">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/fitclub-devices.png">
                    <h1>fitness for everyone</h1>
                    <p>You are <strong>one</strong> step away from gaining access to the high-impact video training series everyone is raving about. The SHREDZ FIT CLUB training program is an ever-expanding video workout series that teaches you, step by step, how to get the ripped physique you’ve always wanted. And the best part is: it’s FREE
                    <button class="btn large-button center-block open-sign-up" data-toggle="modal" data-target="#login-modal">sign up now</button>
                    <a class="already-user open-sign-in" data-toggle="modal" data-target="#login-modal">Already user? Login.</a>
                </div>
            </div>
        </div>
    </section>

    <section id="preview-videos">
        <div class="container section-margin">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 text-center">
                    <h1 class="text-center">PREVIEW VIDEOS</h1><br>
                    <p>Discover a new way to learn the proper form and techniques. Detailed Step by Step Instructions, Assisted Visuals, Easy to Follow.</p>
                </div>
                <div class="col-xs-12">
                    <div class="row text-center row-flex">
                        <div class="col-sm-4 col-xs-6 col-flex padding-right legs">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/172109149" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Legs.jpg ">
                                </a>
                            </div>
                            <h2 class="color-light-black">LEGS</h2>
                            {{--<a href="{{ url('vip-preview') }}?category=legs">
                                <img class="img-responsive" src="{{ asset('images/subscription/home-thumbs/legs.png') }}">
                                <h2 class="color-light-black">LEGS</h2>
                            </a> --}}
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-left">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/171926298" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Shoulders.jpg">
                                </a>
                            </div>
                            <h2 class="color-light-black">SHOULDERS</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-right">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/172441285" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Chest.jpg">
                                </a>
                            </div>
                            <h2 class="color-light-black">CHEST</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-left">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/172108033" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Core.jpg">
                                </a>
                            </div>
                            <h2 class="color-light-black">CORE</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-right">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/172101727" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Back.jpg">
                                </a>
                            </div>
                            <h2 class="color-light-black">BACK</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-left">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/171929902" class="video-popup">
                                    <div class="play-button">
                                        <i class="icon icon-play"></i>
                                    </div>
                                    <img class="img-responsive lazy" src="https://dash-assets.s3.amazonaws.com/assets/Arms.jpg">
                                </a>
                            </div>
                            <h2 class="color-light-black">ARMS</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
             <div class="col-xs-12 text-center">
                    <a href="{{ route('fitclub') }}"><button type="button" class="btn large-button center-block" style="color: #cc0000; background: white; border: 1px solid #cc0000;">View Library</button></a>
                    <a class="already-user open-sign-in" data-toggle="modal" data-target="#login-modal">Already user? Login.</a>
            </div>
            </div>
        </div>
    </section>
    <!-- <section id="verified-result" class="section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>VERIFIED RESULTS</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="row">
                        <div class="col-sm-5">
                             <img src="/images/dummy_review_page.jpg" class="img-thumbnail">
                        </div>
                        <div class="col-sm-7 text-left">
                            <h2 class="text-center-mobile"><sup><i class="fa fa-quote-left quote-icon-style"></i></sup><span class="text-inside-quote">&nbsp;TOOK MY WORKOUT TO THE NEXT LEVEL! &nbsp;</span><sub><i class="quote-icon-style fa fa-quote-right"></i></sub></h2>
                            <p class="paragraph-text">Before Daily Burn, Amanda constanicontly made excuses because of her weight. In just three months, she lost 26 ounds and gained more confidence!</p>
                            <a href="#" data-toggle="modal" data-target="#login-modal">
                                <button type="button" class="inside-section-margin signup-button center-block">SIGN UP NOW!</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- <section id="preview-tips">
        <div class="container section-margin">
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
                    <h1 class="text-center">PREVIEW TIPS &AMP; TRICKS</h1>
                    <br />
                    <p class="paragraph-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since, our team is innovating and building
                    </p>
                </div>
                <div class="col-xs-12">
                    <div class="row text-center">
                        <div class="col-sm-4 col-xs-6">
                            <iframe class="img-thumbnail" style="height: 120px; width: 350px;" src="" frameborder="0" allowfullscreen></iframe>
                            <h2>NUTRITION 101</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <iframe class="img-thumbnail" style="height: 120px; width: 350px;" frameborder="0" allowfullscreen></iframe>
                            <h2>HOME WORKOUT</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <iframe class="img-thumbnail" style="height: 120px; width: 350px;" src="" frameborder="0" allowfullscreen></iframe>
                            <h2>GYM WORKOUT</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <iframe class="img-thumbnail" style="height: 120px; width: 350px;" src="" frameborder="0" allowfullscreen></iframe>
                            <h2>GYM WORKOUT 1</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 inside-section-margin">
                    <a href="#" data-toggle="modal" data-target="#login-modal">
                        <button id="button-bottom" type="button" class="signup-button big-button center-block">SIGN UP NOW AND HAVE FULL ACCESS</button>
                    </a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- SIGN UP MODAL -->
    <!-- <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <button type="button" class="close button-close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">SIGN UP FOR FITCLUB</h3>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success success-message-create" role="alert"  style="display: none;"></div>
                    <div class="alert alert-danger error-message" role="alert" style="display: none"></div>
                    <form role="form">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <p id="first_name" style="display:none;"></p>
                            <input type="text" class="form-control" id="first-name" placeholder="First Name"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <p id="last_name" style="display:none;"></p>
                            <input type="text" class="form-control" id="last-name" placeholder="Last Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <p id="email_address" style="display:none;"></p>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <p id="label_password" style="display:none;"></p>
                            <input type="password" class="form-control" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <p id="confirm_password" style="display:none;"></p>
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn signup-post center-block">SIGN ME UP</button>
                </div>
            </div>
        </div>
    </div> -->

   {{--  <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <button type="button" class="close button-close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">SIGN UP FOR FITCLUB</h3>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <div class="fitclub-logo-holder">
                                <img src="{{ asset('images/fitclub/fitclub-logo.png') }}">
                            </div>
                            <h4 class="enter-email">Be the first to find out when SHREDZ Fit Club goes live!</span></h4>
                            <ul class="benefits">
                                <li><i class="fa fa-check"></i>Join the club. Get fit together</li>
                                <li><i class="fa fa-check"></i>Instructional training videos</li>
                                <li><i class="fa fa-check"></i>Tips from exercise physiologists</li>
                                <li><i class="fa fa-check"></i>Advice from Registered Dietitians</li>
                                <li><i class="fa fa-check"></i>members-only discounts and rewards</li>
                            </ul>
                            <div class="alert-success email-sub-success" style="display:none;">
                                Success! You have been subscribed!
                            </div>
                            <div class="alert-danger email-sub-error" style="display:none;">
                                Error in form submission. Please try again.
                            </div>
                            <div class="spinner spinner-footer" style="display: none;">
                                <img src="{{ asset('images/loading.gif') }}">
                            </div>
                            <form role="form" id="fitclub-signup-form" action="/subscription_email" method="post">
                                {{ csrf_field() }}
                                <input style="display: none" class="fitclub-identifier" value="fitclub"></input>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="fitclub-email-sub" placeholder="Enter Email Here">
                                </div>
                                <button type="submit" class="btn large-button center-block" id="submit-button">notify me</button>
                            </form>
                            <ul class="list-inline">
                                <li>no costs &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></li>
                                <li>no fees &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></li>
                            </ul>
                            <!-- <h4 class="invitation">invitation only</h4> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/pages/fitclub/fitclub.js') }}"></script>
@append
