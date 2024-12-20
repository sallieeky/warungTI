<?php

namespace App\Http\Domains\Orders\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['order_date', 'total_amount', 'product_id'];
}