@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    
<!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:chart-line"
                    style="vertical-align: middle; font-size: 14px;"></span>
                Edit User
            </h2>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('members.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Users
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:chart-line"></span>
                    Edit User
                </li>
            </ol>
        </nav>
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
                            <label class="form-label">Extension ID</label>
                            <input type="text" class="form-control" name="extension_id" value="{{ old('extension_id', $member->extension_id) }}" placeholder="496461049">
                            @error('extension_id')
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
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="department-select" class="form-control" required>
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
                                <option value="">Select Department First</option>
                                @foreach($roles ?? [] as $role)
                                    <option value="{{ $role->id }}" data-department="{{ $role->department_id }}" data-role-name="{{ strtolower($role->name) }}" {{ old('role_id', $member->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                           <div class="col-md-2 position-relative mb-5" id="team-section">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select name="team" id="team" class="form-control" required>
                                <option value="">Select Team</option>
                            </select>
                            @error('team')
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

// LOB and Team functionality for Edit User
document.getElementById('lob').addEventListener('change', function() {
    const lobId = this.value;
    const teamSelect = document.getElementById('team');

    // Reset and disable team select initially
    teamSelect.innerHTML = '<option value="">Select Team</option>';
    teamSelect.disabled = true;

    if (lobId) {
        // Make API call to get teams
        fetch(`/api/teams/${lobId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(teams => {
                // Populate teams dropdown
                teams.forEach(team => {
                    const option = new Option(team.name, team.id);
                    if(currentTeamId && team.id == currentTeamId) {
                        option.selected = true;
                    }
                    teamSelect.add(option);
                });
                // Enable the teams dropdown
                teamSelect.disabled = false;
                // Reset team leader when LOB changes
                updateTeamLeadersEdit();
            })
            .catch(error => {
                console.error('Error fetching teams:', error);
                teamSelect.disabled = true;
                // Show error message to user
                const errorOption = new Option('Error loading teams', '');
                teamSelect.innerHTML = '';
                teamSelect.add(errorOption);
            });
    }
    // Reset team leader when LOB changes
    updateTeamLeadersEdit();
});

// Add team change listener
document.getElementById('team').addEventListener('change', updateTeamLeadersEdit);

// Load teams on page load if LOB is selected
document.addEventListener('DOMContentLoaded', function() {
    const lobId = document.getElementById('lob').value;
    if(lobId) {
        const teamSelect = document.getElementById('team');
        teamSelect.innerHTML = '<option value="">Select Team</option>';
        
        fetch(`/api/teams/${lobId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(teams => {
            teams.forEach(team => {
                const option = new Option(team.name, team.id);
                if(currentTeamId && team.id == currentTeamId) {
                    option.selected = true;
                }
                teamSelect.add(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Initialize role options based on department
    initializeRoleOptions();
    
    // Initialize sections
    initializeSections();
    
    // Add event listeners
    document.getElementById('department-select').addEventListener('change', handleDepartmentChange);
    document.getElementById('role-select').addEventListener('change', handleRoleChange);
});

// Initialize role options based on selected department
function initializeRoleOptions() {
    const departmentId = document.getElementById('department-select').value;
    const roleSelect = document.getElementById('role-select');
    const roleOptions = roleSelect.querySelectorAll('option[data-department]');
    
    if (departmentId) {
        roleOptions.forEach(option => {
            if (option.getAttribute('data-department') === departmentId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    }
}

// Handle department change
function handleDepartmentChange() {
    const departmentId = this.value;
    const roleSelect = document.getElementById('role-select');
    const roleOptions = roleSelect.querySelectorAll('option[data-department]');
    
    // Reset role selection if department changes
    if (roleSelect.value && roleSelect.options[roleSelect.selectedIndex].getAttribute('data-department') !== departmentId) {
        roleSelect.value = '';
    }
    
    if (departmentId) {
        roleSelect.querySelector('option[value=""]').textContent = 'Select Role';
        roleOptions.forEach(option => {
            if (option.getAttribute('data-department') === departmentId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    } else {
        roleSelect.querySelector('option[value=""]').textContent = 'Select Department First';
        roleOptions.forEach(option => {
            option.style.display = 'none';
        });
    }
    
    // Reset team and team leader sections
    document.getElementById('team-section').style.display = 'none';
    document.getElementById('team-leader-section').style.display = 'none';
    document.getElementById('team').removeAttribute('required');
}

// Handle role change
function handleRoleChange() {
    const selectedRoleId = this.value;
    const noTeamRoles = ['19', '6', '9', '12'];
    const teamLeaderRoles = ['1', '7', '10', '13', '15', '16'];
    const teamSection = document.getElementById('team-section');
    const teamSelect = document.getElementById('team');
    const teamLeaderSection = document.getElementById('team-leader-section');
    
    // Handle team section visibility
    if (selectedRoleId && !noTeamRoles.includes(selectedRoleId)) {
        teamSection.style.display = 'block';
        teamSelect.setAttribute('required', 'required');
    } else {
        teamSection.style.display = 'none';
        teamSelect.removeAttribute('required');
        teamSelect.value = '';
    }
    
    // Handle team leader section visibility
    if (teamLeaderRoles.includes(selectedRoleId)) {
        teamLeaderSection.style.display = 'block';
        updateTeamLeadersEdit();
    } else {
        teamLeaderSection.style.display = 'none';
        document.getElementById('team_leader').value = '';
    }
}

// Initialize sections on page load
function initializeSections() {
    const roleSelect = document.getElementById('role-select');
    const selectedRoleId = roleSelect.value;
    const noTeamRoles = ['19', '6', '9', '12'];
    const teamLeaderRoles = ['1', '7', '10', '13', '15', '16'];
    const teamSection = document.getElementById('team-section');
    const teamSelect = document.getElementById('team');
    const teamLeaderSection = document.getElementById('team-leader-section');
    
    // Initialize team section
    if (selectedRoleId && !noTeamRoles.includes(selectedRoleId)) {
        teamSection.style.display = 'block';
        teamSelect.setAttribute('required', 'required');
    } else {
        teamSection.style.display = 'none';
        teamSelect.removeAttribute('required');
    }
    
    // Initialize team leader section
    if (teamLeaderRoles.includes(selectedRoleId)) {
        teamLeaderSection.style.display = 'block';
        updateTeamLeadersEdit();
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

// Function to load team leaders for edit page
function updateTeamLeadersEdit() {
    const lobId = document.getElementById('lob').value;
    const departmentId = document.getElementById('department-select').value;
    const roleId = document.getElementById('role-select').value;
    const teamId = document.getElementById('team').value;
    const teamLeaderSelect = document.getElementById('team_leader');
    const teamLeaderRoles = ['1', '7', '10', '13', '15', '16'];
    const currentTeamLeader = {{ old('team_leader', $member->team_leader) ?? 'null' }};
    
    if (teamLeaderRoles.includes(roleId) && lobId && departmentId && roleId) {
        const params = new URLSearchParams({
            lob: lobId,
            department: departmentId,
            role: roleId
        });
        
        if (teamId) {
            params.append('team', teamId);
        }
        
        fetch(`/api/team-leaders?${params.toString()}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
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
            teamLeaderSelect.innerHTML = '<option value="">Error loading team leaders</option>';
        });
    } else if (teamLeaderRoles.includes(roleId)) {
        teamLeaderSelect.innerHTML = '<option value="">Complete other fields first</option>';
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