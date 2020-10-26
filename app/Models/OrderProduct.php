<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model{
    use HasFactory;
    protected $table = 'orden_productos';
    protected $fillable = [
        'order_id',
        'product_id',
        'cant',
        'unit_price',
        'currency_id'
    ];
}
