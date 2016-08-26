<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Mail;
use App\User;
use Validator;
use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Auth\Traits\SupportsAuth;
use App\Http\Controllers\Auth\Traits\VerifiesUser;
use App\Http\Controllers\Auth\Traits\RegistersUser;
use App\Http\Controllers\Auth\Traits\AuthenticatesUser;
use App\Http\Controllers\Auth\Traits\AuthenticatesOauth2;

class AuthController extends BaseController
{


    use AuthenticatesUser, RegistersUser, VerifiesUser, SupportsAuth, ThrottlesLogins, AuthenticatesOauth2;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getVerifyEmail', 'resendVerifyEmailWhenLogggedIn', 'verifyOauthCredentials']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registerValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:customers,payer_email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            // 'date_of_birth' => 'required',
            // 'height' => 'required',
            // 'weight' => 'required'
        ]);
    }

     /**
     * Get a validator for verifying the email
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function verifyEmailValidator(array $data)
    {
        Validator::extend('token_belongs_to_user', function($param, $value) use ($data){
            $user = User::where('payer_email', $data['payer_email'])->first();
            return $user->verify_token == $value;
        });
        return Validator::make($data, [
            'payer_email' => 'required|email|exists:customers',
            'verify_token' => 'required|exists:customers|token_belongs_to_user'
        ]);
    }

    /**
     * Get a validator for an incoming login request
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function loginValidator(array $data)
    {
        return Validator::make($data, [
            'payer_email' => 'required|is_verified',
            'password' => 'required'
        ], [
            'payer_email.is_verified' => 'unverified'
        ]);
    }

    /**
     * Get a validator instance when a user submits Oauth verification credentials
     * @param array $data
     * @return Validator
     */
    public function oauthCredentialsValidator(array $data)
    {
        $currentUser = Auth::user();
        Validator::extend('unique_email', function($param, $value) use ($currentUser) {

            $usersWithEmail = User::where($param, $value)->get();
            $withEmailExcludingCurrentUser = $usersWithEmail->filter(function($user) use ($currentUser) {
                return $user->id != $currentUser->id;
            });

            if($withEmailExcludingCurrentUser->count()){
                return false;
            }else{
                return true;
            }
        });
        return Validator::make($data, [
            'payer_email' => 'required|unique_email|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[
            'payer_email.unique_email' => 'The email address has already been taken.'
        ]);
    }

    /**
     * Get a validator instance when a user submits Oauth verification credentials
     * @param array $data
     * @return Validator
     */
    public function oauthCredentialsValidatorNoEmail(array $data)
    {
        return Validator::make($data, [
            'payer_email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
