<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPaymentStatus extends Model
{
    protected $fillable = [
        'booking_status_id',
        'payment_status_id', 
        'department',
        'role'
    ];

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }
}