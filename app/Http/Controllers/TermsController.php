<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\Merchant;
use App\Models\TravelBookingType;

class TermsController extends Controller
{
    // General Terms
    public function index()
    {   
        return view('terms.terms-and-conditions');
    }

    // Flydreamz
   
    public function Nonrefundable($refundStatus, $booking_id)
    {   
        $booking_id = decode($booking_id);
        $booking = TravelBooking::find($booking_id);    
        $merchant = Merchant::find($booking->selected_company);
        $booking_type = TravelBookingType::where('booking_id', $booking_id)->get();

        return view('terms.nonrefundable',compact('booking','merchant','booking_type'));
    }


    // FareticketsUS
    public function Refundable($refundStatus, $booking_id)
    {
        return view('terms.refundable');
    }

   
}
