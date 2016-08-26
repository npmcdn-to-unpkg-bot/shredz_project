<section id="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 text-center carousel-holder">
            <a href="{{ route('fitclub') }}">
                <img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/fitclub/fitclub-flat-logo.png">
            </a>
            </div>
        </div>
    </div>
</section>
@if(Auth::check())
<section id="member-profile">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-sm-offset-1 vertical-center">
				@if(@Auth::user()->avatar)
				<img class="img-responsive img-circle center-block user-image" src="{{ Auth::user()->avatar }}" />
				@else
				<div class="initials">
					<ul class="list-inline">
						<li>{{ @Auth::user()->initials[0] }}</li>
						<li>{{ @Auth::user()->initials[1] }}</li>
					</ul>
				</div>
				@endif
				<h3>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
				<a href="/fitclub-member/{{Auth::user()->first_name}}-{{Auth::user()->last_name}}">
				<h3 class="my-profile">My Fitclub</h3>
				</a>
			</div><!--
			--><div class="col-xs-0 col-sm-6 col-sm-pull-1 text-right my-fitclub hidden-xs vertical-center">
				<h4>
					<a href="/fitclub-member/{{Auth::user()->first_name}}-{{Auth::user()->last_name}}">
						<i class="fa fa-user"></i><span>my fitclub</span>
					</a>
				</h4>
			</div>
		</div>
	</div>
</section>
@endif
<section id="fitclub-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 no-gutter">
				<div class="filter-bar clearfix">
		            <div class="clearfix">
		                <div class="first-nav">
			                <a href="{{ url('fitclub') }}" class="show-all"><h2 data-category="all" class="nav-item">ALL</h2></a>
		                    <a href="{{ url('fitclub') }}?category=workouts" class="workouts"><h2 data-category="workouts" class="nav-item">workouts</h2></a>
		                    <a href="{{ url('fitclub') }}?category=routines" class="routines"><h2 data-category="routines" class="nav-item">routines</h2></a>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 no-gutter">
				<div class="filter-bar clearfix">
		            <div class="clearfix">
		                <div class="second-nav">
		                	<!-- <a class="total-body"><h2 data-category="total-body" class="nav-item">total body</h2></a> -->
		                	<a class="chest"><h2 data-category="chest" class="nav-item">chest</h2></a>
		                 	<a class="arms"><h2 data-category="arms" class="nav-item">arms</h2></a>
		                 	<a class="back"><h2 data-category="back" class="nav-item">Back</h2></a>
		                 	<a class="shoulders"><h2 data-category="shoulders" class="nav-item">Shoulders</h2></a>
		                 	<a class="legs"><h2 data-category="legs" class="nav-item">legs</h2></a>
		                 	<a class="core"><h2 data-category="core" class="nav-item">core</h2></a>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
</section>
