<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TravelBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class UnitReportExport implements WithMultipleSheets
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function sheets(): array
    {
        return [
            new UnitReportDataSheet($this->request)
        ];
    }
}

class UnitReportDataSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function title(): string
    {
        return 'Unit Data';
    }

    public function collection()
    {
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
        ->leftJoin('call_logs', 'users.id', '=', 'call_logs.user_id');

        // Apply filters
        if ($this->request->filled('period')) {
            $this->applyPeriodFilter($query, $this->request->period);
        }

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->whereBetween('travel_bookings.created_at', [$this->request->start_date, $this->request->end_date]);
        }

        if ($this->request->filled('booking_status')) {
            $query->where('travel_bookings.booking_status_id', $this->request->booking_status);
        }

        if ($this->request->filled('payment_status')) {
            $query->where('travel_bookings.payment_status_id', $this->request->payment_status);
        }

        if ($this->request->filled('team')) {
            $query->where('users.team', $this->request->team);
        }

        if ($this->request->filled('campaign')) {
            $query->where('travel_bookings.campaign', $this->request->campaign);
        }

        return $query->groupBy('users.id', 'users.name')
                    ->havingRaw('COUNT(DISTINCT travel_bookings.id) > 0')
                    ->orderBy('gross_amount', 'desc')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Agent Name',
            'Charge Back',
            'Refund',
            'Gross Amount',
            'Net Amount',
            'Net Profit',
            'QC Score',
            'Booking Status Count',
            'Payment Status Count',
            'No of Calls'
        ];
    }

    public function map($agent): array
    {
        return [
            $agent->name,
            number_format($agent->charge_back ?? 0, 2),
            number_format($agent->refund ?? 0, 2),
            number_format($agent->gross_amount ?? 0, 2),
            number_format($agent->net_amount ?? 0, 2),
            number_format($agent->net_profit ?? 0, 2),
            number_format($agent->avg_qc_score ?? 0, 1),
            $agent->booking_status_count,
            $agent->payment_status_count,
            $agent->no_of_calls ?? 0
        ];
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
}

class UnitReportChartSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function title(): string
    {
        return 'Chart Data';
    }

    public function collection()
    {
        $query = TravelBooking::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(gross_value) as gross_amount'),
            DB::raw('SUM(net_value) as net_amount'),
            DB::raw('SUM(CASE WHEN booking_status_id = 8 THEN gross_value ELSE 0 END) as charge_back'),
            DB::raw('SUM(CASE WHEN booking_status_id = 9 THEN gross_value ELSE 0 END) as refund')
        );

        if ($this->request->filled('period')) {
            $this->applyPeriodFilter($query, $this->request->period);
        }

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->whereBetween('created_at', [$this->request->start_date, $this->request->end_date]);
        }

        return $query->groupBy('date')->orderBy('date')->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Gross Amount',
            'Net Amount',
            'Charge Back',
            'Refund'
        ];
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


}