<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CallLog;
use App\Models\Attendance;
use App\Models\ShortBreak;
use Carbon;

class UserDashboardController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $flight = CallLog::where('user_id', $userId)->where('chkflight', 1)->count();
        $hotel = CallLog::where('user_id', $userId)->where('chkhotel', 1)->count();
        $cruise = CallLog::where('user_id', $userId)->where('chkcruise', 1)->count();
        $car = CallLog::where('user_id', $userId)->where('chkcar', 1)->count();
        $today_score = 350;
        $weekly_score= 1200;
        $monthly_score= 8002;

        
        // $attendances = Attendance::where('user_id', $userId)
        //     ->whereMonth('attendance_date', 7)  // June
        //     ->whereYear('attendance_date', 2025)
        //     ->pluck('status', 'attendance_date');

        $attendances=[];

        //   \App\Models\Attendance::create([
        //     'user_id' => 1,
        //     'attendance_date' => '2025-07-08',
        //     'status' => 'H',
        // ]);

    //     \App\Models\ShortBreak::create([
    //     'user_id' => 1,
    //     'type' => 'Short',
    //     'break_date' => today(),
    //     'status' => 'Ended',
    //     'start_time' => now()->subMinutes(13),
    //     'end_time' => now(),
    //     'total_time' => 13,
    //     'approved' => true,
    // ]);

        // Format result for calendar grid
        $daysInMonth = Carbon\Carbon::createFromDate(2025, 7, 1)->daysInMonth;
        $calendar = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon\Carbon::create(2025, 7, $day)->format('Y-m-d');
            $calendar[$day] = $attendances[$date] ?? '';
        }


        return view('web.user-dashboard', compact('calendar','flight', 'hotel', 'cruise', 'car','today_score','weekly_score','monthly_score'));
    }
}
