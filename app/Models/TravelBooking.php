<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Loggable;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;

class TravelBooking extends Model
{
    use HasFactory;
    use Loggable;

    protected $table = 'travel_bookings';

    protected $fillable = [
        'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr',
        'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
        'selected_company', 'booking_status_id', 'payment_status_id', 'reservation_source',
        'descriptor','flightbookingimage','hotelbookingimage','cruisebookingimage','carbookingimage','trainbookingimage',
        'call_queue','shared_booking','screenshot'
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
    
    public function trainBookingDetails()
    {
        return $this->hasMany(TravelTrainDetail::class, 'booking_id');
    }

    public function pricingDetails()
    {
        return $this->hasMany(TravelPricingDetail::class, 'booking_id');
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

    public function changeLogs()
    {
        return $this->hasMany(ChangeLogs::class, 'booking_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class, 'booking_status_id');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }


}
