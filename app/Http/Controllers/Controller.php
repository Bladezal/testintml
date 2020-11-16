<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $baseURL;

    public function __construct(){
        $this->baseURL = Config::get('constants.base_ML_URI');
    }

    public function mlGetRequest($token, $method, $params = NULL){
        return Http::withToken($token)->get($this->baseURL.$method.$params);
    }

    public function mlPostRequest($head, $body, $method){
        return Http::withHeaders($head)->post(($this->baseURL.$method),$body);
    }
}
