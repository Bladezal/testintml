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
                'date_closed_order' => date('Y-m-d H:i:s', strtotime($order->date_closed)),
                'status_order' => $order->status,
                'total_amount_order' => $order->total_amount,
                'currency_id' => $order->currency_id,
                'first_name_order' => $order->buyer->first_name,
                'last_name_order' => $order->buyer->last_name,
                'shipping_id_order' => $order->shipping->id,
            ]);
            $orden->save();
            foreach ($order->order_items as $item) {
                $itemOrder = OrderProduct::create([
                    'order_id' => $orden->id,
                    'product_id' => $item->item->id,
                    'cant' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'currency_id' => $item->currency_id
                ]);
                $itemOrder->save();
            }
        }
        return view('pages.orders.vincsuccess');
        //echo $response;
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
