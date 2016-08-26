<?php 

namespace App\Http\Controllers\Auth\Traits;

use Crypt;
use DB;
use Auth;
use App\User;
use Validator;
use Socialite;
use Redirect;
use App\Models\Eloquent\OauthPendingVerify;
use Illuminate\Http\Request;
use App\CustomerProfile;
use Log;

trait AuthenticatesOauth2
{

	/**
	 * Redirect user to provider
	 * @param string $provider
	 * @return Response
	 */
	public function redirectToProvider($provider, $code, Request $request)
	{
		$referer = $this->fromDomain($request->server('HTTP_REFERER'));
		if(!$referer){
			$referer = env('MAIN_URL');
		}
		$identity = Crypt::decrypt($code);
		$orig_identity = [
			'user' => null,
			'session_id' => $identity,
			'origin' => $request->server('HTTP_HOST'),
			'referer' => $referer,
			'redirect_url' => $request->server('HTTP_REFERER')
		];
		$request->session()->flash('orig_identity', $orig_identity);
		return Socialite::driver($provider)->redirect();
	}

	/**
	 * Obtain user information from provider
	 * @return Response
	 */
	public function handleProviderCallback($provider)
	{
		try {
			$userFromProvider = Socialite::driver($provider)->user();
		} catch (Exception $e){
			Log::info('Oauth2 Error from provider: '.$provider.' Message: '. $e->getMessage()); 
			return Redirect::to('/');			
		}
		$identity = session('orig_identity');
		$userToCheckVerify = $this->findOrCreateUser($userFromProvider, $provider, $identity);
		$authUser = $this->checkUserAccountVerification($userToCheckVerify, $provider); 
		$identity['user'] = $authUser->id;
		Auth::login($authUser, true);
		if($identity['referer'] == env('MAIN_URL')){
			return redirect()->away($identity['redirect_url']);
		}
		//handle traffic from a subdomain
        Auth::logout();
        return redirect()->away($identity['referer'] . '/oauth2/redirect/' . Crypt::encrypt($identity));
	}


	/**
	 * Determine if the user created from the oauth provider
	 * contains the information we need to verified his/her email
	 * @param User $user
	 * @return User $user
	 */
	public function checkUserAccountVerification(User $user, $provider)
	{
		$user->load('oauthPendingVerify');
		if($user->oauthPendingVerify->count()){
			$pendingVerify = $user->oauthPendingVerify;
			$filteredPendingVerify = $pendingVerify->filter(function($verify) use ($provider) {
				return $provider == $verify->name;
			});
			if($filteredPendingVerify->count()){
				$user->verify_token = $filteredPendingVerify->first()->pivot->type;
				$user->verified = NULL;
				$user->save();
				return $user;
			}
			if($user->payer_email){
				$verify = OauthPendingVerify::where('name', 'auth')->first();
				DB::table('oauth_pending_verify')->where('user_id', $user->id)->where('oauth_verify_id', $verify->id)->delete();
				$user->verified = 1;
				$user->save();
				return $user;
			}			
		}
		if($user->payer_email){
        	$user->verified = 1;
        	$user->save();
        	return $user;
		}
		return $user;
		
	}

	/**
	 * Get user provider
	 * @param  string $userFromProvider, the user retrieved from oauth2 provider
	 * @param string $provider , the name of oauth2 provider
	 * @param array $identity
	 * 
	 * @return User
	 */
	public function findOrCreateUser($userFromProvider, $provider, $identity)
	{
		if(!$userFromProvider->email){
			return $this->handleUserWithoutProviderEmail($userFromProvider, $provider, $identity);
		}
		$authUser = User::with('profile')->where('payer_email', $userFromProvider->email)->first();
		//The user does not exists
		if(!$authUser){
			//Create new user with profile			
			$authUser = User::create([
				'payer_email' => $userFromProvider->email,
				'auth_type' => $provider				
			]);
			//create a profile with oauth info in it
			$profile = CustomerProfile::create([
				'oauth_avatar' => ($provider == 'underarmour' ? NULL : $userFromProvider->avatar),
				$provider . '_id' => $userFromProvider->id
			]);
			//attach profile to user
			$authUser->profile()->save($profile);
			return $this->saveFullnameFromProvider($authUser, $userFromProvider->name);			
		}
		//The user exists. Lets check if has a profile
		$currentUserProfile = CustomerProfile::where('customer_id', $authUser->id)->first();
		if(!$currentUserProfile){
			$profile = CustomerProfile::create([
				'oauth_avatar' => ($provider == 'underarmour' ? NULL : $userFromProvider->avatar) ,
				$provider . '_id' => $userFromProvider->id
			]);
			$authUser->profile()->save($profile);
			$authUser->auth_type = $provider;
			$authUser->save();
			return $this->saveFullnameFromProvider($authUser, $userFromProvider->name);	
		}
		$currentUserProfile->fill([
			$provider . '_id' => $userFromProvider->id,
			'date_of_birth' => $currentUserProfile->date_of_birth,
			'gender' => $currentUserProfile->gender,
			'weight' => $currentUserProfile->weight,
			'height' => $currentUserProfile->height,
			'avatar' => $currentUserProfile->avatar

		]);
		if($provider != 'underarmour'){//Under armour does not return avatar
			$currentUserProfile->oauth_avatar = $userFromProvider->avatar;
		}
		$currentUserProfile->save();
		$authUser->auth_type = $provider;
		$authUser->save();
		return $this->saveFullnameFromProvider($authUser, $userFromProvider->name);	
	}

