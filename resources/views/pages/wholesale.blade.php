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
                <form action="#" class="wholesale-form">
                    <div class="form-header">
                        <p>Please fill out the following form to become Wholesale/Distributor partner and we will reach out to you immediately.</p>
                    </div>
                    <div class="form-fields-box">
                        <div class="fieldset">
                            <strong class="title">Personal Informartion</strong>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="first-name">Full Name</label>
                                    <input id="first-name" type="text" value="Johnson">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="company-name">Company Name</label>
                                    <input id="company-name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="email">Email</label>
                                    <input id="email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="contact-phone">Contact Phone</label>
                                    <input id="contact-phone" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="fieldset">
                            <strong class="title">Address Informartion</strong>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="address-line1">Address Line 1</label>
                                    <input id="address-line1" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="address-line2">Address Line 2</label>
                                    <input id="address-line2" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="address-city">City</label>
                                    <input id="address-city" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="zip-code">Zip Code</label>
                                    <input id="zip-code" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="choose-state">Choose State</label>
                                    <div class="select-box">
                                        <select id="choose-state">
                                            <option value=""></option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="choose-country">Choose Country</label>
                                    <div class="select-box">
                                        <select id="choose-country">
                                            <option value=""></option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fieldset">
                            <strong class="title">Type Of Business</strong>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="choose-type-of-business">Choose Type of Business</label>
                                    <div class="select-box">
                                        <select id="choose-type-of-business">
                                            <option value=""></option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="label-title">How do you intend on selling our product lines?</span>
                                <ul class="checkboxes">
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox">
                                            In-store (Brick &amp; Mortar)
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox">
                                            Online
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox">
                                            Other
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-item text-center">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        Subscribe to the SHREDZ Newsletter
                                    </label>
                                </div>
                                <input type="submit" value="SUBMIT PARTNERSHIP INQUIRY">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/wholesale.js') }}"></script>
@stop