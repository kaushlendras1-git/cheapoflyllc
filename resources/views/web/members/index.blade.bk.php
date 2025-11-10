@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Users</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Users</a>
        </div>
    </div>


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



    <div class="card">
        <div class="card-datatable p-4">
            <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                <div class="row align-items-end w-100 booking-form gen_form mb-4">


                    <!-------------Start Filter Section --------------------->

                    <div class="col-md-2">
                        <input id="searchKeyword" class="form-control input-style" type="text"
                            placeholder="Search Name/ Email/ Pseudo" value="{{ request('keyword') }}">
                    </div>


                    <div class="col-md-1">
                        <select id="searchLob" class="form-control input-style">
                            <option value="">Lobs</option>
                            @if(isset($lobs))
                            @foreach($lobs as $lob)
                            <option value="{{ $lob->id }}" {{ request('lob')==$lob->id ? 'selected' : '' }}>
                                {{ $lob->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>


                    <div class="col-md-1">
                        <select id="searchTeam" name="team" class="form-select input-style">
                            <option value="">Teams</option>
                            @if(request('lob'))
                            @foreach($teams ?? [] as $team)
                            <option value="{{ $team->id }}" {{ request('team')==$team->id ? 'selected' : '' }}>
                                {{ $team->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select id="searchTeamLeader" class="form-control input-style">
                            <option value="">Team Leaders</option>
                            @if(isset($team_leaders))
                            @foreach($team_leaders as $leader)
                            <option value="{{ $leader->id }}" {{ request('team_leader')==$leader->id ? 'selected' : ''
                                }}>{{ $leader->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>


                    <div class="col-md-1">
                        <select id="searchDepartment" class="form-control input-style">
                            <option value="">Departments</option>
                            @if(isset($departments))
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department')==$department->id ? 'selected'
                                : '' }}>{{ $department->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-1">
                        <select id="searchRole" class="form-control input-style">
                            <option value="">Roles</option>
                            @if(isset($roles))
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role')==$role->id ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <!-------------Filter Section End --------------------->


                    <div class="col-md-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('attendance.index') }}" class="btn btn-success button-style">
                            <i class="ri ri-calendar-check-line me-1"></i>
                            <span class="d-none d-sm-inline-block">Attendance</span>
                        </a>

                        <button class="btn btn-warning button-style" style="font-size: 12px;" tabindex="0" type="button"
                            data-bs-toggle="modal" data-bs-target="#loginRequestsModal">
                            <span class="d-none d-sm-inline-block">Login Approvals</span>
                            <span class="badge bg-danger ms-1" id="pendingCount">0</span>
                        </button>

                        <button class="btn btn-primary button-style float-right" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAddUser">
                            <i class="ri ri-add-line me-1"></i>
                            <span class="d-none d-sm-inline-block">Add User</span>
                        </button>
                    </div>

                </div>






                <div class="justify-content-between dt-layout-table">
                    <div class="justify-content-between align-items-center dt-layout-full crm-table">
                        <table id="membersTable" class="table dataTable dtr-column table-responsive">
                            <thead>
                                <tr>
                                    <th><span class="dt-column-title" role="button">S.No.</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Name</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Email</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">LOB</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Team</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Deartments</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Role</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Team Leader</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Pseudo</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Extension</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Shift</span><span
                                            class="dt-column-order"></span></th>
                                    <!-- <th><span class="dt-column-title">Profile</span><span class="dt-column-order"></span></th> -->
                                    <th><span class="dt-column-title">PAN Card</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title">Aadhar Card</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Status</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title">Actions</span><span
                                            class="dt-column-order"></span></th>
                                </tr>
                            </thead>
                            <tbody id="membersTableBody">
                                @foreach($members as $key => $member)

                                <tr>
                                    <td class="dt-select">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="sorting_1">{{ $member->name }}</td>
                                    <td class="sorting_1">{{ $member->email }}</td>
                                    <td>
                                        @php
                                        $lob = $member->lobRelation;
                                        $lobColors = ['bg-primary', 'bg-success', 'bg-info', 'bg-danger'];
                                        $lobColor = $lobColors[($lob->id ?? 0) % count($lobColors)];
                                        @endphp
                                        <span class="badge {{ $lobColor }}">{{ $lob->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @php
                                        $team = $member->teamRelation;
                                        $teamColors = [
                                        'bg-warning text-dark',
                                        'bg-secondary',
                                        'bg-dark text-white',
                                        'bg-light text-dark'
                                        ];
                                        $teamColor = $teamColors[($team->id ?? 0) % count($teamColors)];
                                        @endphp
                                        <span class="badge {{ $teamColor }}">{{ $team->name ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        @php
                                        $dept = $member->departmentRelation;
                                        $deptColors = [
                                        'bg-purple text-white',
                                        'bg-pink text-white',
                                        'bg-orange
                                        text-white',
                                        'bg-teal text-white'
                                        ];
                                        $deptColor = $deptColors[($dept->id ?? 0) % count($deptColors)] ??
                                        'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $deptColor }} me-1"
                                            style="{{ str_contains($deptColor, 'bg-purple') ? 'background-color: #6f42c1 !important;' : '' }}{{ str_contains($deptColor, 'bg-pink') ? 'background-color: #e83e8c !important;' : '' }}{{ str_contains($deptColor, 'bg-orange') ? 'background-color: #fd7e14 !important;' : '' }}{{ str_contains($deptColor, 'bg-teal') ? 'background-color: #20c997 !important;' : '' }}">{{
                                            $dept->name ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        @php
                                        $role = $member->roleRelation;
                                        $roleColors = [
                                        'bg-indigo text-white',
                                        'bg-cyan text-white',
                                        'bg-yellow
                                        text-dark',
                                        'bg-lime text-dark'
                                        ];
                                        $roleColor = $roleColors[($role->id ?? 0) % count($roleColors)] ??
                                        'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $roleColor }}"
                                            style="{{ str_contains($roleColor, 'bg-indigo') ? 'background-color: #6610f2 !important;' : '' }}{{ str_contains($roleColor, 'bg-cyan') ? 'background-color: #0dcaf0 !important;' : '' }}{{ str_contains($roleColor, 'bg-yellow') ? 'background-color: #ffc107 !important;' : '' }}{{ str_contains($roleColor, 'bg-lime') ? 'background-color: #32cd32 !important;' : '' }}">{{
                                            $role->name ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        @if($member->teamLeader)
                                        <span class="badge bg-success">{{ $member->teamLeader->name }}</span>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>{{ $member->pseudo }}</td>
                                    <td>{{ $member->extension ?? '-' }}</td>
                                    <td>{{ $member->currentShift?->shift->name ?? 'No Shift Assigned' }}</td>
                                    <!--td>
                                                @if($member->profile_picture)
                                                <img src="{{ asset('storage/' . $member->profile_picture) }}" alt="Profile" class="img-thumbnail" style="width: 30px; height: 30px; object-fit: cover;">
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td-->
                                    <td>
                                        @if($member->pan_card)
                                        <a href="{{ asset('storage/' . $member->pan_card) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success">
                                            <i class="ri ri-file-text-line"></i>
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($member->aadhar_card)
                                        <a href="{{ asset('storage/' . $member->aadhar_card) }}" target="_blank"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="ri ri-file-text-line"></i>
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-toggle"
                                            onclick="toggleStatus({{ $member->id }}, '{{ $member->status == 1 ? 'Deactivate' : 'Activate' }}')"
                                            style="cursor: pointer; font-size: 18px;">
                                            {{ $member->status == 1 ? '✅' : '❌' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="action-icons d-flex align-items-center">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" class="me-2"
                                                    data-bs-target="#assignShiftTeamModal"
                                                    data-url="{{ route('users.assignments', $member->id) }}">
                                                    <img width="30"
                                                        src="{{asset('assets/img/icons/img-icons/shift.png')}}"
                                                        alt="shift-change">
                                                </a>
                                                <a href="{{ route('members.edit', encode($member->id)) }}" class="me-2">
                                                    <img width="20"
                                                        src="{{asset('assets/img/icons/img-icons/edit.png')}}"
                                                        alt="edit-change">
                                                </a>
                                                <form action="{{ route('members.destroy', $member) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="no-btn p-0"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <img width="25"
                                                            src="{{asset('assets/img/icons/img-icons/delete.png')}}"
                                                            alt="delete">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 h-100">


                    <form class="add-new-user pt-0" action="{{ route('members.store') }}" method="post">
                        @csrf

                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="name" aria-label="John Doe" required="">
                            <label for="add-user-fullname">Full Name</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="pseudo" aria-label="John Doe" required="">
                            <label for="add-user-fullname">Pseudo</label>
                        </div>


                        <!-- Email Field -->
                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="email" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email"
                                required="">
                            <label for="add-user-email">Email</label>
                        </div>

                        <!-- Contact Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="phone" required="">
                            <label for="add-user-contact">Contact</label>
                        </div>

                        <!-- Extension Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" id="add-user-extension" class="form-control" placeholder="1001"
                                aria-label="Extension" name="extension">
                            <label for="add-user-extension">Extension</label>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="password" id="add-user-password" class="form-control" placeholder="Password"
                                aria-label="Password" name="password" required="">
                            <label for="add-user-password">Password</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-5">
                            <select id="lob" name="lob" class="form-select" required="">
                                <option value="">Select Lobs</option>
                                @foreach($lobs as $lob)
                                <option value="{{ $lob->id }}">{{ $lob->name }}</option>
                                @endforeach
                            </select>
                            <label for="lob">LOB</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-5">
                            <select id="team" name="team" class="form-select" required="">
                                <option value="">Select Team</option>
                            </select>
                            <label for="team">Teams</label>
                        </div>

                        <script>
                            document.getElementById('lob').addEventListener('change', function () {
                                const lobId = this.value;
                                const teamSelect = document.getElementById('team');

                                // Reset and disable team select initially
                                teamSelect.innerHTML = '<option value="">Select Team</option>';
                                teamSelect.disabled = true;

                                if (lobId) {
                                    // Make API call to get teams
                                    fetch(`/api/teams/${lobId}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute('content')
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
                                                teamSelect.add(option);
                                            });
                                            // Enable the teams dropdown
                                            teamSelect.disabled = false;
                                            // Reset team leader when LOB changes
                                            updateTeamLeaders();
                                        })
                                        .then(() => {
                                            // Add team change listener
                                            teamSelect.addEventListener('change', updateTeamLeaders);
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
                                updateTeamLeaders();
                            });

                            // Add team change listener
                            document.getElementById('team').addEventListener('change', updateTeamLeaders);

                            // Function to update team leaders based on LOB and team
                            function updateTeamLeaders() {
                                const lobId = document.getElementById('lob').value;
                                const teamId = document.getElementById('team').value;
                                const roleSelect = document.getElementById('role-select');
                                const teamLeaderSection = document.getElementById('team-leader-section');
                                const teamLeaderSelect = document.getElementById('team_leader');

                                // Check if agent role is selected
                                const selectedRole = roleSelect?.options[roleSelect.selectedIndex];
                                const roleName = selectedRole?.getAttribute('data-role-name');

                                if (roleName === 'agent' && lobId && teamId) {
                                    teamLeaderSection.style.display = 'block';

                                    fetch(`/api/team-leaders?lob=${lobId}&team=${teamId}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                                .getAttribute('content')
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(leaders => {
                                            teamLeaderSelect.innerHTML = '<option value="">Select Team Leader</option>';
                                            leaders.forEach(leader => {
                                                const option = new Option(leader.name, leader.id);
                                                teamLeaderSelect.add(option);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error loading team leaders:', error);
                                            teamLeaderSelect.innerHTML =
                                                '<option value="">Error loading team leaders</option>';
                                        });
                                } else if (roleName !== 'agent') {
                                    teamLeaderSection.style.display = 'none';
                                } else {
                                    teamLeaderSelect.innerHTML = '<option value="">Select LOB and Team first</option>';
                                }
                            }

                            // Role change handler
                            document.addEventListener('DOMContentLoaded', function () {
                                const roleSelect = document.getElementById('role-select');
                                if (roleSelect) {
                                    roleSelect.addEventListener('change', updateTeamLeaders);
                                }
                            });
                        </script>
                        <!-- User Role Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <select id="user-role" name="department_id" class="form-select" required="">
                                <option value="">Select Departments</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <label for="user-role">Departments</label>
                        </div>

                        <!-- User Role Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <select id="role-select" name="role_id" class="form-select" required="">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" data-role-name="{{ strtolower($role->name) }}">
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="role-select">User Role</label>
                        </div>


                        <div class="form-floating form-floating-outline mb-5" id="team-leader-section"
                            style="display: none;">
                            <select id="team_leader" name="team_leader" class="form-select">
                                <option value="">Select Team Leader</option>
                            </select>
                            <label for="team_leader">Team Leader</label>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light"
                            style="padding: 5px; font-size: 12px;">Submit</button>
                    </form>

                    <script>
                        // Role change handler for team leader visibility
                        document.addEventListener('DOMContentLoaded', function () {
                            document.getElementById('role-select').addEventListener('change', function () {
                                const selectedOption = this.options[this.selectedIndex];
                                const roleName = selectedOption.getAttribute('data-role-name');
                                const teamLeaderSection = document.getElementById('team-leader-section');
                                const teamLeaderSelect = document.getElementById('team_leader');

                                if (roleName === 'agent') {
                                    teamLeaderSection.style.display = 'block';
                                    // Load team leaders
                                    fetch('/api/team-leaders', {
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                    'content')
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(leaders => {
                                            teamLeaderSelect.innerHTML =
                                                '<option value="">Select Team Leader</option>';
                                            leaders.forEach(leader => {
                                                const option = new Option(leader.name, leader
                                                    .id);
                                                teamLeaderSelect.add(option);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error loading team leaders:', error);
                                        });
                                } else {
                                    teamLeaderSection.style.display = 'none';
                                    teamLeaderSelect.innerHTML =
                                        '<option value="">Select Team Leader</option>';
                                }
                            });
                        });
                    </script>


                </div>
            </div>


        </div>


        <!-- ______________________________   Users List Table ______________________________  -->



        <!-- Shift & Team Assignment Modal -->
        <div class="modal fade" id="assignShiftTeamModal" tabindex="-1" aria-labelledby="assignModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignModalLabel">Assign Shift & Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="assignModalBody">
                        <div class="text-center text-muted">Loading...</div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="row g-6 mb-6 mt-1">
        <div class="container mt-4">
            <div class="row justify-content-start user_anyletics">
                <div class="col-2">
                    <div class="card text-white bg-primary mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">Admin Users</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$admin_count}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card text-white bg-primary mb-3"
                        style="font-size: 0.85rem; background-color: #5356d4 !important;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{$active_agent_count}}</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">14</p>
                        </div>
                    </div>
                </div>
                @foreach($team_counts as $team => $count)
                <div class="col-2">
                    <div class="card text-white bg-warning mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{ $team }} Team</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$count}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach($shift_counts as $shift => $count)
                <div class="col-2">
                    <div class="card text-white bg-info mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{ $shift }} - Shift</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$count}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Login Requests Modal -->
    <div class="modal fade" id="loginRequestsModal" tabindex="-1" aria-labelledby="loginRequestsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginRequestsModalLabel">Pending Login Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loginRequestsList">
                        <div class="text-center text-muted">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<!--  ______________________________  Users List Table ______________________________  -->



<!--/ Content -->

<script>
    // Status toggle function
    function toggleStatus(userId, action) {
        if (confirm(`Are you sure you want to ${action.toLowerCase()} this user?`)) {
            fetch(`/members/${userId}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    // Modal functionality
    const modal = document.getElementById('assignShiftTeamModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-url');
            const modalBody = modal.querySelector('#assignModalBody');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(error => {
                    modalBody.innerHTML = '<div class="alert alert-danger">Failed to load form.</div>';
                });
        });
    }

    // Role change handler for team leader visibility
    document.getElementById('role-select').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const roleName = selectedOption.getAttribute('data-role-name');
        const teamLeaderSection = document.getElementById('team-leader-section');
        const teamLeaderSelect = document.getElementById('team_leader');

        if (roleName === 'agent' || roleName === 'team leader') {
            teamLeaderSection.style.display = 'block';
            // Load team leaders
            fetch('/api/team-leaders', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
                .then(response => response.json())
                .then(leaders => {
                    teamLeaderSelect.innerHTML = '<option value="">Select Team Leader</option>';
                    leaders.forEach(leader => {
                        const option = new Option(leader.name, leader.id);
                        teamLeaderSelect.add(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading team leaders:', error);
                });
        } else {
            teamLeaderSection.style.display = 'none';
            teamLeaderSelect.innerHTML = '<option value="">Select Team Leader</option>';
        }
    });

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function () {
        // LOB change handler
        const lobSelect = document.getElementById('searchLob');
        const teamSelect = document.getElementById('searchTeam');

        if (lobSelect && teamSelect) {
            lobSelect.addEventListener('change', function () {
                const lobId = this.value;
                teamSelect.innerHTML = '<option value="">All Teams</option>';
                document.getElementById('searchTeamLeader').innerHTML =
                    '<option value="">All Team Leaders</option>';

                if (lobId) {
                    fetch(`/api/teams/${lobId}`)
                        .then(response => response.json())
                        .then(teams => {
                            teams.forEach(team => {
                                const option = document.createElement('option');
                                option.value = team.id;
                                option.textContent = team.name;
                                teamSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error loading teams:', error));

                    // Load filtered team leaders when LOB changes
                    fetch(`/api/team-leaders?lob=${lobId}`)
                        .then(response => response.json())
                        .then(leaders => {
                            document.getElementById('searchTeamLeader').innerHTML =
                                '<option value="">All Team Leaders</option>';
                            leaders.forEach(leader => {
                                document.getElementById('searchTeamLeader').innerHTML +=
                                    `<option value="${leader.id}">${leader.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    // Reset to all team leaders when no LOB selected
                    fetch('/api/team-leaders')
                        .then(response => response.json())
                        .then(leaders => {
                            document.getElementById('searchTeamLeader').innerHTML =
                                '<option value="">All Team Leaders</option>';
                            leaders.forEach(leader => {
                                document.getElementById('searchTeamLeader').innerHTML +=
                                    `<option value="${leader.id}">${leader.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
                applyFilters();
            });

            // Team change handler
            teamSelect.addEventListener('change', function () {
                const lobId = document.getElementById('searchLob').value;
                const teamId = this.value;
                const teamLeaderSelect = document.getElementById('searchTeamLeader');

                if (lobId && teamId) {
                    fetch(`/api/team-leaders?lob=${lobId}&team=${teamId}`)
                        .then(response => response.json())
                        .then(leaders => {
                            teamLeaderSelect.innerHTML = '<option value="">All Team Leaders</option>';
                            leaders.forEach(leader => {
                                teamLeaderSelect.innerHTML +=
                                    `<option value="${leader.id}">${leader.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else if (lobId || teamId) {
                    // Show filtered team leaders when only LOB or team is selected
                    fetch(`/api/team-leaders?lob=${lobId}&team=${teamId}`)
                        .then(response => response.json())
                        .then(leaders => {
                            teamLeaderSelect.innerHTML = '<option value="">All Team Leaders</option>';
                            leaders.forEach(leader => {
                                teamLeaderSelect.innerHTML +=
                                    `<option value="${leader.id}">${leader.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    // Reset to show all team leaders when no LOB/team selected
                    fetch('/api/team-leaders')
                        .then(response => response.json())
                        .then(leaders => {
                            teamLeaderSelect.innerHTML = '<option value="">All Team Leaders</option>';
                            leaders.forEach(leader => {
                                teamLeaderSelect.innerHTML +=
                                    `<option value="${leader.id}">${leader.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
                applyFilters();
            });
        }

        // Search input handler
        const searchInput = document.getElementById('searchKeyword');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 500);
            });
        }

        // Filter change handlers for remaining filters
        const filters = ['searchTeamLeader', 'searchDepartment', 'searchRole'];
        filters.forEach(filterId => {
            const element = document.getElementById(filterId);
            if (element) {
                element.addEventListener('change', applyFilters);
            }
        });

        function applyFilters() {
            const params = new URLSearchParams();

            const keyword = document.getElementById('searchKeyword')?.value;
            const lob = document.getElementById('searchLob')?.value;
            const team = document.getElementById('searchTeam')?.value;
            const teamLeader = document.getElementById('searchTeamLeader')?.value;
            const department = document.getElementById('searchDepartment')?.value;
            const role = document.getElementById('searchRole')?.value;

            if (keyword) params.append('keyword', keyword);
            if (lob) params.append('lob', lob);
            if (team) params.append('team', team);
            if (teamLeader) params.append('team_leader', teamLeader);
            if (department) params.append('department', department);
            if (role) params.append('role', role);

            window.location.href = `/masters/members?${params.toString()}`;
        }
    });
</script>
@endsection