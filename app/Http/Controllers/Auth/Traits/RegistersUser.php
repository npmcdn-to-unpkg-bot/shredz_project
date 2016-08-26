<?php 

namespace App\Http\Controllers\Auth\traits;

use DB;
use App\User;
use DateTime;
use App\FitnessGoal;
use App\CustomerProfile;
use Illuminate\Http\Request;
use App\Models\Eloquent\OauthPendingVerify;


trait RegistersUser
{
	/**
     * Get the for page to log the user in
     *
     * @return \Illuminate\Http\Response
     */
	public function getRegister()
	{
		// return view('pages.createAccount');
		return redirect("/");
	}

	/**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postRegister(Request $request)
	{
		$validator = $this->registerValidator($request->all());
		if($validator->fails()){
			if($request->ajax()){
				return response()->json($validator->errors(), 422);
			}
			return back()->withErrors($validator->errors())->withInput();
		}
		$input = $this->prepareInput($request);

		// $input['date_of_birth'] = new DateTime($input['date_of_birth']);
		//begin storing new user
		//DB::transaction(function() use ($request, $input) {
			$user = User::create([
				'first_name' => $input['first_name'],
				'last_name' => $input['last_name'],
				'payer_email' => $input['email'],
				'password' => bcrypt($input['password'])
			]);
			$profile = CustomerProfile::create([
				'height' => $input['height'],//in centimeters
				// 'weight' => $input['weight'],//in kilograms
				// 'gender' => $input['gender'],
				// 'date_of_birth' => $input['date_of_birth']
			]);
			//attach profile to user
			$user->profile()->save($profile);
			//attach fitness goals if any
			if(!empty($request->input('fitness_goals'))){
				foreach ($request->input('fitness_goals') as $goalName) {
					$goal = FitnessGoal::byName($goalName);
					$user->fitness_goals()->save($goal);
				}
			}
			if($user){
				$verify = OauthPendingVerify::where('name', 'auth')->first();
				$user->oauthPendingVerify()->save($verify);
				$verifyToken = $this->sendEmailVerifyLink($user, $request->server('HTTP_REFERER'), $verify);
				if($verifyToken){
					$user->verify_token = $verifyToken;
					$user->save();
				}
			}
		//});
		if($request->ajax()){
			return response()->json(['success' => 'Success! We need to verify your email. Please check your inbox and follow the verification steps.'], 200);
		}
		return back()->withSuccess('Success! We need to verify your email. Please check your inbox and follow the verification steps.');
	}

	/**
	 * Prepare input before we save to DB
	 * @param Request $request
	 * @return array
	 */
	protected function prepareInput(Request $request )
	{
		$params = $request->except(['height_measurement_type', 'weight_measurement_type']);
		if($request->input('height_measurement_type') == 'ft'){
			$heights = explode('\'', $request->input('height'));
			$feet = $heights[0];
			$inches = $heights[1];
			$params['height'] = $this->feetToCentimeters($feet, $inches);
		}else{
			$params['height'] = (int) round($request->input('height'));
		}
		//working with lbs
		if($request->input('weight_measurement_type') == 'lbs'){
			if($request->input('weight')['lbs'] == '100'){
				$params['weight'] = $this->libsToKilograms((int) $request->input('weight')['lbs']);
			}else{
				$weights = explode('-', $request->input('weight')['lbs']);
				$params['weight'] = $this->libsToKilograms((int) ($weights[0] + $weights[1]) / count($weights));
			}
		}else if($request->input('weight_measurement_type') == 'kg'){ 
			if($request->input('weight')['kgs'] == '45'){
				$params['weight'] = (int) $request->input('weight')['kgs'];
			}else{
				$weights = explode('-', $request->input('weight')['kgs']);
				$params['weight'] = (int) round(($weights[0] + $weights[1]) / count($weights));
			}
		}
		return $params;
	}


}