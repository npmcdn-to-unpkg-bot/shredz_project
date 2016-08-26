@extends('themes.default.layout')
@section('root-class') focus @stop
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/focus/focus.css') }}">
@append
@section('content')

<section id="banner">
	<!-- Banner -->
	<div class="container-fluid">
		<div class="cover-image transparent-triangle {{$queryString}}">
		<script>
			switch ('{{$queryString}}') {
			    case 'athletes':
			        localStorage['__shredz_focus__'] = JSON.stringify('athletes');
					break;
			    case 'entrepreneurs':
			        localStorage['__shredz_focus__'] = JSON.stringify('entrepreneurs');
  					break;
			    case 'photovideo':
			        localStorage['__shredz_focus__'] = JSON.stringify('photovideo');
			      break;
		      case 'gamers':
		        localStorage['__shredz_focus__'] = JSON.stringify('gamers');
		      break;
		      default:
		        localStorage['__shredz_focus__'] = JSON.stringify('default');

			}
		</script>
			<div class="text-holder row">
				<div class="col-xs-12 text-center">
					<i class="icon-focus"></i>
					<h1>Focus</h1>
					<div class="triangle">
						<p>beyond your limits</p>
					</div>
					<!-- <h3>SHREDZ FOCUS Pill</h3> -->
					<ul class="list-inline">
						<li>The will to win</li><i class="fa fa-circle" aria-hidden="true"></i>
						<li>The power to rise</li><i class="fa fa-circle" aria-hidden="true"></i>
						<li>The drive to finish</li>
					</ul>
					<button class="btn large-button center-block page-scroll" href="#how-it-works">Learn more</button>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container">
	<!-- Featured -->
	<div id="featured">
		<div class="row">
			<div class="col-xs-8 col-xs-push-2 col-sm-5 col-sm-push-0">
				<img class="img-responsive" src="{{asset('images/focus/bottles.png')}}">
			</div>
			<div class="col-xs-12 col-sm-7 text-holder">
				<h2>SHREDZ FOCUS<sup>&reg;</sup></h2>
				<p>Focus optimizes the way you think. It supports both alertness and focus, so that you can place your attention on the things that matter most, while reducing the amount of errors you make. Make the right decision. Make work your play. Get the job done.</p>
				<p>Achieving greatness is a large part of human nature. It's embedded in us, but few of us find a way to let it come to the surface. Now, focus your efforts on the end goal hard enough for you to reach your full potential. </p>
				<p class="price-desc">30 Day Supply for $50.00</p>
				<div class="row">
					<div class="col-xs-12 text-center">
						<div class="btn-group add-to-cart-dropdown">
							<button type="button" class="btn large-button center-block dropdown-toggle addToCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-sku="COREFCUS-1M">
							Add to cart</button>
							<div class="dropdown-menu">
								<i class="fa fa-caret-up" aria-hidden="true"></i>
								<a class="dropdown-item" href="#" data-sku="COREFCUS-1M">
									<h3 class="male"><i class="icon-focus"></i>FOCUS MALE</h3>
								</a>
								<a class="dropdown-item" href="#" data-sku="MFWFCUS-1M">
									<h3 class="female"><i class="icon-focus"></i>FOCUS FEMALE</h3>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="stars text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<span class="colored">4.2&nbsp;</span><span class="border"></span><span class="text-muted">&nbsp;5</span>
				</div>
				<p class="light-gray">AVERAGE CUSTOMER REVIEW</p> -->
			</div>
		</div>
	</div>
</section>
<section class="container-fluid">
	<!-- How it works -->
	<div id="how-it-works">
		<div class="row">
			<div class="col-xs-12 icon-text-holder text-center">
				<i class="icon-focus"></i><h1>&nbsp;HOW IT WORKS?</h1>
			</div>
			<div class="col-xs-12 cover-image text-center">
				<div class="brain">
					<img class="img-responsive" src="{{ asset('images/focus/brain.png') }}">
				</div>
				<h2 class="text-center">fuel your senses</h2>
				<p>FOCUS uses the unique properties of several high-grade nootropics combined with synergistic amino acids which increase alertness, support attention, and may reduce mental errors.</p>
				<p>A mild stimulant effect helps to keep drowsiness at bay, while other ingredients work to optimize your alertness so that you can get the most out of work, athletics, or any activity that involves a high level of concentration. Each ingredient has a powerful cognitive effect that works in tandem with the next ingredient to maximize the effectiveness of the supplement as a whole. </p>
			</div>
		</div>
	</div>
