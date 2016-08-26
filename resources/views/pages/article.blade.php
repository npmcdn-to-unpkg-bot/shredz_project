@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') blog @stop
@section('metas')
<meta property="fb:app_id" content="1147947408549670">
<meta property="og:site_name" content="Shredz">
<meta property="og:site" content="https://shredz.com/blog">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $page['title'] }}">
<meta property="og:image" content="{{ @$page['assets']['primary_image'][0]['path'] }}">
<meta name="author" data-type="string" content="{{ $page['author']['name'] }}">
<meta name="title" data-type="string" content="{{ $page['title'] }}">
<meta name="keywords" content="@foreach (@$page['tags'] as $tag) {{ $tag }} @endforeach">
<meta name="image" data-type="enum" content="{{ @$page['assets']['primary_image'][0]['path'] }}">
<meta name="url" data-type="enum" content="{{ Request::url() }}">
<meta name="timestamp" data-type="date" content="{{ $page['publish_start'] }}">
<meta name="category" content="{{ strtolower(trim(@$page['_primary_category'])) }}">
@append
@section('styles')
<link rel="stylesheet" href="{{ asset('css/article.css') }}" type="text/css">
@append
@section('page-title')
{{ @$page['_page_title'] ?: $page['title'] }} |
@stop
@section('content')

