<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller{
    public function index(){
        $orders = Order::all();
        return view('Orders.index')->with('orders',$orders);
    }
}
