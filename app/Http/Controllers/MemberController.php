<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LOB;
use App\Models\Department;
use App\Models\Role;
use App\Models\Team;

class MemberController extends Controller
{
  

    public function index(Request $request)
    {
        // Build query with search filters
        $query = User::with(['currentShift.shift', 'currentTeam.team', 'departmentRelation', 'roleRelation', 'lobRelation', 'teamRelation']);

        // Search by keyword (name, email, pseudo)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('pseudo', 'like', "%{$keyword}%");
            });
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role_id', $request->role);
        }

        // Filter by LOB
        if ($request->filled('lob')) {
            $query->where('lob', $request->lob);
        }

        // Filter by team
        if ($request->filled('team')) {
            $query->where('team', $request->team);
        }

        // Handle AJAX requests
        if ($request->ajax || $request->has('ajax')) {
            $members = $query->orderBy('created_at', 'desc')->get();
            $data = $members->map(function($member) {
                return [
                    'name' => $member->name,
                    'email' => $member->email,
                    'departments_badges' => $this->getDepartmentBadge($member),
                    'pseudo' => $member->pseudo,
                    'extension' => $member->extension ?? '<span class="text-muted">-</span>',
                    'role_badge' => $this->getRoleBadge($member),
                    'lob_badge' => $this->getLobBadge($member),
                    'team_badge' => $this->getTeamBadge($member),
                    'shift_name' => $member->currentShift?->shift->name ?? 'No Shift Assigned',
                    'team_name' => $member->currentTeam?->team->name ?? 'No Team Assigned',
                    'status_badge' => '<span class="status-toggle" onclick="toggleStatus(' . $member->id . ', \'' . ($member->status == 1 ? 'Deactivate' : 'Activate') . '\')" style="cursor: pointer; font-size: 18px;">' . ($member->status == 1 ? '✅' : '❌') . '</span>',
                    'actions' => $this->getActionButtons($member),
                    'profile_picture' => $member->profile_picture ? '<img src="' . asset('storage/' . $member->profile_picture) . '" alt="Profile" class="img-thumbnail" style="width: 30px; height: 30px; object-fit: cover;">' : '<span class="text-muted">-</span>',
                    'pan_card' => $member->pan_card ? '<a href="' . asset('storage/' . $member->pan_card) . '" target="_blank" class="btn btn-sm btn-outline-success"><i class="ri ri-file-text-line"></i></a>' : '<span class="text-muted">-</span>',
                    'aadhar_card' => $member->aadhar_card ? '<a href="' . asset('storage/' . $member->aadhar_card) . '" target="_blank" class="btn btn-sm btn-outline-info"><i class="ri ri-file-text-line"></i></a>' : '<span class="text-muted">-</span>'
                ];
            });
            return response()->json(['data' => $data]);
        }

        // Fetch all users for regular page load
        $members = $query->orderBy('created_at', 'desc')->get();

        // Count admins and agents
        $admin_count = User::whereHas('roleRelation', function($q) { $q->where('name', 'Admin'); })->count();
        $active_agent_count = User::whereHas('roleRelation', function($q) { $q->where('name', 'Agent'); })->where('status', '1')->count();
        $inactive_agent_count = User::whereHas('roleRelation', function($q) { $q->where('name', 'Agent'); })->where('status', '0')->count();

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

       $lobs = LOB::all();
       $departments = Department::all();
       $roles = Role::all();
       $teams = Team::all();
       
       // Load teams for selected LOB
       if ($request->filled('lob')) {
           $teams = Team::where('lob_id', $request->lob)->get();
       }

        return view('web.members.index', compact(
            'members',
            'admin_count',
            'active_agent_count',
            'inactive_agent_count',
            'team_counts',
            'shift_counts',
            'total_team_users',
            'total_shift_users',
            'lobs',
            'departments',
            'roles',
            'teams',
        ));
    }

    public function store(Request $request)
    {
       # dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:25',
            'extension' => 'nullable|string|max:10',
            'pseudo' => 'required|string|max:25|unique:users,pseudo',
            'password' => 'required|string|max:25',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
            'lob' => 'required|exists:lobs,id',
            'team' => 'required|exists:teams,id',
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
        $lobs = LOB::all();
        $departments = Department::all();
        $roles = Role::all();
        return view('web.members.edit', compact('member', 'lobs', 'departments', 'roles'));
    }

    public function update(Request $request, $hashid)
    {
        $id = decode($hashid) ?? abort(404, 'Invalid member ID');
        $member = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'extension' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'pseudo' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|string|min:8',
            'department_id' => 'required|integer|exists:departments,id',
            'role_id' => 'required|integer|exists:roles,id',
            'lob' => 'required|integer|exists:lobs,id',
            'team' => 'required|integer|exists:teams,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png|max:1048',
            'aadhar_card' => 'nullable|image|mimes:jpeg,png|max:1048',
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

    public function updateStatus($id)
    {
        $member = User::findOrFail($id);
        $member->status = $member->status === '1' ? '0' : '1';
        $member->save();

        return response()->json(['success' => true, 'status' => $member->status]);
    }

    private function getDepartmentBadges($departments)
    {
        $badges = '';
        foreach(explode(',', $departments) as $department) {
            $dept = trim($department);
            $badgeColors = [
                'Quality' => 'bg-success',
                'Billing' => 'bg-primary', 
                'Sales' => 'bg-warning text-dark',
                'CCV' => 'bg-info text-dark',
                'Admin' => 'bg-danger',
            ];
            $color = $badgeColors[$dept] ?? 'bg-secondary';
            $badges .= '<span class="badge ' . $color . ' me-1">' . $dept . '</span>';
        }
        return $badges;
    }

    private function getRoleBadge($member)
    {
        $role = $member->roleRelation;
        if (!$role) return '<span class="badge bg-secondary">N/A</span>';
        
        $roleColors = ['bg-indigo text-white', 'bg-cyan text-white', 'bg-yellow text-dark', 'bg-lime text-dark'];
        $roleColor = $roleColors[($role->id ?? 0) % count($roleColors)] ?? 'bg-secondary';
        $style = '';
        if (str_contains($roleColor, 'bg-indigo')) $style = 'background-color: #6610f2 !important;';
        if (str_contains($roleColor, 'bg-cyan')) $style = 'background-color: #0dcaf0 !important;';
        if (str_contains($roleColor, 'bg-yellow')) $style = 'background-color: #ffc107 !important;';
        if (str_contains($roleColor, 'bg-lime')) $style = 'background-color: #32cd32 !important;';
        
        return '<span class="badge ' . $roleColor . '" style="' . $style . '">' . $role->name . '</span>';
    }

    private function getDepartmentBadge($member)
    {
        $dept = $member->departmentRelation;
        if (!$dept) return '<span class="badge bg-secondary">N/A</span>';
        
        $deptColors = ['bg-purple text-white', 'bg-pink text-white', 'bg-orange text-white', 'bg-teal text-white'];
        $deptColor = $deptColors[($dept->id ?? 0) % count($deptColors)] ?? 'bg-secondary';
        $style = '';
        if (str_contains($deptColor, 'bg-purple')) $style = 'background-color: #6f42c1 !important;';
        if (str_contains($deptColor, 'bg-pink')) $style = 'background-color: #e83e8c !important;';
        if (str_contains($deptColor, 'bg-orange')) $style = 'background-color: #fd7e14 !important;';
        if (str_contains($deptColor, 'bg-teal')) $style = 'background-color: #20c997 !important;';
        
        return '<span class="badge ' . $deptColor . '" style="' . $style . '">' . $dept->name . '</span>';
    }

    private function getLobBadge($member)
    {
        $lob = $member->lobRelation;
        if (!$lob) return '<span class="badge bg-secondary">N/A</span>';
        
        $lobColors = ['bg-primary', 'bg-success', 'bg-info', 'bg-danger'];
        $lobColor = $lobColors[($lob->id ?? 0) % count($lobColors)];
        
        return '<span class="badge ' . $lobColor . '">' . $lob->name . '</span>';
    }

    private function getTeamBadge($member)
    {
        $team = $member->teamRelation;
        if (!$team) return '<span class="badge bg-secondary">N/A</span>';
        
        $teamColors = ['bg-warning text-dark', 'bg-secondary', 'bg-dark text-white', 'bg-light text-dark'];
        $teamColor = $teamColors[($team->id ?? 0) % count($teamColors)];
        
        return '<span class="badge ' . $teamColor . '">' . $team->name . '</span>';
    }

    private function getActionButtons($member)
    {
        return '<div class="d-flex align-items-center"><div class="action-icons d-flex align-items-center"><a href="javascript:void(0)" data-bs-toggle="modal" class="me-2" data-bs-target="#assignShiftTeamModal" data-url="' . route('users.assignments', $member->id) . '"><img width="30" src="' . asset('assets/img/icons/img-icons/shift.png') . '" alt="shift-change"></a><a href="' . route('members.edit', encode($member->id)) . '" class="me-2"><img width="20" src="' . asset('assets/img/icons/img-icons/edit.png') . '" alt="edit-change"></a><form action="' . route('members.destroy', $member) . '" method="POST" style="display:inline;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="no-btn p-0" onclick="return confirm(\'Are you sure you want to delete this user?\');"><img width="25" src="' . asset('assets/img/icons/img-icons/delete.png') . '" alt="delete"></button></form></div></div>';
    }
}