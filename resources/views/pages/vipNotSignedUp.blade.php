@extends('themes.default.layout')
@section('root-class') vip-area @stop

@section('content')
    <section id="banner">
        <div class="container-fluid cover-image">
            <div class="row">
                <div class="hidden-xs col-sm-4 female text-right">
                    <img src="{{ asset('images/fitclub/female.png') }}">
                </div>
                <div class="col-xs-12 col-sm-4 logo">
                    <div>
                        <img class="img-responsive" src="{{ asset('images/fitclub/fitclub-logo.png') }}">
                        <button class="btn large-button center-block">Enter the fitclub</button>
                    </div>
                </div>
                <div class="hidden-xs col-sm-4 male text-left">
                    <img src="{{ asset('images/fitclub/male.png') }}">
                </div>
            </div>
        </div>
        <div class="container-fluid icon-text">
            <div class="row">
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
            <div class="row world">
                <div class="text">
                    <h1>Workout anywhere</h1>
                    <h4>unlimited access 24/7</h4>
                </div>
                <img class="img-responsive" src="{{ asset('images/fitclub/world.jpg') }}">
            </div>
        </div>
        <div class="container fitness-for-everyone">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">
                    <img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/home/fitclub-devices.png">
                    <h1>fitness for everyone</h1>
                    <p>You are on step away from gaining to the high impact video training series everyone is raving about. SHREDZ FIT CLUB training program is an ever expanding video workout series where teaches you, step by step, how to get the ripped Physique you always wanted. And the best side is, <strong>its FREE</strong> </p>
                    <button class="btn large-button center-block">sign up now</button>
                </div>
            </div>
        </div>
    </section>

    <section id="preview-videos">
        <div class="container section-margin">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 text-center">
                    <h1 class="text-center">PREVIEW VIDEOS</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since, our team is innovating and building
                    </p>
                </div>
                <div class="col-xs-12">
                    <div class="row text-center row-flex">
                        <div class="col-sm-4 col-xs-6 col-flex padding-right">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/legs.png') }}">
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
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/shoulders.jpg') }}">
                                </a>
                            </div>
                            <h2 class="color-light-black">SHOULDERS</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-right">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/chest.jpg') }}">
                                </a>
                            </div>
                            <h2 class="color-light-black">CHEST</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-left">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/core.jpg') }}">
                                </a>
                            </div>
                            <h2 class="color-light-black">CORE</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-right">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/back.jpg') }}">
                                </a>
                            </div>
                            <h2 class="color-light-black">BACK</h2>
                        </div>
                        <div class="col-sm-4 col-xs-6 col-flex padding-left">
                            <div class="accessible">
                                <a href="https://player.vimeo.com/video/154758798?ts=1457966767" class="video-popup">
                                    <div class="play-button">
                                        <img class="img-responsive" src="{{ asset('images/subscription/play-button.png') }}">
                                    </div>
                                    <img class="img-responsive lazy" src="{{ asset('images/subscription/home-thumbs/back.jpg') }}">
                                </a>
                            </div>
                            <h2 class="color-light-black">ARMS</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <a href="#" data-toggle="modal" data-target="#signup-modal">
                        <button type="button" class="btn large-button center-block">SIGN UP NOW</button>
                    </a>
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
                            <a href="#" data-toggle="modal" data-target="#signup-modal">
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
                    <a href="#" data-toggle="modal" data-target="#signup-modal">
                        <button id="button-bottom" type="button" class="signup-button big-button center-block">SIGN UP NOW AND HAVE FULL ACCESS</button>
                    </a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- SIGN UP MODAL -->
    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="row">
                        <button type="button" class="close button-close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">SIGN UP TO WATCH</h3>
                    </div>
                </div>
                <!-- Modal Body -->
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
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn signup-post center-block">SIGN ME UP</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/pages/vipArea.js') }}"></script>
@append
