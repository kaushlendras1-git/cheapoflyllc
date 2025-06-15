<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelBookingType extends Model
{
    use HasFactory;

    protected $table = 'travel_booking_types';

    protected $fillable = ['booking_id', 'type'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}