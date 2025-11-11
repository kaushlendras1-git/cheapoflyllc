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
use App\Http\Controllers\RingCentralController;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CallLogController extends Controller
{


    public function index(Request $request)
    {

        $query = CallLog::query()
            ->join('users', 'call_logs.user_id', '=', 'users.id')
            ->select('call_logs.*', 'users.name as user_name')
            ->with('campaign')
            ->when(
                        auth()->user()->role_id == 1 && auth()->user()->department_id == 2,
                        function ($q) {
                            $q->where('call_logs.user_id', auth()->user()->id);
                        }
                   )
            ->orderBy('call_logs.created_at', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('call_logs.pnr', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('call_logs.phone', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('call_logs.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('call_logs.reservation_source', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('campaign', function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhere('call_logs.call_type', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('users.name', 'LIKE', '%' . $keyword . '%');
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

        $callLogs = $query->with('campaign')->paginate(10)->appends($request->except('page'));
        return view('web.call-logs.index', compact('callLogs'));
    }

    public function create()
    {
        $campaigns = Campaign::all();
        $call_types = CallType::all();
        $teams = Team::all();
        $users = User::all();
        return view('web.call-logs.create', compact('campaigns', 'call_types', 'teams', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'chkflight' => 'nullable|boolean',
            'chkhotel' => 'nullable|boolean',
            'chkcruise' => 'nullable|boolean',
            'chkcar' => 'nullable|boolean',
            'chktrain' => 'nullable|boolean',
            'phone' => 'required|string|max:25',
            'country_code' => 'required',
            'name' => 'required|string|max:255',
            'campaign_id' => 'required|exists:campaigns,id',
          #  'reservation_source' => 'required|string|max:255',
            'call_type' => 'required|string|max:255',
            'call_converted' => 'required|boolean',
            'followup_date' => 'nullable|date',
            'assign' => 'nullable',
            'notes' => 'required_if:call_converted,0|string|nullable',
        ]);
        if (
            !$request->input('chkflight') &&
            !$request->input('chkhotel') &&
            !$request->input('chkcruise') &&
            !$request->input('chkcar') &&
            !$request->input('chktrain')
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'chkflight' => ['At least one of Flight, Hotel, Cruise, Car, or Train must be selected.'],
            ]);
        }
        // Prepare data for CallLog creation
        $validated['user_id'] = auth()->id();
        $validated['pnr'] = '';
        $validated['phone'] = preg_replace('/[^\d+]/', '', $request->phone);
        $callLog = CallLog::create($validated);


        if ($request->call_converted) {
            // Fetch Campaign (already validated, so no need to re-validate)
            $campaign = Campaign::findOrFail($request->campaign_id);

            // Generate PNR
            $campaignPrefix = strtoupper(substr($campaign->name, 0, 3));
            $pnr = $campaignPrefix . (1000000000 + $callLog->id);

            // Update CallLog with PNR
            $callLog->update(['pnr' => $pnr]);

            // Prepare data for TravelBooking
            $bookingData = [
                'name' => $request->name,
                'phone' => $request->phone,
                'reservation_source' => $request->reservation_source,
                'campaign' => $request->campaign_id,
                'call_type' => $request->call_type,
                'pnr' => $pnr,
                'phone'  =>  preg_replace('/\s+/', '', $request->phone),
                'booking_status_id' => 1,
                'payment_status_id' => 1,
                'gross_value' => 0,
                'net_value' => 0,
                'user_id' => auth()->id(),
            ];
            $booking = TravelBooking::create($bookingData);

            // Handle booking types
            $checkboxes = [
                'chkflight' => 'Flight',
                'chkhotel' => 'Hotel',
                'chkcruise' => 'Cruise',
                'chkcar' => 'Car',
                'chktrain' => 'Train',
            ];

            foreach ($checkboxes as $field => $type) {
                if ($request->has($field) && $request->$field) {
                    TravelBookingType::create([
                        'booking_id' => $booking->id,
                        'type' => $type,
                    ]);
                }
            }
            RingCentralController::updateStatus(auth()->user()->extension_id, 'DoNotAcceptAnyCalls');
            return redirect()->route('booking.show', ['id' => encode($booking->id)]);
        }

        // Log operation and redirect

        return redirect()->route('call-logs.index')->with('success', 'Call Log created successfully!');
    }


    public function show(CallLog $callLog)
    {
        return response()->json($callLog);
    }

    public function edit($hash)
    {
        $id = decode($hash);
        $callLog = CallLog::findOrFail($id);
        $logs = Log::where('calllog_id', $id)->with('user')->orderBy('id', 'DESC')->get();
        $campaigns = Campaign::where('status',1)->get();
        $call_types = CallType::all();
        $teams = Team::all();
        $users = User::all();
        log_operation('CallLog', $id, 'Viewed', 'You have seen the call log', auth()->id());
        return view('web.call-logs.edit', compact('callLog', 'logs', 'campaigns', 'call_types', 'teams', 'users'));
    }


    public function update(Request $request, CallLog $callLog)
    {
        $validated = $request->validate([
            'chkflight' => 'nullable|boolean',
            'chkhotel' => 'nullable|boolean',
            'chkcruise' => 'nullable|boolean',
            'chkcar' => 'nullable|boolean',
            'phone' => 'required|string|max:15',
            'name' => 'required|string|max:255',
           # 'campaign_id' => 'required|exists:campaigns,id', // Validate as Campaign ID
           # 'reservation_source' => 'required|string|max:255',
            'call_type' => 'required|string|max:255',
            'call_converted' => 'nullable|boolean',
            'followup_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'assign' => 'nullable',
            'chkflight' => 'required_without_all:chkhotel,chkcruise,chkcar',
        ]);

        // Store old values for logging changes
        $oldValues = $callLog->only(array_keys($validated));

        // Merge default false values for unchecked checkboxes
        $updateData = array_merge([
            'chkflight' => false,
            'chkhotel' => false,
            'chkcruise' => false,
            'chkcar' => false,
        ], $validated);

        // Update the CallLog
        $callLog->update($updateData);

        // Generate PNR if call is converted
        if ($request->call_converted) {
            $campaign = Campaign::findOrFail($request->campaign); // Fetch Campaign by ID
            $campaignPrefix = strtoupper(substr($campaign->name, 0, 3));
            $pnr = $campaignPrefix . (1000000000 + $callLog->id);
            $callLog->pnr = $pnr;
            $callLog->save();

            // Update or create TravelBooking
            $booking = TravelBooking::where('pnr', $pnr)->first();
            if (!$booking) {
                $booking = TravelBooking::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                   # 'reservation_source' => $request->reservation_source,
                    'campaign' => $request->campaign, // Store campaign ID
                    'pnr' => $pnr,
                    'booking_status_id' => 1,
                    'payment_status_id' => 1,
                    'user_id' => auth()->id(),
                ]);
            }

            // Update TravelBookingType records
            $checkboxes = [
                'chkflight' => 'Flight',
                'chkhotel' => 'Hotel',
                'chkcruise' => 'Cruise',
                'chkcar' => 'Car',
            ];

            TravelBookingType::where('booking_id', $booking->id)->delete();

            // Create new TravelBookingType records for checked checkboxes
            foreach ($checkboxes as $field => $type) {
                if ($request->has($field)) {
                    TravelBookingType::create([
                        'booking_id' => $booking->id,
                        'type' => $type,
                    ]);
                }
            }
             return redirect()->route('booking.show', ['id' => encode($booking->id)]);
        }

        // Log changes
        log_field_changes('CallLog', $callLog->id, $oldValues, $updateData, auth()->id());

        return redirect()->back()->with('success', 'Call log updated successfully!');
    }

    public function destroy(CallLog $callLog)
    {
        $callLog->delete();
        return response()->noContent();
    }
}
