<div id="success-modal" class="modal fade login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="sign-in">
     
              <div class="modal-body">
                <div class="alert alert-danger error-list" role="alert" style="display: none"></div>
                <div class="alert alert-success success-message-create" role="alert" style="display: none"></div>
                  <div class="welcome-wrapper">
                  <div class="row">
                    <div class="col-xs-12">
                      <h3 class="text-center">@if(Auth::user()->payer_email) {{Auth::user()->first_name}} @endif</h3>
                      <i class="icon icon-check"></i>
                    </div>
                    <div>
                      <p>Your user profile has been created. We sent you a confirmation e-mail, please check your e-mail and click on the link to confirm your SHREDZ account </p>
                      <p class="you-have-not">You have not verified your email. Please check your inbox and follow the verification steps. Can't find the email? <a class="resend-email" href="{{Auth::user()->payer_email}}" data-url="@if(Auth::check()) /email/sendverifyloggedin/ @else /email/sendverify @endif">Click here to resend</a>.</p>
                      <p class="resend-email-message" style="display:none;"></p>
                    </div>
                  </div>
                  </div>
              </div>
            </div>            
        </div>
    </div>
</div>

