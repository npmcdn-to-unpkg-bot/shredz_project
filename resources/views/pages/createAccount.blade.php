@extends('themes.default.layout')

@section('content')
    <main class="createAccount">
        <div class="bread">
            <div class="content">
                <p><a href="/">HOME</a> / <b>CREATE PROFILE</b></p>
            </div>
        </div>
        <h1>CREATE AN ACCOUNT</h1>
        <form class="content">
        <div class="alert alert-success success-message-create" role="alert" style="display: none"></div>
        <div class="alert alert-danger error-message" role="alert" style="display: none"></div>
            <section class="inputs">
                <div class="strings">
                    <p>First Name</p>
                    <p id="first_name" style="display:none;"></p> 
                    <input class="input text-input" id="f_name" type="text" required>
                    <p>Last Name</p>
                    <p id="last_name" style="display:none;"></p>
                    <input  class="input text-input" id="l_name" type="text" required>
                    <p>Email Address</p>
                    <p id="email_address" style="display:none;"></p>
                    <input class="input text-input" id="create-email" type="text" required>
                    <p>Password</p>
                    <p id="label_password" style="display:none;"></p>
                    <input class="input text-input" id="pass" type="password" required>
                    <p>Confirm Password</p>
                    <p id="confirm-password" style="display:none;"></p>
                    <input class="input text-input" id="confirm" type="password" required>
                </div><!-- .strings -->
                <div class="numeric">
                    <div class="row">
                        <p>Date of Birth</p><br>
                        <div id="month" class="select number-select"></div>
                        <div id="day" class="select number-select"></div>
                        <div id="year" class="select number-select"></div>
                    </div>
                    <div class="row">
                        <p>Gender</p>
                        <div class="gender">
                            <div class="radio"></div>
                            <p class = "r_label">Male</p>
                            <div class="radio"></div>
                            <p class="r_label">Female</p>
                        </div>
                    </div>
                    <div class="row" id="height">
                        <p>Height</p>
                        <div class="radio"></div><p class="light r_label">Inches</p>
                        <div class="radio"></div><p class="light r_label">Centimeters</p>
                    </div>
                    <div class="row" id="weight">
                        <p>Weight</p>
                        <select class="form-control" id="weight-select" name="weight">
                            <option value="100" selected="selected">< 100</option>
                            <option value="100-150">100-150</option>
                            <option value="150-200">150-200</option>
                            <option value="200-255">200-255</option>
                            <option value="250-300">250-300</option>
                            <option value="300">300 +</option>
                        </select>
                        <select class="form-control" id="weight-select-kg" name="weight">
                            <option value="45" selected="selected">< 45</option>
                            <option value="45-68">45-68</option>
                            <option value="68-91">68-91</option>
                            <option value="91-113">91-113</option>
                            <option value="113-137">113-137</option>
                            <option value="137 +">137 +</option>
                        </select>
                        <div id="lb" class="radio"></div><p class="light r_label">lbs</p>
                        <div id="kg" class="radio"></div><p class="light r_label">kg</p>
                    </div>
                    <div class="row">
                        <p>Fitness Goal(s)</p>
                        <p class="light">Check all that apply</p>
                        <div class="goals">
                            <div class="check radio mult"></div><p class="light r_label">Weight Loss</p>
                            <div class="check radio mult"></div><p class="light r_label " >Energy & Wellness</p><br>
                            <div style="margin-left: 0;" class="check radio "></div><p class="light r_label">Burn Fat & Build Muscle</p>
                            <div class="check radio mult"></div><p class="light r_label">Endurance & Wellness</p>
                        </div>
                    </div>
                </div><!-- .numeric -->


            </section>

            <button id="signup" onclick="return false;">SIGN UP</button>
        </form>

    </main>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/pages/createAccount.js')}}"></script>
@append
