<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class products extends Model
{

    protected $fillable = [
        'name', 'description', 'image', 'price','category_id'
    ];
    use HasFactory;
}
