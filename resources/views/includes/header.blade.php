@inject('api', 'App\Tools\ShredzAPI')
@inject('store', 'App\Http\Components\Store')
@inject('menu', 'App\Http\Components\Menu')
<div class="nav-ribbon clearfix">
  <div class="container-extra">
    <div class="left">
      <img class="phone" src="{{ asset('images/call_icon.png') }}">
      <a href="tel:(908) 514-4546">
        <p>(908) 514-4546</p>
      </a>
      <a data-toggle="modal" data-target="#military-discount-modal"><img class="military" src="{{ asset('images/military-icon.png') }}">
        <p class="military">Military Discount</p>
      </a>
    </div>
    <!-- left -->
    <div class="right hidden-xs">
      <a href="{{ url('help') }}">
        <p>QUESTIONS?</p>
      </a>
      @if(!Auth::check())
      <a class="open-sign-in" data-toggle="modal" data-target="#login-modal">
        <p class="auth-login">LOGIN</p>
      </a>
      <a class="open-sign-up" data-toggle="modal" data-target="#login-modal">
        <p>REGISTER</p>
      </a>
      @else
      <a href="{{ url('auth/logout') }}">
        <p>LOGOUT</p>
      </a>
      <a href="{{ url('settings') }}">
        <p>PROFILE</p>
      </a>
      @endif
    </div>
    <!-- right -->
  </div>
</div>
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
<div class="nav-menu desktop clearfix">
  <div class="container-extra">
    <div class="logo">
      <span id="desktop-logo"></span>
      <a href="{{ url('/') }}"><img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/header/shredz-logo.png"></a>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
      <script type="text/javascript">
      var localStrorageForHomePageExist = loadDataFromLocalStorage();
      if(localStrorageForHomePageExist == 'home'){
      $("#desktop-logo").append('<a href="{{ url('/home') }}"><img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/header/shredz-logo.png"></a>')
      }
      else{
      $("#desktop-logo").append('<a href="{{ url('/') }}"><img src="https://s3.amazonaws.com/SHREDZ-SITE/SHREDZ.COM/images/header/shredz-logo.png"></a>')
      }
      </script> -->
    </div>
    <div class="cart">
      <div id="cart_info_holder">
        <a class="cart-external-link" href="{{ $api->getBaseUrl() }}/cart" target="cart">
          <span>VIEW CART</span>
          <div class="cart_icon">
            <p class="cart-quantity"><i class="fa fa-spinner fa-spin"></i></p>
          </div>
          <!--<p>CART / <span id="cartTotal">-</span></p>-->
        </a>
      </div>
    </div>
    <ul class="main-menu">
      <li id="desktop-menu"><a href="{{ url('/') }}">Home</a></li>
      <!--  <script type="text/javascript">
      var localStrorageForHomePageExist = loadDataFromLocalStorage();
      if(localStrorageForHomePageExist == 'home'){
      $("li#desktop-menu").append('<a href="{{ url('/home') }}">Home</a>')
      }
      else{
      $("li#desktop-menu").append('<a href="{{ url('/') }}">Home</a>')
      }
      </script> -->
      <li class="has-megamenu men" id="menu-shop">
        <a class="" href="{{ url('shop') }}/#">shop</i></a>
        <div class="container-megamenu">
          <div class="megamenu movement">
            <div class="">
              <div class=" menu-row text-center">
                <div class="first-row-movement-menu">
                  <ul class="">
                    <li class="nav-icon supplements">
                      <a href="{{ route('shop', ['#weight-loss-supplements+recovery+health-wellness+build-muscle']) }}"><span class="vertical-middle-first-row-movement-menu find-height">Supplements</span></a>
                    </li>
                    <li class="nav-icon performance">
                      <a href="{{ route('shop', ['#performance']) }}"><span class="vertical-middle-first-row-movement-menu find-height">Performance</span></a>
                    </li>
                    <li class="nav-icon ebook_meal">
                      <a href="{{ route('shop', ['#meal-plan']) }}"><span class="vertical-middle-first-row-movement-menu find-height">4 Week Shred</span></a>
                    </li>
                    <li class="nav-icon shirt">
                      <a href="{{ route('shop', ['#accessories+bottoms+looks+stringers+t-shirts+tanktops+tops']) }}"><span class="vertical-middle-first-row-movement-menu find-height">Apparel</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- Apparel Button -->
      <li><a href="{{ url('results') }}">Success Stories</a></li>
      <li><a href="{{ url('fitclub-signup') }}">Fit Club</a></li>
      <li><a href="{{ url('blog') }}">Articles & Videos</a></li>
    </ul>
  </div>
