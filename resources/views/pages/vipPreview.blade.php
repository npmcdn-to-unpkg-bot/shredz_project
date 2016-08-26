@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') vip-preview @stop
@section('metas')
<meta name="category" content="{{ strtolower(trim(@$category)) }}">
@append
@section('content')
<div id="overlay" style="display:none;"> 
    <i class="fa fa-spinner fa-spin spin-big"></i>
</div>
@include('includes.fitclub-header')
<section id="sidenav-and-videos-wrapper">
    <div class="container">
        <div class="row sidenav-wrapper">
            @include('includes._fitclub-sidemenu')
            <h1 class="hidden-xs">Welcome to fit club</h1>
            <div class="col-xs-12 col-sm-9 right-column pull-right" id="videos-grid">
            </div>
        </div>
    </div>
</section>
@stop
@section('templates')
<script name="videos" type="text/x-handlebars-template">
<div class="row row-flex test">
    <!--@{{#each response}}
    --><div class="col-xs-6 col-sm-4 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
        <div class="accessible">
            <a href="/fitclub/@{{ slug }}">
                <div class="play-button">
                    <i class="icon icon-play"></i>
                </div>
                <div class="image-overlay"></div>
                <img class="img-responsive lazy" data-original="@{{thumbnail}}">
                <noscript>
                    <img class="img-responsive" src="@{{thumbnail}}">
                </noscript>
                <p class="duration">@{{ time-helper duration}}</p>
            </a>
        </div>
        <p class="title two-line-ellipsis">@{{ title }}</p>
        <p class="desc two-line-ellipsis hidden-xs">@{{{ content }}}</p>
        <ul class="list-inline tags">
            @{{#each tags}}
                @{{#if (if-eq-array (lcase this) "workouts,routines,legs,arms,back,shoulders,chest,core")}}
                @{{else}}
                <li>@{{ @this }}</li>
                @{{/if}}
            @{{/each}}
        </ul>
    </div><!--
    @{{/each}}-->
</div>
</script>
@append
@section('scripts')
@include('includes.lib.templating')
<script type="text/javascript" src="{{ asset('js/pages/vipPreview.js') }}"></script>
@append
@section('dev-scripts')
<script>


// console.log('Videos:', videos);
</script>
@append