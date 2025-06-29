<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelTrainDetail extends Model
{

    use HasFactory;
    protected $table = 'travel_train_details';

    protected $fillable = [
        'booking_id',
        'direction',
        'departure_date',
        'train_number',
        'cabin',
        'departure_station',
        'departure_hours',
        'departure_minutes',
        'arrival_station',
        'arrival_hours',
        'arrival_minutes',
        'duration',
        'transit',
        'arrival_date',

    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}