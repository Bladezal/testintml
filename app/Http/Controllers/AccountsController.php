<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

use GuzzleHttp;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller{
    public function index(){
        $accounts = Account::all();
        return view('pages.accounts.index')->with('accounts',$accounts);
    }
    
    public function bindAccount($id){
        $account = Account::where('id',$id)->get();

    }

    public function getCode(Request $data){
        $id = $data->input('id_cuenta');
        return redirect('http://auth.mercadolibre.com.ar/authorization?'.
                        'response_type=code&client_id='.Config::get('constants.APP_ID_ML').'&state='.$id.
                        '&redirect_uri='.Config::get('constants.redirect_URI'));
    }

    public function accountAuth(Request $data){
        $code = $data->input('code');
        $id_cuenta = $data->input('state');
        $account = Account::find($id_cuenta);
        $account->code = $code;
        $url = 'https://api.mercadolibre.com/oauth/token';
        $head = [
            'accept'=>'application/json',
            'content-type'=>'application/x-www-form-urlencoded'
        ];
        $body = [
            'grant_type'=>'authorization_code',
            'client_id'=>Config::get('constants.APP_ID_ML'),
            'client_secret'=>Config::get('constants.SECRET_KEY'),
            'code'=>$code,
            'redirect_uri'=>Config::get('constants.redirect_URI')
        ];
        $response = Http::withHeaders($head)->post($url,$body);
        $result = $response->json();
        $account->acount_id = $result['user_id'];
        $account->access_token = $result['access_token'];
        $account->tkdate = date('Y-m-d H:i:s');
        var_dump($account);
        //$account->save();
        //return redirect()->action('AccountsController@index');
    }

    public function addAccount(){
        return view('pages.accounts.addform');
    }

    public function saveAccount(Request $data){
        $account = new Account;
        $account->nickname = $data->input('cuenta');
        $account->save();
        return redirect('accounts');
    }
}
