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
        'card_last_digit',
        'action',
        'type',
        'sent_to',
        'details',
        'card_id',
        'card_billing_id'
    ];


   public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function travel_billing_details(){
       return $this->belongsTo(TravelBillingDetail::class, 'card_billing_id', 'id');
    }
}
