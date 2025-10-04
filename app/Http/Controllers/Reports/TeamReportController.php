<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\LOB;
use App\Models\Team;
use App\Models\User;
use App\Models\CallLog;
use App\Models\TravelQualityFeedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeamReportController extends Controller
{
    public function index(Request $request)
    {
        $bookingStatuses = BookingStatus::all();
        $paymentStatuses = PaymentStatus::all();
        $lobs = LOB::all();
        $teams = Team::all();

        $query = TravelBooking::with(['user', 'bookingStatus', 'paymentStatus', 'user.lobRelation', 'user.teamRelation', 'qualityFeedback']);
        
        // Add calculated fields
        $query->selectRaw('travel_bookings.*, 
            (travel_bookings.net_value - travel_bookings.gross_value) as net_profit,
            COALESCE(travel_bookings.quality_score, 0) as qc_score');

        // Apply filters
        if ($request->filled('period')) {
            $this->applyPeriodFilter($query, $request->period);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('booking_status')) {
            $query->where('booking_status_id', $request->booking_status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status_id', $request->payment_status);
        }

        if ($request->filled('lob')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('lob', $request->lob);
            });
        }

        if ($request->filled('team')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('team', $request->team);
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(50);

        // Calculate chart data
        $chartData = $this->getChartData($request);

        return view('web.reports.team', compact(
            'bookings', 
            'bookingStatuses', 
            'paymentStatuses', 
            'lobs', 
            'teams',
            'chartData'
        ));
    }

    private function applyPeriodFilter($query, $period)
    {
        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'weekly':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
        }
    }

    private function getChartData($request)
    {
        $query = TravelBooking::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(gross_value) as gross_amount'),
            DB::raw('SUM(net_value) as net_amount'),
            DB::raw('COUNT(*) as booking_count')
        );

        // Apply same filters as main query
        if ($request->filled('period')) {
            $this->applyPeriodFilter($query, $request->period);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $chartData = $query->groupBy('date')
                          ->orderBy('date')
                          ->get();

        return [
            'labels' => $chartData->pluck('date')->toArray(),
            'gross_amounts' => $chartData->pluck('gross_amount')->toArray(),
            'net_amounts' => $chartData->pluck('net_amount')->toArray(),
            'booking_counts' => $chartData->pluck('booking_count')->toArray()
        ];
    }
}