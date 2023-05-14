<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    protected $fillable = [
        'user_id', 'adress_id', 'final_price', 'status',
    ];
    use HasFactory;

}
