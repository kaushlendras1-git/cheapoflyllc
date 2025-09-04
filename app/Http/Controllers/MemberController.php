<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
  


    public function index()
    {
        // Fetch all users with their current shift and team
        $members = User::with(['currentShift.shift', 'currentTeam.team'])->orderby(
            'created_at',
            'desc'
        )->get();

        // Count admins and agents
        $admin_count = User::where('role', 'Admin')->count();
        $active_agent_count = User::where('role', 'Agent')->where('status', '1')->count();
        $inactive_agent_count = User::where('role', 'Agent')->where('status', '0')->count();

        // Count users per team
        $team_counts = User::join('user_team_assignments', 'users.id', '=', 'user_team_assignments.user_id')
            ->join('teams', 'user_team_assignments.team_id', '=', 'teams.id')
            ->where('user_team_assignments.effective_from', '<=', now())
            ->where(function ($query) {
                $query->whereNull('user_team_assignments.effective_to')
                    ->orWhere('user_team_assignments.effective_to', '>=', now());
            })
            ->groupBy('teams.id', 'teams.name')
            ->selectRaw('count(*) as total, teams.name')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->name => $item->total];
            });

        // Count users per shift
        $shift_counts = User::join('user_shift_assignments', 'users.id', '=', 'user_shift_assignments.user_id')
            ->join('shifts', 'user_shift_assignments.shift_id', '=', 'shifts.id')
            ->where('user_shift_assignments.effective_from', '<=', now())
            ->where(function ($query) {
                $query->whereNull('user_shift_assignments.effective_to')
                    ->orWhere('user_shift_assignments.effective_to', '>=', now());
            })
            ->groupBy('shifts.id', 'shifts.name')
            ->selectRaw('count(*) as total, shifts.name')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->name => $item->total];
            });

        // Total users with a team or shift
        $total_team_users = $team_counts->sum('total');
        $total_shift_users = $shift_counts->sum('total');

        return view('web.members.index', compact(
            'members',
            'admin_count',
            'active_agent_count',
            'inactive_agent_count',
            'team_counts',
            'shift_counts',
            'total_team_users',
            'total_shift_users'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:25',
            'pseudo' => 'required|string|max:25|unique:users,pseudo',
            'password' => 'required|string|max:25',
            'role' => 'required|in:Agent,TLeader,Manager,Admin',
            'departments' => 'required|in:Quality,Changes,Billing,CCV,Charge Back,Sales',
        ]);
        $validated['status'] = 1;
        User::create($validated);
        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }


    public function show(User $member)
    {
        $member->hashid = $this->hashids->encode($member->id);
        return view('members.show', compact('member'));
    }

    public function edit($hashid)
    {
        $id = decode($hashid) ?? abort(404, 'Invalid member ID');
        $member = User::findOrFail($id);
        return view('web.members.edit', compact('member'));
    }

    public function update(Request $request, $hashid)
    {
        $id = decode($hashid) ?? abort(404, 'Invalid member ID');
        $member = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'pseudo' => 'required|string',
            'password' => 'nullable|string|min:8',
            'departments' => 'required|in:Quality,Changes,Billing,CCV,Charge Back,Sales',
            'role' => 'required|in:Agent,TLeader,Manager,Admin',
            'profile_picture' => 'nullable|image|mimes:jpeg,png|max:1048',
            'aadhar_card' => 'nullable|image|mimes:jpeg,png|max:1048',
            'profile_picture' => 'nullable|image|mimes:jpeg,png|max:1048',
        ]);

        // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if it exists
                if ($member->profile_picture) {
                    Storage::disk('public')->delete($member->profile_picture);
                }
                // Store new profile picture
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $validated['profile_picture'] = $path;
            }

            // Handle PAN card upload
            if ($request->hasFile('pan_card')) {
                // Delete old PAN card if it exists
                if ($member->pan_card) {
                    Storage::disk('public')->delete($member->pan_card);
                }
                // Store new PAN card
                $path = $request->file('pan_card')->store('pan_cards', 'public');
                $validated['pan_card'] = $path;
            }

            // Handle Aadhar card upload
            if ($request->hasFile('aadhar_card')) {
                // Delete old Aadhar card if it exists
                if ($member->aadhar_card) {
                    Storage::disk('public')->delete($member->aadhar_card);
                }
                // Store new Aadhar card
                $path = $request->file('aadhar_card')->store('aadhar_cards', 'public');
                $validated['aadhar_card'] = $path;
            }

        $member->update(array_filter($validated, fn($value) => !is_null($value)));
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }


    public function destroy(User $member)
    {
        // Delete profile picture if it exists
        if ($member->profile_picture) {
            Storage::disk('public')->delete($member->profile_picture);
        }
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