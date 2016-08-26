@extends('themes.default.layout')

@section('content')
    <main class="sub">
        <div id="hero_banner">
            <a href="/cart/?addSub=yes"><img id="the_banner" src="/images/non_member_in.jpg"/></a>
        </div>
        <div class="content">
            <div  class="grid_holder">
                <h1 class="section_headers">
                    WOMEN'S WORKOUT VIDEOS
                </h1>
                <p class="section_description">
                    Description of the workout video.
                </p>
                <div class="grid">
                    <div class="left_grid">
                        <img class="main_video" src="/images/femalepreview.jpg"/>
                    </div>
                    <div class="right_grid">
                        <div class="mini_video left_g">
                            <img src="/images/memberonlycontent.jpg"/>
                        </div>
                        <div class="mini_video right_g">
                            <img src="/images/memberonlycontent.jpg"/>
                        </div>
                        <div class="mini_video left_g">
                            <img src="/images/memberonlycontent.jpg"/>
                        </div>
                        <div class="mini_video right_g">
                            <img src="/images/memberonlycontent.jpg"/>
                        </div>
                    </div>
                </div>
            </div>
            <div id="frame2" class="grid_holder"></div>
        </div>

    </main>
@stop