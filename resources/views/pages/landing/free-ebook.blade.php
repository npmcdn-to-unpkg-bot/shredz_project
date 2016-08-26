@extends('themes.default.layout')
@section('root-class') free-ebook @stop
@section('content')
<div class="wrapper">
	<section id="slider-container">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 mac-holder">
					<div class="fc-ipad"></div>
				</div>
				<div class="col-xs-12 col-sm-6 form-container">
					<div class="">
						<i class="icon-arrow"></i>
						<h2>Get Fit Today</h2>
						<p class="pink">Slimmer Waist, Leaner Legs, Sexier Body</p>
						<p>With our <strong>FREE</strong> 7 Day Head Start E-Book &amp; our weekly Newsletter, consider it done.</p>
						
						<div class="alert-success email-sub-success" style="display:none;">
							Success! You have been subscribed!
						</div>
						<div class="alert-danger email-sub-error" style="display:none;">
							Error in form submission. Please try again.
						</div>
						<div class="spinner spinner-main" style="display: none;">
							<img src="{{ asset('images/loading.gif') }}">
						</div>
						<div class="row">
							<form class="form-inline subscribe-form" action="/subscription_email" id="7day-subscription" method="post" role="form">
								{{ csrf_field() }}
								<input style="display: none" class="7day-dentifier" value="7day"></input>
								<div class="form-group">
									<input type="email" class="form-control 7day-email-sub" placeholder="Email Address">
									<button type="submit" class="btn button">Subscribe</button>
								</div>
							</form> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="ebook-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 ebook-feature">
					<h2>E-Book Features</h2>
					<div class="icon-text">
						<div class="row">
							<div class="col-xs-12">
								<ul class="list-inline">
									<li class="icon">
										<i class="icon-calendar"></i>
									</li>
									<li class="text">
										<h3>Daily Workout Outline</h3>
										<p>Monday thru Sunday! </p>
										<p>Workout directions and duration to effective results.</p>
									</li>
								</ul>
								<ul class="list-inline">
									<li class="icon">
										<i class="icon-chef"></i>
									</li>
									<li class="text">
										<h3>Daily Meal Outline</h3>
										<p>What to eat and when to eat it!</p>
										<p>Recipes along with a full meal plan to keep you on track.</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 seven-day-head-start">
					<h3>7 Day Head Start E-Book</h3>
					<p>Designed to walk with you to reach your goals</p>
					<button type="button" class="btn button-large center-block" data-toggle="modal" data-target="#subscription-modal">get it free</button>
				</a>
			</div>
		</div>
	</section>
	<!--MODAL -->
	<section>
		<!-- Modal -->
		<div id="subscription-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Subscribe &amp; earn</h4>
					</div>
					<div class="modal-body">
						<img src="{{ asset('images/landing/modal-image.png') }}" class="img-responsive">
						<p>Latest SHREDZ news to your doorstep</p>
						<p>Get our 7 Day Head Start E-Book for FREE!</p>
						<div class="alert-success email-sub-success-modal" style="display:none;">
							Success! You have been subscribed!
						</div>
						<div class="alert-danger email-sub-error-modal" style="display:none;">
							Error in form submission. Please try again.
						</div>
						<div class="spinner spinner-modal" style="display: none;">
							<img src="{{ asset('images/loading.gif') }}">
						</div>

						<div class="row">
							<form class="form-inline subscribe-form" action="/subscription_email" id="modal-7day-subscription" method="post" role="form">
								{{ csrf_field() }}
								<input style="display: none" class="7day-dentifier" value="7day"></input>
								<div class="form-group">
									<input type="email" class="form-control 7day-email-sub" placeholder="Email Address">
									<button type="submit" class="btn button">Subscribe</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@stop
@section ('scripts')
<script type="text/javascript" src="{{ asset('js/pages/landing/jquery.frame-carousel.js') }}"></script>
<script type="text/javascript" src="js/pages/landing/landing.js"></script>
@append