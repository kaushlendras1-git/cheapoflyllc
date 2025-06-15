<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::all();
        $admin_count = User::where('role', 'admin')->count();
        $active_agent_count = User::where('role', 'agent')->where('status', '1')->count();
        $inactive_agent_count = User::where('role', 'agent')->where('status', '0')->count();
        return view('web.members.index', compact('members','admin_count','active_agent_count','inactive_agent_count'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:25',
            'password' => 'required|string|max:15',
            'role' => 'required|string|max:30',
            'departments' => 'required|string|max:30',
        ]);

       $validated['status'] = 1;     
        User::create($validated);
        return redirect()->route('users')->with('success', 'Member added successfully.');
    }


    public function show(User $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(User $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required|string|max:15',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(User $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function updateStatus(User $member)
    {
        \Log::info('Member Status Update:', ['id' => $member->id, 'status' => $member->status]);
        $member->status = $member->status === '1' ? '0' : '1';
        $member->save();
    
        return redirect()->route('members.index')->with('success', 'Member status updated successfully!');
    }


}
