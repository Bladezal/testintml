<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    use HasFactory;
    protected $table = 'ordenes';
    protected $fillable = [
        'id_order',
        'date_created_order',
        'date_closed_order',
        'status_order',
        'total_amount_order',
        'currency_id',
        'first_name_order',
        'last_name_order',
        'shipping_id_order'
    ];
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
