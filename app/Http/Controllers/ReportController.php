<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    
    public function marketing()
    {
        return view('web.reports.marketing');
    }
    public function call_queue()
    {
        return view('web.reports.call_queue');
    }
    public function agents()
    {
        return view('web.reports.agents');
    }
    public function score()
    {
        return view('web.reports.score');
    }

}
