<?php

namespace App\Exports;

use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeamReportChartSheet implements FromCollection, WithHeadings, WithTitle
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
            DB::raw('COUNT(*) as booking_count')
        );

        // Apply same filters as main query
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
            'Booking Count'
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