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
            ->selectRaw('users.name, SUM(travel_bookings.net_mco) as net_mco')
            ->groupBy('users.id', 'users.name')
            ->orderBy('net_mco', 'desc')
            ->get();

        // Weekly team performance
        $weeklyPerformance = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereBetween('travel_bookings.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('users.name, SUM(travel_bookings.net_mco) as net_mco')
            ->groupBy('users.id', 'users.name')
            ->orderBy('net_mco', 'desc')
            ->get();

        // Monthly team performance
        $monthlyPerformance = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereMonth('travel_bookings.created_at', now()->month)
            ->whereYear('travel_bookings.created_at', now()->year)
            ->selectRaw('users.name, SUM(travel_bookings.net_mco) as net_mco')
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

        $scores = DB::table('travel_bookings')
                    ->selectRaw("
                        SUM(CASE WHEN DATE(created_at) = CURDATE() THEN net_value ELSE 0 END) as today_score,
                        SUM(CASE WHEN YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) THEN net_value ELSE 0 END) as weekly_score,
                        SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE()) THEN net_value ELSE 0 END) as monthly_score
                    ")
                    ->whereIn('user_id', $teamMemberIds)
                    ->first();

        $today_score   = $scores->today_score ?? 0;
        $weekly_score  = $scores->weekly_score ?? 0;
        $monthly_score = $scores->monthly_score ?? 0;

        $charge_back_data = TravelBooking::whereIn('user_id', $teamMemberIds)
                                        ->where('booking_status_id', 13)
                                        ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                        ->first();
        $charge_back_total = $charge_back_data->total ?? 0;
        $charge_back_count = $charge_back_data->count ?? 0;
        
        $refund_data = TravelBooking::whereIn('user_id', $teamMemberIds)
                                   ->where('payment_status_id', 16)
                                   ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                   ->first();
        $refund_total = $refund_data->total ?? 0;
        $refund_count = $refund_data->count ?? 0;
        
        $total_booking_data = TravelBooking::whereIn('user_id', $teamMemberIds)
                                          ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                          ->first();
        $total_booking_total = $total_booking_data->total ?? 0;
        $total_booking_count = $total_booking_data->count ?? 0;
        
        $attendances = Attendance::whereIn('user_id', $teamMemberIds)
             ->whereMonth('attendance_date', date('m'))
             ->whereYear('attendance_date', 2025)
             ->get()
             ->groupBy('user_id');

        $calendar = [];

        return view('web.teamleader-dashboard', 
        compact('dailyPerformance','weeklyPerformance','monthlyPerformance','calendar','charge_back_total','charge_back_count','total_booking_total','total_booking_count','refund_total','refund_count',
                'flight', 'hotel', 'cruise', 'car','train','today_score','weekly_score','monthly_score','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending','pending_booking'));
    }

    public function scoreDetails(Request $request)
    {
        $userId = Auth::id();
        
        $query = TravelBooking::where('user_id', $userId);
        
        // Apply filters
        if ($request->period) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'weekly':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
            }
        }
        
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        if ($request->booking_type) {
            $query->whereHas('bookingTypes', function($q) use ($request) {
                $q->where('type', $request->booking_type);
            });
        }
        
        // Handle filter types from cards
        if ($request->filter_type) {
            switch ($request->filter_type) {
                case 'chargeback':
                    $query->where('booking_status_id', 13);
                    break;
                case 'refund':
                    $query->where('payment_status_id', 16);
                    break;
                case 'total':
                    // No additional filter for total bookings
                    break;
            }
        }
        
        $bookings = $query->with(['bookingTypes', 'paymentStatus', 'bookingStatus'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);
        
        // Calculate scores for cards
        $scores = DB::table('travel_bookings')
                    ->selectRaw("
                        SUM(CASE WHEN DATE(created_at) = CURDATE() THEN net_value ELSE 0 END) as today_score,
                        SUM(CASE WHEN YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) THEN net_value ELSE 0 END) as weekly_score,
                        SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE()) THEN net_value ELSE 0 END) as monthly_score
                    ")
                    ->where('user_id', $userId)
                    ->first();
        
        // Calculate real data from travel_bookings
        $charge_back_data = TravelBooking::where('user_id', $userId)
                                        ->where('booking_status_id', 13)
                                        ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                        ->first();
        $charge_back_total = $charge_back_data->total ?? 0;
        $charge_back_count = $charge_back_data->count ?? 0;
        
        $refund_data = TravelBooking::where('user_id', $userId)
                                   ->where('payment_status_id', 16)
                                   ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                   ->first();
        $refund_total = $refund_data->total ?? 0;
        $refund_count = $refund_data->count ?? 0;
        
        $total_booking_data = TravelBooking::where('user_id', $userId)
                                          ->selectRaw('SUM(net_value) as total, COUNT(*) as count')
                                          ->first();
        $total_booking_total = $total_booking_data->total ?? 0;
        $total_booking_count = $total_booking_data->count ?? 0;
        
        return view('web.score-details', compact('bookings', 'scores', 'charge_back_total', 'charge_back_count', 'total_booking_total', 'total_booking_count', 'refund_total', 'refund_count'));
    }
}

