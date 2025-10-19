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
        $pending = CallLog::whereIn('user_id', $teamMemberIds)->where('call_converted','!=', 1)->count();

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
        
        // Additional metrics for cards
        $today_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->whereDate('created_at', today())->count();
        $today_successful_bookings = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereDate('created_at', today())->count();
        $today_refund = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->whereDate('created_at', today())->sum('net_value') ?? 0;
        $today_chargeback = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->whereDate('created_at', today())->sum('net_value') ?? 0;
        $today_rpc = $today_calls > 0 ? round($today_score / $today_calls, 2) : 0;
        $today_conversion = $today_calls > 0 ? round(($today_successful_bookings * 100) / $today_calls, 2) : 0;
        $today_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereDate('created_at', today())->avg('quality_score') ?? 0, 2);
        
        $weekly_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weekly_successful_bookings = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weekly_refund = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('net_value') ?? 0;
        $weekly_chargeback = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('net_value') ?? 0;
        $weekly_rpc = $weekly_calls > 0 ? round($weekly_score / $weekly_calls, 2) : 0;
        $weekly_conversion = $weekly_calls > 0 ? round(($weekly_successful_bookings * 100) / $weekly_calls, 2) : 0;
        $weekly_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->avg('quality_score') ?? 0, 2);
        
        $monthly_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $monthly_successful_bookings = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $monthly_refund = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('net_value') ?? 0;
        $monthly_chargeback = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('net_value') ?? 0;
        $monthly_rpc = $monthly_calls > 0 ? round($monthly_score / $monthly_calls, 2) : 0;
        $monthly_conversion = $monthly_calls > 0 ? round(($monthly_successful_bookings * 100) / $monthly_calls, 2) : 0;
        $monthly_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->avg('quality_score') ?? 0, 2);
        
        // Booking type scores with additional metrics
        $flight_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $flight_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('chkflight', 1)->count();
        $flight_successful_bookings = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->whereIn('b.booking_status_id', [19, 20])->count();
        $flight_rpc = $flight_calls > 0 ? round($flight_score / $flight_calls, 2) : 0;
        $flight_conversion = $flight_calls > 0 ? round(($flight_successful_bookings * 100) / $flight_calls, 2) : 0;
        $flight_quality = round(DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->avg('b.quality_score') ?? 0, 2);
        $flight_refund = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->whereIn('b.payment_status_id', [13, 16])->sum('b.net_value') ?? 0;
        $flight_chargeback = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Flight')->where('b.booking_status_id', 22)->sum('b.net_value') ?? 0;
        
        $hotel_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $hotel_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('chkhotel', 1)->count();
        $hotel_successful_bookings = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->whereIn('b.booking_status_id', [19, 20])->count();
        $hotel_rpc = $hotel_calls > 0 ? round($hotel_score / $hotel_calls, 2) : 0;
        $hotel_conversion = $hotel_calls > 0 ? round(($hotel_successful_bookings * 100) / $hotel_calls, 2) : 0;
        $hotel_quality = round(DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->avg('b.quality_score') ?? 0, 2);
        $hotel_refund = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->whereIn('b.payment_status_id', [13, 16])->sum('b.net_value') ?? 0;
        $hotel_chargeback = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Hotel')->where('b.booking_status_id', 22)->sum('b.net_value') ?? 0;
        
        $cruise_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $cruise_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('chkcruise', 1)->count();
        $cruise_successful_bookings = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->whereIn('b.booking_status_id', [19, 20])->count();
        $cruise_rpc = $cruise_calls > 0 ? round($cruise_score / $cruise_calls, 2) : 0;
        $cruise_conversion = $cruise_calls > 0 ? round(($cruise_successful_bookings * 100) / $cruise_calls, 2) : 0;
        $cruise_quality = round(DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->avg('b.quality_score') ?? 0, 2);
        $cruise_refund = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->whereIn('b.payment_status_id', [13, 16])->sum('b.net_value') ?? 0;
        $cruise_chargeback = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Cruise')->where('b.booking_status_id', 22)->sum('b.net_value') ?? 0;
        
        $car_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $car_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('chkcar', 1)->count();
        $car_successful_bookings = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->whereIn('b.booking_status_id', [19, 20])->count();
        $car_rpc = $car_calls > 0 ? round($car_score / $car_calls, 2) : 0;
        $car_conversion = $car_calls > 0 ? round(($car_successful_bookings * 100) / $car_calls, 2) : 0;
        $car_quality = round(DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->avg('b.quality_score') ?? 0, 2);
        $car_refund = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->whereIn('b.payment_status_id', [13, 16])->sum('b.net_value') ?? 0;
        $car_chargeback = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Car')->where('b.booking_status_id', 22)->sum('b.net_value') ?? 0;
        
        $train_score = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->whereIn('b.booking_status_id', [19, 20])->sum('b.net_value') ?? 0;
        $train_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('chktrain', 1)->count();
        $train_successful_bookings = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->whereIn('b.booking_status_id', [19, 20])->count();
        $train_rpc = $train_calls > 0 ? round($train_score / $train_calls, 2) : 0;
        $train_conversion = $train_calls > 0 ? round(($train_successful_bookings * 100) / $train_calls, 2) : 0;
        $train_quality = round(DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->avg('b.quality_score') ?? 0, 2);
        $train_refund = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->whereIn('b.payment_status_id', [13, 16])->sum('b.net_value') ?? 0;
        $train_chargeback = DB::table('travel_bookings as b')->join('travel_booking_types as t', 't.booking_id', '=', 'b.id')->whereIn('b.user_id', $teamMemberIds)->where('t.type', 'Train')->where('b.booking_status_id', 22)->sum('b.net_value') ?? 0;
        
        $package_booking_ids = DB::table('travel_booking_types')->select('booking_id')->whereIn('booking_id', function($query) use ($teamMemberIds) { $query->select('id')->from('travel_bookings')->whereIn('user_id', $teamMemberIds); })->groupBy('booking_id')->havingRaw('COUNT(DISTINCT type) > 1')->pluck('booking_id');
        $package_booking = count($package_booking_ids);
        $package_score = DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->whereIn('booking_status_id', [19, 20])->sum('net_value') ?? 0;
        $package_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->whereRaw('(chkflight + chkhotel + chkcruise + chkcar + chktrain) > 1')->count();
        $package_successful_bookings = DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->whereIn('booking_status_id', [19, 20])->count();
        $package_rpc = $package_calls > 0 ? round($package_score / $package_calls, 2) : 0;
        $package_conversion = $package_calls > 0 ? round(($package_successful_bookings * 100) / $package_calls, 2) : 0;
        $package_quality = round(DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->avg('quality_score') ?? 0, 2);
        $package_refund = DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->whereIn('payment_status_id', [13, 16])->sum('net_value') ?? 0;
        $package_chargeback = DB::table('travel_bookings')->whereIn('id', $package_booking_ids)->where('booking_status_id', 22)->sum('net_value') ?? 0;
        
        // Status-based metrics
        $declined_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 21)->count();
        $declined_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 21)->sum('net_value') ?? 0;
        $declined_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->where('call_converted', '!=', 1)->count();
        $declined_rpc = $declined_calls > 0 ? round($declined_score / $declined_calls, 2) : 0;
        $declined_conversion = 0;
        $declined_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 21)->avg('quality_score') ?? 0, 2);
        $declined_refund = 0;
        $declined_chargeback = 0;
        
        $chargeback_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->count();
        $chargeback_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->sum('net_value') ?? 0;
        $chargeback_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->count();
        $chargeback_bookings = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->count();
        $chargeback_rpc = $chargeback_calls > 0 ? round($chargeback_score / $chargeback_calls, 2) : 0;
        $chargeback_conversion = $chargeback_calls > 0 ? round(($chargeback_bookings * 100) / $chargeback_calls, 2) : 0;
        $chargeback_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->where('booking_status_id', 22)->avg('quality_score') ?? 0, 2);
        $chargeback_refund = 0;
        $chargeback_chargeback = $chargeback_score;
        
        $refund_count = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->count();
        $refund_score = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->sum('net_value') ?? 0;
        $refund_calls = DB::table('call_logs')->whereIn('user_id', $teamMemberIds)->count();
        $refund_bookings = DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->count();
        $refund_rpc = $refund_calls > 0 ? round($refund_score / $refund_calls, 2) : 0;
        $refund_conversion = $refund_calls > 0 ? round(($refund_bookings * 100) / $refund_calls, 2) : 0;
        $refund_quality = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('payment_status_id', [13, 16])->avg('quality_score') ?? 0, 2);
        $refund_refund = $refund_score;
        $refund_chargeback = 0;
        
        $quality_avg = round(DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->avg('quality_score') ?? 0, 2);
        
        // Graph data for charts
        // Top 10 Ranks Agent (team members)
        $top10Agents = DB::table('travel_bookings')
            ->join('users', 'users.id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->selectRaw('users.name, SUM(travel_bookings.net_value) as total_score')
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_score', 'desc')
            ->limit(10)
            ->get();
            
        // Shift wise data
        $shiftWiseData = DB::table('travel_bookings')
            ->join('user_shift_assignments', 'user_shift_assignments.user_id', '=', 'travel_bookings.user_id')
            ->whereIn('travel_bookings.user_id', $teamMemberIds)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->selectRaw('user_shift_assignments.shift_id, SUM(travel_bookings.net_value) as total_score, COUNT(*) as bookings')
            ->groupBy('user_shift_assignments.shift_id')
            ->get();
            
        // Merchant wise data
        $merchantWiseData = DB::table('travel_bookings')
            ->whereIn('user_id', $teamMemberIds)
            ->whereIn('booking_status_id', [19, 20])
            ->selectRaw('selected_company, SUM(net_value) as total_score, COUNT(*) as bookings')
            ->groupBy('selected_company')
            ->orderBy('total_score', 'desc')
            ->get();
            
        // Per day wise score (30 days)
        $dailyScoreData = DB::table('travel_bookings')
            ->whereIn('user_id', $teamMemberIds)
            ->whereIn('booking_status_id', [19, 20])
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(net_value) as daily_score, SUM(gross_mco) as gross_mco, SUM(net_mco) as net_mco')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        // Gross MCO & Net MCO comparison
        $mcoComparison = [
            'gross_mco' => DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->sum('gross_mco') ?? 0,
            'net_mco' => DB::table('travel_bookings')->whereIn('user_id', $teamMemberIds)->whereIn('booking_status_id', [19, 20])->sum('net_mco') ?? 0
        ];

        return view('web.teamleader-dashboard', compact(
            'dailyPerformance', 'weeklyPerformance', 'monthlyPerformance',
            'flight', 'hotel', 'cruise', 'car', 'train', 'pending',
            'flight_booking', 'hotel_booking', 'cruise_booking', 'car_booking', 'train_booking', 'package_booking', 'pending_booking',
            'today_score', 'weekly_score', 'monthly_score',
            'today_calls', 'today_rpc', 'today_conversion', 'today_quality', 'today_refund', 'today_chargeback',
            'weekly_calls', 'weekly_rpc', 'weekly_conversion', 'weekly_quality', 'weekly_refund', 'weekly_chargeback',
            'monthly_calls', 'monthly_rpc', 'monthly_conversion', 'monthly_quality', 'monthly_refund', 'monthly_chargeback',
            'flight_score', 'flight_calls', 'flight_rpc', 'flight_conversion', 'flight_quality', 'flight_refund', 'flight_chargeback',
            'hotel_score', 'hotel_calls', 'hotel_rpc', 'hotel_conversion', 'hotel_quality', 'hotel_refund', 'hotel_chargeback',
            'cruise_score', 'cruise_calls', 'cruise_rpc', 'cruise_conversion', 'cruise_quality', 'cruise_refund', 'cruise_chargeback',
            'car_score', 'car_calls', 'car_rpc', 'car_conversion', 'car_quality', 'car_refund', 'car_chargeback',
            'train_score', 'train_calls', 'train_rpc', 'train_conversion', 'train_quality', 'train_refund', 'train_chargeback',
            'package_score', 'package_calls', 'package_rpc', 'package_conversion', 'package_quality', 'package_refund', 'package_chargeback',
            'declined_count', 'declined_score', 'declined_calls', 'declined_rpc', 'declined_conversion', 'declined_quality', 'declined_refund', 'declined_chargeback',
            'chargeback_count', 'chargeback_score', 'chargeback_calls', 'chargeback_rpc', 'chargeback_conversion', 'chargeback_quality', 'chargeback_refund', 'chargeback_chargeback',
            'refund_count', 'refund_score', 'refund_calls', 'refund_rpc', 'refund_conversion', 'refund_quality', 'refund_refund', 'refund_chargeback',
            'quality_avg', 'top10Agents', 'shiftWiseData', 'merchantWiseData', 'dailyScoreData', 'mcoComparison'
        ));
    }
}