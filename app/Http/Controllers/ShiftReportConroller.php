<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TravelBooking;

class ShiftReportConroller extends Controller
{
    public function index(){
        $report = TravelBooking::select('shifts.name', DB::raw('COUNT(*) as total'))
                ->join('shifts', 'travel_bookings.shift_id', '=', 'shifts.id')
                ->groupBy('shifts.name')
                ->get();
    }
}
