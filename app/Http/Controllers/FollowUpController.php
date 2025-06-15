<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\CallLog;
use App\Models\Campaign;
use App\Models\CallType;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Hashids;


class FollowUpController extends Controller
{
    protected $authId;

    public function __construct()
    {
        $this->authId = Auth::id(); // Retrieve the authenticated user's ID
    }

    public function index(Request $request)
{
    // Build the query with join
    $query = CallLog::query()
        ->join('users', 'call_logs.user', '=', 'users.id') // Join with users table
        ->select('call_logs.*', 'users.name as user_name') // Select call logs and user name
        ->where(function ($query) {
            $query->where('call_logs.assign', $this->authId)
                  ->orWhere(function ($subQuery) {
                      $subQuery->where('call_logs.user', $this->authId)
                               ->where('call_logs.followup_date', '!=', '');
                  });
        });

    // Filter by selected criteria and keyword
    if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
        $query->where(function ($subQuery) use ($keyword) {
            $subQuery->where('call_logs.pnr', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('call_logs.phone', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('call_logs.name', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('call_logs.campaign', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('call_logs.call_type', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('users.name', 'LIKE', '%' . $keyword . '%'); // Filter by user name
        });
    }

    // Filter by date range
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('call_logs.created_at', [
            $request->input('start_date'),
            $request->input('end_date'),
        ]);
    }

    // Paginate the results
    $callLogs = $query->orderBy('call_logs.created_at', 'desc')->paginate(10)->appends($request->except('page'));

    // Return the view with data
    return view('web.follow-up.index', compact('callLogs'));
}



   
}
