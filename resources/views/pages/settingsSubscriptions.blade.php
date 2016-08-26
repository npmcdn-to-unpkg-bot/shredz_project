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
        <div class="subscriptions">
            <h2 class="desktop">MANAGE SUBSCRIPTIONS</h2>
            <div class="alert alert-success" style="display: none;">
                <strong>Success! </strong>
                <span>Success message.</span>
            </div>
            <img src="{{ asset('images/small-loading.gif') }}" class="loading-img">
            <div id="template" style="display: none;">
                <div class="subscription">
                    <div data-open="false" class="basic">
                        <div class="product">
                            <h3>PRODUCT</h3>
                            <p>asdfasdfasdfasdfasdf</p>
                        </div>
                        <div class="next-billing-date">
                            <h3>NEXT BILLING</h3>
                            <p>December 1, 2015</p>
                            <span class="glyphicon glyphicon-menu-down hidden-xs" aria-hidden="true"></span>
                        </div>
                        <div class="total">
                            <h3>TOTAL</h3>
                            <p>$350.00</p>
                        </div>
                        <!-- <img src="{{asset('images/orders-carrot.png')}}"> -->
                        <!-- <i class="fa fa-caret-down icon-position"></i> -->
                        <div class="glyphicon glyphicon-menu-down visible-xs" aria-hidden="true"></div>
                        <div class="subscription-details">
<!--                             <div>
                                <div class="address-to">
                                </div>
                            </div> -->
                             <div>
                                <div class="detail-box">
                                    <b>Deliver to:</b>
                                    <div><img src="{{ asset('images/small-loading.gif') }}"></div>
                                    <div></div>
                                    <input type="hidden" name="current_address_uid" class="current_address_uid" />
                                </div>
                                <button class="subscription-action changeAddress" data-toggle="modal" data-target="#myModal">Change address</button>
                            </div>
                            <div>
                                <div class="detail-box">
                                    <b>Payment method:</b>
                                    <div><img src="{{ asset('images/small-loading.gif') }}"></div>
                                    <div></div>
                                    <input type="hidden" name="current_payment_uid" class="current_payment_uid" />
                                </div>
                                <button class="subscription-action changePayment" data-toggle="modal" data-target="#myModal">Change payment method</button>

                            </div>
                            <div>
                                <div class="detail-box">
                                    <b>Status:</b>
                                    <div><img src="{{ asset('images/small-loading.gif') }}"></div>
                                </div>
                                <button class="subscription-action cancel"  data-toggle="modal" data-target="#myModal">Cancel Subscription</button>
                            </div>
                        </div>
                        <input type="hidden" name="subscription-index" class="subscription-index"/>
                    </div> 
                </div><!-- subscription -->
            </div><!-- template -->
        </div><!-- subscriptions -->

    </div><!-- content -->
</main>

<!-- Cancel Modal -->
<div id="baseModal" class="modal fade cancelModal" role="dialog">
    <div class="modal-dialog modal-cancel-subscription">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title name">CANCEL SUBSCRIPTION</h4>
                <p class="instagram"></p>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-xs-12">
                        <h3>Are you sure to cancel this subscription?</h3>
                        <div class="modal-product">
                            <p><b>Order Date:</b></p>
                            <p class="cancel-product-date">2016-03-07</p>
                            <p><b>PRODUCT:</b></p>
                            <p class="cancel-product-name">SHREDZ Burner For Women</p>
                        </div>
                    </div>
                </div>
                <div class="row review-holder">
                    <div class="btn-group confirm-btn-group">
                        <button class="btn btn-success confirm-cancellation">
                            <span class="glyphicon glyphicon-ok"></span> Yes
                        </button>
                        <button class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                    </div>
                    <div class="reason-group">
                        Could you please write us a reason? (Optional)
                        <textarea class="form-control reason-textarea" rows="3"></textarea>
                        <span class="validate-reason-msg" style="color:red;"></span>
                        <button class="btn btn-info send-cancellation">
                            Confirm cancellation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Payment Modal -->
<div id="baseModal" class="modal fade changeModal" role="dialog">
    <div class="modal-dialog modal-change-content">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title name">CHANGE PAYMENT METHOD</h4>
                <p class="instagram"></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 subscription_description">
                        <h3>Choose your new payment method to this subscription:</h3>
                        <div class="modal-product">
                            <p><b>Order Date:</b></p>
                            <p class="cancel-product-date">2016-03-07</p>
                            <p><b>PRODUCT:</b></p>
                            <p class="cancel-product-name">SHREDZ Burner For Women</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 change-detail-list">
                        <img src="{{ asset('images/small-loading.gif') }}" class="loading-img">
                        <label class="change-detail-box">
                            <div>Credit Card - Mastercard</div>
                            <div>xxxx xxxx xxxx 3573</div>
                            <input type="radio" name="update_uid" value="" />
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 manage-this">
                        <p>Can't find? <a href="/settings/addresses">Manage your addresses.</a></p>
                    </div>
                </div>
                <div class="row review-holder">
                    <div class="btn-group confirm-btn-group">
                        <button class="btn btn-success confirm-change">
                            <span class="glyphicon glyphicon-ok"></span> Confirm change
                        </button>
                        <button class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
</style>
@stop

@section('scripts')
<script>

    /*blade variables*/
    var user_l = {!! $user !!};

</script>
<script rel="script" type="text/javascript" src="{{asset('js/pages/settingsSubs.js')}}"></script>
@append