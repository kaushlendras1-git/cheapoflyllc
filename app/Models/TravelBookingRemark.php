<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBookingRemark extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_booking_remarks';

    protected $fillable = ['booking_id', 'agent', 'date_time', 'particulars'];

    protected $casts = [
        'date_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
    
    public function agentUser()
    {
        return $this->belongsTo(User::class, 'agent');
    }

}