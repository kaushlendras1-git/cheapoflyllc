<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPassenger extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_passengers';

    protected $fillable = [
        'booking_id',
        'passenger_type',
        'gender',
        'dob',
        'seat_number',
        'title',
        'credit_note_amount',
        'first_name',
        'middle_name',
        'last_name',
        'e_ticket_number',
    ];

    protected $casts = [
        'credit_note_amount' => 'decimal:2',
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}