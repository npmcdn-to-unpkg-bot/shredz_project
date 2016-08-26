@extends('themes.default.layout')
@section('root-class') results @stop
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.css">
@append
@section('content')
<section id="featured">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-4 col-sm-1 left-bar"></div>
			<div class="col-xs-4 col-sm-2 text text-center">
				<h4>Results</h4>
			</div>
			<div class="col-xs-4 col-sm-9 right-bar"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<ul class="bxslider">
				<li>
					<div class="col-xs-12 col-sm-6 text-holder">
						<h2>Become your</h2>
						<h1>best self</h1>
						<p>thousands of lives transformed</p>
						<a href="{{ route('shop') }}"><button class="btn large-button center-block">Start today</button></a>
					</div>
					<div class="col-xs-12 col-sm-6 image-holder">
						<img src="{{ asset('images/results/banner.png') }}" class="img-responsive">
					</div>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619870" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619876" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619884" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619833" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619843" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619865" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
				<li>
					<iframe src="https://player.vimeo.com/video/164619851" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</li>
			</ul>
		</div>
	</div>
	<div class="container video-holder">
		<div class="row">
			<div class="col-xs-12 text-center">
				<ul class="list-inline" id="bx-pager">
					<li><a data-slide-index="0" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/results-small.png') }}" /></a></li>
					<li><a data-slide-index="1" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/Geneva_Brainard.jpg') }}" /></a></li>
					<li><a data-slide-index="2" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/eric_lainer.jpg') }}" /></a></li>
					<li><a data-slide-index="3" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/Abigail_Hester.jpg') }}" /></a></li>
					<li><a data-slide-index="4" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/lisa_harvel.jpg') }}" /></a></li>
					<li><a data-slide-index="5" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/Krystal_deandra.jpg') }}" /></a></li>
					<li><a data-slide-index="6" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/John_Bellmore.jpg') }}" /></a></li>
					<li><a data-slide-index="7" href=""><img class="img-responsive" src="{{ asset('images/results/video_thumbnail/KatyAnn_Coulter.jpg') }}" /></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div class="container disclaimer-content">
	<p>
		WE INVITED THE CUSTOMERS HIGHLIGHTED BELOW TO VISIT AND MEET THE SHREDZ TEAM TO SHARE THEIR STORIES WITH US. THESE INDIVIDUALS HAVE BEEN DEDICATED MEMBERS OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH DIFFERENT COMBINATIONS OF PROPER EXERCISE PLANS, DIET PLANS, COACHING, AND SUPPLEMENTS, HAVE ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND EACH AND EVERY ONE OF THEM AND ARE HONORED TO BE PART OF THEIR FITNESS JOURNEY.
	</p>
</div>

<section id=customer-reviews>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h2>They Did It. <strong>So Can You.</strong></h2>
				<h3>Dedicated Long Term Customers</h3>
				<p>Everyone needs the motivation to start! Take a look at these individuals who made a decision to change their lives!</p>
			</div>
		</div>
		<div class="row user-image-container">
			<ul class="ch-grid">
				<li>
					<div class="ch-item ch-img-1">
						<div class="ch-info-wrap" data-name="geneva">
							<div class="ch-info">
								<div class="ch-info-front ch-img-1"></div>
								<div class="ch-info-back">
									<a data-name="geneva">
										<div>
											<img class="img-responsive" src="{{ asset('images/results/after/geneva-brainard.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">Geneva Brainard</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="geneva">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-2">
						<div class="ch-info-wrap" data-name="eric">
							<div class="ch-info">
								<div class="ch-info-front ch-img-2"></div>
								<div class="ch-info-back">
									<a data-name="eric">
										<div>
											
											<img class="img-responsive" src="{{ asset('images/results/after/eric-lanier.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">Eric Lanier</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="eric">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-3">
						<div class="ch-info-wrap" data-name="abigail">
							<div class="ch-info">
								<div class="ch-info-front ch-img-3"></div>
								<div class="ch-info-back">
									<a data-name="abigail">
										<div>
											
											<img class="img-responsive" src="{{ asset('images/results/after/abigail-hester.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">Abigail Hester</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="abigail">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-3">
						<div class="ch-info-wrap" data-name="lisa">
							<div class="ch-info">
								<div class="ch-info-front ch-img-4"></div>
								<div class="ch-info-back">
									<a data-name="lisa">
										<div>
											
											<img class="img-responsive" src="{{ asset('images/results/after/lisa-havel.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">Lisa Havel</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="lisa">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-3">
						<div class="ch-info-wrap" data-name="krystal">
							<div class="ch-info">
								<div class="ch-info-front ch-img-5"></div>
								<div class="ch-info-back">
									<a data-name="krystal">
										<div>
											
											<img class="img-responsive" src="{{ asset('images/results/after/krystal-leija-deanda.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">Krystal Leija DeAnda</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="krystal">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-3">
						<div class="ch-info-wrap" data-name="john">
							<div class="ch-info">
								<div class="ch-info-front ch-img-6"></div>
								<div class="ch-info-back">
									<a data-name="john">
										<div>
											
											<img class="img-responsive" src="{{ asset('images/results/after/john-bellmore.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">John Bellmore</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="john">View My Story</a></span>
				</li>
				<li>
					<div class="ch-item ch-img-3">
						<div class="ch-info-wrap" data-name="katyann">
							<div class="ch-info">
								<div class="ch-info-front ch-img-7"></div>
								<div class="ch-info-back">
									<a data-name="katyann">
										<div>
											<img class="img-responsive" src="{{ asset('images/results/after/katyann-coulter.png') }}">
										</div>
										<h3>View My Story</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<span class="name">KatyAnn Coulter</span>
					<span class="visible-xs view-my-story"><a href="#" data-name="katyann">View My Story</a></span>
				</li>
			</ul>
		</div>
		<div class="row start-today">
			<div class="col-xs-12">
				<a href="{{ route('shop') }}"><button class="btn large-button center-block">start today</button></a>
			</div>
		</div>
		<div class="disclaimer-content small">
			<p>EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. REGARDING THE TESTIMONIALS: RESULTS MAY VARY DEPENDING UPON STARTING POINT, TIME, GOALS, AND EFFORT.</p>
		</div>
	</div>
