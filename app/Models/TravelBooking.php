<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 use App\Traits\LogsActivity;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;

class TravelBooking extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'travel_bookings';

    protected $fillable = [
        'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr','user_id',
        'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
        'selected_company', 'booking_status_id', 'payment_status_id', 'reservation_source',
        'descriptor','flightbookingimage','hotelbookingimage','cruisebookingimage','carbookingimage','trainbookingimage',
        'call_queue','shared_booking','screenshot','gross_value','net_value','gross_mco','net_mco','merchant_fee','car_description',
        'hotel_description','train_description','hotel_payment_type','cruise_payment_type','car_payment_type','card_details_json',
        'changes_assign_to'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'card_details_json'=>'array'
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

    public function trainBookingDetails()
    {
        return $this->hasMany(TravelTrainDetail::class, 'booking_id');
    }

    public function billingDetails()
    {
        return $this->hasMany(TravelBillingDetail::class, 'booking_id');
    }

    public function pricingDetails()
    {
        return $this->hasMany(TravelPricingDetail::class, 'booking_id');
    }

    public function remarks()
    {
        return $this->hasMany(TravelBookingRemark::class, 'booking_id')->where('status',1)->orderBy('id', 'asc');
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

    public function lobs()
    {
        return $this->belongsTo(PaymentStatus::class, 'selected_company');
    }

    public function getSelectedCompanyNameAttribute()
    {
        $companies = [
            1 => 'flydreamz',
            2 => 'fareticketsus',
            3 => 'fareticketsllc',
            4 => 'cruiselineservice'
        ];

        return $companies[$this->selected_company] ?? null;
    }

    public function logChange() {
        return true;
        // return $this->hasMany(TravelBookingChangeLog::class, 'booking_id');
    }


}