</section>
<section id="graph">
	<!-- Graphs Section -->
	<div class="container-fluid">
		<div class="row icon-text-wrapper">
			<div class="col-xs-4 icon-text-holder text-center">
				<div class="icon"><i class="icon-target"></i></div>
				<div class="text"><h3><span class="hidden-xs">Improves focus</span><span class="visible-xs">Focus</span></h3></div>
			</div>
			<div class="col-xs-4 icon-text-holder text-center">
				<div class="icon"><i class="icon-attention"></i></div>
				<div class="text"><h3><span class="hidden-xs">Supports Attention</span><span class="visible-xs">Attention</span></h3></div>
			</div>
			<div class="col-xs-4 icon-text-holder text-center">
				<div class="icon"><i class="icon-alertness"></i></div>
				<div class="text"><h3><span class="hidden-xs">Improves Alertness</span><span class="visible-xs">Alertness</span></h3></div>
			</div>
		</div>
		<div class="graphs-wrapper">
			<div class="focus-chart row">
				<div class="col-xs-12 col-sm-12 col-md-6 graph">
					<h1 class="visible-xs"><i class="icon-target"></i>&nbsp;FOCUS</h1>
					<canvas id="focusGraphOne" width="200" height="200"></canvas>
					<p class="visible-xs notes">Mean hit rate (proportion of targets detected) * P < .05, n=16</p>
					<canvas id="focusGraphTwo" width="200" height="200"></canvas>
					<p class="visible-xs notes">Mean Discriminability index d' **P < .01, n=16</p>
					<ul class="list-inline hidden-xs">
						<li class="notes">Mean hit rate (proportion of targets detected) * P < .05, n=16</li>
						<li class="notes">Mean Discriminability index d' **P < .01, n=16</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 text">
					<h1 class="hidden-xs"><i class="icon-target"></i>&nbsp;FOCUS</h1>
					<p>In a study of a subset of key ingredients in FOCUS, participants engaged in a visuospatial attention task measured with continuous EEG data and discriminability index value. The study indicated a significant increase in the number of correct responses compared to the placebo group. </p>
				</div>
			</div>
			<div class="attention-chart row">
				<div class="col-xs-12 col-sm-6">
					<h1 class="visible-xs"><i class="icon-attention"></i>&nbsp;ATTENTION</h1>
					<canvas id="attentionGraph" width="200" height="200"></canvas>
					<p class="notes">The probability of omission errors is plotted as a function of treatment and time. The
					subset of SHREDZ Focus ingredients decreased omission errors by 50% relative to placebo.</p>
				</div>
				<div class="col-xs-12 col-sm-6 text">
					<h1 class="hidden-xs"><i class="icon-attention"></i>&nbsp;ATTENTION</h1>
					<p>In a double-blind, placebo controlled, randomized assessment of sustained attention to response inhibit task in healthy adults, key ingredients in FOCUS were shown to decrease omission errors by 50% relative to the placebo. </p>

				</div>
			</div>
			<div class="alertness-chart row">
				<div class="col-xs-12 col-sm-12 col-md-6 graph">
					<h1 class="visible-xs"><i class="icon-alertness"></i>&nbsp;ALERTNESS</h1>
					<canvas id="alertnessGraphOne" width="200" height="200"></canvas>
					<p class="visible-xs notes">Accuracy on the attention switching task (mean +- SE).
					Main effect of formula (P<0.01)</p>

					<canvas id="alertnessGraphTwo" width="200" height="200"></canvas>
					<p class="visible-xs notes">Changes in reported alertness on the Bond-Lader visual analogue
					mood scales (mean plus/minus SE)</p>
					<ul class="list-inline hidden-xs">
						<li class="notes">Accuracy on the attention switching task (mean +- SE).
					Main effect of formula (P<0.01)</li>
						<li class="notes">Changes in reported alertness on the Bond-Lader visual analogue
					mood scales (mean plus/minus SE)</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 text">
					<h1 class="hidden-xs"><i class="icon-alertness"></i>&nbsp;ALERTNESS</h1>
					<p>During a double blind, placebo controlled, randomized study examining two key ingredients in FOCUS, participants completed a set of cognitive tasks which showed an increase in accuracy on the attention-switching tasks compared to placebo. </p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 text-center">
					<div class="btn-group add-to-cart-dropdown">
						<button type="button" class="btn large-button center-block dropdown-toggle addToCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-sku="COREFCUS-1M">
						Add to cart</button>
						<div class="dropdown-menu">
							<i class="fa fa-caret-up" aria-hidden="true"></i>
							<a class="dropdown-item" href="#" data-sku="COREFCUS-1M">
								<h3 class="male"><i class="icon-focus"></i>FOCUS MALE</h3>
							</a>
							<a class="dropdown-item" href="#" data-sku="MFWFCUS-1M">
								<h3 class="female"><i class="icon-focus"></i>FOCUS FEMALE</h3>
							</a>
						</div>
					</div>
				</div>
				<!-- <div class="col-xs-12">
					<div class="btn-group add-to-cart-dropdown">
						<button type="button" class="btn large-button center-block dropdown-toggle addToCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-sku="COREFCUS-1M">
						Add to cart</button>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>
