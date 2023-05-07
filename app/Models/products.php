<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{

    protected $fillable = [
        'name', 'description', 'image', 'price', 'QTY', 'category_id',
    ];
    use HasFactory;
}
