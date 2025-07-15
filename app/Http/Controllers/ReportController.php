<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;

class ReportController extends Controller
{
    
    public function marketing()
    {   
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();
        return view('web.reports.marketing',compact('booking_status','payment_status'));
    }

    public function call_queue()
    {   
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();
        return view('web.reports.call_queue',compact('booking_status','payment_status'));
    }
    public function agents()
    {   
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();
        return view('web.reports.agents',compact('booking_status','payment_status'));
    }

    public function score()
    {
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();
        return view('web.reports.score',compact('booking_status','payment_status'));
    }

}
