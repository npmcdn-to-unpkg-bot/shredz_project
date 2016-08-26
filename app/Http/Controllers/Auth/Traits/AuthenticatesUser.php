<?php 

namespace App\Http\Controllers\Auth\traits;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

trait AuthenticatesUser
{

	/**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        Validator::extend('is_verified', function() use ($request){
            $user = User::byEmail($request->input('payer_email'));
            if($user){
                $user->load('oauthPendingVerify');
                if($user->oauthPendingVerify->count()){                       
                    return false;                                      
                }
                return true;
            }else{
                return true;
            }
        });
        $validator = $this->loginValidator($request->all());
        if($validator->fails()){
            if($request->ajax()){
				return response()->json($validator->errors(), 422);
            }
            return back()->withErrors($validator->errors())->withInput();
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);
        if (Auth::attempt($credentials, $request->has('remember'))){
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }
        if($request->ajax()){
          return response()->json(['errors' => 'These credentials do not match our records.'], 422);
        }
        return back()->withErrors(['These credentials do not match our records'])->withInput();
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
     {
        $user = Auth::user();
        $user->auth_type = 'auth';
        $user->save();
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }
 		if($request->ajax()){
           return response()->json(['success' => 'You have been succesfully logged in', 'loginType' => 'auth'], 200); 
        }
        return redirect('/auth/login');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );
    }

     /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'payer_email';
    }

}