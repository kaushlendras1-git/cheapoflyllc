<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CompanyReportExport implements WithMultipleSheets
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function sheets(): array
    {
        return [
            new CompanyReportDataSheet($this->request)
        ];
    }
}