<?php

namespace App\Models;

use App\Model\products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    protected $fillable = [
        'name', 'description','image'
    ];
    use HasFactory;

}
