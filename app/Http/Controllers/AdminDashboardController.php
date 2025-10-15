<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $flight = CallLog::where('user_id', $userId)->where('chkflight', 1)->count();
        $hotel = CallLog::where('user_id', $userId)->where('chkhotel', 1)->count();
        $cruise = CallLog::where('user_id', $userId)->where('chkcruise', 1)->count();
        $car = CallLog::where('user_id', $userId)->where('chkcar', 1)->count();
        
        // Today's scores by booking type (net_value)
        $flight_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->where('travel_booking_types.type', 'Flight')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $hotel_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->where('travel_booking_types.type', 'Hotel')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $cruise_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->where('travel_booking_types.type', 'Cruise')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $car_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->where('travel_booking_types.type', 'Car')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $train_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->where('travel_booking_types.type', 'Train')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
        // Today's total net_value score
        $today_score = DB::table('travel_bookings')
            ->whereIn('booking_status_id', [19, 20])
            ->whereDate('created_at', date('Y-m-d'))
            ->sum('net_value') ?? 0;
        $weekly_score = DB::table('travel_bookings')
            ->whereIn('booking_status_id', [19, 20])
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('net_value') ?? 0;
            
        $monthly_score = DB::table('travel_bookings')
            ->whereIn('booking_status_id', [19, 20])
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->sum('net_value') ?? 0;
            
        // Weekly data - last 8 weeks
        $weeklyData = [];
        for ($i = 7; $i >= 0; $i--) {
            $startOfWeek = now()->subWeeks($i)->startOfWeek();
            $endOfWeek = now()->subWeeks($i)->endOfWeek();
            
            $weeklyProfit = DB::table('travel_bookings')
                ->whereIn('booking_status_id', [19, 20])
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->sum('net_value') ?? 0;
                
            $weeklyData[] = [
                'label' => $startOfWeek->format('M d') . ' - ' . $endOfWeek->format('M d'),
                'value' => $weeklyProfit
            ];
        }
        
        // Monthly data - last 12 months
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            
            $monthlyProfit = DB::table('travel_bookings')
                ->whereIn('booking_status_id', [19, 20])
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('net_value') ?? 0;
                
            $monthlyData[] = [
                'label' => $month->format('M Y'),
                'value' => $monthlyProfit
            ];
        }
        
        // Daily data - last 2 months
        $dailyData = [];
        $startDate = now()->subMonths(2)->startOfMonth();
        $endDate = now()->endOfDay();
        
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dailyProfit = DB::table('travel_bookings')
                ->whereIn('booking_status_id', [19, 20])
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('net_value') ?? 0;
                
            $dailyData[] = [
                'label' => $date->format('M d'),
                'value' => $dailyProfit
            ];
        }
        
        // Booking type line chart data - last 2 months
        $lineChartData = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateStr = $date->format('Y-m-d');
            
            $flightProfit = DB::table('travel_bookings')
                ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
                ->whereIn('travel_bookings.booking_status_id', [19, 20])
                ->where('travel_booking_types.type', 'Flight')
                ->whereDate('travel_bookings.created_at', $dateStr)
                ->sum('travel_bookings.net_value') ?? 0;
                
            $hotelProfit = DB::table('travel_bookings')
                ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
                ->whereIn('travel_bookings.booking_status_id', [19, 20])
                ->where('travel_booking_types.type', 'Hotel')
                ->whereDate('travel_bookings.created_at', $dateStr)
                ->sum('travel_bookings.net_value') ?? 0;
                
            $cruiseProfit = DB::table('travel_bookings')
                ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
                ->whereIn('travel_bookings.booking_status_id', [19, 20])
                ->where('travel_booking_types.type', 'Cruise')
                ->whereDate('travel_bookings.created_at', $dateStr)
                ->sum('travel_bookings.net_value') ?? 0;
                
            $carProfit = DB::table('travel_bookings')
                ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
                ->whereIn('travel_bookings.booking_status_id', [19, 20])
                ->where('travel_booking_types.type', 'Car')
                ->whereDate('travel_bookings.created_at', $dateStr)
                ->sum('travel_bookings.net_value') ?? 0;
                
            $lineChartData[] = [
                'label' => $date->format('M d'),
                'flight' => $flightProfit,
                'hotel' => $hotelProfit,
                'cruise' => $cruiseProfit,
                'car' => $carProfit
            ];
        }

        // User performance data for current month
        $userPerformance = DB::table('users')
            ->leftJoin('travel_bookings', 'users.id', '=', 'travel_bookings.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereMonth('travel_bookings.created_at', date('m'))
            ->whereYear('travel_bookings.created_at', date('Y'))
            ->selectRaw('
                users.name,
                users.email,
                roles.name as role_name,
                departments.name as department_name,
                SUM(travel_bookings.gross_value) as gross_value,
                SUM(travel_bookings.net_value) as net_value
            ')
            ->groupBy('users.id', 'users.name', 'users.email', 'roles.name', 'departments.name')
            ->orderBy('net_value', 'desc')
            ->get();

        // Revenue data for current month
        $revenueData = DB::table('travel_bookings')
            ->whereIn('booking_status_id', [19, 20])
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->selectRaw('
                DATE(created_at) as date,
                COUNT(*) as count,
                SUM(gross_value) as gross,
                SUM(net_value) as net,
                SUM(gross_value - net_value) as deductions,
                SUM(net_value) as total
            ')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Queue status data for current date
        $queueStatus = DB::table('travel_bookings')
            ->join('booking_statuses', 'travel_bookings.booking_status_id', '=', 'booking_statuses.id')
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->selectRaw('
                booking_statuses.name as status_name,
                COUNT(*) as count
            ')
            ->groupBy('booking_statuses.id', 'booking_statuses.name')
            ->orderBy('count', 'desc')
            ->get();

        return view('web.admin-dashboard', compact('flight', 'hotel', 'cruise', 'car','today_score','weekly_score','monthly_score','userPerformance','revenueData','queueStatus','flight_score','hotel_score','cruise_score','car_score','train_score','weeklyData','monthlyData','dailyData','lineChartData'));
    }

    public function revenueData(Request $request)
    {
        $dateFrom = $request->input('date_from', date('Y-m-01'));
        $dateTo = $request->input('date_to', date('Y-m-t'));

        $revenueData = DB::table('travel_bookings')
            ->whereIn('booking_status_id', [19, 20])
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->selectRaw('
                DATE(created_at) as date,
                COUNT(*) as count,
                SUM(gross_value) as gross,
                SUM(net_value) as net,
                SUM(gross_value - net_value) as deductions,
                SUM(net_value) as total
            ')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($revenueData);
    }

    public function queueStatus(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));

        $queueStatus = DB::table('travel_bookings')
            ->join('booking_statuses', 'travel_bookings.booking_status_id', '=', 'booking_statuses.id')
            ->whereDate('travel_bookings.created_at', $date)
            ->selectRaw('
                booking_statuses.name as status_name,
                COUNT(*) as count
            ')
            ->groupBy('booking_statuses.id', 'booking_statuses.name')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($queueStatus);
    }

    public function userPerformance(Request $request)
    {
        $dateFrom = $request->input('date_from', date('Y-m-01'));
        $dateTo = $request->input('date_to', date('Y-m-t'));

        $userPerformance = DB::table('users')
            ->leftJoin('travel_bookings', 'users.id', '=', 'travel_bookings.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereBetween('travel_bookings.created_at', [$dateFrom, $dateTo])
            ->selectRaw('
                users.name,
                users.email,
                roles.name as role_name,
                departments.name as department_name,
                SUM(travel_bookings.gross_value) as gross_value,
                SUM(travel_bookings.net_value) as net_value
            ')
            ->groupBy('users.id', 'users.name', 'users.email', 'roles.name', 'departments.name')
            ->orderBy('net_value', 'desc')
            ->get();

        return response()->json($userPerformance);
    }
}