</section>
<section id="transformation-slider">
	<div class="container">
		<div class="container">
			<div class="col-xs-12">
				<h2>Check Out More Amazing Transformations</h2>
				<p>These transformations were submitted by customers that started their transformation journey using SHREDZ! All our orders come with Before and After cards!</p>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-push-2 text-center">
				<div class="review-slider">
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/1.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/2.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/3.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/4.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/5.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/6.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/7.jpg') }}">
					</div>
					<div class="slide">
						<img class="img-responsive" src="{{ asset('images/results/transformation/8.jpg') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<a href="{{ route('shop') }}"><button class="btn large-button center-block">start now</button></a>
			</div>
		</div>
		<div class="disclaimer-content small">
			<p>EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. REGARDING THE TESTIMONIALS: RESULTS MAY VARY DEPENDING UPON STARTING POINT, TIME, GOALS, AND EFFORT.</p>
		</div>
	</div>
</section>
<section id="build-your-own">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h2>Build Your Own 30 Day Plan</h2>
				<p>You might not be able to achieve all your goals in 30 days, but you have to start! Don't wait and join the thousands that took the step in the right direction!</p>
				<img class="img-responsive" src="{{ asset('images/results/stack.png') }}">
			</div>
			<div class="col-xs-12 icon-holder">
				<ul class="list-inline">
					<li><i class="icon icon-bottle"></i><span>Supplements</span></li>
					<li><i class="icon icon-dumbblle"></i><span>Workouts</span></li>
					<li><i class="icon icon-apple"></i><span>Nutrition</span></li>
				</ul>
			</div>
			<div class="col-xs-12">
				<a href="{{ route('shop') }}"><button class="btn large-button center-block">Build your plan</button></a>
			</div>
		</div>
	</div>
</section>
@stop
<!-- Modal -->
<div id="baseModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title name"></h4>
				<p class="instagram"></p>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<img class="img-responsive image_url" src="">
					</div> 
					<div class="col-xs-12 col-sm-6 record">
						<h3>start weight</h3>
						<p class="start_weight"></p>
						<h3>current weight</h3>
						<p class="current_weight"></p>
						<h3>favorite product</h3>
						<div class="favorite_product"></div>
					</div>
				</div>
				<div class="row video-holder">
					<div class="col-xs-12">
						<iframe src="" class="video_url" width="400" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
				<div class="row review-holder">
					<div class="col-xs-12">
						<h3>My story</h3>
						<p class="story"></p>
					</div>
					<div class="col-xs-12">
						<a href="#"><button class="btn large-button center-block check-vlog" style="display: none;">check my vlog</button></a>
					</div>
					<div class="col-xs-12 disclaimer-content">
						<p>WE HOSTED THIS CUSTOMER TO VISIT AND MEET THE SHREDZ TEAM TO SHARE HIS/HER STORY WITH US. THIS INDIVIDUAL HAS BEEN A DEDICATED MEMBER OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH PROPER EXERCISE PLANS, DIET PLANS, AND SUPPLEMENTS, HAS ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND HIM/HER AND ARE HONORED TO BE PART OF HIS/HER FITNESS JOURNEY.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/vendor/jquery.fitvids.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="{{ asset('js/pages/results.js') }}"></script>
@append