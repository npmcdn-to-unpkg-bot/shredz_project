@extends('themes.default.layout')
@section('root-class') newproduct @stop
@section('top-scripts')
	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="//v2.zopim.com/?3pFFS3RUnAOb0VtRQCyu4R25kr53MP1t";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
	<!--End of Zopim Live Chat Script-->
@append
@section('styles')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css">	
@append
@section('content')
<div id="overlay" style="display:none;"> 
    <i class="fa fa-spinner fa-spin spin-big"></i>
</div>
<div class="product-header">
	<h1>shredz 30 day</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#step1"><span class="circle">1</span><span class="text">Goal</span></a></li>
		<li><a data-href="#step2"><i class="fa fa-angle-right"></i><span class="circle">2</span><span class="text">Supplements</span></a></li>
		<li><a data-href="#step3"><i class="fa fa-angle-right"></i><span class="circle">3</span><span class="text">Plan</span></a></li>
		<li class="last"><a data-href="#step4"><i class="fa fa-angle-right"></i><span class="circle">4</span><span class="text">Apparel</span></a></li>
	</ol>
</div>
<div class="product-content">
	<div class="container">
		<div id="step1" class="steps current show-gender">
			<div class="choose-gender">
				<div class="row" id="row-gender">
					<h2>Choose Gender</h2>
					<div class="col-xs-6 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 gender left-col">
						<div class="card">
							<a id="step1_male" href="#" class="male" data-gender="male">
								<i class="circle icon-male"></i><span>MALE</span>
							</a>
						</div>
					</div>
					<div class="col-xs-6 col-sm-5 col-md-4 gender right-col">
						<div class="card">
							<a id="step1_female" href="#" class="female" data-gender="female">
								<i class="circle icon-female"></i><span>FEMALE</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="choose-goal">
				<div class="row" id="row-goal">
					<h2>Choose Goal</h2>
					<div class="col-xs-6 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 goal left-col">
						<div class="card">
							<a id="step1_weightloss" href="#" class="weight-loss" data-goal="weight-loss">
								<i class="circle icon-weightloss"></i><span class="text">Weight <span>Loss</span></span>
							</a>
						</div>
					</div>
					<div class="col-xs-6 col-sm-5 col-md-4 goal right-col">
						<div class="card">
							<a id="step1_buildmuscle" href="#" class="build-muscle" data-goal="build-muscle">
								<i class="circle icon-muscle"></i><span class="text">Build <span>Muscle</span></span>
							</a>
						</div>
					</div>
				</div>
				<div class="row" id="row-email">
					<h2>Enter Email</h2>
					<div class="col-xs-12 col-sm-6 col-sm-offset-3">
						<div class="email-form">
							<form role="form" name="email_form" id="email_form">
								<div class="form-group">
									<input id="step1_email" type="email" class="form-control" id="email" placeholder="">
									<label for="email">Email <span class="note">*optional</span></label>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="step2" class="steps">
			<div class="choose-supplements">
				<div class="row">
					<h2>Choose Supplements</h2>
					<div class="col-xs-12">
						<div class="menu-selector">
							<ul class="list-inline">
								<li><a id="step2_showstack" href="#" class="active stack">Combo Stack</a></li>
								<li ><a id="step2_showsingle" href="#" class="single">Single Bottle</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="stack-products" id="stack">
					<div class="row slider-stack-product stack-slider">
					</div>
				</div>
				<div class="single-product" style="display: none;" id="single">
					<div class="row slider-single-product single-slider">
					</div>
				</div>
			</div>
		</div>
		<div id="step3" class="steps">
			<div class="step4 choose-plan">
				<div class="row">
					<div class="col-xs-12 no-gutter auto-height">
						<h2 class="title-free no-gutter" style="display: none;" id="ebook-credit">You qualify for <span class="free" id="free-ebook"><span class="left" style="display: none;">Left</span></span> worth of ebooks</h2>
					</div>
				</div>
				<div class="row plans">
					
				</div>
			</div>
		</div>
		<div id="step4" class="steps last">
			<div class="step5 choose-apparel">
				<div class="row">
					<div class="col-xs-12 no-gutter">
						<h2  class="title-free no-gutter" id="apparel-credit" style="display: none;">You qualify for <span class="free" id="free-apparel">$<span class="left" style="display: none;">Left</span></span> worth of Apparel</h2>
						<div class="apparel-menu-selector">
							<ul class="list-inline">
								<li><a href="#" class="active apparel">Apparel</a></li>
								<!-- <li><a href="#" class="tops">Tops</a></li>
								<li><a href="#" class="bottoms">Bottoms</a></li> -->
								<li><a href="#" class="accessories">Accessories</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row" id="apparel">
					<div class="apparel-slider">
					</div>
				</div>
				<div class="accessories row" id="accessories" style="display: none;">
					<div class="accessories-slider">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-footer text-center navbar-fixed">
	<div class="container">
		<div class="col-xs-3 no-right no-left">
		<!-- <a class="left-action" id="summary" href="#" data-toggle="modal" data-target="#myModal">Summary</a> -->
		<a class="left-action" id="summary" href="#" data-toggle="modal" data-target="#modalSummary"><span>Summary</span> <i class="fa fa-angle-up"></i>
		</a>
		</div>
		<div class="col-xs-6 no-gutter">
			<button id="next" class="next btn-primary" disabled>Next</button>
			<button id="fakeNext" class="next btn-primary" data-toggle="modal" disabled data-target="#modalNotQualify" style="display:none;">Next</button>
			<button id="checkout" class="btn-primary goCheckout" style="display: none;width:100%;padding-left:0;padding-right:0;">Checkout <i class="fa fa-check-circle" aria-hidden="true"></i></button>
		</div>
		<div class="col-xs-3 no-left">
			<button class="right-action goCheckout" id="skip">Skip to checkout</button>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="modalSummary" class="modal fade modal-summary" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Summary</h4>
      </div>
      <div class="modal-body row">
       	
      </div>
      <div class="modal-total">
       		
       	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalQualify" class="modal fade modal-qualify" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body row">
       	<div class="qualify-popup">
			<h2>Your supplement choice qualifies you for</h2>
			
			<div class="free-benefits">
				<ul>
					<li><i class="fa fa-check" aria-hidden="true"></i> $<span class="ebookfree"></span> of <strong>FREE</strong> Ebooks</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> $<span class="apparelfree"></span> of <strong>FREE</strong> Apparel & Accessories</li>
				</ul>
				<img src="{{asset('images/newproduct/modal-offer.png') }}" alt="">	
			</div>
			
			<!-- <h2>Would you like to see offers and pick your products?</h2> -->
			<h2 class="question">Would you like to see our latest and trending products?</h2>
			<button class="btn btn-primary goNext">Yes, please!</button>
			<button class="btn btn-secondary goCheckout">No, thanks. <span>Bring me to checkout</span></button>
		</div>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalNotQualify" class="modal fade modal-qualify" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body row">
       	<div class="qualify-popup">
			<!-- <h2>Would like to see Shredz Ebooks and Apparel?</h2> -->
			<h2>Workouts go better with ebooks & apparel</h2>
			
			<div class="free-benefits">
				<img src="{{asset('images/newproduct/modal-offer.png') }}" alt="">	
			</div>
			<h2>Would you like to see our latest and trending products?</h2>
			<button class="btn btn-primary goNext">Yes, please!</button>
			<button class="btn btn-secondary goCheckout">No, thanks. <span>Bring me to checkout</span></button>
		</div>
      </div>
    </div>

  </div>
