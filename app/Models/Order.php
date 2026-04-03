<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'ten',
        'email',
        'sdt',
        'diachi',
        'cart',
        'total',
        'payment_method',
        'ma_giao_dich',
        'status'
    ];
}
