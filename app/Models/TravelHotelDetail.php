<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelHotelDetail extends Model
{
    use HasFactory;

    protected $table = 'travel_hotel_details';

    protected $fillable = [
        'booking_id',
        'hotel_name',
        'room_category',
        'checkin_date',
        'checkout_date',
        'no_of_rooms',
        'confirmation_number',
        'hotel_address',
        'remarks',
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'checkout_date' => 'date',
        'no_of_rooms' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}