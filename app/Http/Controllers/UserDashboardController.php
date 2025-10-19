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




        // Compact time-based metrics
        $periods = [
            'today' => [today(), today()->endOfDay()],
            'week' => [now()->startOfWeek(), now()->endOfWeek()],
            'fortnight' => [now()->subDays(13)->startOfDay(), now()->endOfDay()],
            'month' => [now()->startOfMonth(), now()->endOfMonth()]
        ];
        
        $metrics = [];
        foreach ($periods as $period => $dates) {
            $gross_score = DB::table('travel_bookings')->where('user_id', $userId)->whereIn('booking_status_id', [19, 20])->whereBetween('created_at', $dates)->sum('net_mco') ?? 0;
            $refund_sum = DB::table('travel_bookings')->where('user_id', $userId)->whereIn('payment_status_id', [13, 16])->whereBetween('created_at', $dates)->sum('net_mco') ?? 0;
            $chargeback = DB::table('travel_bookings')->where('user_id', $userId)->where('booking_status_id', 22)->whereBetween('created_at', $dates)->sum('net_mco') ?? 0;
            $score = $gross_score - $refund_sum - $chargeback;
            $bookings = DB::table('travel_bookings')->where('user_id', $userId)->whereBetween('created_at', $dates)->count();
            $successful_bookings = DB::table('travel_bookings')->where('user_id', $userId)->whereIn('booking_status_id', [19, 20])->whereBetween('created_at', $dates)->count();
            $calls = DB::table('call_logs')->where('user_id', $userId)->whereBetween('created_at', $dates)->count();
            $quality = round(DB::table('travel_bookings')->where('user_id', $userId)->whereBetween('created_at', $dates)->avg('quality_score') ?? 0, 2);
            
            $metrics[$period] = [
                'score' => $score,
                'bookings' => $bookings,
                'calls' => $calls,
                'rpc' => $calls > 0 ? round($score / $calls, 2) : 0,
                'conversion' => $calls > 0 ? round(($successful_bookings * 100) / $calls, 2) : 0,
                'quality' => $quality,
                'refund' => $refund_sum,
                'chargeback' => $chargeback
            ];
        }
        
        extract($metrics['today'], EXTR_PREFIX_ALL, 'today');
        extract($metrics['week'], EXTR_PREFIX_ALL, 'week');
        extract($metrics['fortnight'], EXTR_PREFIX_ALL, 'fortnight');
        extract($metrics['month'], EXTR_PREFIX_ALL, 'total');
        
        // Weekly daily data for chart
        $weeklyData = [];
        $startOfWeek = now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayScore = DB::table('travel_bookings')->where('user_id', $userId)->whereIn('booking_status_id', [19, 20])->whereDate('created_at', $date)->sum('net_mco') ?? 0;
            $dayBookings = DB::table('travel_bookings')->where('user_id', $userId)->whereDate('created_at', $date)->count();
            $dayCalls = DB::table('call_logs')->where('user_id', $userId)->whereDate('created_at', $date)->count();
            $weeklyData[] = [
                'score' => $dayScore,
                'bookings' => $dayBookings,
                'calls' => $dayCalls
            ];
        }
        
        // Month-specific counts
        $charge_back_count = DB::table('travel_bookings')->where('user_id', $userId)->where('booking_status_id', 22)->whereBetween('created_at', $periods['month'])->count();
        $refund_count = DB::table('travel_bookings')->where('user_id', $userId)->whereIn('payment_status_id', [13, 16])->whereBetween('created_at', $periods['month'])->count();
        
        // Aliases for backward compatibility
        $total_booking_total = $total_score;
        $total_booking_count = $total_bookings;
        $charge_back_total = $total_chargeback;
        $refund_total = $total_refund;
        $rpc = $total_rpc;
        $conversion = $total_conversion;
        $quality = $total_quality;
        
        // BOOKING TYPE SPECIFIC METRICS
        // Flight metrics
        $flight_metrics = $this->getBookingTypeMetrics($userId, 'Flight');
        
        // Hotel metrics  
        $hotel_metrics = $this->getBookingTypeMetrics($userId, 'Hotel');
        
        // Cruise metrics
        $cruise_metrics = $this->getBookingTypeMetrics($userId, 'Cruise');
        
        // Car metrics
        $car_metrics = $this->getBookingTypeMetrics($userId, 'Car');
        
        // Train metrics
        $train_metrics = $this->getBookingTypeMetrics($userId, 'Train');
        
        // Package metrics (bookings with multiple types)
        $package_metrics = $this->getPackageMetrics($userId);
        
        // CHARGEBACK SPECIFIC METRICS (booking_status_id = 22)
        $chargeback_metrics = $this->getStatusMetrics($userId, 'chargeback', 22);
        
        // REFUND SPECIFIC METRICS (payment_status_id IN (13,16))
        $refund_metrics = $this->getPaymentStatusMetrics($userId, 'refund', [13, 16]);
        
        // DECLINED SPECIFIC METRICS (booking_status_id = 21)
        $declined_metrics = $this->getStatusMetrics($userId, 'declined', 21);
        
        // QUALITY SCORE METRICS
        $quality_metrics = $this->getQualityMetrics($userId);

        
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
                'flight', 'hotel', 'cruise', 'car','train','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending','pending_booking',
                'total_score','total_bookings','total_calls','rpc','conversion','quality',
                'today_score','today_bookings','today_calls','today_rpc','today_conversion','today_quality','today_refund','today_chargeback',
                'week_score','week_bookings','week_calls','week_rpc','week_conversion','week_quality','week_refund','week_chargeback',
                'fortnight_score','fortnight_bookings','fortnight_calls','fortnight_rpc','fortnight_conversion','fortnight_quality','fortnight_refund','fortnight_chargeback',
                'flight_metrics','hotel_metrics','cruise_metrics','car_metrics','train_metrics','package_metrics',
                'chargeback_metrics','refund_metrics','declined_metrics','quality_metrics','weeklyData'));
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
        

        
        // Calculate real data from travel_bookings using net_mco
        $charge_back_data = TravelBooking::where('user_id', $userId)
                                        ->where('booking_status_id', 22)
                                        ->selectRaw('SUM(net_mco) as total, COUNT(*) as count')
                                        ->first();
        $charge_back_total = $charge_back_data->total ?? 0;
        $charge_back_count = $charge_back_data->count ?? 0;
        
        $refund_data = TravelBooking::where('user_id', $userId)
                                   ->whereIn('payment_status_id', [13, 16])
                                   ->selectRaw('SUM(net_mco) as total, COUNT(*) as count')
                                   ->first();
        $refund_total = $refund_data->total ?? 0;
        $refund_count = $refund_data->count ?? 0;
        
        $total_booking_data = TravelBooking::where('user_id', $userId)
                                          ->selectRaw('SUM(net_mco) as total, COUNT(*) as count')
                                          ->first();
        $total_booking_total = $total_booking_data->total ?? 0;
        $total_booking_count = $total_booking_data->count ?? 0;
        
        return view('web.score-details', compact('bookings', 'charge_back_total', 'charge_back_count', 'total_booking_total', 'total_booking_count', 'refund_total', 'refund_count'));
    }
    
    private function getBookingTypeMetrics($userId, $type)
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        
        // Get bookings that have only this specific type (current month)
        $bookingIds = DB::table('travel_booking_types')
            ->select('booking_id')
            ->where('type', $type)
            ->whereIn('booking_id', function($query) use ($userId, $monthStart, $monthEnd) {
                $query->select('id')
                      ->from('travel_bookings')
                      ->where('user_id', $userId)
                      ->whereBetween('created_at', [$monthStart, $monthEnd]);
            })
            ->whereNotIn('booking_id', function($query) use ($type) {
                // Exclude bookings that have other types (those are packages)
                $query->select('booking_id')
                      ->from('travel_booking_types')
                      ->where('type', '!=', $type)
                      ->groupBy('booking_id')
                      ->havingRaw('COUNT(*) > 0');
            })
            ->pluck('booking_id');
            
        $gross_score = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->whereIn('booking_status_id', [19, 20])
            ->sum('net_mco') ?? 0;
            
        $refund_sum = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->whereIn('payment_status_id', [13, 16])
            ->sum('net_mco') ?? 0;
            
        $chargeback = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->where('booking_status_id', 22)
            ->sum('net_mco') ?? 0;
            
        $score = $gross_score - $refund_sum - $chargeback;
            
        $bookings = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->count();
            
        $successful_bookings = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->whereIn('booking_status_id', [19, 20])
            ->count();
            
        $calls = DB::table('call_logs')
            ->where('user_id', $userId)
            ->where('chk' . strtolower($type), 1)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $rpc = $calls > 0 ? round($score / $calls, 2) : 0;
        $conversion = $calls > 0 ? round(($successful_bookings * 100) / $calls, 2) : 0;
        
        $quality = DB::table('travel_bookings')
            ->whereIn('id', $bookingIds)
            ->avg('quality_score') ?? 0;
            
        $refund = $refund_sum;
            
        return [
            'score' => $score,
            'bookings' => $bookings,
            'calls' => $calls,
            'rpc' => $rpc,
            'conversion' => $conversion,
            'quality' => round($quality, 2),
            'refund' => $refund,
            'chargeback' => $chargeback
        ];
    }
    
    private function getPackageMetrics($userId)
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        
        // Get bookings that have multiple types (packages) - current month
        $packageBookingIds = DB::table('travel_booking_types')
            ->select('booking_id')
            ->whereIn('booking_id', function($query) use ($userId, $monthStart, $monthEnd) {
                $query->select('id')
                      ->from('travel_bookings')
                      ->where('user_id', $userId)
                      ->whereBetween('created_at', [$monthStart, $monthEnd]);
            })
            ->groupBy('booking_id')
            ->havingRaw('COUNT(DISTINCT type) > 1')
            ->pluck('booking_id');
            
        $gross_score = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->whereIn('booking_status_id', [19, 20])
            ->sum('net_mco') ?? 0;
            
        $refund_sum = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->whereIn('payment_status_id', [13, 16])
            ->sum('net_mco') ?? 0;
            
        $chargeback = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->where('booking_status_id', 22)
            ->sum('net_mco') ?? 0;
            
        $score = $gross_score - $refund_sum - $chargeback;
            
        $bookings = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->count();
            
        $successful_bookings = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->whereIn('booking_status_id', [19, 20])
            ->count();
            
        // For package calls, count calls that have multiple checkboxes checked (current month)
        $calls = DB::table('call_logs')
            ->where('user_id', $userId)
            ->whereRaw('(chkflight + chkhotel + chkcruise + chkcar + chktrain) > 1')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $rpc = $calls > 0 ? round($score / $calls, 2) : 0;
        $conversion = $calls > 0 ? round(($successful_bookings * 100) / $calls, 2) : 0;
        
        $quality = DB::table('travel_bookings')
            ->whereIn('id', $packageBookingIds)
            ->avg('quality_score') ?? 0;
            
        $refund = $refund_sum;
            
        return [
            'score' => $score,
            'bookings' => $bookings,
            'calls' => $calls,
            'rpc' => $rpc,
            'conversion' => $conversion,
            'quality' => round($quality, 2),
            'refund' => $refund,
            'chargeback' => $chargeback
        ];
    }
    
    private function getStatusMetrics($userId, $type, $statusId)
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        
        $score = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->where('booking_status_id', $statusId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('net_mco') ?? 0;
            
        $bookings = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->where('booking_status_id', $statusId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        // For calls, we use total calls as base since these are status-based filters
        $calls = DB::table('call_logs')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $rpc = $calls > 0 ? round($score / $calls, 2) : 0;
        $conversion = $calls > 0 ? round(($bookings * 100) / $calls, 2) : 0;
        
        $quality = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->where('booking_status_id', $statusId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->avg('quality_score') ?? 0;
            
        return [
            'score' => $score,
            'bookings' => $bookings,
            'calls' => $calls,
            'rpc' => $rpc,
            'conversion' => $conversion,
            'quality' => round($quality, 2),
            'refund' => 0, // Not applicable for status metrics
            'chargeback' => $score // For chargeback card, this is the main metric
        ];
    }
    
    private function getPaymentStatusMetrics($userId, $type, $statusIds)
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        
        $score = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('payment_status_id', $statusIds)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('net_mco') ?? 0;
            
        $bookings = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('payment_status_id', $statusIds)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $calls = DB::table('call_logs')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $rpc = $calls > 0 ? round($score / $calls, 2) : 0;
        $conversion = $calls > 0 ? round(($bookings * 100) / $calls, 2) : 0;
        
        $quality = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('payment_status_id', $statusIds)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->avg('quality_score') ?? 0;
            
        return [
            'score' => $score,
            'bookings' => $bookings,
            'calls' => $calls,
            'rpc' => $rpc,
            'conversion' => $conversion,
            'quality' => round($quality, 2),
            'refund' => $score, // For refund card, this is the main metric
            'chargeback' => 0 // Not applicable for payment status metrics
        ];
    }
    
    private function getQualityMetrics($userId)
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        
        $gross_score = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('booking_status_id', [19, 20])
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('net_mco') ?? 0;
            
        $refund_sum = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('payment_status_id', [13, 16])
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('net_mco') ?? 0;
            
        $chargeback = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->where('booking_status_id', 22)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('net_mco') ?? 0;
            
        $score = $gross_score - $refund_sum - $chargeback;
            
        $bookings = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $successful_bookings = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereIn('booking_status_id', [19, 20])
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $calls = DB::table('call_logs')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
            
        $rpc = $calls > 0 ? round($score / $calls, 2) : 0;
        $conversion = $calls > 0 ? round(($successful_bookings * 100) / $calls, 2) : 0;
        
        $quality = DB::table('travel_bookings')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->avg('quality_score') ?? 0;
            
        $refund = $refund_sum;
            
        return [
            'score' => $score,
            'bookings' => $bookings,
            'calls' => $calls,
            'rpc' => $rpc,
            'conversion' => $conversion,
            'quality' => round($quality, 2),
            'refund' => $refund,
            'chargeback' => $chargeback
        ];
    }
}
