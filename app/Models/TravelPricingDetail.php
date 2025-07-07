<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Loggable;

class TravelPricingDetail extends Model
{
    use HasFactory, SoftDeletes;
    use Loggable;

    protected $table = 'travel_pricing_details';

    protected $fillable = [
        'booking_id',
        'hotel_cost',
        'cruise_cost',
        'total_amount',
        'advisor_mco',
        'conversion_charge',
        'airline_commission',
        'final_amount',
        'merchant',
        'net_mco',
        'passenger_type',
        'num_passengers',
        'gross_price',
        'net_price',
        'details'
    ];

    protected $casts = [
        'hotel_cost' => 'decimal:2',
        'cruise_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'advisor_mco' => 'decimal:2',
        'conversion_charge' => 'decimal:2',
        'airline_commission' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'net_mco' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}
