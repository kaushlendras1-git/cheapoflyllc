<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use App\Models\TravelBooking;
use Illuminate\Http\Request;

class LogExampleController extends Controller
{
    // Example: View a call log (manual logging)
    public function viewCallLog($id)
    {
        $callLog = CallLog::find($id);
        
        if ($callLog) {
            // Log the view action
            $callLog->logView("User viewed call log details");
        }
        
        return view('call-log.show', compact('callLog'));
    }
    
    // Example: View a booking (manual logging)
    public function viewBooking($id)
    {
        $booking = TravelBooking::find($id);
        
        if ($booking) {
            // Log the view action with additional details
            $booking->logView("User accessed booking PNR: {$booking->pnr}");
        }
        
        return view('booking.show', compact('booking'));
    }
    
    // Example: Update booking status (manual logging with details)
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = TravelBooking::find($id);
        $oldStatus = $booking->booking_status_id;
        
        $booking->update([
            'booking_status_id' => $request->status_id
        ]);
        
        // Log with specific details about the status change
        $booking->logActivity('status_change', "Status changed from {$oldStatus} to {$request->status_id}");
        
        return response()->json(['success' => true]);
    }
}