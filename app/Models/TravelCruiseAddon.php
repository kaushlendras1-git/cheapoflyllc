<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCruiseAddon extends Model
{
    use HasFactory;

    protected $table = 'travel_cruise_addons';

    protected $fillable = [
        'services',
        'service_name',
        'image',
        'booking_id'
    ];
}
