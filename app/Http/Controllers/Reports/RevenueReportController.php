<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

class RevenueReportController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::all();
        
        $query = TravelBooking::select('*');
        
        if ($request->filled('campaign_id')) {
            $query->where('campaign', $request->campaign_id);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(50);
        
        $stats = [
            'total_net_value' => $query->sum('net_value'),
            'total_gross_mco' => $query->sum('gross_mco'),
            'total_bookings' => $query->count(),
            'by_campaign' => TravelBooking::select('campaign', 
                DB::raw('SUM(net_value) as total_net_value'),
                DB::raw('SUM(gross_mco) as total_gross_mco'),
                DB::raw('COUNT(*) as total_bookings')
            )
            ->when($request->filled('date_from'), function($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            })
            ->groupBy('campaign')
            ->get()
        ];
        
        return view('web.reports.revenue', compact('bookings', 'campaigns', 'stats'));
    }
}