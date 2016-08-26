@extends('themes.default.layout')

@section('content')
<main class="athlete-list">
<h1 class="large-font text-center">SHREDZ ATHLETES</h1>

<div class="container-athlete">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <!-- <div class="featured-athlete">
                    <h2 class="name text-center">{{ $content['females'][$content['featured-female']]['name'] }}</h2>
                    <img class="photo" src="{{ $content['females'][$content['featured-female']]['thumbnail'] }}">
                    <div class="info">
                        <p>{{ $content['females'][$content['featured-female']]['aboutleft'] }}</p>
                        <a href="{{$content['url-pre']}}/{{$content["featured-female"]}}"><button class="{{$content['females'][$content['featured-female']]['gender']}}">LEARN MORE</button></a>
                        <h2 class="favorites">{{ $content['females'][$content['featured-female']]['name'] }} FAVORITES</h2>
                        <div class="products">
                            @foreach($content['females'][$content['featured-female']]['recommended'] as $key => $recommended)
                            <a href="/products/{{ $recommended['product_id'] }}"><img class="@if(array_search($key,array_keys($content['females'][$content['featured-female']]['recommended'])) > 1) mobile-margin @endif" src="{{ $recommended['image'] }}"></a>
                            @endforeach
                        </div>
                    </div>
                    </div> -->
                    <div class="featured-athlete">
                        <h2 class="name text-center">{{ $content['females']['jessica-arevalo']['name'] }}</h2>
                        <h5 class="text-center"><span class="insta-class">@<a href="https://www.instagram.com/{{ $content['females']['jessica-arevalo']['instagram_handle'] }}" target="_blank;" class="insta-class">{{ $content['females']['jessica-arevalo']['instagram_handle'] }}</a></span> - <span class="country-class">{{ $content['females']['jessica-arevalo']['country'] }}</span></h4>

                        <img class="photo no-margin" src="{{ $content['females']['jessica-arevalo']['thumbnail']}}">
                        <div class="info">
                            <p>{{ $content['females']['jessica-arevalo']['aboutleft']}}</p>
                            <a href="{{$content['url-pre']}}/jessica-arevalo"><button class="female">LEARN MORE</button></a>

                            <h2 class="favorites">{{ $content['females']['jessica-arevalo']['name'] }} FAVORITES</h2>
                            <div class="products">
                                @foreach($content['females']['jessica-arevalo']['recommended'] as $key => $recommended)
                                <a href="/products/{{ $recommended['product_id'] }}"><img class="@if(array_search($key,array_keys($content['females']['jessica-arevalo']['recommended'])) > 1) mobile-margin @endif" src="{{ $recommended['image'] }}"></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- <div class="featured-athlete">
            <h2 class="name text-center">{{ $content['males'][$content['featured-male']]['name'] }}</h2>
        <div class="container">
            <div class="row col-xs-12">
                <img class="photo right" src="{{ $content['males'][$content['featured-male']]['thumbnail'] }}">
                <div class="info left">
                    <p>{{ $content['males'][$content['featured-male']]['aboutleft'] }}</p>
                    <a href="{{$content['url-pre']}}/{{$content["featured-male"]}}"><button class="{{$content['males'][$content['featured-male']]['gender']}}">LEARN MORE</button></a>
                    <h2 class="favorites">{{ $content['males'][$content['featured-male']]['name'] }} FAVORITES</h2>
                    <div class="products">
                        @foreach($content['males'][$content['featured-male']]['recommended'] as $key => $recommended)
                        <a href="/products/{{ $recommended['product_id'] }}"><img class="@if(array_search($key,array_keys($content['males'][$content['featured-male']]['recommended'])) > 1) mobile-margin @endif" src="{{ $recommended['image'] }}"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <div class="featured-athlete">
            <h2 class="name text-center">{{ $content['males']['joey-swoll']['name'] }}</h2>
            <h5 class="text-center"><span class="insta-class">@<a href="https://www.instagram.com/{{ $content['males']['joey-swoll']['instagram_handle'] }}" target="_blank;" class="insta-class">{{ $content['males']['joey-swoll']['instagram_handle'] }}</a></span> - <span class="country-class">{{ $content['males']['joey-swoll']['country'] }}</span></h4>

            <div class="container">
                <div class="row col-xs-12">
                    <img class="photo right no-margin" src="{{ $content['males']['joey-swoll']['thumbnail'] }}">
                    <div class="info left">
                        <p>{{ $content['males']['joey-swoll']['aboutleft'] }}</p>
                        <a href="{{$content['url-pre']}}/{{ $content['joey-swoll']}}"><button class="male">LEARN MORE</button></a>
                        <h2 class="favorites">{{ $content['males']['joey-swoll']['name'] }} FAVORITES</h2>
                        <div class="products">
                            @foreach($content['males']['joey-swoll']['recommended'] as $key => $recommended)
                            <a href="/products/{{ $recommended['product_id'] }}"><img class="@if(array_search($key,array_keys($content['males']['joey-swoll']['recommended'])) > 1) mobile-margin @endif" src="{{ $recommended['image'] }}"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="greyBackground all-athlete-container">
        <div class="container">
            <div class="row">
                <h2 class="sub-title">{{ $content['persons'] }}</h2>
                @foreach($content['athletes'] as $key => $val)
                <div class="col-xs-12 col-sm-4 text-center margin-bottom" style="min-height: 300px;">
                    <a href="{{$content['url-pre']}}/{{$key}}">
                        <img src="{{ $val['thumbnail'] }}" class="img-responsive no-margin">
                        <h4>{{ $val['name'] }}</h4>
                    </a>
                    <h5><span class="insta-class">@<a href="https://www.instagram.com/{{ @$val['instagram_handle'] }}" target="_blank;" class="insta-class">{{ @$val['instagram_handle'] }}</a></span> - <span class="country-class">{{ @$val['country'] }}</span></h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@stop
