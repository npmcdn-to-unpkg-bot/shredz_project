<?php

namespace App\Http\Controllers;

use App\CountryFlag;
use App\File;
use App\Tools\Geo\GeoIp;
use App\Tools\Transformers\FlagTransformerForPage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;
    protected $mainReferer;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this -> request = $request;
    }

     /**
     * @return resource|string
     */
    public function getJsonBody()
    {
        $content = json_decode($this -> request ->getContent(),true);
        return $content;
    }

    /**
     * Temporary
     */
    public function checkUserSubscription()
    {
        // // if user is not logged in return false
        // if(!Auth::check())
        // {
        //     return false;
        // }
        // // get logges in user
        // $user = Auth::user();
        // //checl if user email is tied to subscription
        // $subscribed = $this -> checkShredzSubscription($user -> email);
        // // return API response
        // if($subscribed)
        // {
        //     return true;
        // }
        // else
        // {
        //     return false;
        // }
    }

}
