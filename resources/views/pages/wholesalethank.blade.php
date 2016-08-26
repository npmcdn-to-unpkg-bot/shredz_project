@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') vip-wholesale @stop
@section('page-title')  @stop
@section('metas')
<meta name="category" content="{{ strtolower(trim(@$category)) }}">
@append

@section('content')
    <div class="container">
        <div class="two-wholesale-cols">
            <article class="article">
                <img src="{{ asset('images/main-wholesale-img01.png') }}" alt="main-wholesale-img01" class="img-responsive">
                <h2>SHREDZ<br> WHOLESALE</h2>
                <p><strong>SHREDZ® Supplements</strong> is the culmination of innovative formulas & proven results working together with trusted suppliers and manufacturers to create a maximum strength product line for consumers across the world.</p>
                <ul class="panel-list">
                    <li>
                        <strong class="maintitle">NATIONALLY ENFORCED MAP PRICING</strong>
                        <p>Customers will never find our products for a cheaper price from any brick & mortar retailer location or any online website including our own corporate sites!</p>
                    </li>
                    <li>
                        <strong class="maintitle">HIGHEST PROFIT MARGINS</strong>
                        <p>Guaranteed to receive 30-60% margins across the entire line.</p>
                    </li>
                    <li>
                        <strong class="maintitle">DEAL DIRECT WITHOUT MIDDLEMEN</strong>
                        <p>You’ll get the best pricing and best customer service because you’ll never have to deal with a distributor. We pride ourselves on developing personal relationships with every brick & mortar store across the country!</p>
                    </li>
                    <li>
                        <strong class="maintitle">THE PRODUCTS JUST WORK</strong>
                        <p>With millions of followers across every social media platform and customers across the world the response has been consistent. Our clinically proven ingredients and innovative stacks provide customers the results that they want.</p>
                    </li>
                </ul>
                <p><strong>Our award-winning Wholesale department is ready to partner with both domestic and international partners for wholesale and/or distribution opportunities.</strong></p>
                <p>Visit our <a href="#">Success Storiees Page</a> and see some of the amazing transformations that our products have helped people achieve.</p>
            </article>
            <div class="form-main-holder">
                <div class="wholesale-form">
                    <div class="form-header">
                        <p>THANK YOU!</p>
                    </div>
                    <div class="message-box">
                        <p class="bold">Thank you for submitting your Wholesale inquiry. We’ve worked very hard to develop one of the best product lines in the world and we cannot wait to get it into the hands of your customers.</p>
                        <p>A member of our Wholesale department will be in touch immediately; however, if you’re eager to place a Purchase Order immediately - you can call +1 (732) 215 - 8319 to speak to Ahmead Desoukey, our Global Wholesale Coordinator or shoot him an email at wholesale@shredz.com and we’ll do our best to process your order immediately!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/wholesale.js') }}"></script>
@stop