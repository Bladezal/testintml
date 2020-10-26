<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model{
    use HasFactory;
    protected $table = 'historico_estados';
    protected $fillable = [
        'old_status_id',
        'new_status_id'
    ];
}
