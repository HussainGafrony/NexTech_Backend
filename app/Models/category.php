<?php

namespace App\Models;

use App\Model\products;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name', 'description','image'
    ];

}
