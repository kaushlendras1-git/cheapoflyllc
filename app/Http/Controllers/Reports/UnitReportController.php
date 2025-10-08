<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Team;
use App\Models\Campaign;
use App\Models\User;
use App\Models\CallLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnitReportExport;

class UnitReportController extends Controller
{
    public function index(Request $request)
    {
        $bookingStatuses = BookingStatus::all();
        $paymentStatuses = PaymentStatus::all();
        $teams = Team::all();
        $campaigns = Campaign::all();

        // Get aggregated data by agent
        $query = User::select([
            'users.id',
            'users.name',
            DB::raw('COUNT(DISTINCT travel_bookings.id) as total_bookings'),
            DB::raw('SUM(CASE WHEN travel_bookings.booking_status_id = 22 THEN travel_bookings.gross_value ELSE 0 END) as charge_back'),
            DB::raw('SUM(CASE WHEN travel_bookings.booking_status_id IN (15, 18) THEN travel_bookings.gross_value ELSE 0 END) as refund'),
            DB::raw('SUM(travel_bookings.gross_value) as gross_amount'),
            DB::raw('SUM(travel_bookings.net_value) as net_amount'),
            DB::raw('SUM(travel_bookings.net_value - travel_bookings.gross_value) as net_profit'),
            DB::raw('AVG(travel_bookings.quality_score) as avg_qc_score'),
            DB::raw('COUNT(CASE WHEN travel_bookings.booking_status_id IS NOT NULL THEN 1 END) as booking_status_count'),
            DB::raw('COUNT(CASE WHEN travel_bookings.payment_status_id IS NOT NULL THEN 1 END) as payment_status_count'),
            DB::raw('COUNT(DISTINCT call_logs.id) as no_of_calls')
        ])
        ->leftJoin('travel_bookings', 'users.id', '=', 'travel_bookings.user_id')
        ->leftJoin('call_logs', 'users.id', '=', 'call_logs.user_id')
        ->with(['teamRelation', 'roleRelation']);

        // Apply filters
        if ($request->filled('period')) {
            $this->applyPeriodFilter($query, $request->period);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('travel_bookings.created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('booking_status')) {
            $query->where('travel_bookings.booking_status_id', $request->booking_status);
        }

        if ($request->filled('payment_status')) {
            $query->where('travel_bookings.payment_status_id', $request->payment_status);
        }

        if ($request->filled('team')) {
            $query->where('users.team', $request->team);
        }

        if ($request->filled('campaign')) {
            $query->where('travel_bookings.campaign', $request->campaign);
        }

        $agents = $query->groupBy('users.id', 'users.name')
                       ->havingRaw('COUNT(DISTINCT travel_bookings.id) > 0')
                       ->orderBy('gross_amount', 'desc')
                       ->paginate(20);

        // Calculate chart data
        $chartData = $this->getChartData($request);

        return view('web.reports.unit', compact(
            'agents',
            'bookingStatuses',
            'paymentStatuses',
            'teams',
            'campaigns',
            'chartData'
        ));
    }

    private function applyPeriodFilter($query, $period)
    {
        switch ($period) {
            case 'daily':
                $query->whereDate('travel_bookings.created_at', Carbon::today());
                break;
            case 'weekly':
                $query->whereBetween('travel_bookings.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('travel_bookings.created_at', Carbon::now()->month)
                      ->whereYear('travel_bookings.created_at', Carbon::now()->year);
                break;
        }
    }

    private function getChartData($request)
    {
        $query = TravelBooking::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(gross_value) as gross_amount'),
            DB::raw('SUM(net_value) as net_amount'),
            DB::raw('SUM(CASE WHEN booking_status_id = 8 THEN gross_value ELSE 0 END) as charge_back'),
            DB::raw('SUM(CASE WHEN booking_status_id = 9 THEN gross_value ELSE 0 END) as refund')
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
            'charge_backs' => $chartData->pluck('charge_back')->toArray(),
            'refunds' => $chartData->pluck('refund')->toArray()
        ];
    }

    public function export(Request $request)
    {
        return Excel::download(new UnitReportExport($request), 'unit-report.xlsx');
    }
}