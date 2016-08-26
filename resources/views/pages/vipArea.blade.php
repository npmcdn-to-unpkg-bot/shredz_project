@extends('themes.default.layout')

@section('content')

    <div id="vip-preview-modal" class="vip-preview-modal modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>FREE PREVIEW OF VIP MEMBERSHIP CONTENT</h2>
                    <iframe width="" height="" src="https://www.youtube-nocookie.com/embed/oxxgoz1ge7g" frameborder="0" allowfullscreen=""></iframe>
                    <img src="/images/notifymem.png">
                    <button>SIGN UP NOW</button>
                </div>
            </div>
        </div>
    </div><!-- vip preview modal -->

    <div id="vip-video-modal" class="vip-video-modal modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="title"></h2>
                    <div class="vid-cont" id="vid-cont"></div>
                </div>
            </div>
        </div>
    </div> <!-- vip video player -->

    <main class="vip-preview">
        <div class="welcome">
            <h2>WELCOME TO THE <img src="{{ asset('images/SHREDZLogo_GREY_EXACT.png') }}"> FIT CLUB</h2>
        </div>
        <div class="wrapper-vgrid">
            <div class="vid-nav">
                <p>Video Categories</p>
                <a data-filter="back" class="active">Back</a>
                <a data-filter="arms">Arms</a>
                <a data-filter="chest">Chest</a>
                <a data-filter="core">Core</a>
                <a data-filter="shoulders">Shoulders</a>
                <a data-filter="legs">Legs</a>

                <p>Tips & Tricks Ebooks</p>
                <a>Nutrition 101</a>
                <a>Home Workouts</a>
                <a>Gym Workouts</a>
            </div>
            <div class="videos container">
                <h2>BACK WORKOUTS</h2>
                <div class="row">
                    <!-- row 1 -->
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img id="test">
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <!-- row 2 -->
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <!-- row 3 -->
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                    <div class="video-container col-xs-12 col-sm-6 col-md-4">
                        <div class="preview">
                            <img>
                            <p>PREVIEW VIDEO</p>
                        </div>
                    </div>
                </div>
            </div><!-- videos -->
        </div><!-- wrapper for video grid -->

        @if($user['subscribed'])
            <div class="vip-area">
                <div class="logged-in-deal">
                    <h2>[name], HERE IS A SPECIAL DEAL FOR YOU</h2>
                    <div class="products container">
                        <div class="row">
                            <div class="product col-xs-12 col-sm-6 col-md-3">
                                <img>
                            </div>
                            <div class="product col-xs-12 col-sm-6 col-md-3">
                                <img>
                            </div>
                            <div class="product col-xs-12 col-sm-6 col-md-3">
                                <img>
                            </div>
                            <div class="product col-xs-12 col-sm-6 col-md-3">
                                <img>
                            </div>
                        </div>
                    </div>
                </div><!-- logged in special -->
            </div><!-- vip area -->
        @else
            <div class="vip-signup">
                <div class="lightGreyBackground">
                    <div class="sub-options container">
                        <h2>SUBSCRIPTION OPTIONS</h2>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="cont">
                                    <p class="deal">$9<span>.99/MO</span></p>
                                    <p>MONTHLY</p>
                                    <button href="/cart?addSub=yes">GET STARTED</button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="cont">
                                    <p class="deal">$9<span>/MO</span></p>
                                    <p>3 MONTHS</p>
                                    <button href="/cart?addSub=yes">GET STARTED</button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="cont">
                                    <p class="deal">$8<span>.25/MO</span></p>
                                    <p>12 MONTHS</p>
                                    <button href="/cart?addSub=yes">GET STARTED</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- sub options -->
                </div>
            </div><!-- vip-signup -->
        @endif

    </main>
@stop

@section('scripts')
    <script>

        //blade variables
        var videosDir = "{{ asset('videos/vip') }}";
        var gender = "{{ $user['gender'] }}";

        $(".sub-options button").on("click", function(){
            window.location.href = $(this).attr("href");
        });

    </script>
    @if($user['subscribed'])
        <script type="text/javascript" src="{{asset('js/pages/vipArea.js')}}"></script>
    @else
        <script type="text/javascript" src="{{ asset('js/pages/vipPreview.js') }}"></script>
    @endif
@append