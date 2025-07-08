<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTeamAssignment;

class UserTeamController extends Controller
{
    public function changeTeam(Request $request, $userId)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $newTeamId = $request->input('team_id');

        // Close current assignment
        UserTeamAssignment::where('user_id', $userId)
            ->whereNull('effective_to')
            ->update(['effective_to' => now()]);

        // New team assignment
        UserTeamAssignment::create([
            'user_id' => $userId,
            'team_id' => $newTeamId,
            'effective_from' => now(),
        ]);

        return back()->with('success', 'Team updated successfully.');
    }


    // Reporting: Team-wise Bookings
    public function teamBookingReport(){
        $teamReport = TravelBooking::select('teams.name', DB::raw('count(*) as total'))
            ->join('teams', 'travel_bookings.team_id', '=', 'teams.id')
            ->groupBy('teams.name')
            ->get();
            }

}