</div>
@section('modals')
{{-- military discount modal --}}
<div id="military-discount-modal" class="modal fade military-discount-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button class="close" data-dismiss="modal">x</button>
        <h2>MILITARY DISCOUNTS</h2>
        <p>
          We would like to extend a gesture of gratitude to the men and women who serve or who have served in the United States Military. <strong>To say thanks, we have made discounts available ranging from 10-30% off the MSRP.*</strong>
        </p>
        <p>
          Please call us at <span class="male">(908) 514-4546</span> and one of our customer service representatives will validate, process, and approve your order at the discounted rate!
        </p>
        <p class="separate_p">
          * If you are shipping your order to an APO/FPO/DPO address, an active duty military serviceperson, or veteran, you qualify for a discount.
        </p>
      </div>
    </div>
  </div>
</div>
@if(!Auth::user())
{{-- login modal --}}
<div id="login-modal" class="modal fade login-modal" role="dialog">
  <div id="overlay" style="display:none;">
    <i class="fa fa-spinner fa-spin spin-big"></i>
  </div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="sign-in">
        <div class="modal-header">
          {{-- <button class="close close-button" data-dismiss="modal">x</button> --}}
        </div>
        <div class="modal-body">
          <div class="alert alert-success success-message-create" role="alert" style="display: none"></div>
          <div class="alert alert-danger error-message error-list-login" role="alert" style="display: none"></div>
          <div class="top-tab" id="topTab">
            <ul>
              <li id="tabSignIn" class="active">SIGN IN<i class="fa fa-caret-down" aria-hidden="true"></i>
              </li>
              <li id="tabSignUp">SIGN UP<i class="fa fa-caret-down" aria-hidden="true"></i>
              </li>
            </ul>
          </div>
          <div class="login-wrapper">
            <div id="signInContent" class="row">
              <div class="col-xs-12 col-sm-6">
                <form id="login-form" class="login-form" action="{{ url('auth/login') }}" method="POST" novalidate>
                  <p class="form-error signin-form-error" style="display:none;"></p>
                  <input class="login_input username" id="username" name="payer_email" type="text" placeholder="Email">
                  <p id="payer_email" class="form-error" style="display:none;"></p>
                  <div class="container-password">
                    <input class="login_input password" id="password" name="password" type="password" placeholder="Password">
                    <i class="fa fa-eye show-password" aria-hidden="true"></i>
                    <p id="pass" class="form-error" style="display:none;"></p>
                  </div>
                  <p data-dismiss="modal" data-toggle="modal" data-target="#forgot-pass-modal" class="forgot_password_text">Forgot Password?</p>
                  <button type="submit" class="signin" id="login">SIGN IN</button>
                </form>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="hidden-sm hidden-lg hidden-md or"><span>or</span></div>
                <ul class="social-login">
                  <li class="login-facebook"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/facebook/authorize/' . $userIdentity) }}"><i class="fa fa-facebook" aria-hidden="true"></i><span>Sign in with Facebook</span></a></li>
                  <li class="login-google"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/google/authorize/' . $userIdentity) }}"><i class="fa fa-google" aria-hidden="true"></i><span>Sign in with Google</span></a></li>
                  <li class="login-fitbit"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/fitbit/authorize/' . $userIdentity) }}"><i class="icon icon-fitbit" aria-hidden="true"></i><span>Sign in with Fitbit</span></a></li>
                  <li class="login-underarmour"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/underarmour/authorize/' . $userIdentity) }}"><i class="icon icon-underarmour" aria-hidden="true"></i><span>Sign in with Under Armour</span></a></li>
                </ul>
              </div>
            </div>
            <div id="signUpContent" class="row load-hidden">
              <div class="col-xs-12 col-sm-6">
                <form class="login-form" action="{{ url('auth/register') }}" method="POST" novalidate>
                  <input class="login_input username" id="f_name" name="first_name" type="text" placeholder="First name">
                  <p id="first_name" class="form-error" style="display:none;"></p>
                  <input class="login_input username" id="l_name" name="last_name" type="text" placeholder="Last name">
                  <p id="last_name" class="form-error" style="display:none;"></p>
                  <input class="login_input username" id="create-email" name="payer_email" type="text" placeholder="Email">
                  <p id="email_address" class="form-error" style="display:none;"></p>
                  <div class="container-password">
                    <input class="login_input password" id="pass" name="password" type="password" placeholder="Password">
                    <i class="fa fa-eye show-password" aria-hidden="true"></i>
                  </div>
                  <p id="label_password" class="form-error" style="display:none;"></p>
                  <div class="container-password">
                    <input class="login_input password" id="confirm" name="confirm_password" type="password" placeholder="Confirm Password">
                    <i class="fa fa-eye show-password" aria-hidden="true"></i>
                  </div>
                  <p id="confirm-password" class="form-error" style="display:none;"></p>
                  <button type="submit" class="signin" id="signup">SIGN UP</button>
                </form>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="hidden-sm hidden-lg hidden-md or"><span>or</span></div>
                <ul class="social-login">
                  <li class="login-facebook"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/facebook/authorize/' . $userIdentity) }}"><i class="fa fa-facebook" aria-hidden="true"></i><span>Sign up with Facebook</span></a></li>
                  <li class="login-google"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/google/authorize/' . $userIdentity) }}"><i class="fa fa-google" aria-hidden="true"></i><span>Sign up with Google</span></a></li>
                  <li class="login-fitbit"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/fitbit/authorize/' . $userIdentity) }}"><i class="icon icon-fitbit" aria-hidden="true"></i><span>Sign up with Fitbit</span></a></li>
                  <li class="login-underarmour"><a style="color:white;" href="{{ url($mainUrl .'/oauth2/underarmour/authorize/' . $userIdentity) }}"><i class="icon icon-underarmour" aria-hidden="true"></i><span>Sign up with Under Armour</span></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="signUpSuccess" class="success-wrapper" style="display: none;">
            <div class="welcome-wrapper">
              <div class="row">
                <div class="col-xs-12">
                  <h3 class="text-center"></h3>
                  <i class="icon icon-check"></i>
                </div>
                <div>
                  <p>Your user profile has been created. We sent you a confirmation e-mail, please check your e-mail and click on the link to confirm your SHREDZ account </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@if(Auth::check())
  @if(Auth::user()->auth_type == "fitbit")
    @if(!Auth::user()->verified && Auth::user()->password)
      @include('pages._success-modal-fitclub')
    @elseif(Auth::user()->verified && !Auth::user()->password)
      @include('pages._welcome-modal-fitclub')
    @elseif(Auth::user()->verified && Auth::user()->password)
    @else
      @include('pages._success-modal-fitclub')
      @include('pages._welcome-modal-fitclub')
    @endif
  @else
    @if(!Auth::user()->password)
      @include('pages._welcome-modal-fitclub')
    @endif
  @endif
