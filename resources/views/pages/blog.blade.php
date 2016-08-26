@inject('pageComponent', 'App\Http\Components\Page')

@extends('themes.default.layout')

@section('root-class') blog @stop

@section('metas')
<meta name="category" content="{{ strtolower(trim(@$category)) }}">
@append

@section('content')
<section id="blog-container">
	<div class="container-fluid blog-wrapper">
		<div class="row">
			<!-- 1 -->
			<!-- Left Sidenav -->
			<div class="col-md-2 left-navbar" id="left-container">
				<ul>
					<li class="hidden-xs hidden-sm"><a class="show-all" href="{{ url('blog/') }}"><i class="iconmoon icon-show-all hidden-xs"></i><span>Show All</span></a></li>
					<li><a class="workouts" href="{{ url('blog') }}?category=workouts"><i class="iconmoon icon-workouts hidden-xs"></i><span>Workouts</span></a></li>
					<li><a class="recipes" href="{{ url('blog') }}?category=recipes"><i class="iconmoon icon-recipes hidden-xs"></i><span>Recipes</span></a></li>
					<li><a class="motivation" href="{{ url('blog') }}?category=motivation"><i class="iconmoon icon-motivation hidden-xs"></i><span>Motivation</span></a></li>
					<li><a class="nutrition" href="{{ url('blog') }}?category=nutrition"><i class="iconmoon icon-nutrition hidden-xs"></i><span>Nutrition</span></a></li>
					<li><a class="wellness" href="{{ url('blog') }}?category=wellness"><i class="iconmoon icon-wellness hidden-xs"></i><span>Wellness</span></a></li>
					<li><a class="women" href="{{ url('blog/') }}?category=women" class="no-border"><i class="iconmoon icon-women hidden-xs"></i><span class="hidden-xs">For Women</span><span class="visible-xs">Women</span></a></li>
					<a href="{{ url('shop') }}" class="hidden-sm hidden-xs"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/mens_shop.jpg"></a>
				</ul>
			</div><!-- Left Sidenav ends here -->

			<!-- 2 -->
			<!-- Middle content -->
			<div class="col-sm-9 col-md-8 middle-container" id="middle-container">
				@if(@$blogs[0]['assets']['primary_image'][0])
				<div class="image-container">
					<ul class="list-inline categories-label" style="right: 0; top: 0;">
						@foreach (@$blogs[0]['tags'] as $index => $value)
							@if(in_array($index, $blogTags))
							<li>
								<span>
									<i class="icon-{{ $index }}"></i>
								</span>
								<span style="text-transform: capitalize">{{ $value }}</span>
							</li>
							@endif
						@endforeach
					</ul>
					<a href="/blog/{{ @$blogs[0]['slug'] }}">
						<img src="{{ @$blogs[0]['assets']['primary_image'][0]['path'] }}">
					</a>
				</div>
				@endif
				<div class="content-container">
					<!-- <div class="inner-padding"> -->
						<div class="row featured-content">
							<div class="col-xs-12 white-color-background">
								@if (@$blogs[0])
								<a href="/blog/{{ @$blogs[0]['slug'] }}"><h2>{{ @$blogs[0]['title'] }}</h2></a>
								<p class="date-class">{{ $pageComponent->formatDate(@$blogs[0]['publish_start']) }}</p>
								<p style="margin-top: 10px;">{!! @$blogs[0]['_summary'] !!}</p>
								<p><a href="/blog/{{ @$blogs[0]['slug'] }}" class="read-more-link">Read More</a></p>
								@endif
							</div>
						</div>
						<div class="secondary-content-wrapper inner-section-margin">
							<div class="row">
								@for ($subFeatured = 1; $subFeatured < 3; $subFeatured++)
									@if (@$blogs[$subFeatured])
								    <div class="col-xs-12 col-sm-6">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<ul class="list-inline categories-label">
												@foreach (@$blogs[$subFeatured]['tags'] as $index => $value)
													@if(in_array($index, $blogTags))
													<li>
														<span>
															<i class="icon-{{ $index }}"></i>
														</span>
														<span style="text-transform: capitalize">{{ $value }}</span>
													</li>
													@endif
												@endforeach
												</ul>
												<a href="/blog/{{ @$blogs[$subFeatured]['slug'] }}"><img class="img-responsive" src="{{ @$blogs[$subFeatured]['assets']['primary_image'][0]['path'] }}"></a>
											</div>
											<div class="col-xs-12">
												<div class="photo-text-container">
													<div class="text-holder">
														<a href="/blog/{{ @$blogs[$subFeatured]['slug'] }}"><h3>{{ @$blogs[$subFeatured]['title'] }}</h3></a>
														<p class="date-class">{{ $pageComponent->formatDate(@$blogs[$subFeatured]['publish_start']) }}</p>
													</div>
													<p class="text-center no-margin">{!! $pageComponent->limitString(@$blogs[$subFeatured]['_summary'], 110) !!}...</p>
													<p class="text-center no-margin"><a href="/blog/{{ @$blogs[$subFeatured]['slug'] }}" class="read-more-link">Read More</a></p>
												</div>
											</div>
										</div>
									</div>
									@endif
								@endfor
							</div>
							<hr class="visible-xs" />
							<!-- <div class="row">
								<h3 class="hidden-xs" style="margin-left: 20px;">Most Recent</h3>
							</div> -->

							@if(@$blogs[3])
							<?php $count = 2; $rowInserted = false; $countObject = count($blogs); $ifInsertedAlready = false; ?>
							@for ($mostRecent = 3; $mostRecent < $countObject; $mostRecent++)
								@if (@$blogs[$mostRecent])
									@if($count == 2)
									<?php $rowInserted = true; ?>
									<div class="row inner-section-margin most-recent-container">
									@endif
									<div class="col-sm-4 col-md-4">
										<div class="row">
											<div class="col-xs-6 col-sm-12 most-recent-image">
												@if(!@$category)
												<ul class="list-inline categories-label hidden-xs" style="top: 0;">
													@foreach (@$blogs[$mostRecent]['tags'] as $index => $value)
														@if(in_array($index, $blogTags))
														<li>
															<span>
																<i class="icon-{{ $index }}"></i>
															</span>
															<span style="text-transform: capitalize">{{ $value }}</span>
														</li>
														@endif
													@endforeach
												</ul>
												@endif
												<a href="/blog/{{ @$blogs[$mostRecent]['slug'] }}"><img class="img-responsive lazy" data-original="{{ @$blogs[$mostRecent]['assets']['primary_image'][0]['path'] }}"></a>
											</div>
											<div class="col-xs-6 col-sm-12 no-padding">
												<div class="photo-text-container">
													<div class="text-holder">
														<a href="/blog/{{ @$blogs[$mostRecent]['slug'] }}"><h4>{{ @$blogs[$mostRecent]['title'] }}</h4></a>
														<p class="date-class  no-top">{{ $pageComponent->formatDate(@$blogs[$mostRecent]['publish_start']) }}</p>
													</div>
													<p class="hidden-xs text-center no-margin">{!! $pageComponent->limitString(@$blogs[$mostRecent]['_summary'], 80) !!}...</p>
													<p class="hidden-xs text-center no-margin"><a href="/blog/{{ @$blogs[$mostRecent]['slug'] }}" class="read-more-link">Read More</a></p>
												</div>
											</div>
										</div>
									</div>

									@if($rowInserted && $mostRecent == $countObject-1)
									<?php $ifInsertedAlready = true; ?>
									</div>
									@endif

									@if($rowInserted && $count != 0)
									<?php $count = $count - 1; ?>
									@elseif($rowInserted && $count == 0 && !$ifInsertedAlready)
									</div>
									<?php $count = 2; ?>
									@else
									<?php $rowInserted = false; ?>
									@endif

								@endif
							@endfor
							@endif
							<div class="row hidden-md hidden-lg">
								<div class="col-xs-12">
									<a href="{{ url('shop') }}"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/mens_shop_mobile.jpg"></a>
								</div>
							</div>
						</div>
					<!-- </div> -->
				</div>
			</div><!--Middle content ends here -->

			<!-- 3 -->
			<!-- Right Sidenav -->
			<div class="visible-xs section-margin"></div>

			<!-- 4 -->
			<div class="col-sm-3 col-md-2" id="right-container">
				<ul>
					<li class="trending-now">Trending Now </li>
					@foreach ($trendingNowPath as $trendingNow)
    					@if($trendingNowArticle = $pageComponent->path('/blog/'.$trendingNow))
    					<li>
							<a href="{{ url('blog').'/'.$trendingNow }}">
							    {{ $trendingNowArticle['title'] }}
							</a>
						</li>
    					@endif
					@endforeach
					<li><a href="{{ url('fitclub-signup') }}" class="join-the-movement">#JOINTHEMOVEMENT</a></li>
					<!-- <li><a href="#"><i class="fa fa-search"></i> SEARCH BLOG</a></li> -->
					<a href="{{ url('/products/personalized-diet-training-plan-for-her-meal-prep-containers') }}" class="hidden-xs"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/womens_dietworkout.jpg"></a>
					<a href="{{ url('/products/personalized-diet-training-plan-for-her-meal-prep-containers') }}" class="hidden-sm hidden-md hidden-lg"><img style="padding-top: 15px; padding-bottom: 15px; background: white;" class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/womens_dietworkout_mobile.jpg"></a>
				</ul>
			</div>
			<!--Right Sidenav ends here -->
		</div>
	</div>
	<h1 class="text-center semantic-title">
		SHREDZ Blog <span>Fitness, Motivation, Nutrition, Wellness, Kitchen and Women.</span>
	</h1>
