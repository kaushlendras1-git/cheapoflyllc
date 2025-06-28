<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $flight = CallLog::where('user', $userId)->where('chkflight', 1)->count();
        $hotel = CallLog::where('user', $userId)->where('chkhotel', 1)->count();
        $cruise = CallLog::where('user', $userId)->where('chkcruise', 1)->count();
        $car = CallLog::where('user', $userId)->where('chkcar', 1)->count();
        $today_score = 350;
        $weekly_score= 1200;
        $monthly_score= 8002;

        return view('web.admin-dashboard', compact('flight', 'hotel', 'cruise', 'car','today_score','weekly_score','monthly_score'));
    }
}
