<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\flightImages;
use App\Models\HotelImages;
use App\Models\ScreenshotImages;
use App\Models\TrainImages;
use App\Models\TravelTrainDetail;
use App\Utils\JsonResponse;
use App\Models\TravelBooking;
use App\Models\TravelBookingType;
use App\Models\TravelSectorDetail;
use App\Models\TravelPassenger;
use App\Models\TravelBillingDetail;
use App\Models\TravelPricingDetail;
use App\Models\TravelBookingRemark;
use App\Models\TravelQualityFeedback;
use App\Models\TravelScreenshot;
use App\Models\TravelFlightDetail;
use App\Models\TravelCarDetail;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\TravelCruiseDetail;
use App\Models\TravelHotelDetail;
use App\Models\UserShiftAssignment;
use App\Models\ChangeLog;
use App\Models\Campaign;
use App\Models\User;
use App\Models\BookingType;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SignatureController extends Controller
{   
 
    protected $logController;

    public function showForm($booking_id, $card_id, $card_billing_id, $refund_status)
    {   
        $id = decode($booking_id);
        $hashids = $booking_id;    
        $booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails',
            'pricingDetails',
            'trainBookingDetails',
            'screenshots',
            'travelFlight' => fn($query) => $query->withTrashed(),
            'travelCar',
            'travelCruise',
            'travelHotel',
        ])->findOrFail($id);
         
        $billingPricingData = DB::table('travel_billing_details as b')
                            ->join('billing_details as p', 'b.state', '=', 'p.id')
                            ->where('b.booking_id', $booking->id)
                            ->select(
                                'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 'b.exp_month', 'b.exp_year', 'b.cvv','b.authorized_amt',
                                'p.email', 'p.contact_number', 'p.street_address', 'p.city', 'p.state', 'p.zip_code','p.country'
                            )
                            ->first();

        $booking_status = BookingStatus::where('status',1)->get();
        $payment_status = PaymentStatus::where('status',1)->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::where('booking_id',$booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = flightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $users = User::get();
        return view('web.signature.signature', compact('card_id','card_billing_id','refund_status','billingPricingData','car_images','cruise_images','flight_images','hotel_images','train_images','screenshot_images','booking','users', 'hashids','booking_status','payment_status','campaigns','billingData'));
    }


    public function store(Request $request)
    {    
      
         $booking_id = decode($request->booking_id);
         $request->validate([
            'signature' => 'required|string',
             'signature_type' => 'required|in:draw,type', 
        ]);

        // Get Public IP from an external service
        $response = Http::get('https://api.ipify.org?format=json');
        $publicIP = $response->json('ip');
        Signature::create([
            'booking_id' => $booking_id,
            'card_id' => $request->input('card_id'),
            'card_billing_id' => $request->input('card_billing_id'),
            'refund_status' => $request->input('refund_status'),

            'signature_data' => $request->input('signature'),
            'signature_type' => $request->input('signature_type'),
            'ip_address' => $publicIP,
        ]);

        return redirect()->back()->with('success', 'Signature and IP saved successfully!');
    }


}
