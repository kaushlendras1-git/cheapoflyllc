<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCruiseDetail extends Model
{
    use HasFactory;

    protected $table = 'travel_cruise_details';

    protected $fillable = [
        'booking_id',
        'cruise_line',
        'ship_name',
        'category',
        'stateroom',
        'departure_port',
        'departure_date',
        'departure_hrs',
        'departure_mm',
        'arrival_port',
        'arrival_date',
        'arrival_hrs',
        'arrival_mm',
        'remarks',
        'date',
        'files'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'date'=>'date',
        'arrival_date' => 'date',
//        'departure_hrs' => 'integer',
//        'departure_mm' => 'integer',
//        'arrival_hrs' => 'integer',
//        'arrival_mm' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}
