<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPricingDetail extends Model
{
    use HasFactory;

    protected $table = 'travel_pricing_details';

    protected $fillable = [
        'booking_id',
        'passenger_type',
        'num_passengers',
        'gross_price',
        'net_price',
        'details',
    ];

  
}
