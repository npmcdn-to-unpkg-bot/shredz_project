@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') vip-preview @stop
@section('page-title')  @stop
@section('metas')
<meta name="category" content="{{ strtolower(trim(@$category)) }}">
@append
@section('content')
<div id="overlay" style="display:none;"> 
    <i class="fa fa-spinner fa-spin spin-big"></i>
</div>
@include('includes.fitclub-header')
<section id="sidenav-and-videos-wrapper">
    <div class="container video-container">
        <div class="row sidenav-wrapper">
            {{-- @include('includes._fitclub-sidemenu') --}}
            {{-- <h1 class="hidden-xs" id="workout-category"></h1> --}}
            <div class="col-xs-12 col-sm-12 right-column videopage" id="current-video-grid">
            </div>
        </div>
    </div>
</section>
@stop

@section('templates')
    <script name="videos" type="text/x-handlebars-template">
        <div class="row row-flex test">
            <div class="col-xs-12 col-sm-9">
                @{{headTitle video.title}}
                @{{headMeta video.content}}

                @if(!Auth::check())
                <div class="thumbnail-container">
                    <div class="image-overlay" data-toggle="modal" data-target="#login-modal">
                        <h2><i class="icon fa fa-lock" aria-hidden="true"></i>Log in or signup for free<br>to watch</h2>
                    </div>
                <img class="img-responsive lazy" data-original="@{{video.thumbnail}}">
                <noscript>
                    <img class="img-responsive" src="@{{video.thumbnail}}">
                </noscript>
                </div>
                @else
                <iframe src="https://player.vimeo.com/video/@{{video.assets.primary_video}}" width="840" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="float:left"></iframe>
                @endif
                <div class="intro">
                   <h2>@{{video.title}}</h2>
                    @{{#if video.category.primary_muscles}}
                    <p style="text-transform:capitalize;">Primary Muscle: <span style="display:inline; color: #cc0000;">@{{video.category.primary_muscles}}</span></p> 
                    @{{/if}}
                    @{{#if video.category.secondary_muscles}}
                    <p style="text-transform:capitalize;">Secondary Muscle: <span style="display: inline; color: #cc0000;">@{{video.category.secondary_muscles}}</span></p> 
                    @{{/if}}
                    <p>@{{{ video.content }}}</p>
                </div>
            </div>
            <div class="col-sm-3 related-videos hidden-xs">
                <h4>Related Videos</h4><hr style="margin: 10px 0;">
                <div class="row row-flex test">
                    @{{#each (limit (shuffle video.related_videos) 6)}}
                    <div class="col-sm-12 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
                        <div class="row">
                            <div class="col-sm-8 col-md-7 col-lg-6">
                                <div class="accessible">
                                    <a href="/fitclub/@{{slug}}">
                                        <div class="play-button">
                                            <i class="icon icon-play"></i>
                                        </div>
                                        <div class="image-overlay"></div>
                                        <img class="img-responsive lazy" data-original="@{{thumbnail}}">
                                        <noscript>
                                            <img class="img-responsive" src="@{{thumbnail}}">
                                        </noscript>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-5 col-lg-6 no-gutter">
                                <p class="title">@{{ title }}</p>
                               <p class="duration">@{{ time-helper duration}}</p>
                            </div>
                        </div>
                    </div>
                    @{{/each}}
                </div>
            </div>
            <div class="col-xs-12 related-videos visible-xs" style="margin-top: 15px;">
                <h1><span  class="line-center">Related Videos</span></h1>
                <div class="row row-flex test">
                    @{{#each (limit video.related_videos 6)}}
                    <div class="col-xs-6 col-sm-4 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
                        <div class="accessible">
                            <a href="/fitclub/@{{slug}}">
                                <div class="play-button">
                                    <i class="icon icon-play"></i>
                                </div>
                                <div class="image-overlay"></div>
                                <img class="img-responsive lazy" data-original="@{{thumbnail}}">
                                <noscript>
                                    <img class="img-responsive" src="@{{thumbnail}}">
                                </noscript>
                            </a>
                        </div>
                        <p class="title">@{{ title }}</p>
                        <ul class="list-inline tags">
                            @{{#each tags}}
                            @{{#if (if-eq-array (lcase this) "workouts,routines,legs,arms,back,shoulders,chest,core,full_body")}}
                            @{{else}}
                            <li>@{{ @this }}</li>
                            @{{/if}}
                            @{{/each}}
                        </ul>
                    </div>
                    @{{/each}}
                </div>
            </div>
        </div>
    </script>
@append


@section('scripts')
@include('includes.lib.templating')
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="{{ asset('js/pages/videoPage.js') }}"></script>
<script type="text/javascript">
var slug = {!! json_encode($slug) !!}
</script>
@append

