@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit User</h2>
        <div class="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('members.index') }}">Users</a>
                <a>Edit User</a>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="card p-1 create-booking-wrapper">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="edit-user pt-0" action="{{ route('members.update', encode($member->id)) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Top Bar -->
                <div class="mt-2 ps-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Empty space for consistency -->
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" style="padding: 5px; font-size: 12px;"
                                class="btn btn-sm btn-primary text-center">
                                <i style="width: 14px; margin-right: 3px; height: 14px;"
                                    class="icon-base ri ri-save-2-fill"></i> Update User
                            </button>
                            <!-- <a href="{{ route('members.index') }}" style="padding: 5px; font-size: 12px;"
                                class="btn btn-sm btn-secondary text-center">
                                <i style="width: 14px; margin-right: 3px; height: 14px;"
                                    class="icon-base ri ri-arrow-left-line"></i> Back
                            </a> -->
                        </div>
                    </div>
                </div>
                
                <div class="pt-5 ps-0">
                    <div class="row booking-form">
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $member->name) }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Pseudo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pseudo" value="{{ old('pseudo', $member->pseudo) }}" required>
                            @error('pseudo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $member->email) }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Contact <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $member->phone) }}" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Extension</label>
                            <input type="text" class="form-control" name="extension" value="{{ old('extension', $member->extension) }}" placeholder="1001">
                            @error('extension')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="" placeholder="Leave blank to keep unchanged">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                          <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', $member->address) }}" >
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">LOB <span class="text-danger">*</span></label>
                            <select name="lob" id="lob" class="form-control" required>
                                <option value="">Select LOB</option>
                                @foreach($lobs as $lob)
                                    <option value="{{ $lob->id }}" {{ old('lob', $member->lob) == $lob->id ? 'selected' : '' }}>{{ $lob->name }}</option>
                                @endforeach
                            </select>
                            @error('lob')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select name="team" id="team" class="form-control" required>
                                <option value="">Select Team</option>
                            </select>
                            @error('team')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach($departments ?? [] as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $member->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="role-select" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach($roles ?? [] as $role)
                                    <option value="{{ $role->id }}" data-role-name="{{ strtolower($role->name) }}" {{ old('role_id', $member->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5" id="team-leader-section" style="display: none;">
                            <label class="form-label">Team Leader</label>
                            <select name="team_leader" id="team_leader" class="form-control">
                                <option value="">Select Team Leader</option>
                            </select>
                            @error('team_leader')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                     
                        

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status', $member->status) == '1' ? 'selected' : '' }}>✅ Active</option>
                                <option value="0" {{ old('status', $member->status) == '0' ? 'selected' : '' }}>❌ Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this, 'profile_preview')">
                            <div class="mt-2" id="profile_preview">
                                @if ($member->profile_picture)
                                <img src="{{ asset('storage/' . $member->profile_picture) }}" alt="Current Profile Picture" class="img-thumbnail" style="max-height: 50px;">
                                @else
                                <small class="text-muted">No profile picture uploaded</small>
                                @endif
                            </div>
                            @error('profile_picture')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">PAN Card</label>
                            <input type="file" class="form-control" name="pan_card" id="pan_card" accept="image/jpeg,image/png,image/jpg,application/pdf" onchange="previewFile(this, 'pan_preview')">
                            <div class="mt-2" id="pan_preview">
                                @if ($member->pan_card)
                                <a href="{{ asset('storage/' . $member->pan_card) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current PAN</a>
                                @else
                                <small class="text-muted">No PAN card uploaded</small>
                                @endif
                            </div>
                            @error('pan_card')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Aadhar Card</label>
                            <input type="file" class="form-control" name="aadhar_card" id="aadhar_card" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this, 'aadhar_preview')">
                            <div class="mt-2" id="aadhar_preview">
                                @if ($member->aadhar_card)
                                <a href="{{ asset('storage/' . $member->aadhar_card) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current Aadhar</a>
                                @else
                                <small class="text-muted">No Aadhar card uploaded</small>
                                @endif
                            </div>
                            @error('aadhar_card')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const currentTeamId = {{ old('team', $member->team) ?? 'null' }};

document.getElementById('lob').addEventListener('change', function() {
    loadTeams(this.value);
});

function loadTeams(lobId, selectedTeamId = null) {
    const teamSelect = document.getElementById('team');
    
    teamSelect.innerHTML = '<option value="">Select Team</option>';
    teamSelect.disabled = true;
    
    if(lobId) {
        fetch(`/api/teams/${lobId}`)
            .then(response => response.json())
            .then(teams => {
                teams.forEach(team => {
                    const option = new Option(team.name, team.id);
                    if(selectedTeamId && team.id == selectedTeamId) {
                        option.selected = true;
                    }
                    teamSelect.add(option);
                });
                teamSelect.disabled = false;
                // Update team leaders after teams are loaded
                updateTeamLeaders();
            })
            .catch(error => {
                console.error('Error fetching teams:', error);
            });
    }
}

// Load teams on page load if LOB is selected
document.addEventListener('DOMContentLoaded', function() {
    const lobId = document.getElementById('lob').value;
    if(lobId) {
        loadTeams(lobId, currentTeamId);
    }
    
    // Initialize team leader section
    checkRoleForTeamLeader();
    
    // Add role change listener
    document.getElementById('role-select').addEventListener('change', checkRoleForTeamLeader);
    document.getElementById('team').addEventListener('change', updateTeamLeaders);
});

function checkRoleForTeamLeader() {
    const roleSelect = document.getElementById('role-select');
    const selectedOption = roleSelect.options[roleSelect.selectedIndex];
    const roleName = selectedOption.getAttribute('data-role-name');
    const teamLeaderSection = document.getElementById('team-leader-section');
    
    if (roleName === 'agent') {
        teamLeaderSection.style.display = 'block';
        updateTeamLeaders();
    } else {
        teamLeaderSection.style.display = 'none';
    }
}

function updateTeamLeaders() {
    const lobId = document.getElementById('lob').value;
    const teamId = document.getElementById('team').value;
    const teamLeaderSelect = document.getElementById('team_leader');
    const roleSelect = document.getElementById('role-select');
    const selectedRole = roleSelect?.options[roleSelect.selectedIndex];
    const roleName = selectedRole?.getAttribute('data-role-name');
    const currentTeamLeader = {{ old('team_leader', $member->team_leader) ?? 'null' }};
    
    if (roleName === 'agent' && lobId && teamId) {
        fetch(`/api/team-leaders?lob=${lobId}&team=${teamId}`)
            .then(response => response.json())
            .then(leaders => {
                teamLeaderSelect.innerHTML = '<option value="">Select Team Leader</option>';
                leaders.forEach(leader => {
                    const option = new Option(leader.name, leader.id);
                    if(currentTeamLeader && leader.id == currentTeamLeader) {
                        option.selected = true;
                    }
                    teamLeaderSelect.add(option);
                });
            })
            .catch(error => {
                console.error('Error loading team leaders:', error);
                teamLeaderSelect.innerHTML = '<option value="">Error loading leaders</option>';
            });
    } else if (roleName === 'agent') {
        teamLeaderSelect.innerHTML = '<option value="">Select LOB and Team first</option>';
    }
}

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="img-thumbnail" style="max-height: 50px;">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="img-thumbnail" style="max-height: 50px;">';
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<small class="text-success">File selected: ' + file.name + '</small>';
        }
    }
}
</script>
@endsection