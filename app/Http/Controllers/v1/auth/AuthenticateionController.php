<?php

namespace App\Http\Controllers\v1\auth;

use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class AuthenticateionController extends ResponseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = "/";
    protected $redirectAfterLogout = "/auth";

    public function postLogin(Request $request)
    {
        $this -> redirectTo = $request ->fullUrl();
        $auth = false;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $auth = true; // Success
        }

        if ($request->ajax()) {
            return $this->setData([
                'auth' => $auth
            ])->respondAPI();
        } else {
            if($auth)
            {
                return redirect()->intended($this->redirectPath());
            }
        }
    }
}
