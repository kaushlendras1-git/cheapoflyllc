<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCarDetail extends Model
{
    use HasFactory;

    protected $table = 'travel_car_details';

    protected $fillable = [
        'booking_id',
        'car_rental_provider',
        'car_type',
        'pickup_location',
        'dropoff_location',
        'pickup_date',
        'pickup_time',
        'dropoff_date',
        'dropoff_time',
        'confirmation_number',
        'remarks',
        'rental_provider_address',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'dropoff_date' => 'date',
        'pickup_time' => 'datetime:H:i',
        'dropoff_time' => 'datetime:H:i',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}