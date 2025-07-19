<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CallLog;
use App\Models\Attendance;
use App\Models\ShortBreak;
use App\Models\TravelBooking;
use Carbon\Carbon;


class UserDashboardController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $flight = CallLog::where('user_id', $userId)->where('chkflight', 1)->count();
        $hotel = CallLog::where('user_id', $userId)->where('chkhotel', 1)->count();
        $cruise = CallLog::where('user_id', $userId)->where('chkcruise', 1)->count();
        $car = CallLog::where('user_id', $userId)->where('chkcar', 1)->count();
        $train = CallLog::where('user_id', $userId)->where('chktrain', 1)->count();
        $pending = CallLog::where('user_id', $userId)->where('call_converted','!=1', 1)->count();

        $flight_booking = TravelBooking::where('user_id', $userId)->where('airlinepnr','!=', NULL)->count();
        $hotel_booking = TravelBooking::where('user_id', $userId)->where('hotel_ref','!=', NULL)->count();
        $cruise_booking = TravelBooking::where('user_id', $userId)->where('cruise_ref','!=', NULL)->count();
        $car_booking = TravelBooking::where('user_id', $userId)->where('car_ref','!=', NULL)->count();
        $train_booking = 0;
        $pending_booking = TravelBooking::where('user_id', $userId)->where('booking_status_id',1)->count();

        $today_score = 350;
        $weekly_score= 1200;
        $monthly_score= 8002;

        
         $attendances = Attendance::where('user_id', $userId)
             ->whereMonth('attendance_date', 7)  // June
             ->whereYear('attendance_date', 2025)
             ->pluck('status', 'attendance_date');

       
          \App\Models\Attendance::firstOrCreate([
                'user_id' => $userId,
                'attendance_date' => Carbon::today()->toDateString(),
            ], [
                'status' => 'P',
            ]);

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
        $daysInMonth = Carbon::createFromDate(2025, 7, 1)->daysInMonth;
        $calendar = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create(2025, 7, $day)->format('Y-m-d');
            $calendar[$day] = $attendances[$date] ?? '';
        }

        return view('web.user-dashboard', compact('calendar','flight', 'hotel', 'cruise', 'car','train','today_score','weekly_score','monthly_score','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending','pending_booking'));
    }
}
