<?php

namespace App\Http\Controllers\v1\ajax;

use App\FitnessGoal;
use App\Http\Controllers\ResponseController;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends ResponseController
{
    public function update_image()
    {
        $user = User::find(Auth::user()['id']);
        //$user = User::find(10);
        $upload_info = [
            "user_id"=>$user->id,
            "file_name"=>"image"
        ];
        $image =  $this->uploadFile($upload_info);
        if($image==null)
        {
            return $this->setError('File was not sent')->respondAPI();
        }
        $user -> image = $image -> id;
        $user -> save();
        return $this->setData($image)->respondAPI();
    }

    public function getUser()
    {
        $user = Auth::user();
        return $this ->setData($user) -> respondAPI();
    }

    public function editUser()
    {
        User::unguard();
        $data = $this->getJsonBody();
        $current_user = User::find(Auth::user()['id']);
        if(isset($data['first_name']))
        {
            $current_user -> first_name = $data['first_name'];
        }

        if(isset($data['last_name']))
        {
            $current_user -> last_name = $data['last_name'];
        }

        if(isset($data['email']))
        {
            $current_user -> email = $data['email'];
        }

        if(isset($data['password']) && $data['password']!='')
        {

            $current_user -> password = Hash::make($data['password']);
        }

        if(isset($data['date_of_birth']))
        {

             $current_user -> date_of_birth = Carbon::parse($data['date_of_birth']);

        }

        if(isset($data['height']))
        {
            $current_user -> height = $data['height'];
        }

        if(isset($data['height_measurement_type']))
        {
            $current_user -> height_measurement_type = $data['height_measurement_type'];
        }

        if(isset($data['weight']))
        {
            $current_user -> weight = $data['weight'];
        }

        if(isset($data['weight_measurement_type']))
        {
            $current_user -> weight_measurement_type = $data['weight_measurement_type'];
        }

        if(isset($data['phone']))
        {
            $current_user -> phone = $data['phone'];
        }

        if(isset($data['gender']))
        {
            $current_user -> gender = $data['gender'];
        }

        if(isset($data['fitness_goals']))
        {
            $current_user -> fitness_goals() -> detach();
            foreach($data['fitness_goals'] as $fitness_goals)
            {
                $fitness_goals_object = FitnessGoal::where("name",$fitness_goals)->get()->first()->toArray();
                $current_user -> fitness_goals() ->attach($fitness_goals_object['id']);
            }
        }
        Log::info($current_user);
        $current_user -> save();
        User::reguard();
        return $this->setData("User information has been updated")->respondAPI();
    }
}
