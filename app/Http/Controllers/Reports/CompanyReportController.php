<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Team;
use App\Models\Campaign;
use App\Models\LOB;
use App\Models\CallLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompanyReportExport;

class CompanyReportController extends Controller
{
    public function index(Request $request)
    {
        $bookingStatuses = BookingStatus::all();
        $paymentStatuses = PaymentStatus::all();
        $teams = Team::all();
        $campaigns = Campaign::all();
        $lobs = LOB::all();

        // Get aggregated data by LOB
        $query = LOB::select([
            'lobs.id',
            'lobs.name',
            DB::raw('COUNT(DISTINCT travel_bookings.id) as total_bookings'),
            DB::raw('SUM(travel_bookings.gross_value) as gross_amount'),
            DB::raw('SUM(travel_bookings.net_value) as net_amount'),
            DB::raw('SUM(CASE WHEN travel_bookings.booking_status_id = 22 THEN travel_bookings.gross_value ELSE 0 END) as charge_back'),
            DB::raw('SUM(CASE WHEN travel_bookings.booking_status_id IN (15, 18) THEN travel_bookings.gross_value ELSE 0 END) as refund'),
            DB::raw('SUM(travel_bookings.net_value - travel_bookings.gross_value) as net_profit'),
            DB::raw('AVG(travel_bookings.quality_score) as avg_qc_score'),
            DB::raw('COUNT(DISTINCT users.id) as agent_count'),
            DB::raw('SUM(travel_bookings.gross_value) * 0.05 as call_cost'), // Assuming 5% call cost
            DB::raw('COUNT(CASE WHEN travel_bookings.booking_status_id IS NOT NULL THEN 1 END) as booking_status_count'),
            DB::raw('COUNT(CASE WHEN travel_bookings.payment_status_id IS NOT NULL THEN 1 END) as payment_status_count'),
            DB::raw('COUNT(DISTINCT call_logs.id) as no_of_calls')
        ])
        ->leftJoin('users', 'lobs.id', '=', 'users.lob')
        ->leftJoin('travel_bookings', 'users.id', '=', 'travel_bookings.user_id')
        ->leftJoin('call_logs', 'users.id', '=', 'call_logs.user_id');

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

        $lobReports = $query->groupBy('lobs.id', 'lobs.name')
                           ->havingRaw('COUNT(DISTINCT travel_bookings.id) > 0')
                           ->orderBy('gross_amount', 'desc')
                           ->paginate(20);

        // Calculate chart data
        $chartData = $this->getChartData($request);

        return view('web.reports.company', compact(
            'lobReports',
            'bookingStatuses',
            'paymentStatuses',
            'teams',
            'campaigns',
            'lobs',
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
            DB::raw('SUM(CASE WHEN booking_status_id = 9 THEN gross_value ELSE 0 END) as refund'),
            DB::raw('SUM(net_value - gross_value) as net_profit')
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
            'net_profits' => $chartData->pluck('net_profit')->toArray(),
            'charge_backs' => $chartData->pluck('charge_back')->toArray(),
            'refunds' => $chartData->pluck('refund')->toArray()
        ];
    }

    public function export(Request $request)
    {
        return Excel::download(new CompanyReportExport($request), 'company-report.xlsx');
    }
}