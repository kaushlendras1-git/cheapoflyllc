<?php

namespace App\Http\Controllers;

use App\Models\LOB;
use App\Models\User;
use Illuminate\Http\Request;

class LOBController extends Controller
{
    public function index()
    {
        $lobs = LOB::with('user')->paginate(10);
        return view('masters.lob.index', compact('lobs'));
    }

    public function create()
    {
        $users = User::all();
        return view('masters.lob.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
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
        $users = User::all();
        return view('masters.lob.edit', compact('lob', 'users'));
    }

    public function update(Request $request, LOB $lob)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
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