<section id="what-ingredients">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h1><i class="icon-focus"></i>&nbsp;WHAT ARE THE INGREDIENTS?</h1>
			</div>
		</div>
	</div>
	<div class="container ingredients-details">
		<!-- <div class="row pill">
			<div class="col-xs-12">
				<img class="img-responsive" src="{{ asset('images/focus/pill.png') }}">
			</div>
		</div> -->
		<div class="row details">
			<div class="col-xs-5 col-sm-4 text-center">
				<div class="hexagon-wrapper bacopa">
					<div class="hexagon">
						<img class="img-responsive" src="{{ asset('images/focus/bacoba.png') }}">
					</div>
					<div class="hidden-xs">
						<h3>BACOPA MONNIERI </h3>
						<h4>ACTIVE INGREDIENT</h4>
						<p>Bacopa Monnieri can be used as an effective nootropic, adaptogen, and antioxidant and is commonly used in Ayurvedic medicine for improved brain function.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 text visible-xs">
				<h3> BACOPA MONNIERI </h3>
				<h4>ACTIVE INGREDIENT</h4>
				<p>Bacopa Monnieri can be used as an effective nootropic, adaptogen, and antioxidant and is commonly used in Ayurvedic medicine for improved brain function.</p>
			</div>
			<div class="col-xs-5 col-sm-4 text-center">
				<div class="hexagon-wrapper">
					<div class="hexagon">
						<img class="img-responsive" src="{{ asset('images/focus/l-theanine.png') }}">
					</div>
					<div class="hidden-xs">
						<h3> L-THEANINE </h3>
						<h4>ACTIVE INGREDIENT</h4>
						<p>An amino acid that is mostly found in green teas. L-Theanine has been studied to show a reduction in errors (omission) and is commonly known to be a non-sedative.  When taken with proper amount of caffeine, L-Theanine further improves alertness and attention.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 text visible-xs">
				<h3> L-THEANINE </h3>
				<h4>ACTIVE INGREDIENT</h4>
				<p>An amino acid that is mostly found in green teas. L-Theanine has been studied to show a reduction in errors (omission) and is commonly known to be a non-sedative.  When taken with proper amount of caffeine, L-Theanine further improves alertness and attention.</p>
			</div>
			<div class="col-xs-5 col-sm-4 text-center">
				<div class="hexagon-wrapper ginko">
					<div class="hexagon">
						<img class="img-responsive" src="{{ asset('images/focus/ginko.png') }}">
					</div>
					<div class="hidden-xs">
						<h3>Ginkgo Biloba</h3>
						<h4>ACTIVE INGREDIENT</h4>
						<p>A traditional Chinese medicinal plant that is commonly used for brain health. The lasting effects of Ginkgo Biloba are being determined based on ongoing industry research.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 text visible-xs">
				<h3> Ginkgo Biloba </h3>
				<h4>ACTIVE INGREDIENT</h4>
				<p>A traditional Chinese medicinal plant that is commonly used for brain health. The lasting effects of Ginkgo Biloba are being determined based on on-going industry research.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				<div class="btn-group add-to-cart-dropdown">
					<button type="button" class="btn large-button center-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					supplement facts</button>
					<div class="dropdown-menu">
						<i class="fa fa-caret-up" aria-hidden="true"></i>
						<a class="dropdown-item">
							<h3 class="male img-responsive fancybox-images" href="https://s3.amazonaws.com/SHREDZ-CARTS/Supplement%20Facts/Made%20For%20Men/Single/Focus-MFM.jpg" >FOR MALE</h3>
						</a>
						<a class="dropdown-item">
							<h3 class="female img-responsive fancybox-images" href="https://s3.amazonaws.com/SHREDZ-CARTS/Supplement%20Facts/Made%20For%20Women/Single/Focus-MFW.jpg" >FOR FEMALE</h3>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <section id="review-section">
	<div class="container-fluid">
		<div class="cover-image">
			<div class="review-slider">
				<div class="slide">
					<img class="img-responsive" src="{{ asset('images/focus/user.png') }}">
					<p><i class="fa fa-quote-left" aria-hidden="true"></i> This product works! I can start remembering all the little things I use to miss and I feel more awake.&nbsp;<i class="fa fa-quote-right" aria-hidden="true"></i></p>
					<p class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</p>
				</div>
				<div class="slide">
					<img class="img-responsive" src="{{ asset('images/focus/user.png') }}">
					<p><i class="fa fa-quote-left" aria-hidden="true"></i>FINALLY! A product that works! I can focus better, I am more alert and make less mistakes. &nbsp;<i class="fa fa-quote-right" aria-hidden="true"></i></p>
					<p class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</p>
				</div>
			</div>
		</div>
	</div>
