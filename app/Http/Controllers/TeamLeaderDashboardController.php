<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CallLog;
use App\Models\Attendance;
use App\Models\ShortBreak;
use App\Models\TravelBooking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TeamLeaderDashboardController extends Controller
{

    public function index(){
        $userId = Auth::id();
        
        // Get team member IDs
        $teamMemberIds = \App\Models\User::where('team_leader', $userId)->pluck('id');
        
        // Daily team performance
        $dailyPerformance = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereDate('travel_bookings.created_at', today())
            ->selectRaw('users.name, SUM(travel_bookings.net_value) as net_mco')
            ->groupBy('users.id', 'users.name')
            ->orderBy('net_mco', 'desc')
            ->get();

        // Weekly team performance
        $weeklyPerformance = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereBetween('travel_bookings.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('users.name, SUM(travel_bookings.net_value) as net_mco')
            ->groupBy('users.id', 'users.name')
            ->orderBy('net_mco', 'desc')
            ->get();

        // Monthly team performance
        $monthlyPerformance = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereMonth('travel_bookings.created_at', now()->month)
            ->whereYear('travel_bookings.created_at', now()->year)
            ->selectRaw('users.name, SUM(travel_bookings.net_value) as net_mco')
            ->groupBy('users.id', 'users.name')
            ->orderBy('net_mco', 'desc')
            ->get();

        $flight = CallLog::whereIn('user_id', $teamMemberIds)->where('chkflight', 1)->count();
        $hotel = CallLog::whereIn('user_id', $teamMemberIds)->where('chkhotel', 1)->count();
        $cruise = CallLog::whereIn('user_id', $teamMemberIds)->where('chkcruise', 1)->count();
        $car = CallLog::whereIn('user_id', $teamMemberIds)->where('chkcar', 1)->count();
        $train = CallLog::whereIn('user_id', $teamMemberIds)->where('chktrain', 1)->count();
        $pending = CallLog::whereIn('user_id', $teamMemberIds)->where('call_converted','!=1', 1)->count();

        $booking_type_count = DB::table('travel_bookings as b')
                    ->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')
                    ->selectRaw("
                        SUM(CASE WHEN t.type = 'Flight' THEN 1 ELSE 0 END) as flight_booking,
                        SUM(CASE WHEN t.type = 'Hotel' THEN 1 ELSE 0 END) as hotel_booking,
                        SUM(CASE WHEN t.type = 'Cruise' THEN 1 ELSE 0 END) as cruise_booking,
                        SUM(CASE WHEN t.type = 'Car' THEN 1 ELSE 0 END) as car_booking,
                        SUM(CASE WHEN t.type = 'Train' THEN 1 ELSE 0 END) as train_booking
                    ")
                    ->whereIn('b.user_id', $teamMemberIds)
                    ->first();                           
        $flight_booking = $booking_type_count->flight_booking ?? 0;
        $hotel_booking = $booking_type_count->hotel_booking ?? 0;
        $cruise_booking = $booking_type_count->cruise_booking ?? 0;
        $car_booking = $booking_type_count->car_booking ?? 0;
        $train_booking = $booking_type_count->train_booking ?? 0;

        $pending_booking = TravelBooking::whereIn('user_id', $teamMemberIds)->where('booking_status_id',1)->count();

        // Team metrics calculations using net_value
        $today_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereDate('created_at', today())->sum('net_value') ?? 0;
        $weekly_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('net_value') ?? 0;
        $monthly_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('net_value') ?? 0;
        
        // Booking type scores
        $flight_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $hotel_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $cruise_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $car_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $train_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        
        // Package bookings (multiple types)
        $package_booking_ids = DB::table('travel_booking_types')->select('booking_id')->whereIn('booking_id', function($query) use ($teamMemberIds) { $query->select('id')->from('travel_bookings')->whereIn('user_id', $teamMemberIds); })->groupBy('booking_id')->havingRaw('COUNT(DISTINCT type) > 1')->pluck('booking_id');
        $package_booking = count($package_booking_ids);
        $package_score = DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->whereIn('booking_status_id', [19, 20])->sum('net_value') ?? 0;
        
        $declined_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 21)->count();
        $declined_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 21)->sum('net_value') ?? 0;
        $chargeback_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->count();
        $chargeback_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->sum('net_value') ?? 0;
        $refund_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->count();
        $quality_avg = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->avg('quality_score') ?? 0, 2);
        
        $attendances = Attendance::whereIn('user_id', $teamMemberIds)
             ->whereMonth('attendance_date', date('m'))
             ->whereYear('attendance_date', 2025)
             ->get()
             ->groupBy('user_id');

        $calendar = [];

        return view('web.teamleader-dashboard', 
        compact('dailyPerformance','weeklyPerformance','monthlyPerformance','calendar',
                'flight', 'hotel', 'cruise', 'car','train','today_score','weekly_score','monthly_score','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending','pending_booking',
                'flight_score','hotel_score','cruise_score','car_score','train_score','package_booking','package_score','declined_count','declined_score','chargeback_count','chargeback_score','refund_count','quality_avg'));
    }


}

