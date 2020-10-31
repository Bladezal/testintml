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

    public function getCode($id){
        return redirect('http://auth.mercadolibre.com.ar/authorization?'.
                        'response_type=code&client_id='.Config::get('constants.APP_ID_ML').'&state='.$id.
                        '&redirect_uri=https://testintml.herokuapp.com/accountauth');
    }

    public function accountAuth(Request $request){
        print_r($request);
    }

    public function addAccount(){
        return view('pages.accounts.addform');
    }

    public function saveAcount(Request $data){
        $account = new Account;
        $account->nickname = $data->input('cuenta');
        $account->save();
        return redirect('accounts');
    }
}
