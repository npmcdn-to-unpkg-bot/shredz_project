@inject('api', 'App\Tools\ShredzAPI')

<!DOCTYPE html>
<!--[if IE]>
<html class="ie" lang="en-US">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en-US">
<!--><![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="p:domain_verify" content="8e7c00cd481789a568db1177ca520798"/>
    <meta name="api-base" content="{{ $api->getBaseUrl() }}">
    <meta name="api-token" content="{{ $api->getToken() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-base" content="{{ asset('') }}">
    @if(isset($user['token']))
    <meta name="btClientToken" content="{{ $user['token'] }}">
    @endif
    @if(!App::environment('production'))
    <meta name="debug" content="true">
    @endif

    @if(@$page['_meta_description'])
    <meta name="description" content="{{ $page['_meta_description'] }}">
    @elseif (@$page['_summary'])
    <meta name="description" content="{{ $page['_summary'] }}">
    @else
    <meta name="description" content="SHREDZ® helps people find a reason to fight for their bodybuilding and weight loss goals, and gives them the supplements they need to reach them.">
    @endif
    @yield("metas")
    <title>
    @if(!App::environment('production'))
      {{ strtoupper(App::environment()) }} |
    @endif
    @section('page-title')
    {{ @$page['_page_title'] ? $page['_page_title'] . ' | ' : ''  }}
    @show
    {{ @$siteName ?: 'SHREDZ&reg; Supplements | Bodybuilding and Weight Loss Solutions' }}
    </title>
    <!--[if lte IE 9]>
    <script src="{{ asset('js/xdomain.min.js') }}" slave="{{ $api->getBaseUrl() }}/v1/xdomain"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{-- ## F A V I C O N S ## --}}
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{{ asset('apple-touch-icon-57x57.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('apple-touch-icon-114x114.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('apple-touch-icon-72x72.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('apple-touch-icon-144x144.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{{ asset('apple-touch-icon-60x60.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{{ asset('apple-touch-icon-120x120.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{{ asset('apple-touch-icon-76x76.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{{ asset('apple-touch-icon-152x152.png') }}}">
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">
    <link rel="icon" type="image/png" href="{{{ asset('favicon-196x196.png') }}}" sizes="196x196">
    <link rel="icon" type="image/png" href="{{{ asset('favicon-96x96.png') }}}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{{ asset('favicon-32x32.png') }}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{{ asset('favicon-16x16.png') }}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{{ asset('favicon-128.png') }}}" sizes="128x128">
    <meta name="application-name" content="Shredz Supplements">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{{ asset('mstile-144x144.png') }}}">
    <meta name="msapplication-square70x70logo" content="{{{ asset('mstile-70x70.png') }}}">
    <meta name="msapplication-square150x150logo" content="{{{ asset('mstile-150x150.png') }}}">
    <meta name="msapplication-wide310x150logo" content="{{{ asset('mstile-310x150.png') }}}">
    <meta name="msapplication-square310x310logo" content="{{{ asset('mstile-310x310.png') }}}">
    {{-- ## F O N T S ## --}}
    <link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,700,800|Montserrat:100,200,400,700' rel='stylesheet' type='text/css'>

    {{-- ## S T Y L E S H E E T S ## --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css" type="text/css" >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    @yield("styles")
    @yield("top-scripts")
    @if(App::environment('production'))
    {{-- Start Visual Website Optimizer Asynchronous Code --}}
    <script type='text/javascript'>
    var _vwo_code=(function(){
    var account_id=203593,
    settings_tolerance=2000,
    library_tolerance=2500,
    use_existing_jquery=false,
    // DO NOT EDIT BELOW THIS LINE
    f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
    </script>
    {{-- End Visual Website Optimizer Asynchronous Code --}}
      @include('includes.binganalytics')
      @include('includes.googleanalytics')
    @endif
  </head>

  <body class="@yield('root-class')">
    @if(App::environment('production'))
      {{-- ## P R O D U C T I O N   O N L Y ## --}}
      @include('includes.analytics')
    @endif

    <header class="affixed">
    @section('header')
      @include('themes.default.header')
    @show
    </header>

    <div class="main-content {{ str_slug(@$page['type'], '-') }} @yield('main-content-class')">
      @yield('content')
    </div>

    @section('footer')
      @include('themes.default.footer')
    @show

    @yield('modals')
    @yield('templates')

    {{-- SCRIPTS --}}
    {{-- LIBRARIES --}}
     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.0/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-viewport-checker/1.8.7/jquery.viewportchecker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    @include('includes.sentry')
    @if(!App::environment('production'))
      {{-- ##  P O L Y F I L L S  ## --}}
      <script type="text/javascript" src="{{ asset('js/polyfills.js') }}"></script>
      {{-- ## G L O B A L   L I B S  ## --}}
      <script type="text/javascript" src="{{ asset('js/api.module.js') }}"></script>
      <script rel="script" type="text/javascript" src="{{ asset('js/CartModule.js') }}"></script>
      <script rel="script" type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    @else
      {{-- ##  P O L Y F I L L S  ## --}}
      <script type="text/javascript" src="{{ asset('js/polyfills.min.js') }}"></script>
      {{-- ## G L O B A L   L I B S  ## --}}
      <script type="text/javascript" src="{{ asset('js/api.module.min.js') }}"></script>
      <script rel="script" type="text/javascript" src="{{ asset('js/CartModule.min.js') }}"></script>
      <script rel="script" type="text/javascript" src="{{ asset('js/functions.min.js') }}"></script>
    @endif

    <script type="text/javascript">
      $(function(){
        $('iframe[name=google_conversion_frame]', parent.document).css({"height":"0px", "margin":0}); {{-- ## Remove white space below footer ## --}}
      })
    </script>
    @yield("scripts")

    @if(!App::environment('production'))
      {{-- ## DEV ONLY: No need to remove ## --}}
      <script>
        console.log('%c --- DEV ONLY --------------------------', 'font-weight: bold');

        var pageData = {!! json_encode(@$page) !!};
        console.log('%c Page Data:', 'font-weight: bold', pageData);
      </script>
      @yield('dev-scripts')
      <script>
        console.log('%c --- END DEV ONLY -----------------------', 'font-weight: bold');
      </script>
    @endif

  </body>
</html>