<section id="article-container">
	<div class="container-fluid article-wrapper">
		<div class="row">
			<!-- Left Sidenav -->
			<div class="col-md-2 left-navbar" id="left-container">
				<ul class="full-height-sidebar">
					<li class="active hidden-xs hidden-sm"><a href="{{ url('blog/') }}"><i class="iconmoon icon-show-all hidden-xs"></i>Show All</a></li>
					<li><a class="workouts" href="{{ url('blog/') }}?category=workouts"><i class="iconmoon icon-workouts hidden-xs"></i>Workouts</a></li>
					<li><a class="recipes" href="{{ url('blog/') }}?category=recipes"><i class="iconmoon icon-recipes hidden-xs"></i><span>Recipes</span></a></li>
					<li><a class="motivation" href="{{ url('blog/') }}?category=motivation"><i class="iconmoon icon-motivation hidden-xs"></i>Motivation</a></li>
					<li><a class="nutrition" href="{{ url('blog/') }}?category=nutrition"><i class="iconmoon icon-nutrition hidden-xs"></i>Nutrition</a></li>
					<li><a class="wellness" href="{{ url('blog/') }}?category=wellness"><i class="iconmoon icon-wellness hidden-xs"></i>Wellness</a></li>
					<li><a class="women" href="{{ url('blog/') }}?category=women" class="no-border"><i class="iconmoon icon-women hidden-xs"></i><span class="hidden-xs">For Women</span><span class="visible-xs">Women</span></a></li>
					<a href="{{ url('shop') }}" class="hidden-sm hidden-xs"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/mens_shop.jpg"></a>
				</ul>
				</div><!-- Left Sidenav ends here -->
				<!-- Middle content -->
				<?php $blogTags = [
				'workouts',
				'motivation',
				'nutrition',
				'wellness',
				'recipes',
				'women',
				'howitworks'
				];
				?>
				<div class="col-sm-9 col-md-8 middle-container" id="middle-container">
					@if(@$page['assets']['primary_image'][0])
					<div class="image-container">
						<ul class="list-inline categories-label" style="right: 0; top: 0;">
							@foreach (@$page['tags'] as $index => $value)
							@if(in_array($index, $blogTags))
							<li>
								<span>
									<i class="icon-{{ $index }}"></i>
								</span>
							</li>
							@endif
							@endforeach
						</ul>
						<img src="{{ @$page['assets']['primary_image'][0]['path'] }}">
					</div>
					@endif
					<div class="content-container">
						<div class="row featured-content">
							<div class="col-xs-12 white-color-background">
								@if(@$page['title'])
								<h1>{{ $page['title'] }}</h1>
								@endif
								<div class="row">
									<div class="col-xs-12 color-medium-grey">
										<div class="inline-styling">
											@if(@$page['_social_shares_count'])
											<span class="shares-count">{{ $page['_social_shares_count'] }}</span><br>
											<span class="share-heading">SHARES</span>
											@endif
										</div>
										<div class="share-button-holder">
											<ul class="list-inline social-share-buttons">
												<span class="healthy-living"> Share for Healthy Living</span>
												<li style="background: #4464a3;">
													<a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}" target="facebook" class="facebook-handler"><i class="fa fa-facebook"></i><span class="share-text">Share</span></a>
												</li>
												<li style="background: #60b5f0;">
													<a href="https://twitter.com/home?status={{ request()->url() }}" target="twitter" class="twitter-handler"><i class="fa fa-twitter"></i><span class="share-text">Tweet</span></a>
												</li>
												<li style="background: #C92228;">
													<a href="https://pinterest.com/pin/create/button/?url=&media={{ request()->url() }}" target="googleplus" class="google-plus-handler"><i class="fa fa-pinterest"></i><span class="share-text">Pin It</span></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="secondary-content-wrapper">
							<div class="row">
								<div class="col-xs-12 content-details">
									@if (@$page['content'])
									{!! $page['content'] !!}
									@endif
								</div>
							</div>
							<div class="row author-margin-mobile">
								<div class="col-xs-12">
									@if (@$page)

								@foreach (@$page['tags'] as $index => $value)
									@if(in_array($index, $blogTags))

										@if($index == "howitworks")

												<div class="how-it-works" id="hiw">
												<img class="title img-responsive" src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/blog/title.png" alt="">
												<div class="row mobile-slider">
													<div class="col-xs-4">
														<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/blog/my-plan.png" alt="">
														<h3>Choose your plan</h3>
														<p>There's an option for every one and any goal.</p>
													</div>
													<div class="col-xs-4">
														<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/blog/day-check.png" alt="">
														<h3>Follow for 30 days</h3>
														<p>Work up a sweat and start feeling better today.</p>
													</div>
													<div class="col-xs-4">
														<img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/blog/body.png" alt="">
														<h3>See results</h3>
														<p>Once you start seeing the results, it gets addicting.</p>
													</div>
												</div>
												<a href="{{ url('shop') }}" class="btn large-button">START TODAY</a>
											</div>
										@else


										@endif

									@endif
								@endforeach

									<p><span class="medium-grey">by</span> <span class="color-shredz-primary">{{ $page['author']['name'] }}</span></p>
									<p class="date-class">{{ $pageComponent->formatDate(@$page['publish_start']) }}</p>
									@endif
								</div>
							</div>
							<!-- <div class="row share-button-holder">
									<div class="col-xs-12">
											<ul class="list-inline social-share-buttons">
													<span class="healthy-living"> Share for Healthy Living</span>
													<li style="background: #4464a3;">
															<a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}" target="facebook" class="facebook-handler"><i class="fa fa-facebook" style="margin-left: 4px;"></i><span class="share-text">Share</span></a>
													</li>
													<li style="background: #60b5f0;">
															<a href="https://twitter.com/home?status={{ request()->url() }}" target="twitter" class="twitter-handler"><i class="fa fa-twitter"></i><span class="share-text">Tweet</span></a>
													</li>
													<li style="background: #C92228;">
															<a href="https://pinterest.com/pin/create/button/?url=&media={{ request()->url() }}" target="googleplus" class="google-plus-handler"><i class="fa fa-pinterest"></i><span class="share-text">Pin It</span></a>
													</li>
											</ul>
									</div>
							</div> -->
							<?php $relatedArticles = $pageComponent->relatedPagesTo($page);
								if($relatedArticles){
									shuffle($relatedArticles);
								}
							?>
							@if($relatedArticles)
							<div class="row related-articles">
								<h2>Related Articles</h2>
								@for ($i=0; $i<3; $i++)
								<div class="col-xs-12 col-sm-4 col">
									<a href="/blog/{{ @$relatedArticles[$i]['slug'] }}">
										<div class=overlay-styling>
											<img class="img-responsive" src="{{ @$relatedArticles[$i]['assets']['primary_image'][0]['path'] }}">
											<p>{{ $relatedArticles[$i]['title'] }}</p>
										</div>
									</a>
								</div>
								@endfor
							</div>
							@endif
							<!-- <div class="row">
									<h2>Featured Products</h2>
							</div>
							<div id="product-grid-ads">
							</div> -->
							<div class="padding-bottom-mobile">
								<a class="hidden-md hidden-lg" href="{{ url('shop') }}"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/mens_shop_mobile.jpg"></a>
							</div>
							<!-- <div class="ad-container row inner-section-margin">
									<div class="col-xs-6 col-sm-3 ad">
											<a href="#" ><img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=38&w=400&h=400"></a>
									</div>
									<div class="col-xs-6 col-sm-3 ad">
											<a href="#" ><img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=38&w=400&h=400"></a>
									</div>
									<div class="col-xs-6 col-sm-3 ad">
											<a href="#" ><img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=38&w=400&h=400"></a>
									</div>
									<div class="col-xs-6 col-sm-3 ad">
											<a href="#" ><img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=38&w=400&h=400"></a>
									</div>
							</div> -->
							<!-- <div class="row ratings-container">
									<div class="col-xs-12">
											<h1>RATE THIS ARTICLE</h1>
									</div>
									<div class="col-xs-12 ratings-holder">
											<select id="rating-value-holder">
													<option value=""></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
											</select>
									</div>
							</div> -->
							<!-- <div class="row inner-section-margin">
									<div class="col-xs-12">
											<div class="form-group">
													<label for="comment">Log in to comment</label>
													<p>Please keep comments positive and constructive. Help the community by reporting inappropriate comments. Inappropriate comments may be reported and/or removed.</p>
													<textarea class="form-control text-area-styling inner-section-margin" rows="3" placeholder="Please login to comment."></textarea>
											</div>
									</div>
							</div>
							<div class="row inner-section-margin comment-heading-container">
									<div class="col-sm-6 col-xs-6 text-left">
											<h4>Comments</h4>
									</div>
									<div class="col-sm-6 col-xs-6 text-right">
											<button class="shredz-primary-button">POST COMMENT</button>
									</div>
							</div>
							<div class="row inner-section-margin comments">
									<div class="col-xs-3">
											<img src="https://placeholdit.imgix.net/~text?txtsize=38&w=200&h=200">
									</div>
									<div class="col-xs-9">
											<p><strong>Justinfit</strong> <span class="color-shredz-primary">(Justin Miale)</span></p>
											<p>This is a great article! Really helped me put training into a new perspective. Thanks for the post.</p>
									</div>
									<div class="col-xs-12 text-right">
											<p>Today - <a href="#"><span class="color-shredz-primary">Report</span></a> -  <a href="#"><span class="color-shredz-primary">Reply</span></a></p>
									</div>
							</div>
							<div class="row inner-section-margin comments">
									<div class="col-xs-3">
											<img src="https://placeholdit.imgix.net/~text?txtsize=38&w=200&h=200">
									</div>
									<div class="col-xs-9">
											<p><strong>Justinfit</strong> <span class="color-shredz-primary">(Justin Miale)</span></p>
											<p>This is a great article! Really helped me put training into a new perspective. Thanks for the post.</p>
									</div>
									<div class="col-xs-12 text-right">
											<p>Today - <a href="#"><span class="color-shredz-primary">Report</span></a> -  <a href="#"><span class="color-shredz-primary">Reply</span></a></p>
									</div>
							</div> -->
						</div>
						<!-- <div style="margin-bottom: 60px;"></div> -->
					</div>
					</div><!--Middle content ends here -->
					<!-- Right Sidenav -->
					<?php $trendingNowPath = [
						'3-reasons-you-re-not-shredded',
						'10-ways-to-cut-calories-without-noticing',
						'post-workout-beauty-tips',
						'5-strength-training-mistakes-that-are-holding-you-back',
						'chicken-butterflying-your-chicken-breast'
						];
					?>
					<div class="col-sm-3 col-md-2" id="right-container">
						<ul>
							<li class="trending-now">Trending Now</li>
							@foreach ($trendingNowPath as $trendingNow)
							@if($trendingNowArticle = $pageComponent->path('/blog/'.$trendingNow))
							<li>
								<a href="{{ $trendingNow }}">
									<div class=overlay-styling>
										<div class="row text-over-image">
											<div class="col-xs-12">
												<p>{!! $pageComponent->limitString($trendingNowArticle['title'], 40) !!}...</p>
											</div>
										</div>
										<img class="img-responsive" src="{{ @$trendingNowArticle['assets']['primary_image'][0]['path'] }}">
									</div>
								</a>
							</li>
							@endif
							@endforeach
							<a href="{{ url('/products/customized-diet-plan-for-her#CDP-W') }}" class="hidden-xs"><img class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/womens_dietworkout.jpg"></a>
							<a href="{{ url('/products/customized-diet-plan-for-her#CDP-W') }}" class="hidden-sm hidden-md hidden-lg"><img style="padding-top: 15px; padding-bottom: 15px; background: white;" class="img-responsive" src="https://s3.amazonaws.com/SHREDZ-CARTS/Blog/storelinks/womens_dietworkout_mobile.jpg"></a>
						</ul>
					</div>
					<!--Right Sidenav ends here -->
				</div>
			</div>
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
@section('templates')
<script name="productsAds" type="text/x-handlebars-template">
<div class="row">
	<!--@{{#each products}}
	--><div onclick="window.location='/products/@{{ slug }}'" class="item-product col-sm-3 col-xs-6 product-@{{ lcase gender }}" data-price="@{{ base_variant.price }}" data-filters="@{{join categories }} gender-@{{ lcase gender }}" data-sort-id="@{{ @index }}">
		<a class="item_anchor" href="/products/@{{ slug }}">
			@{{#in flags 'featured-sale'}}
			@{{#if-gt base_variant.msrp base_variant.price }}
			<div class="discount-container">
				<i class="iconmoon icon-discount"></i>
				<span class="discount">@{{ sale base_variant.price base_variant.msrp }}</span>
			</div>
			@{{/if-gt}}
			@{{/in}}
			<img class="img-responsive pri_store_image lazy" src="@{{ asset_location }}primaryimage_new.jpg" data-original="@{{ asset_location }}primaryimage_new.jpg">
			<!-- Fallback for non javascript browser -->
			<noscript>
			<img src="@{{ asset_location }}primaryimage_new.jpg">
			</noscript>
		</a>
		<div class="gender-@{{ lcase gender }}" onclick="window.location='/products/@{{ slug }}'">
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
@append
@section('scripts')
@include('includes.lib.animation')
@include('includes.lib.templating')
<script rel="script" type="text/javascript" src="{{ asset('js/jquery.barrating.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pages/blog-article-common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pages/article.js') }}"></script>

@append
@section('dev-scripts')
<script>
	var relatedPages = {!! json_encode($pageComponent->relatedPagesTo($page)) !!};
	console.log('Related Page:', relatedPages);
</script>
@append
