<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusInterdependency extends Model
{
    protected $fillable = [
        'booking_status_id',
        'payment_status_id', 
        'department_id',
        'role_id',
        'direction'
    ];

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}