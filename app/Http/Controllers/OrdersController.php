<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Config;

class OrdersController extends Controller{
    public function index(){
        $orders = Order::all();
        $data = ['orders' => $orders, 'app_id' => Config::get('constants.APP_ID_ML')];
        return view('pages.orders.index', $data);//->with('orders',$orders);
    }
}
