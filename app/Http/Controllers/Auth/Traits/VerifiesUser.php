<?php 

namespace App\Http\Controllers\Auth\traits;

use Log;
use DB;
use Auth;
use Mail;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Models\Eloquent\OauthPendingVerify;
use App\Http\Controllers\Auth\traits\SupportsAuth;

trait VerifiesUser
{
	/**
     * Send email verification link
     * @param App\User $user
     * @param string $token
     * @param string the name of the domain we want the user to be redirected to when they follow the link
     * @param App\Models\OauthPendingVerify
     */
    protected function sendEmailVerifyLink(User $user, $fromDomain, $oauth_verify = null)
    {
        $user = $user->fresh();
        $fromDomain = $this->fromDomain($fromDomain);
        if(!is_null($fromDomain)){
            $view = 'emails.verify';
            $token = $this->createToken($user->payer_email);
            $user->verify_token = $token;
            $user->save(); 
            if($oauth_verify){
                DB::table('oauth_pending_verify')
                    ->where('user_id', $user->id)
                    ->where('oauth_verify_id', $oauth_verify->id)
                    ->update(['type' => $token]);        
            }
            Mail::send($view, compact('token', 'user', 'fromDomain'), function($m) use ($user){
                $m->to($user->payer_email)->subject('Please verify your email.');
            });
            Log::info('Email verification email was sent to user id # '. $user->id);           
            return $token;
        }        
    }

    /**
     * Process email verification when customer clicks email verification link
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getVerifyEmail($token = null)
    {
        Auth::logout();
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }
        $user = User::byVerifyToken($token);
        $user->load(['oauthPendingVerify' => function($q) use ($token) {
            $q->wherePivot('type', $token);
        }]);
        if($user->oauthPendingVerify->count()){
            $validator = $this->verifyEmailValidator(['verify_token' => $token, 'payer_email' => $user->payer_email]);
             if($validator->fails()){
                return redirect('/');
            }
            //remove pending verify with same token
            DB::table('oauth_pending_verify')->where('user_id', $user->id)->delete();      
            $user->verified = 1;
            $user->auth_type = 'auth';
            $user->verify_token = $this->createToken($user->payer_email);
            $user->save();
            Auth::login($user);
            return redirect('/settings');
        }
        return redirect('/');
    }

    public function resendVerifyEmailWhenLogggedIn(Request $request)
    {
        $this->resendVerifyEmail($request);
        return response()->json(['message' => 'Email has been sent!']);
    }

    /**
     * Resend verification email to a user who received the email before
     * @param string $email 
     */
    public function resendVerifyEmail(Request $request)
    {
        $email = $request->get('email');
        $domain = $request->server('HTTP_REFERER');
        $user = User::byEmail($email);
        $user->load('oauthPendingVerify');
        if($user->oauthPendingVerify->count()){
            $verify = OauthPendingVerify::where('name', $user->auth_type)->first();
            $pendingVerify = $user->oauthPendingVerify->filter(function($ver) use ($verify){
                return $ver->pivot->oauth_verify_id == $ver->id;
            });
            if($pendingVerify->count()){
                $this->sendEmailVerifyLink($user, $domain, $verify);
                return response()->json(['message' => 'Email has been sent!']);
            }
            return response()->json(['message' => 'No pending verify with auth type'], 422);
            ////////NO PENDING VERIFY WITH AUTH TYPE
        }
        return response()->json(['message' => 'No pending verify.'], 422);
        /////NO PENDING VERIFY/////        
    }
}