<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

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
    
        $teams = $teams->paginate(10);   
        return view('masters.teams.index', compact('teams'));
    }
    

    public function create()
    {
        return view('masters.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
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
        return view('masters.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
