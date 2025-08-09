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
use Hashids\Hashids;
use Carbon\Carbon;


class SignatureController extends Controller
{   
    protected $hashids;
    protected $logController;

    public function __construct()
    {
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
    }

    public function showForm($hash)
    {
        $id = $this->hashids->decode($hash);
        $id = $id[0] ?? null;

        if (!$id) {
            abort(404);
        }
        $hashids = $hash;    
        $booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails',
            'pricingDetails',
            'remarks',
            'qualityFeedback',
            'trainBookingDetails',
            'screenshots',
            'travelFlight' => fn($query) => $query->withTrashed(), // Include soft-deleted flights
            'travelCar',
            'travelCruise',
            'travelHotel',
        ])->findOrFail($id);
        $booking_status = BookingStatus::where('status',1)->get();
        $payment_status = PaymentStatus::where('status',1)->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::where('booking_id',$booking->id)->get();
        $feed_backs = TravelQualityFeedback::where('booking_id', $booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = flightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $users = User::get();
        return view('web.signature.signature', compact('car_images','cruise_images','flight_images','hotel_images','train_images','screenshot_images','booking','users', 'hashids','feed_backs','booking_status','payment_status','campaigns','billingData'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'signature' => 'required|string',
             'signature_type' => 'required|in:draw,type', 
        ]);

        // Get Public IP from an external service
        $response = Http::get('https://api.ipify.org?format=json');
        $publicIP = $response->json('ip'); // Extract the IP address

        // Save signature and public IP in the database
        Signature::create([
            'signature_data' => $request->input('signature'),
            'signature_type' => $request->input('signature_type'),
            'ip_address' => $publicIP,
        ]);

        return redirect()->back()->with('success', 'Signature and IP saved successfully!');
    }


     public function list()
    {
        $signatures = Signature::all();
        return view('web.signature.signature-list', compact('signatures'));
    }


}
