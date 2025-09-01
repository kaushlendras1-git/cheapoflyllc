<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCruise extends Model
{
    use HasFactory;

    protected $table = 'travel_cruise'; // If your table name is `travel_cruise`

    protected $fillable = [
        'booking_id',
        'cruise_name',
        'ship_name',
        'length',
        'departure_port',
        'arrival_port',
        'cruise_line',
        'category',
        'stateroom',
        'created_at',
        'updated_at'
    ];

    /**
     * Relationship with Booking (assuming bookings table exists)
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
