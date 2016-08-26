@extends('themes.default.layout')

@section('content')
    <main class="settings">
        <div class="bread">
            <div class="content">
                <p><a href="/">HOME</a> / <b>ACCOUNT</b></p>
            </div>
        </div>
    <div class="content">
        @include('includes.settings-nav')
        <div class="pages">
            <div class="account">
                @if(session('successMessage'))
                    <div class="alert alert-success success-message-create" role="alert">{{ session('successMessage') }}</div>
                @endif
                <div class="alert alert-success success-message-create" role="alert" style="display: none"><span></span></div>
                <div class="alert alert-danger danger-message-create" role="alert" style="display: none"><span></span></div>
                <a href="/settings" class="active tab">Account <span class="hidden-xs">information</span></a><a href="/settings/payments" class="tab">Payment <span class="hidden-xs">information</span></a><a href="/settings/addresses" class="tab"><span class="hidden-xs">Address information</span><span class="visible-xs">Addresses</span></a>
                <div class="account-info">
                    <div class="account-box">
                        <h5>Costumer Information</h5>
                        <div>
                            <input id="first_name" placeholder="First Name" type="text"  value="{{$user['first_name']}}">
                        </div>
                        <div>
                            <input id="last_name" placeholder="Last Name" type="text" value="{{$user['last_name']}}">
                        </div>
                        <div>
                            <input id="payer_email" readonly="readonly" placeholder="Email" type="text"  value="{{$user['payer_email']}}">
                        </div>
                        <div>
                            <input id="contact_phone" placeholder="Contact Phone" type="text" value="{{$user['contact_phone']}}">
                        </div>
                    </div>
                    <div class="account-box">
                       <span class="date">
                        <input type="text" name="date_of_birth" id="date_of_birth" placeholder="Birthday" value="{{$user['date_of_birth']}}" />
                       </span>
                        <span class="gender">
                          <div>Gender</div>
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default @if($user->profile['gender']=='M') active @endif">
                              <input type="radio" name="gender" value="M" @if($user->profile['gender']=='M') checked="checked" @endif /> Male
                            </label>
                            <label class="btn btn-default @if($user->profile['gender']=='F') active @endif">
                              <input type="radio" name="gender" value="F" @if($user->profile['gender']=='F') checked="checked" @endif/> Female
                            </label>
                          </div>
                       
                       </span>
                       
                   </div>
                    <div class="account-box pass">
                        <h5>Login Credentials</h5>
                        <div>
                            <input id="current_password" placeholder="Current Password" type="password"  value="">
                        </div>
                        <div>
                            <input id="new_password" placeholder="New Password" type="password"  value="">
                        </div>
                        <div>
                            <input id="confirm_new_password" placeholder="Confirm New Password" type="password"  value="">
                        </div>
                    </div>
                    <div class="account-box" style="display:none;">
                        <h5>New email</h5>
                        <div>
                            <input id="new_email" placeholder="New Email" type="text"  value="">
                        </div>
                        <div>
                            <input id="confirm_new_email" placeholder="Confirm New Email" type="text" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" value="">
                        </div>
                        <!-- <p>When you change your email you will be redirected.</p> -->
                    </div>
                    <div class="action">
                        <button class="change-details-btn">Change Details</button>
                        <button class="change-email-btn">Change E-mail</button>
                        <button class="save" value="change-details">SAVE CHANGES</button>
                    </div>
                </div>
            </div><!-- pages -->
            <div class="overlay" style="display:none;"><img src="{{ asset('images/small-loading.gif') }}" ></div>
        </div><!-- content -->
    </main>
    @stop

@section('scripts')

<script rel="script" type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script rel="script" type="text/javascript" src="{{asset('js/pages/editAccountInformation.js')}}"></script>
@append