	/**
	 * Registering users when email has not been provided by the oauth provider
	 * 
	 * @return User
	 */
	public function handleUserWithoutProviderEmail($userFromProvider, $provider, $identity)
	{
		$profile = CustomerProfile::with('user')->where($provider . '_id', $userFromProvider->id)->first();
		if($profile){
			$profile->user->auth_type = $provider;
			if($provider != 'underarmour'){
				$profile->oauth_avatar = $userFromProvider->avatar;
			}
			$profile->user->save();
			$profile->save();
			return $this->saveFullnameFromProvider($profile->user, $userFromProvider->name);
		}
		//Create new user with profile			
		$authUser = User::create([
			'auth_type' => $provider				
		]);
		//create a profile with oauth info in it
		$profile = CustomerProfile::create([
			'oauth_avatar' => ($provider == 'underarmour' ? NULL : $userFromProvider->avatar) ,
			$provider . '_id' => $userFromProvider->id
		]);
		//attach profile to user
		$authUser->profile()->save($profile);
		$authUser->save();
		return $this->saveFullnameFromProvider($authUser, $userFromProvider->name);
	}

	/**
	 * Update customer's first and last name with data from Oauth providers
	 * @param User $user
	 * @param string $nameFromProvider
	 */
	private function saveFullnameFromProvider($user, $nameFromProvider)
	{
		$fullName = explode(" ", $nameFromProvider);
		$count = count($fullName);
		if($count){
			if($count >= 2){
				$user->first_name = $fullName[0];
				$user->last_name = $fullName[1];
			}else if($count == 1){
				$user->first_name = $fullName[0];
			}else{
				$user->first_name = $nameFromProvider;
			}
			$user->save();
			return $user;	
		}		
	}

	/**
     * Handle redirecting users who authenticated from a subdomain
     * @param string $identity
     */
	public function oauthSubdomainRedirect($identity)
	{
		if(!is_null($identity)){
			$identity = Crypt::decrypt($identity);
			$user = User::find($identity['user']);
			Auth::login($user);
			return redirect()->away($identity['redirect_url']);
		}else{
			return redirect(env('MAIN_URL'));
		}
	}

	/**
	 * Verify and store current user's credentials when he/she logs in via Oauth (AJAX ONLY) and does not have email | pass credentials stored
	 * 
	 * @param Request $request
	 */
	public function verifyOauthCredentials(Request $request)
	{
	 	if($request->ajax()){
			$authUser = Auth::user();
			$params = $request->all();
			if(!$authUser->payer_email){
				//Find user with entered email
				$userWithEmail = User::where('payer_email', $params['payer_email'])->first();
				if($userWithEmail){
					$userWithEmailProfile = CustomerProfile::where('customer_id', $userWithEmail->id)->first();
					$authUserProfile = CustomerProfile::where('customer_id', $authUser->id)->first();
					///Update profile with providers info///
					if($authUser->auth_type == 'fitbit'){
						$userWithEmailProfile->fitbit_id = $authUserProfile->fitbit_id;
						$userWithEmailProfile->save();
					}
					$userWithEmail->auth_type = $authUser->auth_type;
					$userWithEmail->verified = NULL;
					$userWithEmail->save();
					//get the oauth verify
					$verify = OauthPendingVerify::where('name', $authUser->auth_type)->first();
					if(!$verify){
						$verify = OauthPendingVerify::where('name', 'auth')->first();
					}
					$userWithEmail->oauthPendingVerify()->save($verify);
					//logout fake user
					Auth::logout();
					//remove fake user
					$authUser->delete();
					$authUserProfile->delete();
					$sentToken = false;
					$userWithEmail = $userWithEmail->fresh();
					if($verifyToken = $this->sendEmailVerifyLink($userWithEmail, $request->server('HTTP_REFERER'), $verify)){
						$sentToken = true;
					}
					return response()->json(['success' => 'Your credentials have been stored', 'user' => $userWithEmail->toArray(), 'sent_token' => $sentToken], 200);
				}
				//No other user with same email so we can add these credentials to the user
				$validator = $this->oauthCredentialsValidatorNoEmail($params);
				if($validator->fails()){
					return response()->json($validator->errors(), 422);
				}
				$authUser->fill([
					'payer_email' => $params['payer_email'],
					'password' => bcrypt($params['password'])
				]);
				$authUser->save();
				$verify = OauthPendingVerify::where('name', $authUser->auth_type)->first();
				if(!$verify){
					$verify = OauthPendingVerify::where('name', 'auth')->first();
				}
				$authUser->oauthPendingVerify()->save($verify);
				$sentToken = false;
				if($verifyToken = $this->sendEmailVerifyLink($authUser, $request->server('HTTP_REFERER'), $verify)){
					$sentToken = true;
				}
				return response()->json(['success' => 'Your credentials have been stored', 'user' => $authUser->toArray(), 'sent_token' => $sentToken], 200);
			}else{
				$params['payer_email'] = $authUser->payer_email;
				$validator = $this->oauthCredentialsValidator($params);
				if($validator->fails()){
					return response()->json($validator->errors(), 422);
				}
				$authUser->fill([
					'payer_email' => $params['payer_email'],
					'password' => bcrypt($params['password'])
				]);
				$authUser->save();			
				return response()->json(['success' => 'Your credentials have been stored', 'user' => $authUser->toArray(), 'sent_token' => false], 200);
			}
        }//end request is ajax		
	}//end oauth credentials
}