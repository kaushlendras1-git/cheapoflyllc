<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'description',
        'remarks',
        'progress_status',
        'attempted_by'
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'attempted_by');
    }
}