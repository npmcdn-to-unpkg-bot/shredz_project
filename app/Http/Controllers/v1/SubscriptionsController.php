<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\DataController;
use App\Http\Controllers\ResponseController;
use App\Models\Eloquent\Vip;
//use FitlifeGroup\Models\Eloquent\Customer;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Class SubscriptionsController
 * @package App\Http\Controllers\v1
 */
class SubscriptionsController extends DataController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {   
        $email = $request->json('email');
        $fromWhere = $request->json('fromWhere');
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return $this->setError("validation failed")->respondAPI();
        }

        if (is_null($vip = Vip::where('email', $email)->first())) {
            $vip = new VIP;
            $vip->email = $email;
            $vip->acquired_from = $fromWhere;
        }

        else{
            if($fromWhere == "blog" || $fromWhere == "7day"){
                $vip->acquired_from = $fromWhere;
            }
        }

        $customer = User::where('payer_email', $email)->first();
        if ($customer) {
            $vip->customer()->associate($customer);
        }

        $vip->save();

        return $this->setData($vip)->respondAPI();
    }

}
