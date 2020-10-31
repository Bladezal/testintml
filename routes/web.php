<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('orders',[OrdersController::class, 'index']);
Route::post('getcode',[AccountsController::class, 'getCode']);
Route::post('accountauth', [AccountsController::class, 'accountAuth']);