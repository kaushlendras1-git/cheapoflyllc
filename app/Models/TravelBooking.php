<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_bookings';

    protected $fillable = [
        'pnr',
        'hotel_ref',
        'cruise_ref',
        'name',
        'phone',
        'email',
        'query_type',
        'company_organisation',
        'booking_status',
        'payment_status',
        'reservation_source',
        'descriptor',
        'amadeus_sabre_pnr',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function bookingTypes()
    {
        return $this->hasMany(TravelBookingType::class, 'booking_id');
    }

    public function sectorDetails()
    {
        return $this->hasMany(TravelSectorDetail::class, 'booking_id');
    }

    public function passengers()
    {
        return $this->hasMany(TravelPassenger::class, 'booking_id');
    }

    public function billingDetails()
    {
        return $this->hasMany(TravelBillingDetail::class, 'booking_id');
    }

    public function pricingDetails()
    {
        return $this->hasOne(TravelPricingDetail::class, 'booking_id');
    }

    public function remarks()
    {
        return $this->hasMany(TravelBookingRemark::class, 'booking_id');
    }

    public function qualityFeedback()
    {
        return $this->hasMany(TravelQualityFeedback::class, 'booking_id');
    }

    public function screenshots()
    {
        return $this->hasMany(TravelScreenshot::class, 'booking_id');
    }
    
    public function travelFlight()
    {
        return $this->hasMany(TravelFlightDetail::class, 'booking_id');
    }
    
    public function travelCar()
    {
        return $this->hasMany(TravelCarDetail::class, 'booking_id');
    }
    
    public function travelCruise()
    {
        return $this->hasMany(TravelCruiseDetail::class, 'booking_id');
    }
    
    public function travelHotel()
    {
        return $this->hasMany(TravelHotelDetail::class, 'booking_id');
    }

    

}