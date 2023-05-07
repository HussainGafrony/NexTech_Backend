<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class address extends Model
{
    protected $fillable = [
        'address_line_1', 'user_id', 'city', 'default', 'country',

        'postcode', 'phone',
    ];
    use HasFactory;
}
