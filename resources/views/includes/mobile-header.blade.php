@inject('api', 'App\Tools\ShredzAPI')
<div class="nav-menu mobile">
    <menu class="menu" id="toggle-nav">
        <div class="toggle">
            <i class="fa fa-bars mobile-menu"></i>
        </div>
    </menu>
    <script type="text/javascript">      

        var homePageIdentifier;

        ///////////////////////////////////////////////////////////////////////////////////////
        //  loadDataFromLocalStorage()-> load localstorage data if set
        ///////////////////////////////////////////////////////////////////////////////////////

        function loadDataFromLocalStorage() {
            try {
                homePageIdentifier = JSON.parse(localStorage['__shredz_home_page__']);
            } catch (e) {
                //
            }

            return homePageIdentifier;
        }

        ///////////////////////////////////////////////////////////////////////////////////////
        //  saveDataToLocalStorage()-> save localstorage data
        ///////////////////////////////////////////////////////////////////////////////////////

        function saveDataToLocalStorage() {
            try {
                if (localStorage) {
                    localStorage['__shredz_home_page__'] = JSON.stringify(homePageIdentifier);
                }
            } catch (e) {
                // DO NOTHING
            }
        }
    </script>
    @if(Request::url() == url('home'))
    <script type="text/javascript">   
        homePageIdentifier = 'home';
        saveDataToLocalStorage();
    </script>
    @endif
    <span id="logo"><a class="logo hidden-blog" href="{{ url('/') }}"><img  src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/shredz-logo-mobile.png"/></a></span>

    <a class="logo visible-blog" href="{{ url('blog') }}" style="display: none;"><img  src="{{ asset('images/logo-blog.png') }}"/></a>

    <a class="shopping-bag cart-external-link" class="cart-external-link" href="{{ $api->getBaseUrl() }}/cart" target="cart">
        <p class="cart-quantity"><i class="fa fa-spinner fa-spin"></i></p>
    </a>

    <div class="main-menu" id="mobile-nav" style="display: none">
        <div class="side-nav">
            <ul>
                <li class="outer-nav" id="mobile-menu"><a class="outer-title" href="{{ url('/') }}">HOME</a></li>
                <li class="outer-nav" id="mobile-menu-shop">
                    <div class="drop outer-title">SHOP</div>
                    <ul class="sub-menu">
                        <li class="inner-nav">
                            <a href="{{ route('shop') }}">All Products</a>
                        </li>
                        <li class="inner-nav">
                            <a href="{{ route('shop', ['#weight-loss-supplements+recovery+health-wellness+build-muscle']) }}">Supplements</a>
                        </li>
                        
                        <li class="inner-nav">
                            <a href="{{ route('shop', ['#performance']) }}">Performance</a>
                        </li>

                        <li class="inner-nav">
                            <a href="{{ route('shop', ['#meal-plan']) }}">4 Week Shred</a>
                        </li>
                        <li class="inner-nav">
                            <a href="{{ route('shop', ['#accessories+bottoms+looks+stringers+t-shirts+tanktops+tops']) }}">Apparel</a>
                        </li>
                    </ul>
                </li>
                <li class="outer-nav">
                    <a class="outer-title" href="/results">SUCCESS STORIES</a>
                </li>
                <li class="outer-nav">
                    <a class="outer-title" href="{{ url('fitclub-signup') }}">FIT CLUB</a>
                </li>
                <li class="outer-nav">
                    <a class="outer-title" href="{{ url('blog') }}/#">Articles & Videos</a>
                </li>
                @if(Auth::check())
                <li class="outer-nav">
                    <div class="drop outer-title">ACCOUNT</div>
                    <ul class="sub-menu">
                            <li class='inner-nav'><a href="/settings">SETTINGS</a></li>                      
                    </ul>
                </li>
                  @else
                    <li class='outer-nav'><a class="outer-title" href="#" data-toggle="modal" id="openRegister" data-target="#login-modal">REGISTER</a></li>
                    <li class='outer-nav'><a class="outer-title" href="#" data-toggle="modal" id="openLogin" data-target="#login-modal">LOG IN</a></li>
                  @endif
            </ul>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).on('click', function (e) {
        var $toggleNav = $('#toggle-nav');
        var $mobileNav = $('#mobile-nav');
        var $sideNav = $mobileNav.find('.side-nav');
        if (e.target
        && $.contains($mobileNav.get(0), e.target)
        && $(e.target).hasClass('drop')
        ) {
            // Clicking Sub Menu
        } else if ($toggleNav.hasClass('down')) {
            $toggleNav.removeClass("down");
            $mobileNav.slideUp();
        }
    });
    $('#toggle-nav').click(function(e){
        if (!$(this).hasClass("down")) {
            $(this).addClass("down");
        } else {
            $(this).removeClass("down");
        }
        $('#mobile-nav').slideToggle();

        if (e && e.preventDefault) {
            e.preventDefault();
            e.stopImmediatePropagation();
            e.returnValue = false;
        }
    });
    $('.inner-nav a').click(function(){
        $('#mobile-nav').hide();
    })
    $('.side-nav div.drop').unbind();
    $('.side-nav div.drop').click(function(){
        var notOuter = $(".outer-title").not(this);
        var hasActive = $(this).parent().siblings('li').hasClass("active");

        notOuter.hide();

        if (hasActive) {
             //remove this to do alternating inner drawers
            $(this).parent().siblings("li.active").each(function(){
               $(this).children('ul').first().slideUp(170);
              $(this).removeClass('active');
            })
        }
        if($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).siblings('ul').first().slideUp(170);
              notOuter.show();
        }
        else{
            $(this).parent().addClass('active');
            $(this).siblings('ul').first().slideDown(170);
        }
    }).children().click(function(e) {
        return false;
    });

    if (localStorage.getItem("__shredz_focus__") !== null) {
      localStorageValue = localStorage.getItem("__shredz_focus__").replace(/['"]+/g, '');
      $("<li class='outer-nav'><a class='outer-title' href='/focus-enhance-your-mind/?type=" + localStorageValue +  "'>SHREDZ FOCUS</a></li>" ).insertAfter( "#mobile-menu-shop" );
    } 
</script>
@append
