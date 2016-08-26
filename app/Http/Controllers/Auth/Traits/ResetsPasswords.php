<?php

namespace App\Http\Controllers\Auth\traits;

use DB;
use Crypt;
use Auth;
use Mail;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\CustomerProfile;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\traits\SupportsAuth;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;

trait ResetsPasswords
{

    protected $emailView = 'emails.password';
    protected $redirectPath = '/settings';

     /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $validator = $this->passwordResetEmailValidator($request->all());
        if($validator->fails()){
            if($request->ajax()){
                return response()->json($validator->errors(), 422);
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $response = $this->sendResetLink($request);
        switch ($response) {
            case Password::RESET_LINK_SENT:
                if($request->ajax()){
                    return response()->json(['success' => 'Your password reset link has been sent.'], 200);
                }
                return redirect()->back();
            case Password::INVALID_USER:
                $message = new MessageBag;
                $message->add('errors', 'This user does not exists.');
                if($request->ajax()){
                    return response()->json($message, 422);
                }
                return redirect()->back()->withErrors($message);
        }
    }

    /**
     * Send a password reset link to a user.
     *
     * @param  array  $credentials
     * @return string
     */
    public function sendResetLink(Request $request)
    {
        $user = $this->getUser($request->all());
         if (is_null($user)) {
            return PasswordBrokerContract::INVALID_USER;
        }
        $token = $this->createToken($request->get('payer_email'));
        $user->remember_token = $token;
        $user->save();
        $fromDomain = $this->fromDomain($request->server('HTTP_REFERER'));
        if(!is_null($fromDomain)){
            $this->emailResetLink($user, $token, $fromDomain);
            return PasswordBrokerContract::RESET_LINK_SENT;
        }
    }

    /**
     * Send the password reset link via e-mail.
     *
     * @param  App\User  $user
     * @param  string  $token
     * @param  \Closure|null  $callback
     * @return int
     */
    public function emailResetLink($user, $token, $fromDomain)
    {
        $view = $this->emailView;
        return Mail::send($view, compact('token', 'user', 'fromDomain'), function($m) use ($user){
            $m->to($user->payer_email)->subject($this->getEmailSubject());
        });
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

     /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }
        $userIdentity = Auth::check() ? Auth::user()->payer_email : \Session::getId();
        $userIdentity = Crypt::encrypt(json_encode($userIdentity));
        $mainUrl = config('app.url');
        $user = User::byRememberToken($token);
        if(!$user->profile){
            $profile = CustomerProfile::create();
            $user->profile()->save($profile);
        }
        $user->verified = 1;
        DB::table('oauth_pending_verify')->where('user_id', $user->id)->delete(); 
        $user->save();
        $email = $user->payer_email;
        return view('auth.reset', compact('token', 'email', 'userIdentity', 'mainUrl'));
    }

     /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $token = $request->input('token');
        $email = $request->input('payer_email');
        $user = User::byEmail($email);

        Validator::extend('token_belongs_to_user', function() use ($token, $email, $user) {
            if($user && $user->remember_token == $token){
                return true;
            }else if($user && $user->remember_token != $token){
                return false;
            }else if(!$user){
                return true;
            }
        });

        $validator = $this->passwordResetTokenValidator($request->all());
        if($validator->fails()){
            if($request->ajax()){
                return response()->json($validator->errors(), 422);
            }
            return redirect()->back()->withErrors($validator->errors());
        }
        $credentials = $request->only(
            'payer_email', 'password', 'password_confirmation', 'token'
        );
        $response = $this->resetPassword($credentials);
        switch ($response) {
            case Password::PASSWORD_RESET:
                $request->session()->flash('successMessage', 'Your password has been changed.');
                return redirect($this->redirectPath());
            default:
                return redirect()->back()->withInput($request->only('payer_email'));
        }
    }

     /**
     * Reset the password for the given token.
     *
     * @param  array  $credentials
     * @return mixed
     */
    public function resetPassword(array $credentials)
    {
        $user = $this->getUser($credentials);
        $user->password = bcrypt($credentials['password']);
        $user->remember_token = $this->createToken($user->payer_email);
        $user->save();
        Auth::login($user);
        return PasswordBrokerContract::PASSWORD_RESET;
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * Get the user for the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\CanResetPassword
     *
     * @throws \UnexpectedValueException
     */
    public function getUser(array $credentials)
    {
        return User::byEmail($credentials['payer_email']);

    }
}
