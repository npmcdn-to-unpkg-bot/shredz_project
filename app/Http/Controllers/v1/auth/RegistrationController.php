<?php

namespace App\Http\Controllers\v1\auth;

use App\FitnessGoal;
use App\Http\Controllers\ResponseController;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends ResponseController
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

    protected $redirectAfterLogout = "/";

    /**
     * @api {get} /user/:id
     * @apiName Create trainers.
     * @apiDescription Create trainers.
     * @apiGroup Trainer
     */
    public function store()
    {
        $body = $this -> getJsonBody();
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'password' => 'required|confirmed|min:6',
            "date_of_birth"=>'required|date',
            "height"=>'required',
            "height_measurement_type"=>'required',
            "weight"=>'required',
            "weight_measurement_type"=>'required',
        ];

        $input = $body;


        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            //Log::info('Validation Failed '.$input);
            return $this->setError('Validation Failed')->setWarnings($validator->messages())->respondAPI();
        }
        // generate random string for confirmation purposes
        $confirmation_code = str_random(50);
        $user = User::create([
            "first_name"=>$body['first_name'],
            "last_name"=>$body['last_name'],
            "email"=>$body['email'],
            "gender"=>$body['gender'],
            "confirmation_code"=>$confirmation_code,
            "password"=>Hash::make($body['password']),
            "date_of_birth"=>Carbon::parse($body['date_of_birth']),
            "height"=>$body['height'],
            "height_measurement_type"=>$body['height_measurement_type'],
            "weight"=>$body['weight'],
            "weight_measurement_type"=>$body['weight_measurement_type'],
        ]);
        if(isset($body['fitness_goals']))
        {
            foreach($body['fitness_goals'] as $fitness_goals)
            {
                $fitness_goals_object = FitnessGoal::where("name",$fitness_goals)->get()->first()->toArray();
                $user -> fitness_goals() ->attach($fitness_goals_object['id']);
            }
        }

        // send confirmation email
        Mail::send('emails.confirmation', array( 'confirmation_code' => $confirmation_code), function($message) use ($body){
            $message->to($body['email'])
                ->subject('SHREDZ Confirmation');
        });

        Auth::login($user);
        return $this -> setData('User has been created.')->respondAPI();
    }

    public function confirm($token)
    {
        // get user with confirmation code of
        $user = User::WithConfirmationCode($token)->get()->first();
        // if confirmation code is invalid return with error
        if(!$user)return view("pages.landing.confirmationlanding")->with(['status'=>"error"]);
        // else make confirmation code invalid (This means user was found)
        $user -> confirmation_code = null;
        $user -> save();
        // return view with success
        return view("pages.landing.confirmationlanding")->with(['status'=>"success"]);
    }
}
