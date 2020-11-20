<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Status;
use App\Models\StatusHistory;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller{

    public function index(){
        $orders = Order::all();
        return view('pages.orders.index')->with('orders',$orders);
    }

    public function getMLOrders(Request $request){
        $account_id = $request->input('id_cuenta');
        $offset = $request->input('offset');
        $limite = $request->input('limite');
        $migrated = $request->input('migrado');
        $account = Account::find($account_id);
        $resultado = json_decode($this->mlGetRequest($account->access_token,'/orders/search?',
                                ('seller='.$account->account_id.'&offset='.$offset.'&limit='.$limite)));
        var_dump($resultado);
        die();
        if (isset($resultado->error) && $resultado->message = 'Invalid token') {
            $account = $this->refreshToken($account);
            $resultado = json_decode($this->mlGetRequest($account->access_token,'/orders/search?',
                                    ('seller='.$account->account_id.'&offset='.$offset.'&limit='.$limite)));
        }
        $total = intval($resultado->paging->total);
        $orders = [];
        foreach ($resultado->results as $order) {
            $orden = [
                'id_order' => $order->id,
                'date_created_order' => date('Y-m-d H:i:s', strtotime($order->date_created)),
                'total_amount_order' => $order->total_amount,
                'first_name_order' => $order->buyer->first_name,
                'last_name_order' => $order->buyer->last_name,
                'id_account' => $account_id
            ];
            $reason = [];
            foreach ($order->order_items as $item) {
                $reason[] = $item->item->title; 
            }
            $order_detail = json_encode($order->order_items);
            $orden['detail_order'] = $order_detail;
            $orden['reason_order'] = rtrim(implode(',',$reason),',');
            $shipping_detail = json_decode($this->mlGetRequest($account->access_token,'/shipments/',$order->shipping->id));
            $orden['shipping_type_order'] = !empty($shipping_detail->shipping_option->name) ? $shipping_detail->shipping_option->name : null;
            $orders[] = $orden;
        }
        
        
        DB::table('ordenes')->insert($orders);
        $account->migrated = ($migrated == 0) ? false : true;
        $account->save();
        return response()->json(['result' => true, 'total' => $total]);
    }

    public function upd_order(Request $request){
        $order = Order::find($request->orderId);
        $hist_status = StatusHistory::create([
            'old_status_id' => (!empty($order->intl_status) ? $order->intl_status : $request->status),
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

    public function refreshToken($account){
        $params = $this->prepareMLAuth('refresh_token',$account->refresh_token);
        $result = $this->mlPostRequest($params['head'],$params['body'],$params['method']);
        $resultado = $result->json();
        $account->refresh_token = $resultado['refresh_token'];
        $account->access_token = $resultado['access_token'];
        $account->tkdate = date('Y-m-d H:i:s');
        $account->rftdate = date('Y-m-d H:i:s');
        $account->save();
        return $account;
    }
}
