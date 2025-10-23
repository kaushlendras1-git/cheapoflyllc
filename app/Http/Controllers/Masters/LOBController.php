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
            'email' => 'required|email|unique:lobs,email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $lob = LOB::create($validated);

        // Create corresponding user record
        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'lob' => $lob->id,
            'role_id' => 0,
            'status' => 1,
            'is_lob' => 1,
        ]);

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
            'email' => 'required|email|unique:lobs,email,' . $lob->id . '|unique:users,email,' . optional($lob->user)->id,
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email']
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }

        $lob->update($updateData);

        // Update corresponding user record
        $user = \App\Models\User::where('lob', $lob->id)->first();
        if ($user) {
            $user->update($updateData);
        } else {
            // Create user if doesn't exist
            \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $updateData['password'] ?? bcrypt('password123'),
                'lob' => $lob->id,
                'role_id' => 0,
                'status' => 1,
                'is_lob' => 1,
            ]);
        }

        return redirect()->route('lobs.index')->with('success', 'LOB updated successfully.');
    }

    public function destroy(LOB $lob)
    {
        // Delete corresponding user record
        \App\Models\User::where('lob', $lob->id)->delete();
        
        $lob->delete();

        return redirect()->route('lobs.index')->with('success', 'LOB deleted successfully.');
    }
}