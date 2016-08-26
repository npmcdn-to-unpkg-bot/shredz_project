<?php

namespace App\Http\Controllers;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ResponseTransformer\ObjectToArray;
use ApaiIO\ResponseTransformer\XmlToSimpleXmlObject;
use App\Tools\Geo\GeoIp;
use Crypt;
use App\Tools\Pages\Slug;
use App\Tools\Transformers\XmlToArrayTransformer;
use App\Tools\ShredzAPI;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * This class will be used to get data structure while the API is finished
 *
 * Class DataController
 * @package App\Http\Controllers
 */
class DataController extends ResponseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $userIdentity = Auth::check() ? Auth::user()->payer_email : \Session::getId();
        view()->share('userIdentity', Crypt::encrypt(json_encode($userIdentity)));
        view()->share('mainUrl', config('app.url'));
    }

    /**
     * Generate a token to use for api.shredz.com
     *
     * @return mixed
     */
    public function generateToken(Request $request, ShredzAPI $api){
        return $api->getToken();
    }

    /**
     * Generate a token to use for devgru.shredz.com
     *
     * @return mixed
     */
    public function generateTokenAjax(Request $request, ShredzAPI $api){
        return $this->setData($api->getToken())->respondAPI();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function redirectUsersSubscription()
    {
        // depending ton user response redirect to correct page
        if($this -> checkUserSubscription())
        {
            return view('pages.subscriptions');
        }
        else
        {
            return view('pages.membership');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelUsersSubscription()
    {
        // get logges in user
        $user = Auth::user();
        //delete users subscription
        $deleted = $this -> cancelSubscription($user -> email);
        if($deleted)
        {
            return $this->setData("Subscription was deleted")->respondAPI();
        }
        else
        {
            return $this->setError("User does not have subscription")->respondAPI();
        }
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function checkShredzSubscription($email)
    {
        $client = new Client();
        //look for subscription
        Log::info("SHREDZ subscription check for $email");
        $token = $this -> generateToken($this -> request);
        Log::info($token);
        $response = $client->get(env('SHREDZ_API_BASE_URL').'/v1/subscription',
            [
                'headers'=>[
                    'Authorization'=>'Bearer '.$token,
                    'Content-type'=>'application/json',
                    'Accept'=>'application/json',
                ],
                //avoid guuzzle exception on 404
                "http_errors"=>false,
            ]);
        // if response is 200
        Log::info("Email check came back with ". $response->getStatusCode());
        if($response->getStatusCode()==200)
        {
            // found return videos page
            return true;
        }
        else
        {
            // 400 response respond with subscription
            return false;
        }
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function cancelSubscription($email)
    {
        $client = new Client();
        $response = $client->delete(env('SHREDZ_API_BASE_URL').'/v1/subscription',
            [
                'headers'=>[
                    'Authorization'=>'Bearer '.$this -> generateToken($this -> request),
                    'Content-type'=>'application/json',
                    'Accept'=>'application/json',
                ],
                //avoid guuzzle exception on 404
                "http_errors"=>false,
            ]);
        // if response is 202 (Accepted)
        if($response->getStatusCode()==202)
        {
            // found return videos page
            return true;
        }
        else
        {
            // 400 response respond with subscription
            return false;
        }
    }

    public function submitPayment(Request $request){
        $data = $request->getContent();

        return view('pages.thanks', ['order'=>$data]);
    }

    public function listUsersOrders()
    {
        $client = new Client();
        $response = $client->get(env('SHREDZ_API_BASE_URL').'/v1/orders',
            [
                'headers'=>[
                    'Authorization'=>'Bearer '.$this -> generateToken($this -> request),
                    'Content-type'=>'application/json',
                    'Accept'=>'application/json',
                ],
                //avoid guuzzle exception on 404
                "http_errors"=>false,
            ]);
        $data = json_decode($response->getBody(),true);
        return $this->setData($data['data'])->respondAPI();
    }

    public function orderDetails($order_id)
    {
        $client = new Client();
        $response = $client->get(env('SHREDZ_API_BASE_URL').'/v1/orders/'.$order_id,
            [
                'headers'=>[
                    'Authorization'=>'Bearer '.$this -> generateToken($this -> request),
                    'Content-type'=>'application/json',
                    'Accept'=>'application/json',
                ],
                //avoid guuzzle exception on 404
                "http_errors"=>false,
            ]);
        $data = json_decode($response->getBody(),true);
        return $this->setData($data['data'])->respondAPI();
    }

    public function isRequestFromUs()
    {
        $geo = new GeoIp($this -> request -> ip());
        //store country code in variable accessible from any controller
        $countryCode= $geo -> getCountryCode();
        if($countryCode=="US")
        {
            return true;
        }
        return false;
    }

}
