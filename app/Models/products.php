<?php

namespace App\Models;

use App\Model\category;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{

    protected $fillable = [
        'name', 'description', 'image', 'price','category_id'
    ];

}
