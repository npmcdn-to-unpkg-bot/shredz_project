@extends('themes.default.layout')

@section('banner')
    <section class="banner" id="nonmember_vip_banner">
        <div class="max-width-match">
            <div class="text-block">
                <p>JOIN TODAY <span class="pink bold">EXCLUSIVE</span> MEMBER ONLY CONTENT</p>
                <button>SIGN UP FOR $4.99 MONTH</button>
            </div>
        </div>
    </section>
@stop

@section('content')
    <main class="vip">
        <div class="video-content-container">
            <h2>WORKOUT VIDEOS</h2>
            <p><span class="bold">Default paragraph</span> Bacon ipsum dolor amet kevin porchetta pancetta shank swine filet mignon pastrami bresaola venison chicken salami rump spare ribs flank. Ball tip short loin chicken pastrami spare ribs leberkas, chuck pork chop sirloin cow t-bone rump ham. Chicken ham venison shankle jerky corned beef strip steak pork. Fatback jowl flank capicola tenderloin.</p>
            <div class="hide-overflow">
                <section class="video-content " id="workout_videos">
                    <div class="video-highlight girl_lifting_bg_img">
                        <p><span class="play-btn"><i class="fa fa-play-circle-o"></i></span> FREE PREVIEW</p>
                        <div class="overlay_this"></div>
                    </div>
                    <div class="grid four-four">
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                    </div>
                    <div class="grid four-four">
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                    </div>
                    <div class="grid four-four">
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content girl_lifting_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                    </div>
                </section>
            </div>

            <img class="arrow" src="{{asset('images/arrow.png')}}" id="move_workout_videos"/>
        </div>
        <div class="video-content-container ">
            <h2>RECIPES</h2>
            <p><span class="bold">Default paragraph</span> Bacon ipsum dolor amet kevin porchetta pancetta shank swine filet mignon pastrami bresaola venison chicken salami rump spare ribs flank. Ball tip short loin chicken pastrami spare ribs leberkas, chuck pork chop sirloin cow t-bone rump ham. Chicken ham venison shankle jerky corned beef strip steak pork. Fatback jowl flank capicola tenderloin.</p>
            <div class="hide-overflow">
                <section  class="video-content" id="recipes">
                    <div class="video-highlight peaches_protein_bg_img">
                        <p><span class="play-btn"><i class="fa fa-play-circle-o"></i></span> FREE PREVIEW</p>
                        <div class="overlay_this"></div>
                    </div>
                    <div class="grid four-four">
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                    </div>
                    <div class="grid four-four">
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                        <div class="single-block member-only-content peaches_protein_bg_img">
                            <p>MEMBER ONLY CONTENT</p>
                            <div class="overlay_this"></div>
                        </div>
                    </div>
                </section>
                <img class="arrow" src="{{asset('images/arrow.png')}}"  id="move_recipes"/>
            </div>
        </div>
    </main>
@stop