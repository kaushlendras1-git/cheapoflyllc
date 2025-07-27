<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'contact_number',
        'street_address',
        'city',
        'state',
        'zip_code',
        'country',
        'booking_id',
    ];

    /**
     * Get the booking associated with the billing detail.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}