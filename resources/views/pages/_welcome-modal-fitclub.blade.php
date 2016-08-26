<div id="welcome-modal" class="modal fade login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="sign-in">
               <div class="modal-body">
                  <div class="welcome-wrapper">
                     <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                      <div class="alert alert-success success-message-create" role="alert" style="display: none"></div>
                      <div class="alert alert-danger error-message error-list-login" role="alert" style="display: none"></div>
                    </div>
                  <div class="row">
                   
                    <div class="col-xs-12 col-sm-6">
                      @if(Auth::user()->profile()->first()->avatar)
                        <img class="img-responsive" style="margin:0 auto; margin-bottom: 20px;" src="{{Auth::user()->profile()->first()->avatar}}">
                      @elseif(Auth::user()->profile()->first()->oauth_avatar)
                        <img class="img-responsive" style="margin:0 auto; margin-bottom: 20px;" src="{{Auth::user()->profile()->first()->oauth_avatar}}">  
                      @else
                      <i class="fa fa-user"></i>
                      @endif
                      <h3>Welcome <span class="username">@if(Auth::user()->payer_email) {{Auth::user()->first_name}} @endif</span></h3>
                      <p>One last step to get you started. Let’s create your SHREDZ account </p>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                      <form class="login-form" novalidate>
                        @if(Auth::user()->payer_email)
                        <input class="login_input username" id="create_email" name="payer_email" type="text" value="{{Auth::user()->payer_email}}" placeholder="Email" style="display:none">
                        @else
                        <input class="login_input username" id="create_email" name="payer_email" type="text" placeholder="Email">
                        @endif
                        <input class="login_input password" id="pass" name="password" type="password" placeholder="Password">
                        <input class="login_input password" id="confirm" name="password_confirm" type="password" placeholder="Confirm Password">
                        <button type="submit" class="btn-login" id="social-signup">CREATE ACCOUNT</button>
                      </form>
                    </div>
                  </div>
                  </div>
              </div>
            </div>            
        </div>
    </div>
</div>