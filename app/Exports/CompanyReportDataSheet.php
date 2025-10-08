<?php

namespace App\Exports;

use App\Models\LOB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyReportDataSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function title(): string
    {
        return 'Company Data';
    }

    public function collection()
    {
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
            DB::raw('SUM(travel_bookings.gross_value) * 0.05 as call_cost'),
            DB::raw('COUNT(DISTINCT call_logs.id) as no_of_calls')
        ])
        ->leftJoin('users', 'lobs.id', '=', 'users.lob')
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

        return $query->groupBy('lobs.id', 'lobs.name')
                    ->havingRaw('COUNT(DISTINCT travel_bookings.id) > 0')
                    ->orderBy('gross_amount', 'desc')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'LOB Name',
            'Call Cost',
            'Gross Amount',
            'Net Amount',
            'Charge Back',
            'Refund',
            'Net Profit',
            'QC Score',
            'No of Calls'
        ];
    }

    public function map($lob): array
    {
        return [
            $lob->name,
            number_format($lob->call_cost ?? 0, 2),
            number_format($lob->gross_amount ?? 0, 2),
            number_format($lob->net_amount ?? 0, 2),
            number_format($lob->charge_back ?? 0, 2),
            number_format($lob->refund ?? 0, 2),
            number_format($lob->net_profit ?? 0, 2),
            number_format($lob->avg_qc_score ?? 0, 1),
            $lob->no_of_calls ?? 0
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