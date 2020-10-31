<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

use GuzzleHttp;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller{
    public function bindAccount($id){
        $account = Account::where('id',$id)->get();

    }

    public function getCode(){
        return redirect('http://auth.mercadolibre.com.ar/authorization?'.
                        'response_type=code&client_id='.Config::get('constants.APP_ID_ML').
                        '&redirect_uri=https://testintml.herokuapp.com/accountauth');
    }

    public function accountAuth(Request $request){
        print_r($request);
    }
}
