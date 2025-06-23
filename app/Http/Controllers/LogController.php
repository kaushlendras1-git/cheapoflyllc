<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function logChange($bookingId, $modelName, $recordId, $field, $oldValue, $newValue)
    {
        Log::create([
            'booking_id' => $bookingId,
            'model_name' => $modelName,
            'record_id' => $recordId,
            'field' => $field,
            'old_value' => is_array($oldValue) ? json_encode($oldValue) : $oldValue,
            'new_value' => is_array($newValue) ? json_encode($newValue) : $newValue,
            'user_id' => Auth::id(),
            'changed_at' => now(),
        ]);
    }

    public function index($bookingId)
    {
        $booking = TravelBooking::findOrFail($bookingId);
        $logs = Log::where('booking_id', $bookingId)->orderBy('changed_at', 'desc')->get();
        return view('logs.index', compact('booking', 'logs'));
    }
}
?>