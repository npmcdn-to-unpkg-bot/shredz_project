@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') vip-preview @stop
@section('styles') 
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.7.0/cropper.min.css">
@append
@section('content')
<div id="overlay" style="display:none;">
	<i class="fa fa-spinner fa-spin spin-big"></i>
</div>
@include('includes.fitclub-header')
<section id="fitclub-member-profile">
	<div class="container-fluid">
		<div class="row myprofile-text">
			<div class="col-xs-12 text-center">
				<h1>my profile</h1>
			</div>
		</div>
		<div class="row personal-info">
			<div class="col-xs-12 text-center">
				@if(Auth::user()->profile()->first()->avatar)
				<img class="img-responsive center-block user-image" src="{{ Auth::user()->profile()->first()->avatar }}" />
				@elseif(Auth::user()->profile()->first()->oauth_avatar)
				<img class="img-responsive center-block user-image" src="{{Auth::user()->profile()->first()->oauth_avatar}}" />
				@else
				<div class="initials">
					<ul class="list-inline">
						<li>{{Auth::user()->first_name[0]}}</li>
						<li>{{Auth::user()->last_name[0]}}</li>
					</ul>
				</div>
				@endif
			</div>
			<div class="col-xs-12 text-center ">
				<ul class="list-inline">
					<li><i class="fa fa-user"></i>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</li>
					<li><i class="fa fa-calendar"></i>Member since {{ $pageComponent->formatDate(Auth::user()->created_at) }}</li>
					{{-- <li><i class="fa fa-check-square"></i>18 Videos Completed</li> --}}
					@if(Auth::user()->profile()->first()->avatar)
					<li class="image-upload-wrapper">
                   		<a class="dz-clickable" id="updateImage">Update Image</a>
                   	</li>
					@else
					<li class="image-upload-wrapper">
                   		<a class="dz-clickable" id="updateImage">Upload Image</a>
                   	</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</section>

{{-- <section id="recently-completed-videos">
	<div class="container">
		<div class="row row-flex test">
			<div class="col-xs-12 text-center">
				<p>Your Process Since Start</p>
				 <h1><span class="line-center">Recently Completed Videos</span></h1>
			</div>
			<div class="col-xs-6 col-sm-4 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
				<div class="accessible">
					<a href="/vip-preview/bench-press-101-part-1" >
						<div class="play-button">
							<i class="icon icon-play"></i>
						</div>
						<img class="img-responsive lazy" src="https://i.vimeocdn.com/video/23566238_600x500.webp">
					</a>
				</div>
				<p class="title two-line-ellipsis">Introduction</p>
			</div>
			<div class="col-xs-6 col-sm-4 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
				<div class="accessible">
					<a href="/vip-preview/bench-press-101-part-1" >
						<div class="play-button">
							<i class="icon icon-play"></i>
						</div>
						<img class="img-responsive lazy" src="https://i.vimeocdn.com/video/23566238_600x500.webp">
					</a>
				</div>
				<p class="title two-line-ellipsis">Introduction</p>
			</div>
			<div class="col-xs-6 col-sm-4 col-flex" data-tags="@{{#each tags}}@{{@key}} @{{/each}}">
				<div class="accessible">
					<a href="/vip-preview/bench-press-101-part-1" >
						<div class="play-button">
							<i class="icon icon-play"></i>
						</div>
						<img class="img-responsive lazy" src="https://i.vimeocdn.com/video/23566238_600x500.webp">
					</a>
				</div>
				<p class="title two-line-ellipsis">Introduction</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<button class="btn large-button center-block">All Completed Videos</button>
			</div>
		</div>
	</div>
</section> --}}
<section id="member-discount">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 coupon-holder">
				<div class="coupon">
					<h3>Members discount</h3>
					<p>Fit Club members qualify for</p>
					<p><strong>15% off</strong> on any product purchase</p>
					<a href="{{ route('shop', ['coupon=fitclub-member']) }}" class="btn large-button center-block">Shop now</a>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.7.0/cropper.min.js"></script>
<script type="text/javascript" src="{{ asset('js/pages/fitclub-member.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<script>
		(function(){
          

		})();
	</script>
@append