@endif
{{-- forgot pass modal --}}
<div id="forgot-pass-modal" class="modal fade forgot-pass-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{ asset('/images/logInHeader.png') }}" class="img-responsive">
        <button class="close close-button" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger forgot-pass-error" role="alert" style="display: none"></div>
        <div class="alert alert-success forgot-pass-success" role="alert" style="display: none"></div>
        <form action="{{ url('password/email') }}" id="forgot_password_form" method="POST" novalidate>
          <input type="email" placeholder="Email Address" name="payer_email">
          <button type="submit" id="forgot_my_pass_button" class="reset-button">RESET PASSWORD</button>
        </form>
      </div>
    </div>
  </div>
</div>
@append
@section('scripts')
<script>
!(function (window, undefined) {
var $ = window.jQuery || window.$ || {};
var $cart = ShredzAPI.CartFactory.make();
var _showMenuTimeout, _hideMenuTimeout;
// Define a jquery helper fucntion for determining
// if an element is found on  screen
$.fn.isOnScreen = function() {
var win = $(window);
var viewport = {
top: win.scrollTop(),
left: win.scrollLeft()
};
viewport.right = viewport.left + win.width();
viewport.bottom = viewport.top + win.height();
var bounds = this.offset();
bounds.right = bounds.left + this.outerWidth();
bounds.bottom = bounds.top + this.outerHeight();
return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};
function onPasswordResetSuccess(data){
if (data.success) {
$("input[name='password']").val("");
$('#forgot-pass-modal .forgot-pass-error').hide();
$('#forgot-pass-modal .forgot-pass-success').html('<p>' + data.success + '</p>')
$("#forgot-pass-modal .forgot-pass-success").show();
}
hideOverlay();
}
/**
* When login succeeds
* Redirect user to their profile page
* @param  object   data    Data payload
* @return void
*/
function onLoginSuccess(data) {
if (data.success) {
$('.success-message').html('<p>' + data.success + '</p>');
$('.error-list-login').hide();
$('.success-message').show();
$("input[name='payer_email']").val("");
$("input[name='password']").val("");
if(data.loginType == "auth"){
  window.location.reload();
}
// window.location.href = {!! json_encode(url('/settings')) !!};
}
hideOverlay();
}
/**
* When login fails
* Show error messages
* @param  object   error   Error response object
* @return void
*/
function onLoginFailed(error) {
var parsed = window.JSON.parse(error.responseText);
var email = $("#login-modal #username").val();
if ($.inArray('unverified', parsed.payer_email) > -1) {
var errorList = '<p class="you-have-not">You have not verified your email. Please check your inbox and follow the verification steps. Can\'t find the email? <a class="resend-email" href="'+email+'" data-url="@if(Auth::check()) /email/sendverifyloggedin/ @else /email/sendverify @endif">Click here to resend</a>.</p><p class="resend-email-message" style="display:none;"></p>';
$('#login-modal .error-list-login').html(errorList).show();

$(".resend-email").on("click", onResendPasswordLinkClicked);

hideOverlay();
return false;
}
if(Object.keys(parsed).length > 0){
if(parsed['payer_email']){
$("#signInContent #payer_email").show().text(parsed.payer_email);
$("#forgot-pass-modal .forgot-pass-error").show().text(parsed.payer_email);
$('#forgot-pass-modal .forgot-pass-success').hide();
}
else{
$("#signInContent #payer_email").hide();
$("#forgot-pass-modal .forgot-pass-error").hide();
}
if(parsed['password']){
$("#signInContent #pass").show().text(parsed.password);
}
else{
$("#signInContent #pass").hide();
}
if(parsed['errors']){
$("#signInContent .signin-form-error").show().text(parsed['errors']);
}
else{
$("#signInContent .signin-form-error").hide();
}
}
hideOverlay();
}
function showOverlay(){
$("#overlay").show();
}
function hideOverlay(){
$("#overlay").hide();
}
/**
* When a login form is submitted
* @param  Event    e
* @preventDefault
* @return void
*/
function onLoginFormSubmit(e) {
showOverlay();
var $form = $(this);
var url = $form.prop('action');
var method = 'POST';
var formData = {
payer_email: $form.find('input[name=payer_email]').val().trim(),
password: $form.find('input[name=password]').val()
};
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url: url,
type: method,
data: formData
})
.done(function(data){
if($form.attr('id') != "forgot_password_form"){
onLoginSuccess(data);
} else{
onPasswordResetSuccess(data);
}
})
.fail(onLoginFailed);
if (e && e.preventDefault) {
e.preventDefault();
e.returnValue = false;
}
}

