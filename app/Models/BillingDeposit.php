<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDeposit extends Model
{
    protected $table = 'billing_deposits';

    protected $fillable = [
        'booking_id',
        'deposit_type',
        'total_amount',
        'deposit_amount',
        'pending_amount',
        'due_date',
    ];
    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}
