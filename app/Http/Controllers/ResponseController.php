<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;

/**
 * Class ResponseController
 * @package App\Http\Controllers
 */
class ResponseController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @var
     */
    protected $statusCode = 200;
    /**
     * @var array
     */
    protected $responseStructure = [
        "data"=>null,
        "error"=>null,
        "warnings"=>null,
        "meta"=>null,
    ];
    /**
     * @var array
     */
    protected $header=[];

    /**
     * @param $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this -> responseStructure['data']=$data;

        return $this;
    }


    /**
     * @param $data
     *
     * @return $this
     */
    public function setWarnings($data)
    {
        $this -> responseStructure['warnings']=$data;
        return $this;
    }

    /**
     *
     */
    public function setMeta()
    {
        $this -> responseStructure['meta']=Array(
            'time'=> (double)\PHP_Timer::stop(),
            'httpCode'=>$this -> statusCode
        );
    }

    /**
     * @param $header
     *
     * @return $this
     */
    public function withHeader($header)
    {
        array_push($this -> header,$header);
        return $this;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondAPI()
    {
        $this -> setMeta();
        return response()->json($this -> responseStructure,$this->statusCode,$this -> header);
    }

    /**
     * @param $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this -> setStatusCode(400);
        $this -> responseStructure['error']=$error;
        $this -> header = $this -> responseStructure;

        return $this;
    }


    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatusCode($status)
    {
        $this -> statusCode = $status;
        return $this;
    }
}