function onResendPasswordLinkClicked(e) {
showOverlay();
var $form = $(this);
var url = $(this).data('url');
var method = 'POST';
var email = {'email' : $(".resend-email").attr('href')};
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url: url,
type: method,
data: email
})
.done(function(data){
  $("p.you-have-not").hide();
  $(".resend-email-message").parents('.error-message.error-list-login').removeClass("alert-danger ");
  $(".resend-email-message").addClass('alert-success').text(data.message).show();
  hideOverlay();
})
.fail(hideOverlay);
if (e && e.preventDefault) {
e.preventDefault();
e.returnValue = false;
}
}
/**
* Show login modal
* @return void
*/
function showLoginModal () {
hideModalMessages();
$("input[name='payer_email']").val("");
$("input[name='password']").val("");
}
/**
* Hide login modal message
* @return void
*/
function hideModalMessages() {
$('.error-list-login').hide();
$('.success-message').hide();
}
/**
* Initialize the fixed header
* @return void
*/
function initFixedHeader() {
var $header = $('header');
var $ribbon = $('.nav-ribbon');
$(window).on("scroll", function() {
if ($ribbon.isOnScreen()) {
$header.removeClass("affixed");
}
else {
$header.addClass("affixed");
}
});
}
/**
* Activate a menu item
* Starts a timer when entering a megamenu to automatically open it
* @return void
*/
function activateMenu(elm, delayed) {
var $active = $('ul.main-menu > li.active');
var $elm = $(elm);
delayed = typeof delayed === 'undefined' ? !$active.length : delayed;
clearTimeout(_showMenuTimeout);
clearTimeout(_hideMenuTimeout);
if ($elm.hasClass('show-megamenu')) {
$elm
.removeClass('show-megamenu')
.removeClass('active');
}
else {
$active
.removeClass('show-megamenu')
.removeClass('active');
$elm.addClass('active');
if (delayed) {
_showMenuTimeout = setTimeout(function () {
$elm.addClass('show-megamenu');
}, 100);
} else {
$elm.addClass('show-megamenu');
}
}
}
/**
* When the mouse enters a menu item
* Activate the menu to highlight it and open the dropdown when necesary
* @param  Event    e
* @return void
*/
function onMenuMouseEnter(e) {
if (!$.contains($(this).find('.megamenu'), e.target)) {
activateMenu(this);
}
}
/**
* When a menu item is clicked
* Opens dropdown if current menu is a megamenu
* @param  Event    e
* @return void
*/
// function onMenuClicked(e) {
//   if ((e.target.parentNode === this) && e && e.preventDefault) {
//     activateMenu(this, false);
//     e.preventDefault();
//     e.returnValue = false;
//   }
//   else {
//     $('ul.main-menu > li.active')
//     .removeClass('show-megamenu')
//     .removeClass('active');
//   }
// }
/**
* When the mouse leaves a menu item
* Starts a timer when leaving a megamenu to automatically close it
* @param  Event    e
* @return void
*/
function onMenuMouseLeave(e) {
var $elm = $(this);
clearTimeout(_showMenuTimeout);
clearTimeout(_hideMenuTimeout);
if ($elm.hasClass('show-megamenu')) {
_hideMenuTimeout = setTimeout(function() {
$elm
.removeClass('show-megamenu')
.removeClass('active');
}, 200);
} else {
$elm
.removeClass('show-megamenu')
.removeClass('active');
}
}
/**
* When the cart link is clicked
* Opens a new window to show the cart
* @param  Event    e
* @return void
*/
function onCartLinkClicked(e) {
var $this = $(this);
var cartWindow = window.open($this.attr('href'), 'cart');
cartWindow.focus();
e && e.preventDefault && e.preventDefault();
}
/**
* When the window is activated
* Resync cart and set the cart item quantity
* @param  Event    e
* @return void
*/
function onWindowActivated(e) {
var $cartQuantity = $(".cart-quantity");
$cart
.sync()
.promise()
.then(function () {
$cartQuantity.html($cart.details().itemCount);
applyCampaignCoupons();
});
}
/**
* Bind the events related to the login modal
* @return void
*/
function bindModalEvents() {
// console.log('bindModalEvents');
$('#login-form, #forgot_password_form').on('submit', onLoginFormSubmit);
$('#login-modal').on('show.bs.modal', hideModalMessages);
$(".resend-email").on("click", onResendPasswordLinkClicked);
}
/**
* Bind the events related to the menu
* @return void
*/
function bindMenuEvents() {
$('a.cart-external-link').on('click', onCartLinkClicked);
$(window).on('focus', onWindowActivated);
$('ul.main-menu')
.on('mouseenter', '> li:not(.active)', onMenuMouseEnter)
.on('mouseleave', '> li.active', onMenuMouseLeave)
// .on('click', '> li.has-megamenu', onMenuClicked);
//show modal when they click the login header link and the  cart login page
$('.auth-login', '#login_text').on('click', showLoginModal);
$('.forgot_password_text').on('click', hideModalMessages);
}
/**
* !! HACK !!
* Grab copon code from the URL
* This will work wether or not the coupon is on the query or the hash
* @return string
*/
function grabCouponsFromUrl() {
var queries = document.location.search.length && document.location.search.replace(/^\?(.*)/, '$1').split('&') || [];
var hashes = document.location.hash.length && document.location.hash.split('?') || [];
if (hashes.length > 1) {
hashes = hashes[1].split('&');
hashes.unshift(0);
hashes.unshift(queries.length);
queries.splice.apply(queries, hashes);
}
for (var keyVal, i = 0, l = queries.length; i < l; i++) {
keyVal = queries[i].split('=');
if ('coupon' === keyVal[0]) {
return keyVal[1];
}
}
}
function applyCampaignCoupons() {
var coupon = grabCouponsFromUrl();
if (coupon) {
$cart.addCoupon(coupon);
}
}
/**
* Bootstrap the module
* @return void
*/
function boot() {
// initFixedHeader();
bindMenuEvents();
bindModalEvents();
onWindowActivated();

// $('#openLogin').click();
$('#welcome-modal').modal('show');
$('#success-modal').modal('show');
$('.show-password').click(function(){
var inputField = $(this).prev();
if (inputField.attr('type') == 'password') {
inputField.prop('type', 'text');
$(this).addClass('active');
} else if (inputField.attr('type') == 'text') {
inputField.prop('type', 'password');
$(this).removeClass('active');
}
})

var openSignUp = function(){
  $("#login-modal").removeClass('success-modal');
  $("#signUpContent").show();
  $('#tabSignUp').addClass('active');
  $('#tabSignIn').removeClass('active');
  $("#signInContent").hide();
  $('.form-error').hide();
  $(".login-wrapper, .top-tab").show();
}
var openSignIn = function(){
    $("#login-modal").removeClass('success-modal');
    $("#signUpContent").hide();
    $('#tabSignUp').removeClass('active');
    $('#tabSignIn').addClass('active');
    $("#signInContent").show();
    $('.form-error').hide();
    $(".login-wrapper, .top-tab").show();
}
$('#tabSignUp, .open-sign-up, #openRegister').click(function(){
  openSignUp();
})
$('#tabSignIn, .open-sign-in').click(function(){
  openSignIn();
})


function getUrlVar(key){
  var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
  return result && unescape(result[1]) || "";
}

(function($){
  $.getUrlVar = function(key){
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
    return result && unescape(result[1]) || "";
  };
  if (getUrlVar("action") == "signin"){
    $("#login-modal").modal('show')
    openSignIn();
  } else if (getUrlVar("action") == "signup") {
    $("#login-modal").modal('show')
    openSignUp();
  }
})(jQuery);

if(window.location.hash == "#_=_"){
  window.location.hash="";
}
}
// INITALIZATION
boot();
})(window);

</script>
@if(!App::environment('production'))
<script type="text/javascript" src="{{asset('js/pages/createAccount.js')}}"></script>
@else
<script type="text/javascript" src="{{asset('js/pages/createAccount.min.js')}}"></script>
@endif
@append
@section('dev-scripts')
<script>
var storeMeta = {!! json_encode($store->meta()) !!};
var storeAssets = {!! json_encode($store->assets()) !!};
console.log('%c Store Meta: ', 'font-weight: bold', storeMeta);
console.log('%c Store Assets: ', 'font-weight: bold', storeAssets);
</script>
@append
