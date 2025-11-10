<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'airline_code',
        'airline_name'
    ];
}
