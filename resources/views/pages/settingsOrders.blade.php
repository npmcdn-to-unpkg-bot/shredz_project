@extends('themes.default.layout')

@section('content')

<main class="settings">
    <div class="bread">
        <div class="content">
            <p><a href="/">HOME</a> / <b>ACCOUNT</b></p>
        </div>
    </div>{{-- --}}
    <div class="content">
        @include('includes.settings-nav')
        <div class="order-history">
            <h2 class="desktop">YOUR ORDERS</h2>
            <div id="template" style="display: none;">
                <div class="order">
                    <div data-open="false" class="basic">
                        <div class="place-date">
                            <h3>ORDER PLACED</h3>
                            <p>December 1, 2015</p>
                        </div>
                        <div class="tid">
                            <h3>TRANSACTION ID</h3>
                            <p>asdfasdfasdfasdfasdf</p>
                            <span class="glyphicon glyphicon-menu-down hidden-xs" aria-hidden="true"></span>
                        </div>
                        <div class="total">
                            <h3>TOTAL</h3>
                            <p>$350.00</p>
                        </div>
                        <!-- <img src="{{asset('images/orders-carrot.png')}}"> -->
                    </div>
                    <div class="expanded container">
                        <div class="item">
                            <div class="left">
                                <img>
                                <p class="description">30 day quick weight loss plan + supplements for women</p>
                            </div>
                            <div class="right row">
                                <div class="labels col-xs-12">
                                    <p class="price col-xs-4">PRICE</p>
                                    <p class="quantity col-xs-4">QUANTITY</p>
                                    <p class="total col-xs-4">TOTAL</p>
                                </div>
                                <div class="number-holder col-xs-12">
                                    <p class="price col-xs-4">$175.00</p>
                                    <p class="quantity col-xs-4">1</p>
                                    <p class="total col-xs-4">$175.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="ghLine"></div>
                        <div class="item">
                            <div class="left no-labels">
                                <img>
                                <p class="description">30 day quick weight loss plan + supplements for women</p>
                            </div>
                            <div class="right no-labels row">
                                <div class="labels col-xs-12">
                                    <p class="col-xs-4 price">PRICE</p>
                                    <p class="col-xs-4 quantity">QUANTITY</p>
                                    <p class="col-xs-4 total">TOTAL</p>
                                </div>
                                <div class="number-holder col-xs-12">
                                    <p class="col-xs-4 price">$175.00</p>
                                    <p class="col-xs-4 quantity">1</p>
                                    <p class="col-xs-4 total">$175.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="item shipment">
                            <div class="tracking">
                                <h4 class="col-md-6 col-xs-12">Tracking Number</h4>
                                <a target='_blank' href='https://tools.usps.com/go/TrackConfirmAction?tLabels=' class="col-md-6 col-xs-12">14554168461651561</a>
                            </div>
                        </div>
                    </div><!-- expanded -->
                </div><!-- order -->
            </div><!-- template -->
        </div><!-- order history -->
    </div><!-- content -->
</main>
@stop

@section('scripts')
<script>

    /*blade variables*/
    var user_l = {!! $user !!};
    var loadingImg = "{{ asset('images/loading.gif') }}";

</script>
<script rel="script" type="text/javascript" src="{{asset('js/pages/settingsOrders.js')}}"></script>
@append