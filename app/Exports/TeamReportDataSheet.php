<?php

namespace App\Exports;

use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeamReportDataSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function title(): string
    {
        return 'Team Data';
    }

    public function collection()
    {
        $query = TravelBooking::with(['user', 'bookingStatus', 'paymentStatus'])
            ->selectRaw('travel_bookings.*, 
                (travel_bookings.net_value - travel_bookings.gross_value) as net_profit,
                COALESCE(travel_bookings.quality_score, 0) as qc_score');

        // Apply filters
        if ($this->request->filled('period')) {
            $this->applyPeriodFilter($query, $this->request->period);
        }

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->whereBetween('created_at', [$this->request->start_date, $this->request->end_date]);
        }

        if ($this->request->filled('booking_status')) {
            $query->where('booking_status_id', $this->request->booking_status);
        }

        if ($this->request->filled('payment_status')) {
            $query->where('payment_status_id', $this->request->payment_status);
        }

        if ($this->request->filled('lob')) {
            $query->whereHas('user', function($q) {
                $q->where('lob', $this->request->lob);
            });
        }

        if ($this->request->filled('team')) {
            $query->whereHas('user', function($q) {
                $q->where('team', $this->request->team);
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Agent Name',
            'Gross Amount',
            'Net Amount',
            'Net Profit',
            'QC Score',
            'Booking Status',
            'Payment Status',
            'PNR'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->created_at->format('Y-m-d'),
            $booking->user->name ?? 'N/A',
            number_format($booking->gross_value ?? 0, 2),
            number_format($booking->net_value ?? 0, 2),
            number_format($booking->net_profit ?? 0, 2),
            $booking->qc_score ?? 'N/A',
            $booking->bookingStatus->name ?? 'N/A',
            $booking->paymentStatus->name ?? 'N/A',
            $booking->pnr ?? 'N/A'
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