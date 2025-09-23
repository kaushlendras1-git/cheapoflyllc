<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

class CampaignCallsReportController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::all();
        
        $query = CallLog::with(['campaign']);
        
        if ($request->filled('campaign_id')) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $callLogs = $query->orderBy('created_at', 'desc')->paginate(50);
        
        $stats = [
            'total_calls' => $query->count(),
            'by_campaign' => CallLog::select('campaign_id', DB::raw('count(*) as total'))
                ->when($request->filled('date_from'), function($q) use ($request) {
                    return $q->whereDate('created_at', '>=', $request->date_from);
                })
                ->when($request->filled('date_to'), function($q) use ($request) {
                    return $q->whereDate('created_at', '<=', $request->date_to);
                })
                ->groupBy('campaign_id')
                ->with('campaign')
                ->get()
        ];
        
        return view('web.reports.campaign-calls', compact('callLogs', 'campaigns', 'stats'));
    }
}