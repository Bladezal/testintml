<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
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
        $resultado = json_decode($response);
         foreach ($resultado->results as $order) {
            $orden = Order::create([
                'id_order' => $order->id,
                'date_created_order' => date('Y-m-d H:i:s', strtotime($order->date_created)),
                'total_amount_order' => $order->total_amount,
                'first_name_order' => $order->buyer->first_name,
                'last_name_order' => $order->buyer->last_name,
                'detail_order' => json_encode($order->order_items),
            ]);
            $reason = [];
            foreach ($order->order_items as $item) {
                $reason[] = $item->item->id; 
            }
            $orden->reason_order = rtrim(implode(',',$reason),',');
            $shipping = Http::withToken($account->access_token)
                        ->get(Config::get('constants.base_ML_URI').'/shipments/'.$order->shipping->id);
            $shipping_detail = json_decode($shipping);
            $orden->shipping_type_order = $shipping_detail->lead_time->shipping_option->name;
            $orden->save();
        }
        return view('pages.orders.vincsuccess');
    }

    public function getProductId($product){
        $producto = Product::where('product_id',$product)->get();
        if (!$producto) {
            # code...
        } else {
            # code...
        }
        return $producto;
    }
}
