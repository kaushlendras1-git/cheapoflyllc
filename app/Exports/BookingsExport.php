<?php

namespace App\Exports;

use App\Models\TravelBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class BookingsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = TravelBooking::with(['user', 'pricingDetails', 'bookingStatus', 'paymentStatus']);

        if ($this->request->filled('keyword')) {
            $query->where(function ($q) {
                $keyword = $this->request->keyword;
                $q->where('pnr', 'like', "%{$keyword}%")
                  ->orWhere('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($this->request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $this->request->start_date);
        }

        if ($this->request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $this->request->end_date);
        }

        if ($this->request->filled('booking_status')) {
            $query->where('booking_status_id', $this->request->booking_status);
        }

        if ($this->request->filled('payment_status')) {
            $query->where('payment_status_id', $this->request->payment_status);
        }

        return $query->get()->map(function ($booking) {
            return [
                'ID' => $booking->id,
                'PNR' => $booking->pnr,
                'Booking Date' => $booking->created_at,
                'Agent' => $booking->user->name ?? 'N/A',
                'Booking Status' => $booking->bookingStatus->name ?? 'N/A',
                'Payment Status' => $booking->paymentStatus->name ?? 'N/A',
                'Total' => $booking->pricingDetails->sum('total_amount'),
                'Agent MCO' => $booking->pricingDetails->sum('advisor_mco'),
                'Name' => $booking->name,
                'Email' => $booking->email,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'PNR', 'Booking Date', 'Agent', 'Booking Status', 'Payment Status', 'Total', 'Agent MCO', 'Name', 'Email'
        ];
    }
}
