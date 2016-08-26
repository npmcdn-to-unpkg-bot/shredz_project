<footer class="mobile-footer visible-xs">
  <section class="disclaimer">
    STATEMENTS ON THIS SITE HAVE NOT BEEN EVALUATED BY THE FDA. PRODUCTS LISTED ARE NOT INTENDED TO DIAGNOSE, TREAT, CURE, OR PREVENT ANY DISEASE.
  </section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <nav class="navbar navbar-inverse products">
          <div class="navbar-header">
            <a class="navbar-brand">products</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".prod">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
          </div>

          <div class="prod collapse">
            <div class="navbar-header navbar-right">
              <p class="navbar-text">
                <a href="{{ route('shop', ['#weight-loss-supplements']) }}" class="navbar-link">Supplements</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('shop', ['#e-books']) }}" class="navbar-link">Diet &amp; Workout Plans</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('shop', ['#looks+stringers+t-shirts+tanktops+tops']) }}" class="navbar-link">Apparel</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('shop', ['#accessories']) }}" class="navbar-link">Accessories</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('shop', ['#health-wellness+weight-loss-supplements']) }}" class="navbar-link">Nutrition</a>
              </p>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-xs-12">
        <nav class="navbar navbar-inverse featured">
          <div class="navbar-header">
            <a class="navbar-brand">featured</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".feat">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
          </div>
          <div class="feat collapse">
            <div class="navbar-header navbar-right">
              <p class="navbar-text">
                <a href="{{ route('shop', ['#sale']) }}" class="navbar-link">Sale</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('shop', ['#under-75']) }}" class="navbar-link">Under $75</a>
              </p>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-xs-12">
        <nav class="navbar navbar-inverse support">
          <div class="navbar-header">
            <a class="navbar-brand">support</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".supp">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
          </div>
          <div class="supp collapse">
            <div class="navbar-header navbar-right">
              <p class="navbar-text">
                <!-- <a href="#" class="navbar-link">Chat With Us</a> -->
              </p>
              <p class="navbar-text">
                <a href="{{ route('help') }}" class="navbar-link">Customer Service</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('help') }}" class="navbar-link">Shipping</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('help') }}" class="navbar-link">FAQ</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('help') }}" class="navbar-link">Send Us Email</a>
              </p>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-xs-12">
        <nav class="navbar navbar-inverse company-info">
          <div class="navbar-header">
            <a class="navbar-brand">company info</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".info">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
          </div>

          <div class="info collapse">
            <div class="navbar-header navbar-right">
              <p class="navbar-text">
                <a href="{{ route('about') }}" class="navbar-link">About Us</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('careers') }}" class="navbar-link">Careers</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('termsAndConditions') }}" class="navbar-link">Terms of Use</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('privacyPolicy') }}" class="navbar-link">Privacy Policy</a>
              </p>
              <p class="navbar-text">
                <a href="{{ route('returnPolicy') }}" class="navbar-link">Return Policy</a>
              </p>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <section class="main-footer">
    <section class="copyright">
      <ul class="list-inline social-networks">
        <li>
          <a href="https://www.instagram.com/shredz/" target="_blank">
            <i class="fa fa-instagram"></i>
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/ShredzSupplements/" target="_blank">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <li>
          <a href="https://twitter.com/shredzarmy" target="_blank">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
        <li>
          <a href="https://www.youtube.com/user/shredztv" target="_blank">
            <i class="fa fa-youtube"></i>
          </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/company/shredz-supplements" target="_blank">
                <i class="fa fa-linkedin"></i>
            </a>
        </li>
        <li>
            <a href="https://www.pinterest.com/shredzarmy/" target="_blank">
                <i class="fa fa-pinterest"></i>
            </a>
        </li>
        <li>
            <a href="http://shredzsupplements.tumblr.com/" target="_blank">
                <i class="fa fa-tumblr"></i>
            </a>
        </li>
      </ul>
      <p class="hidden-xs">*STATEMENTS ON THIS SITE HAVE NOT BEEN EVALUATED BY THE FDA. PRODUCTS LISTED ARE NOT INTENDED TO DIAGNOSE, TREAT, CURE, OR PREVENT ANY DISEASE. </p><br />
      <ul class="list-inline mobile-footer">
        <li style="color: #777777"><span class="icon"><img src="{{ asset('images/flag-icon.png') }}"></span>&nbsp;United States</li>
        <li class="border-left-desktop" style="color: #777777">Copyright &copy; 2016 SHREDZ® Supplements</li>
        <li class="border-left-desktop" style="color: #777777">All Rights Reserved</li>
      </ul>
      <!-- <p><img src="{{ asset('images/united-states-flag-icon.png') }}"/>United States   © 2015 SHREDZ Supplements. All Rights Reserved</p> -->
    </section>
    <!-- <button class="live-chat">LIVE CHAT</button> -->
  </section>
</footer>