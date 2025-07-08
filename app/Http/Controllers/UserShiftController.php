<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserShiftAssignment;
use Carbon\Carbon;

class UserShiftController extends Controller
{
    public function changeShift(Request $request, $userId)
    {
        $request->validate([
            'shift_id' => 'required|exists:shifts,id',
        ]);

        // Close current shift
        UserShiftAssignment::where('user_id', $userId)
            ->whereNull('effective_to')
            ->update(['effective_to' => Carbon::now()]);

        // Create new shift
        UserShiftAssignment::create([
            'user_id' => $userId,
            'shift_id' => $request->shift_id,
            'effective_from' => Carbon::now(),
        ]);

        return back()->with('success', 'Shift updated successfully.');
    }
}