</section>
<section class="subscription" id="email-subscription">
	<div class="container-fluid text-center">
		<div class="alert-success email-sub-success" style="display:none; margin-top: 40px;">
            Success! You have been subscribed!
        </div>
        <div class="alert-danger email-sub-error" style="display:none; margin-top: 40px;">
            Error in form submission. Please try again.
        </div>
        <div class="spinner spinner-footer" style="display: none;">
            <img src="{{ asset('images/loading.gif') }}">
        </div>
		<button class="close-button">x</button>
		<div class="row">
			<p><span class="red">SUBSCRIBE TO NEWSLETTER</span><span class="inside-border"></span><span class="text">Get our 7 Day Head Start E-book for FREE!</span></p>
		</div>
		<div class="row">
			<form action="/subscription_email" method="post" class="subscribe-form" id="blog-subscription">
				{{ csrf_field() }}
				<input style="display: none" class="blog-identifier" value="blog"></input>
				<input type="text" name="email" class="form-group blog-email-sub" placeholder="Email Address" />
				<button type="submit">SUBSCRIBE</button>
			</form>
		</div>
	</div>
</section>
<section class="subscription" id="subscription-modal">
	<button type="button" class="btn btn-info btn-lg" style="display: none;" data-toggle="modal" id="blog-subscription-modal" data-target="#subscriptionModal"></button>
	<!-- Modal -->
	<div id="subscriptionModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">subscribe &amp; earn </h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-xs-12">
	      			<img class="img-responsive" src="{{ asset('images/ebook-popup.jpg') }}">
	      		</div>
	      	</div>
	      	<div class="row form-container">
	      		<div class="col-xs-12">
	      			<h4 class="text-center">Subscribe for the latest SHREDZ Blog News &</p>
	        		<h3 class="text-center">Get our 7 Day Head Start E-Book for FREE!</p>
	      		</div>
	      		<div class="col-xs-12">
			      	<div class="alert-success email-sub-success" style="display:none; margin-bottom: 20px;">
		            	Success! You have been subscribed!
		        	</div>
		        	<div class="alert-danger email-sub-error" style="display:none; margin-bottom: 20px;">
		            	Error in form submission. Please try again.
		        	</div>
		        	<div class="spinner spinner-modal" style="display: none;">
			            <img src="{{ asset('images/loading.gif') }}">
			        </div>
	      			<form action="/subscription_email" method="post" class="subscribe-form" id="modal-blog-subscription">
						{{ csrf_field() }}
						<input style="display: none" class="blog-identifier" value="blog"></input>
						<input type="text" name="email" class="form-group blog-email-sub" placeholder="Email Address" />
						<button type="submit" class="center-block">SUBSCRIBE</button>
					</form>
	      		</div>
	      	</div>

	      </div>
	    </div>
	  </div>
	</div>
</section>
@stop


@section('scripts')
	<!-- <script rel="script" type="text/javascript" src="{{ asset('js/jquery.barrating.js') }}"></script>
	<script rel="script" type="text/javascript" src="{{ asset('js/moment.js') }}"></script> -->
	<script type="text/javascript" src="{{ asset('js/pages/blog-article-common.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/blog.js') }}"></script>
	<script>
	</script>

@append

@section('dev-scripts')
	<script>
		var category = {!! json_encode(@$category) !!};
		var blogs = {!! json_encode(@$blogs) !!};
		// var category = {!! json_encode(@$category) !!};
		console.log('%c Category:', 'font-weight: bold', category);
		console.log('%c Blogs:', 'font-weight: bold', blogs);
	</script>
@append
