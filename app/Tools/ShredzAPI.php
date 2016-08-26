<?php

namespace App\Tools;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Auth;

class ShredzAPI {

    protected $baseUrl;
    protected $credentials;
    protected $payload = [];
    protected $lastToken;
    protected $lastTokenTimestamp;

    protected function generateToken(){
        $client = new Client();
        $response = $client->post($this->baseUrl.'/v1/auth/tokens/generate',
            [
                'headers'=>[
                    'Authorization' => 'Basic N29yVFNPMno2NTZyQVhCekxlQTd2THluajdJSzVoUkE6bmtQdjNsajFoTXU3RlFzS0lGY1ZvNzcxOURxYUR2MGU1b295aWlUZjNGYkNwbnZTMVc0MEdPc2p1b3d3VFlwdw==',
                    'Content-type'  => 'application/json',
                    'Accept'        => 'application/json',
                ],
                "body"              => json_encode(@$this->payload ?: [])
            ]);
        $jsonString = $response->getBody();

        $this->lastToken = json_decode($jsonString,true)['data']['token'];
        $this->lastTokenTimestamp = Carbon::now();

        return $this->lastToken;
    }

    protected function request($method, $url, $options = [])
    {
        $client = new Client();

        $url = $this->baseUrl . preg_replace('/^\\/?(.*)$/', '/$1', $url);

        $options['headers'] = array_merge(@$options['headers'] ?: [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-type'  => 'application/json',
            'Accept'        => 'application/json'
        ]);

        $response = $client->request($method, $url, array_filter($options));

        return $response->getBody();
    }

    public function __construct()
    {
        $this->baseUrl = env('SHREDZ_API_BASE_URL');
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    public function setUser($email)
    {
        $this->payload['user'] = $email;

        return $this;
    }

    public function setReferer($url)
    {
        $this->payload['referer'] = $url;

        return $this;
    }

    public function getToken()
    {
        if (!isset($this->lastToken)) {
            $this->generateToken();
        }

        return $this->lastToken;
    }

    public function getProducts($setId = null)
    {
        return $this->request('get', '/v1/products?productSetId=' . $setId);
    }

    public function getProduct($id_or_slug)
    {
        return $this->request('get', '/v1/products/' . $id_or_slug);
    }

    public static function __callStatic($method, $parameters)
    {
        $instance = new static;

        return call_user_func_array([$instance, $method], $parameters);
    }

}