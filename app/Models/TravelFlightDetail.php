<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelFlightDetail extends Model
{
    use HasFactory;

    protected $table = 'travel_flight_details';

    protected $fillable = [
        'booking_id',
        'direction',
        'date',
        'airlines_code',
        'flight_no',
        'cabin',
        'class_of_service',
        'departure_airport',
        'departure_hrs',
        'departure_mm',
        'arrival_airport',
        'arrival_hrs',
        'arrival_mm',
        'duration',
        'transit',
        'arrival_date',
    ];

    protected $casts = [
        'date' => 'date',
        'arrival_date' => 'date',
        'departure_hrs' => 'integer',
        'departure_mm' => 'integer',
        'arrival_hrs' => 'integer',
        'arrival_mm' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}