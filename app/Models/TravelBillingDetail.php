<?php

namespace App\Models;
use Google\Api\Billing;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBillingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_billing_details';

    protected $fillable = [
        'booking_id',
        'card_type',
        'cc_number',
        'cc_holder_name',
        'exp_month',
        'exp_year',
        'cvv',
        'address',
        'email',
        'contact_no',
        'city',
        'country',
        'state',
        'zip_code',
        'currency',
        'amount',
        'is_active',
        'authorized_amt',
        'new_field',
        'is_paid'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }

    // Encrypt sensitive fields
    public function setCcNumberAttribute($value)
    {
        //$this->attributes['cc_number'] = $value ? encrypt($value) : null;
        $this->attributes['cc_number'] = $value;
    }

    public function getCcNumberAttribute($value)
    {
        // try {
        //     return $value ? decrypt($value) : null;
        // } catch (DecryptException $e) {
        //     return $value;
        // }
        return $value;
    }

    public function setCvvAttribute($value)
    {
        //$this->attributes['cvv'] = $value ? encrypt($value) : null;
        $this->attributes['cvv'] = $value;
    }

    public function getCvvAttribute($value)
    {
        // try {
        //     return $value ? decrypt($value) : null;
        // } catch (DecryptException $e) {
        //     return $value;
        // }
        return $value;
    }
    public function getBillingDetail(){
        return $this->belongsTo(BillingDetail::class, 'state');
    }
}
