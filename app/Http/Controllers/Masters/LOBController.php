<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\LOB;
use Illuminate\Http\Request;

class LOBController extends Controller
{
    public function index()
    {
        $lobs = LOB::paginate(10);
        return view('masters.lob.index', compact('lobs'));
    }

    public function create()
    {
        return view('masters.lob.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        LOB::create($validated);

        return redirect()->route('lobs.index')->with('success', 'LOB created successfully.');
    }

    public function show(LOB $lob)
    {
        return view('masters.lob.show', compact('lob'));
    }

    public function edit(LOB $lob)
    {
        return view('masters.lob.create', compact('lob'));
    }

    public function update(Request $request, LOB $lob)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lob->update($validated);

        return redirect()->route('lobs.index')->with('success', 'LOB updated successfully.');
    }

    public function destroy(LOB $lob)
    {
        $lob->delete();

        return redirect()->route('lobs.index')->with('success', 'LOB deleted successfully.');
    }
}