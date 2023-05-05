<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'order_date', 'product_quantity', 'total_price', 'customer_id', 'product_id', 'status', 'address_id',
    ];

}
