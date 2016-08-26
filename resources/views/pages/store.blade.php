@extends('themes.default.layout')
@section('content')
    <style id="fstyle"></style>
    <div class="store">
       <!--  <div class="carousel-wrapper" style="display: none">
        </div> -->
        <div class="filter-bar clearfix">
            <div class="clearfix">
                <div class="gender-nav">
                    <h2 data-gender="" id="all_products_tab" class="nav-item">ALL PRODUCTS</h2><!--
                 --><h2 data-gender="female" id="female_products_tab" class="gender-female nav-item"><span class="hidden-xs hidden-sm">PRODUCTS</span> FOR WOMEN</h2><!--
                 --><h2 data-gender="male" id="male_products_tab" class="gender-male nav-item"><span class="hidden-xs hidden-sm">PRODUCTS</span> FOR MEN</h2>
                </div>
                <div class="select-buttons pull-right">
                    {{--
                    <div id="sort_by_options_store" class="select pull-left">
                        SORT BY<img src="{{ asset('images/down_arrow.png') }}">
                    </div>
                    <div id="filter_by_options_store" class="select pull-right">
                        FILTER BY<img src="{{ asset('images/down_arrow.png') }}">
                    </div>
                    --}}
                </div>
            </div>
        </div><!-- filter by -->

        <div class="full-width">
            <div class="product-filters" style="display:none">
                <div class="product-categories"></div>
            </div>
            <div class="container mobile-fluid">
                <div class="sort">
                <h2>Shop</h2>
                <p class="visible-xs sort-mobile">sort by<i class="fa fa-angle-down"></i></p>
                <ul class="list-inline sorting-list">
                    <li class="hidden-xs">sort by:</li>
                    <li><a class="show-all active">all</a></li>
                    <li><a class="low-to-high">low to high</a></li>
                    <li><a class="high-to-low">high to low</a></li>
                    <li><a class="featured">popular</a></li>
                </ul>
                </div>
            </div>
            <div id="product-grid" class="products container">
                <div class="spinner">
                    <img src="{{ asset('images/loading.gif') }}">
                </div>
            </div><!-- products -->
        </div>
    </div>
@stop

@section('styles')
<style>
    .slick-slide[aria-hidden="true"] {
        opacity: 0.4;
    }
    .slick-arrow.slick-next,
    .slick-arrow.slick-prev {
        background: transparent;
    }
    .slick-slide img {
        width: 100%;
        max-width: 100%;
    }
</style>
@append

@section('templates')
    {{--<script name="sliders" type="text/x-handlebars-template">
        <!--
        @{{#each sliders}}
        --><div class="slide">
            @{{#if product_slug }}
            <a href="{{ url('products') }}/ @{{~product_slug~}}">
                <img src="@{{ asset_location }}">
            </a>
            @{{else}}
            <img src="@{{ asset_location }}">
            @{{/if}}
        </div><!--
        @{{/each}}
        -->
    </script> --}}
    <script name="products" type="text/x-handlebars-template">
        <div class="row products-container">
            <!--@{{#each products}}
                --><div data-href="@{{#if (if-meal-plan id)}}/meal-plan@{{else}}/products/@{{ slug }}@{{/if}}"
                        data-id="@{{id}}"
                        class="item-product col-md-3 col-sm-6 col-xs-6 product-@{{ lcase gender }} @{{#in flags 'featured-sale'}} featured-sale @{{/in}}" 
                        data-price="@{{ base_variant.price }}"
                        data-featured="@{{#in flags 'featured-sale'}} featured-sale @{{/in}}"
                        data-msrp="@{{ base_variant.msrp }}"
                        data-categories="@{{join categories }}"
                        data-flags="@{{join flags }}"
                        data-gender="@{{ lcase gender }}"
                        data-sort-id="@{{ @index }}"
                    >
                    <a class="item_anchor" href="@{{#if (if-meal-plan id "519")}}/meal-plan?gender=female@{{else}} @{{#if (if-meal-plan id "520")}}/meal-plan?gender=male@{{else}}/products/@{{ slug }}@{{/if}}@{{/if}}">
                        @{{#in flags 'featured-sale'}}
                        @{{#if-gt base_variant.msrp base_variant.price }}
                            <div class="discount-container">
                                <i class="iconmoon icon-discount"></i>
                                <span class="discount">@{{ sale base_variant.price base_variant.msrp }}</span>
                            </div>
                        @{{/if-gt}}
                        @{{/in}}
                        <img class="img-responsive pri_store_image lazy" data-original="@{{ asset_location }}primaryimage_new.jpg">
                        <!-- Fallback for non javascript browser -->
                        <noscript>
                            <img src="@{{ asset_location }}primaryimage_new.jpg">
                        </noscript>
                    </a>

                    <div class="gender-@{{ lcase gender }}">
                        <h3>@{{ name }}</h3>
                        <h4>@{{ description }}</h4>
                    </div>
                    <p>
                        @{{#if-gt base_variant.msrp base_variant.price }}
                        <del class="msrp">$@{{ base_variant.msrp}}</del>
                        @{{/if-gt}}
                        <span class="base-price redeem @{{ lcase gender }}">$@{{ base_variant.price}}</span>
                    </p>
                </div><!--
            @{{/each}}-->
        </div>
    </script>
    <script name="categories" type="text/x-handlebars-template">
        @{{#each-sorted categories }}
            <h3 class="product-category" data-category="@{{ key }}">
                @{{ value }}
            </h3>
        @{{/each-sorted}}
    </script>
@append

@section('scripts')
    @include('includes.lib.animation')
    @include('includes.lib.templating')
    <script src="https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js"></script>
    @if(!App::environment('production'))
	<script type="text/javascript" src="{{asset('js/pages/store.js')}}"></script>
    @else
    <script type="text/javascript" src="{{asset('js/pages/store.min.js')}}"></script>
    @endif    
    <script type="text/javascript">
        $(function(){

        })
    </script>
@append