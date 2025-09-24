<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getBookingStatuses()
    {
        $statuses = BookingStatus::where('status', 1)->get(['id', 'name']);
        return response()->json($statuses);
    }
    
    public function getPaymentStatuses()
    {
        $statuses = PaymentStatus::where('status', 1)->get(['id', 'name']);
        return response()->json($statuses);
    }
}