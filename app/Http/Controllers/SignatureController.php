<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\FlightImages;
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
use App\Models\TravelCruise;
use App\Models\TravelHotelDetail;
use App\Models\UserShiftAssignment;
use App\Models\ChangeLog;
use App\Models\Campaign;
use App\Models\User;
use App\Models\TravelCruiseAddon;
use App\Models\BookingType;
use App\Models\BillingDeposit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SignatureController extends Controller
{

    protected $logController;

    public function showForm($booking_id, $card_id, $card_billing_id, $refund_status)
    {
        $id = decode($booking_id);
        $fare_type = $refund_status;
        $card_id_state= decode($card_id);
        $card_billing_id = decode($card_billing_id);

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

        #dd($card_billing_id);

        $billingPricingData = DB::table('travel_billing_details as b')
                            ->join('billing_details as p', 'b.state', '=', 'p.id')
                            ->where('b.booking_id', $booking->id)
                            ->where('b.id', $card_billing_id)
                            ->select(
                                'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 'b.exp_month', 'b.exp_year', 'b.cvv','b.amount','b.authorized_amt',
                                'p.email', 'p.contact_number', 'p.street_address', 'p.city', 'p.state', 'p.zip_code','p.country'
                            )
                            ->first();

        $billingPricingDataAll = DB::table('travel_billing_details as b')
        ->join('billing_details as p', 'b.state', '=', 'p.id')
        ->where('b.booking_id', $booking->id)
        ->where('b.id', $card_billing_id)
        ->select(
            'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 'b.exp_month', 'b.exp_year', 'b.cvv','b.amount','b.authorized_amt',
            'p.email', 'p.contact_number', 'p.street_address', 'p.city', 'p.state', 'p.zip_code','p.country'
        )
        ->get();



        $booking_status = BookingStatus::where('status',1)->get();
        $payment_status = PaymentStatus::where('status',1)->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::where('booking_id',$booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = FlightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $travel_cruise_data = TravelCruise::where('booking_id', $booking->id)->first();
        $billing_deposits = BillingDeposit::where('booking_id', $booking->id)->first();        
        $travel_cruise_addon = TravelCruiseAddon::where('booking_id',$booking->id)->get();
        $users = User::get();
        return view('web.signature.signature', compact('billing_deposits','fare_type','billingPricingDataAll','travel_cruise_addon','travel_cruise_data','card_id_state','card_billing_id','refund_status','billingPricingData','car_images','cruise_images','flight_images','hotel_images','train_images','screenshot_images','booking','users', 'hashids','booking_status','payment_status','campaigns','billingData'));
    }


    public function pdf($booking_id, $card_id, $card_billing_id, $refund_status)
    {
        $hashids = $booking_id;
        $id = decode($booking_id);
        $fare_type = $refund_status;
        $card_id_state= decode($card_id);
        $card_billing_id = decode($card_billing_id);

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


        #dd($id);

        $billingPricingData = DB::table('travel_billing_details as b')
                            ->join('billing_details as p', 'b.state', '=', 'p.id')
                            ->where('b.booking_id', $booking->id)
                            ->where('b.id', $card_billing_id)
                            ->select(
                                'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 'b.exp_month', 'b.exp_year', 'b.cvv','b.amount','b.authorized_amt',
                                'p.email', 'p.contact_number', 'p.street_address', 'p.city', 'p.state', 'p.zip_code','p.country'
                            )
                            ->first();

        $billingPricingDataAll = DB::table('travel_billing_details as b')
        ->join('billing_details as p', 'b.state', '=', 'p.id')
         ->where('b.booking_id', $booking->id)
         ->where('b.id', $card_billing_id)
        ->select(
            'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 'b.exp_month', 'b.exp_year', 'b.cvv','b.amount','b.authorized_amt',
            'p.email', 'p.contact_number', 'p.street_address', 'p.city', 'p.state', 'p.zip_code','p.country'
        )
        ->get();

        $booking_status = BookingStatus::where('status',1)->get();
        $payment_status = PaymentStatus::where('status',1)->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::where('booking_id',$booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = FlightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $travel_cruise_data = TravelCruise::where('booking_id', $booking->id)->first();
        $travel_cruise_addon = TravelCruiseAddon::where('booking_id',$booking->id)->get();
        $users = User::get();
        
        // Generate PDF using wkhtmltopdf with fallback
        $html = view('web.signature.signature-pdf', compact('fare_type',
            'billingPricingDataAll','travel_cruise_addon','travel_cruise_data','card_id',
            'card_billing_id','refund_status','billingPricingData','car_images','cruise_images',
            'flight_images','hotel_images','train_images','screenshot_images','booking','users',
            'hashids','booking_status','payment_status','campaigns','billingData'
        ))->render();
        
        $tempHtml = tempnam(sys_get_temp_dir(), 'pdf_') . '.html';
        $tempPdf = tempnam(sys_get_temp_dir(), 'pdf_') . '.pdf';
        
        file_put_contents($tempHtml, $html);
        
        // Check if exec() function is available
        if (!function_exists('exec')) {
            // Fallback to original PDF method when exec is disabled
            unlink($tempHtml);
            $pdf = \PDF::loadView('web.signature.signature-pdf', compact(
                'billingPricingDataAll','travel_cruise_addon','travel_cruise_data','card_id',
                'card_billing_id','refund_status','billingPricingData','car_images','cruise_images',
                'flight_images','hotel_images','train_images','screenshot_images','booking','users',
                'hashids','booking_status','payment_status','campaigns','billingData'
            ));
            return $pdf->stream($booking->pnr . '.pdf', ['Attachment' => false]);
        }
        
        $command = "wkhtmltopdf --page-size A4 --margin-top 0.75in --margin-right 0.75in --margin-bottom 0.75in --margin-left 0.75in --enable-local-file-access --load-error-handling ignore --load-media-error-handling ignore \"{$tempHtml}\" \"{$tempPdf}\"";
        \exec($command, $output, $returnCode);
        
        if ($returnCode !== 0 || !file_exists($tempPdf)) {
            // Fallback to original PDF method
            unlink($tempHtml);
            $pdf = \PDF::loadView('web.signature.signature-pdf', compact(
                'billingPricingDataAll','travel_cruise_addon','travel_cruise_data','card_id',
                'card_billing_id','refund_status','billingPricingData','car_images','cruise_images',
                'flight_images','hotel_images','train_images','screenshot_images','booking','users',
                'hashids','booking_status','payment_status','campaigns','billingData'
            ));
            return $pdf->stream($booking->pnr . '.pdf', ['Attachment' => false]);
        }
        
        $pdf = file_get_contents($tempPdf);
        
        unlink($tempHtml);
        unlink($tempPdf);
        
        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $booking->pnr . '.pdf"'
        ]);

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
        $card_id = decode($request->input('card_id'));
        $card_billing_id = decode($request->input('card_billing_id'));

        if($request->input('refund_status') == 'refundable'){
            $refund_status = 1;
        }
        else{
            $refund_status = 0;
        }

        Signature::create([
            'booking_id' => $booking_id,
            'card_id' => $card_id,
            'card_billing_id' => $card_billing_id,
            'refund_status' => $refund_status,

            'signature_data' => $request->input('signature'),
            'signature_type' => $request->input('signature_type'),
            'ip_address' => $publicIP,
        ]);
        TravelBooking::where('id', $booking_id)->update(['booking_status_id' => 23]);
        return response()->json([
            'message'=>'Thanks for Authorization!',
            'code'=>200,
            'status'=>true
        ],200);
    }


}
