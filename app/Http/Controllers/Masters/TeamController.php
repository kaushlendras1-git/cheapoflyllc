<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\LOB;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $teams = Team::query();    
        if ($keyword) {
            $teams->where('name', 'like', "%{$keyword}%");
        }
    
        if ($start_date) {
            $teams->whereDate('created_at', '>=', $start_date);
        }
    
        if ($end_date) {
            $teams->whereDate('created_at', '<=', $end_date);
        }
    
        $teams = $teams->with('lob')->paginate(10);   
        return view('masters.teams.index', compact('teams'));
    }
    

    public function create()
    {
        $lobs = LOB::all();
        return view('masters.teams.create', compact('lobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'lob_id' => 'required|exists:lobs,id',
        ]);

        Team::create($validated);

        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        return view('masters.teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $lobs = LOB::all();
        return view('masters.teams.edit', compact('team', 'lobs'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'lob_id' => 'required|exists:lobs,id',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }

    public function getTeamsByLob($lobId)
    {
        $teams = Team::where('lob_id', $lobId)->where('status', 1)->get(['id', 'name']);
        return response()->json($teams);
    }
}
