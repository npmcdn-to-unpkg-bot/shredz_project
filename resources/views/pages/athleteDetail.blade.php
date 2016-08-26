@extends('themes.default.layout')

@section('page-title')
{{ @$page['_page_title'] ?: $content['name']  }} |
@stop

@section('content')
<div class="athlete-detail">
    <div class="profile-photo">
        <h1>{{ $content['name'] }}</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2>Who is {{ $content['name'] }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>{{ $content['aboutleft'] }}</p>
            </div>
            <div class="col-sm-6">
                <p>{{ $content['aboutright'] }}</p>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12 text-center">
                <h2>{{ $content['name'] }}'s INSTAGRAM</h2>
                {{-- <div class="text-group left">
                        <p>{{ $content['instagramleft'] }}</p>
                    </div>
                <div class="text-group right">
                    <p>{{ $content['instagramright'] }}</p>
                </div> --}}
                @if(isset($content['instagram_handle']))
                    <p><a class="follow {{ $content['gender'] }} text-center" href="//instagram.com/{{ $content['instagram_handle'] }}" target="_blank;">FOLLOW {{ $content['name'] }} ON INSTAGRAM</a></p>
                @endif
            </div>
        </div>
        <div class="photos">
            <div class="container">
                <div class="row">
                    @foreach($content['workout_images'] as $img)
                        <div class="col-sm-3">
                            <img class="img-responsive" src="{{ $img }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-xs-1">
               <i class="fa fa-quote-left icon-style"></i>
            </div> -->
            <div class="col-xs-10 col-xs-push-1 quote-font-size custom-margin">
                <span class="{{ $content['gender'] }}"></span>{{ $content['quote'] }}<span class="{{ $content['gender'] }}"></span>
            </div>
            <!-- <div class="col-xs-1">
                <i class="fa fa-quote-right icon-style"></i>
            </div> -->
        </div>

        <h2 class="closing {{ $content['gender'] }}">{{ $content['name'] }}</h2>
    </div>
    <div class="wrapper no-overflow social">
        <div class="inside-section-margin embed-responsive embed-responsive-16by9">
        <iframe width="835" height="" src="{{ $content['video'] }}" frameborder="0" allowfullscreen></iframe>
        </div>

        {{-- <img class="follow" style="background-image: url('{{ $content['hero'] }}')"> --}}
{{--         <div class="desktop">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
            <img src="{{ $content['slide_show'][0] }}">
        </div> --}}
    </div><!-- social -->
    <div class="container section-margin">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>{{ $content['name'] }}'s FAVORITES</h2>
            </div>
        </div> <br />
        @foreach($content['recommended'] as $key => $recommended)
        <div class="row inside-section-margin favorites">
            <div class="col-sm-6">
                <img class="img-responsive product-image" src="{{ $recommended['image'] }}">
            </div>
            <div class="col-sm-6">
                <p>{{ $recommended['text'] }}</p>
                {{-- Proper link --}}
                <!-- <a href="{{ route('products', $recommended['product_id']) }}" class="{{ $content['gender'] }}">VIEW NOW</a> -->
                {{-- Button, just so you can see the old styling --}}
                <a href="{{ route('products', $recommended['product_id']) }}" class="inside-section-margin no-underline {{ $content['gender'] }}"><button class="center-block button-style {{ $content['gender'] }}">VIEW NOW</button></a>
            </div>
        </div>
        @endforeach

        <!-- @foreach($content['recommended'] as $key => $recommended)
            <div class="product @if(array_search($key,array_keys($content['recommended'])) % 2) right @endif">
                <img src="{{ $recommended['image'] }}">
                <div class="group">
                    <p>{{ $recommended['text'] }}</p>
                    {{-- Proper link --}}
                    <a href="{{ route('products', $recommended['product_id']) }}" class="{{ $content['gender'] }}">VIEW NOW</a>
                    {{-- Button, just so you can see the old styling --}}
                    <button class="{{ $content['gender'] }}">VIEW NOW</button>
                </div>
            </div>
            <div class="bhline"></div>
        @endforeach -->
    </div><!-- favorites -->
    <div class="container">
        <a href="{{$content['back-url']}}"><h2 style="color: #333;">MORE {{$content['subject']}}</h2></a>
        <br />
        <div class="row">
            <div class="col-sm-3"><a href="{{ $content['other-0'] }}"><img class="img-responsive" src="{{ $content['thumb-0'] }}"></a></div>
            <div class="col-sm-3"><a href="{{ $content['other-1'] }}"><img class="img-responsive" src="{{ $content['thumb-1'] }}"></a></div>
            <div class="col-sm-3"><a href="{{ $content['other-2'] }}"><img class="img-responsive" src="{{ $content['thumb-2'] }}"></a></div>
            <div class="col-sm-3"><a href="{{ $content['other-3'] }}"><img class="img-responsive" src="{{ $content['thumb-3'] }}"></a></div>
        </div>
    </div>
</div>
@stop

@section('styles')
<style>

    .athlete-detail .profile-photo {
        background-image: url('{{ $content['hero'] }}');
    }

</style>
@append