</section> -->
<!-- <section id="get-shit-done">
		<div class="container">
				<h1>Get sh*t done</h1>
				<div class="row">
						<div class="col-xs-4 first-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
						<div class="col-xs-4 second-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
						<div class="col-xs-4 third-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
				</div>
				<div class="row" style="margin-top: 10px;">
						<div class="col-xs-4 first-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
						<div class="col-xs-4 second-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
						<div class="col-xs-4 third-col-padding">
								<a class="fancybox-images" rel="group" href="{{ asset('images/focus/banner.jpg') }}">
										<img class="img-responsive" src="{{ asset('images/focus/banner.jpg') }}">
								</a>
						</div>
				</div>
				<div class="row">
						<div class="col-xs-12 text-center">
								<div class="btn-group add-to-cart-dropdown">
										<button type="button" class="btn large-button center-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Add to cart</button>
										<div class="dropdown-menu">
												<i class="fa fa-caret-up" aria-hidden="true"></i>
												<a class="dropdown-item" href="#" data-sku="COREFCUS-1M">
														<h3 class="male"><i class="icon-focus"></i>FOCUS MALE</h3>
												</a>
												<a class="dropdown-item" href="#" data-sku="MFWFCUS-1M">
														<h3 class="female"><i class="icon-focus"></i>FOCUS FEMALE</h3>
												</a>
										</div>
								</div>
						</div>
				</div>
		</div>
</section> -->
<section id="get-focused">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h1>GET FOCUSED</h1>
				<ul class="list-inline">
					<li>The will to win</li><i class="fa fa-circle" aria-hidden="true"></i>
					<li>The power to rise</li><i class="fa fa-circle" aria-hidden="true"></i>
					<li>The drive to finish</li>
				</ul>
			</div>
			<div class="col-xs-12 text-center">
				<div class="btn-group add-to-cart-dropdown">
					<button type="button" class="btn large-button center-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="lastAddToCart">
					Add to cart</button>
					<div class="dropdown-menu">
						<i class="fa fa-caret-up" aria-hidden="true"></i>
						<a class="dropdown-item" href="#" data-sku="COREFCUS-1M">
							<h3 class="male"><i class="icon-focus"></i>FOCUS MALE</h3>
						</a>
						<a class="dropdown-item" href="#" data-sku="MFWFCUS-1M">
							<h3 class="female"><i class="icon-focus"></i>FOCUS FEMALE</h3>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.0/Chart.js"></script>
<script type="text/javascript" src="{{ asset('js/pages/focus/focus.js') }}"></script>
<script type="text/javascript">
    var __cho__ = {"data":{},"pid":7666};
    (function() {
        var c = document.createElement('script');
        c.type = 'text/javascript';
        c.async = true;
        c.src = document.location.protocol + '//cc.chango.com/static/o.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(c, s);
    })();
</script>
@append
