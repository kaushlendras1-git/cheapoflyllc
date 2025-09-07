<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\LOB;
use App\Models\Team;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with(['lob', 'team'])->paginate(10);
        return view('masters.units.index', compact('units'));
    }

    public function create()
    {
        $lobs = LOB::all();
        return view('masters.units.create', compact('lobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lob_id' => 'required|exists:lobs,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        Unit::create($validated);

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    public function show(Unit $unit)
    {
        return view('masters.units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        $lobs = LOB::all();
        return view('masters.units.edit', compact('unit', 'lobs'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lob_id' => 'required|exists:lobs,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $unit->update($validated);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
