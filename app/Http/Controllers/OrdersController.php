<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Status;
use App\Models\StatusHistory;
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
                'last_name_order' => $order->buyer->last_name
            ]);
            $reason = [];
            foreach ($order->order_items as $item) {
                $reason[] = $item->item->title; 
            }
            $order_detail = json_encode($order->order_items);
            $orden->detail_order = $order_detail;
            $orden->reason_order = rtrim(implode(',',$reason),',');
            $shipping = Http::withToken($account->access_token)
                        ->get(Config::get('constants.base_ML_URI').'/shipments/'.$order->shipping->id);
            $shipping_detail = json_decode($shipping);
            $orden->shipping_type_order = $shipping_detail->shipping_option->name;
            $orden->save();
        }
        return view('pages.orders.vincsuccess');
    }

    public function upd_order(Request $request){
        $order = Order::find($request->orderId);
        $hist_status = StatusHistory::create([
            'old_status_id' => (!empty($order->intl_status) ? $order->intl_status : '-1'),
            'new_status_id' => $request->status
        ]);
        if (!$hist_status) {
            return response()->json(['result'=>false, 'msg'=>'Error al guardar el cambio.']);
        }
        $order->notes = $request->notes;
        $order->intl_status = $request->status;
        $order->save();
        return response()->json(['result'=>true, 'msg'=>'Cambios guardados correctamente.']);
    }

    public function getJSONOrder(Request $request){
        $order = Order::find($request->id);
        return response()->json($order);
    }

    public function getOrderDetail(Request $request){
        $order = Order::find($request->id);
        $status = Status::all();
        if (!$order) {
            return response()->json(['result'=>false, 'msg'=>'Orden no encontrada']);
        }
        $detail = json_decode($order->detail_order);
        $view = view('pages.orders.orderdetail')->with(['order'=>$order, 'detail'=>$detail, 'status'=>$status])->render();
        return response()->json(['result'=>true, 'view'=>$view]);
    }
}
