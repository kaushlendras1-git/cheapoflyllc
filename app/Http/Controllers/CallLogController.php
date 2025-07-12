<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use App\Models\Campaign;
use App\Models\CallType;
use App\Models\Team;
use App\Models\User;
use App\Models\Log;
use App\Models\TravelBooking;
use App\Models\TravelBookingType;
use Illuminate\Http\Request;
use Hashids\Hashids;
use DB;
use Carbon\Carbon;


class CallLogController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
    }

    public function index(Request $request)
    {
        $query = CallLog::query()
            ->join('users', 'call_logs.user_id', '=', 'users.id') // Join users table
            ->select('call_logs.*', 'users.name as user_name') // Select required fields
            ->orderBy('call_logs.created_at', 'desc');

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
            $query->whereDate('call_logs.created_at', '>=', $request->start_date)
                ->whereDate('call_logs.created_at', '<=', $request->end_date);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('call_logs.created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('call_logs.created_at', '<=', $request->end_date);
        }

        // Paginate the results
        $callLogs = $query->paginate(10)->appends($request->except('page'));
        $hashids = new \Hashids\Hashids(config('hashids.salt'), config('hashids.length', 8));
        return view('web.call-logs.index', compact('callLogs','hashids'));    
    }


    public function create()
    {   
        $campaigns = Campaign::all();
        $call_types = CallType::all();
        $teams = Team::all();
        $users = User::all();
        //log_operation('info','Add' ,'CallLog', 'CallLog Created', auth()->id());
        //log_operation('error', 'Payment failed', 'Unable to process payment for order #123', 5);
        //log_operation('warning', 'Low disk space', 'Server disk space is below 10%');
        return view('web.call-logs.create', compact('campaigns', 'call_types', 'teams','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chkflight' => 'nullable|boolean',
            'chkhotel' => 'nullable|boolean',
            'chkcruise' => 'nullable|boolean',
            'chkcar' => 'nullable|boolean',
            'chktrain' => 'nullable|boolean',
            'phone' => 'required|string|max:25',
            'name' => 'required|string|max:255',
            'selcompany' => 'required|string|max:255',
            'campaign' => 'required|string|max:255',
            'reservation_source' => 'required|string|max:255',
            'call_type' => 'required|string|max:255',
            'call_converted' => 'nullable|boolean',
            'followup_date' => 'nullable|date',
            'assign' => 'nullable',
            'notes' => 'nullable|string',
        ]);
    
     

        $validated['user_id'] = auth()->id();
        $validated['pnr'] = '';
        $validated['phone'] = preg_replace('/\D/', '', $request->phone); 
        $call_log = CallLog::create($validated);
        
        if($request->call_converted){
             $pnr = date('dm') . str_pad(time() % 86400 % 10000, 4, '0', STR_PAD_LEFT) . str_pad(
                DB::table('travel_bookings')->whereDate('created_at', now()->toDateString())->count() + 1,
                4,
                '0',
                STR_PAD_LEFT);
            $campaign = substr(strtoupper($request->input('campaign')), 0, 3);
            $pnr = $campaign .$pnr;
            $call_log->update(['pnr' => $pnr]);


            $bookingData['name'] = $request->name;
            $bookingData['phone'] = $request->phone;
            $bookingData['reservation_source'] = $request->reservation_source;
            $bookingData['campaign'] = $request->campaign;
           
            $bookingData['pnr'] = $pnr;
            $bookingData['user_id'] = auth()->id();
            $booking = TravelBooking::create($bookingData);

            $checkboxes = [
                'chkflight' => 'Flight',
                'chkhotel' => 'Hotel',
                'chkcruise' => 'Cruise',
                'chkcar' => 'Car',
                'chktrain' => 'Train',
            ];

            foreach ($checkboxes as $field => $type) {
                if ($request->has($field)) {
                    TravelBookingType::create([
                        'booking_id' => $booking->id,
                        'type' => $type,
                    ]);
                }
            }

            $hash = $this->hashids->encode($booking->id);
            return redirect()->route('booking.show', ['id' => $hash]);            
        }

        log_operation('CallLog',$call_log->id , 'created' ,'Call Log created successfully', auth()->id());
        return redirect()->route('call-logs.index')->with('success', 'Call Log created successfully!');
        
    }
    

    /**
     * Display the specified resource.
     */
    public function show(CallLog $callLog)
    {
        return response()->json($callLog);
    }

    public function edit($hash)
    {
        $id = $this->hashids->decode($hash);
        $id = $id[0] ?? null;

        if (!$id) {
            abort(404);
        }

        $callLog = CallLog::findOrFail($id);
        
        $logs = Log::where('calllog_id', $id)->with('user')->orderby('id','DESC')->get();

        $campaigns = Campaign::all();
        $call_types = CallType::all();
        $teams = Team::all();
        $users = User::all();
        log_operation('CallLog',$id , 'Viewed' ,'You have seen the call log', auth()->id());
        return view('web.call-logs.edit', compact('callLog','logs','campaigns','call_types','teams','users'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CallLog $callLog)
{
    $validated = $request->validate([
        'chkflight' => 'nullable|boolean',
        'chkhotel' => 'nullable|boolean',
        'chkcruise' => 'nullable|boolean',
        'chkcar' => 'nullable|boolean',
        'phone' => 'required|string|max:15',
        'name' => 'required|string|max:255',
        'team' => 'required|string|max:255',
        'campaign' => 'required|string|max:255',
        'reservation_source' => 'required|string|max:255',
        'call_type' => 'required|string|max:255',
        'call_converted' => 'nullable|boolean',
        'followup_date' => 'nullable|date',
        'notes' => 'nullable|string',
    ]);

    // Store old values
    $oldValues = $callLog->only(array_keys($validated));

    // Update the CallLog
    $callLog->update($validated);

    if ($request->call_converted) {
        $campaignPrefix = strtoupper(substr($request->campaign, 0, 3));
        $pnr = $campaignPrefix . (1000000000 + $callLog->id);

        // Save the generated PNR to the CallLog
        $callLog->pnr = $pnr;
        $callLog->save();
    }


    // Log the changes
    foreach ($validated as $field => $newValue) {
        $oldValue = $oldValues[$field] ?? null;
        if ($oldValue != $newValue) {
            log_operation(
                'CallLog',
                $callLog->id,
                'Updated',
                "Field '{$field}' updated from '{$oldValue}' to '{$newValue}'",
                auth()->id()
            );
        }
    }

    return redirect()->back()->with('success', 'Call log updated successfully!');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallLog $callLog)
    {
        $callLog->delete();
        return response()->noContent();
    }
}