</div>



@stop
@section('templates')
<script name="stackSingleSlider" type="text/x-handlebars-template">
<!--
@{{#each data}}
--><div class="slide col-xs-12" data-product-id="@{{ id }}">
	<img class="img-responsive main-image" src="@{{ asset_location }}primaryimage_new.png">
	<div class="product-info" style="display: none;">
		<h3 class="prod-title text-center prod-details">@{{ name }}</h3>
		<p><a class="nutrition-info" href="">Supplement Facts</a></p>
		<p class="prod-pitch prod-details"></p>

		<div id="stack-@{{ @index }}" class="benefits prod-details" >
			<ul>
			</ul>
		<div class="variant-options prod-details"></div>
		</div>

		<div class="price prod-details">
			<h1 class="base-price">@{{base_variant.price}}</h1>
		</div>
	</div>
	<button class="step2_stack_addtoplan btn button-large add-to-plan supplementsIdentifier">Add to plan</button>

	<div class="subscribe-container" style="display: none;">
		<p class="horizontal-border prod-details">or</p>
		<div class="subscribe prod-details">
			<div class="price-subscription-holder">
				<h2 class="subscribe-title">Subscribe &amp; Save!</h2>
				<h1 class="subscription-price"></h1>
				<h1 class="subsription-percentage" style="display: none"></h1>
				<button class="button-large dummy-subscription-button">Subscribe &amp; Save</button>
				<p class="cancel">Cancel Anytime</p>
			</div>
			
		</div>
	</div>
	<button class="button-large subscribe-button supplementsIdentifier" style="display: none;">Subscribe &amp; Save</button>
</div><!--
@{{/each}}
-->
</script>

<script name="ebooks" type="text/x-handlebars-template">
<!--
@{{#each ebooks}}
--><div class="col-xs-6 col-sm-5 ebook-container ebook-bg">
<div class="row">
	<div class="col-xs-12 col-sm-6 ebook-cover">
		<div class="plan" data-product-id="@{{ id }}" data-product-sku="@{{ base_variant.sku }}"  data-price="@{{ base_variant.price }}">
			<span class="checkbox"></span>
			<p class="price-holder visible-xs">@{{ base_variant.price }}</p>
			<img class="img-responsive" src="@{{ asset_location }}primaryimage_new.png">
			<p class="ebook-name visible-xs"><i class="fa fa-info-circle"></i>&nbsp;@{{ name }}</p>
		</div>
	</div>
	<div class="col-xs-6 desktop-benefits hidden-xs">
		<p class="ebook-price">$@{{ base_variant.price }}</p>
		<ul data-product-id="@{{ id }}">
		</ul>
	</div>
</div>

</div><!--
@{{/each}}
-->
</script>
<script name="apparelAccessoriesSlider" type="text/x-handlebars-template">
<!--
@{{#each data}}
--><div class="slide" data-product-id="@{{ id }}" data-gender="@{{ gender }}">
		<img class="img-responsive main-image" src="@{{ asset_location }}primaryimage_new.png">
		<!-- <div class="product-info" style="display: none"> -->
			<div class="variant-options">
			</div>
			<div class="price">
				<h1 class="base-price">@{{base_variant.price}}</h1>
			</div>
			<a class="button-large add-to-plan apparelIdentifier">Add to plan </a>
		<!-- </div> -->
	</div><!--
	@{{/each}}
	-->
</script>


@append
@section('scripts')
@include('includes.lib.animation')
@include('includes.lib.templating')

@if(!App::environment('production'))
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-24214732-5', 'auto');
	ga('send', 'pageview');
	</script>
@endif

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="{{ asset('js/product.factory.js') }}"></script>

<script type="text/javascript">
	$("#overlay").fadeIn();
    
    $(function(){
    	$("#overlay").fadeOut();

        var scriptMobile = document.createElement( "script" );
        scriptMobile.type = "text/javascript";
        scriptMobile.src = "{{ asset('js/pages/newProduct.js') }}";

        var scriptDesktop = document.createElement( "script" );
        scriptDesktop.type = "text/javascript";
        scriptDesktop.src = "{{ asset('js/pages/newProductDesktop.js') }}";
        console.log(scriptMobile);
        if($(window).width()>767){
            $("body").append(scriptDesktop);
        }
        else{
            $("body").append(scriptMobile);
        }
        $("a.nutrition-info").fancybox({
        	'autoDimensions': false,
			'autoScale'     : false,
			afterLoad : function(){
				$(".fancybox-inner").click(function(){
					$.fancybox.close();
				})

			},
			beforeLoad : function(){
  				$(".fancybox-skin").css("backgroundColor","transparent !important");
			},
			 fitToView: false, 
			   helpers: {
			    overlay: {
			      locked: true
			    }
			  }
        });
    });
</script>


@append