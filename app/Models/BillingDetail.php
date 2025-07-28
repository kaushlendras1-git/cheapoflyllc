<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    protected $fillable = [
        'email',
        'contact_number',
        'street_address',
        'city',
        'state',
        'zip_code',
        'country',
        'booking_id'
    ];

}
