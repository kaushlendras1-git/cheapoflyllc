<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelFlightDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_flight_details';

    protected $fillable = [
        'booking_id',
        'direction',
        'departure_date',
        'airline_code',
        'flight_number',
        'cabin',
        'class_of_service',
        'departure_airport',
        'departure_hours',
        'departure_minutes',
        'arrival_airport',
        'arrival_hours',
        'arrival_minutes',
        'duration',
        'transit',
        'arrival_date',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}