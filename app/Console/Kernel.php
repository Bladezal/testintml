<?php

namespace App\Console;

use App\Models\Account;
use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
        $schedule->call(function(){
            $accounts = Account::all();
            $baseURL = Config::get('constants.base_ML_URI');
            $from = date('Y-m-dTH:i:s',strtotime("-10 minutes"));
            $to = date('Y-m-dTH:i:s',strtotime("now"));
            $params = '&order.date_created.from='.$from.'&order.date_created.to='.$to;
            foreach ($accounts as $account) {
                $orders_json = Http::withToken($account->access_token)
                          ->get($baseURL.'/orders/search?'.('seller='.$account->account_id.$params));
                $orders = json_decode($orders_json);
                if (isset($orders->error) && $orders->message = 'Invalid token') {
                    $method = '/oauth/token';
                    $head = [
                        'accept'=>'application/json',
                        'content-type'=>'application/x-www-form-urlencoded'
                    ];
                    $body = [
                        'grant_type'=>'refresh_token',
                        'client_id'=>Config::get('constants.APP_ID_ML'),
                        'client_secret'=>Config::get('constants.SECRET_KEY'),
                        'refresh_token'=>$account->refresh_token
                    ];
                    $response = Http::withHeaders($head)->post(($this->baseURL.$method),$body);
                    $resultado = $response->json();
                    $account->refresh_token = $resultado['refresh_token'];
                    $account->access_token = $resultado['access_token'];
                    $account->tkdate = date('Y-m-d H:i:s');
                    $account->rftdate = date('Y-m-d H:i:s');
                    $account->save();
                    $orders_json = Http::withToken($account->access_token)
                                   ->get($baseURL.'/orders/search?'.('seller='.$account->account_id.$params));
                    $orders = json_decode($orders_json);
                }
                foreach ($orders->results as $order) {
                    $orden = [
                        'id_order' => $order->id,
                        'date_created_order' => date('Y-m-d H:i:s', strtotime($order->date_created)),
                        'total_amount_order' => $order->total_amount,
                        'first_name_order' => $order->buyer->first_name,
                        'last_name_order' => $order->buyer->last_name,
                        'id_account' => $account->id
                    ];
                    $reason = [];
                    foreach ($order->order_items as $item) {
                        $reason[] = $item->item->title; 
                    }
                    $order_detail = json_encode($order->order_items, JSON_UNESCAPED_UNICODE);
                    $orden['detail_order'] = $order_detail;
                    $orden['reason_order'] = rtrim(implode(',',$reason),',');
                    $shipping_detail = json_decode(Http::withToken($account->access_token)
                                                         ->get($baseURL.'/shipments/'.$order->shipping->id));
                    $orden['shipping_type_order'] = !empty($shipping_detail->shipping_option->name) ? $shipping_detail->shipping_option->name : null;
                    $pedido = Order::create($orden);
                }
            }
        })->everyFiveMinutes()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(){
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
