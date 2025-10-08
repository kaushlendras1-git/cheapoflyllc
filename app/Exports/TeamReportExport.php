<?php

namespace App\Exports;

use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TeamReportExport implements WithMultipleSheets
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function sheets(): array
    {
        return [
            new TeamReportDataSheet($this->request)
        ];
    }
}