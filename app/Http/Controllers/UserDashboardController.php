<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CallLog;
use App\Models\Attendance;
use App\Models\ShortBreak;
use App\Models\TravelBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



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

        $booking_type_count = DB::table('travel_bookings as b')
                    ->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')
                    ->selectRaw("
                        SUM(CASE WHEN t.type = 'Flight' THEN 1 ELSE 0 END) as flight_booking,
                        SUM(CASE WHEN t.type = 'Hotel' THEN 1 ELSE 0 END) as hotel_booking,
                        SUM(CASE WHEN t.type = 'Cruise' THEN 1 ELSE 0 END) as cruise_booking,
                        SUM(CASE WHEN t.type = 'Car' THEN 1 ELSE 0 END) as car_booking,
                        SUM(CASE WHEN t.type = 'Train' THEN 1 ELSE 0 END) as train_booking
                    ")
                    ->where('b.user_id', Auth::id())
                    #->whereMonth('b.created_at', now()->month)
                    #->whereYear('b.created_at', now()->year)
                    ->first();                           
        $flight_booking = $booking_type_count->flight_booking;
        $hotel_booking = $booking_type_count->flight_booking;
        $cruise_booking = $booking_type_count->flight_booking;
        $car_booking = $booking_type_count->flight_booking;
        $train_booking = $booking_type_count->flight_booking;

        $pending_booking = TravelBooking::where('user_id', $userId)->where('booking_status_id',1)->count();

        $scores = DB::table('travel_bookings')
                    ->selectRaw("
                        SUM(CASE WHEN DATE(created_at) = CURDATE() THEN net_value ELSE 0 END) as today_score,
                        SUM(CASE WHEN YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) THEN net_value ELSE 0 END) as weekly_score,
                        SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE()) THEN net_value ELSE 0 END) as monthly_score
                    ")
                    ->where('user_id', Auth::id())
                    ->first();

        $today_score   = $scores->today_score;
        $weekly_score  = $scores->weekly_score;
        $monthly_score = $scores->monthly_score;


        $charge_back_total = 22;
        $charge_back_count = 22;

        $total_booking_total = 0;
        $total_booking_count = 0;
        
        $refund_total = 16;
        $refund_count = 0;

        
        $attendances = Attendance::where('user_id', $userId)
             ->whereMonth('attendance_date', date('m'))  // June
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
        $daysInMonth = Carbon::createFromDate(2025, date('m'), 1)->daysInMonth;
        $calendar = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create(2025, date('m'), $day)->format('Y-m-d');
            $calendar[$day] = $attendances[$date] ?? '';
        }

        return view('web.user-dashboard', 
        compact('calendar','charge_back_total','charge_back_count','total_booking_total','total_booking_count','refund_total','refund_count',
                'flight', 'hotel', 'cruise', 'car','train','today_score','weekly_score','monthly_score','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending','pending_booking'));
    }
}
