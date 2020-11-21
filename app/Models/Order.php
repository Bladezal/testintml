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
        'total_amount_order',
        'reason_order',
        'first_name_order',
        'last_name_order',
        'shipping_type_order',
        'detail_order',
        'id_account'
    ];
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
