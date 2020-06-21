<?php

namespace App\POS;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'order_date',
        'table',
        'user',
        'customer',
        'totalPay',
        'cashIn'
    ];
}
