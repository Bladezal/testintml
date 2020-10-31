<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class AccountsController extends Controller{
    public function bindAccount(){

    }

    public function getCode(){
        $response = Http::post('http://auth.mercadolibre.com.ar/authorization',[
            'response_type'=>'code',
            'client_id'=>Config::get('constants.APP_ID_ML'),
            'redirect_uri'=>'https://testintml.herokuapp.com/accountauth'
        ]);
    }

    public function accountAuth(Request $request){
        print_r($request);
    }
}
