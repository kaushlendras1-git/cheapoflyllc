<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthHistory extends Model
{
    protected $fillable = [
        'booking_id',
        'billing_details_id',
        'travel_billing_details_id',
        'user_id',
        'action',
        'type',
        'sent_to',
        'details'
    ];
}
