<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller{
    public function index(){
        $orders = Order::all();
        return view('pages.orders.index')->with('orders',$orders);
    }

    public function getMLOrders(Request $request){
        $account_id = $request->input('id_cuenta');
        $account = Account::find($account_id);
        $url = Config::get('constants.base_ML_URI').'/orders/search?';
        $response = Http::withToken($account->access_token)->get($url.'seller='.$account->account_id);
        echo $response;
    }
}
