@extends('web.layouts.main')
@section('content')
<!-- Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:account-multiple-outline"
                    style="vertical-align: middle; font-size: 14px;"></span>
                Users Management
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
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-multiple-outline"></span>
                    Users
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Messages -->
    @include('web.layouts.flash')

    <!-- @if(session('success'))
                                                                                                                                                                                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                                                                                                                                                                        {{ session('success') }}
                                                                                                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                    </div>
                                                                                                                                                                                @endif

                                                                                                                                                                                @if ($errors->any())
                                                                                                                                                                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                                                                                                                                                                        <strong>Whoops!</strong> Please fix the following:
                                                                                                                                                                                        <ul class="mt-2 mb-0 ps-3">
                                                                                                                                                                                            @foreach ($errors->all() as $error)
                                                                                                                                                                                                <li>{{ $error }}</li>
                                                                                                                                                                                            @endforeach
                                                                                                                                                                                        </ul>
                                                                                                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                    </div>
                                                                                                                                                                                @endif -->




    <!-- Users Table Card -->
    <div class="lob-card p-4">
        <form method="GET" action="{{ route('members.index') }}"
            class="filter-form lob-filter p-4 rounded-3 d-flex flex-wrap align-items-end gap-3">

            <!-- Keyword -->
            <div class="col-md-1 position-relative">
                <div class="floating-group lob-card">
                    <input id="searchKeyword" name="keyword" class="form-control input-style w-100" type="text"
                        placeholder=" " value="{{ request('keyword') }}">
                    <label for="searchKeyword" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:account-search-outline"></span>
                        Keyword
                    </label>
                </div>
            </div>

            <!-- LOB -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select id="searchLob" name="lob" class="form-control input-style w-100">
                        <option value="">Select LOB</option>
                        @foreach($lobs as $lob)
                        <option value="{{ $lob->id }}" {{ request('lob') == $lob->id ? 'selected' : '' }}>
                            {{ $lob->name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="searchLob" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:briefcase-outline"></span>
                        LOB
                    </label>
                </div>
            </div>
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select id="searchTeam" name="team" class="form-control input-style w-100">
                        <option value="">Select Team</option>
                        @if(request('lob'))
                        @foreach($teams ?? [] as $team)
                        <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <label for="searchLob" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:briefcase-outline"></span>
                        Team
                    </label>
                </div>
            </div>



            <!-- Team Leader -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select id="searchTeamLeader" name="team_leader" class="form-control input-style w-100">
                        <option value="">Select Leader</option>
                        @foreach($team_leaders ?? [] as $leader)
                        <option value="{{ $leader->id }}" {{ request('team_leader') == $leader->id ? 'selected' : '' }}>
                            {{ $leader->name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="searchTeamLeader" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:account-tie-outline"></span>
                        Team Leader
                    </label>
                </div>
            </div>

            <!-- Department -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select id="searchDepartment" name="department" class="form-control input-style w-100">
                        <option value="">Select Department</option>
                        @foreach($departments ?? [] as $department)
                        <option value="{{ $department->id }}"
                            {{ request('department') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="searchDepartment" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                        Department
                    </label>
                </div>
            </div>

            <!-- Role -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select id="searchRole" name="role" class="form-control input-style w-100">
                        <option value="">Select Role</option>
                        @foreach($roles ?? [] as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="searchRole" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:account-badge-outline"></span>
                        Role
                    </label>
                </div>
            </div>

            <!-- Buttons Section -->
            <div class="col-md-5 d-flex justify-content-start gap-2 mt-2">
                <a href="{{ route('attendance.index') }}"
                    class="btn btn-success button-style d-flex align-items-center gap-2 px-4 py-3">
                    <span class="iconify fs-5" data-icon="mdi:calendar-check-outline"></span>
                    Attendance
                </a>

                <button class="btn btn-warning button-style d-flex align-items-center gap-2 px-4 py-3" type="button"
                    data-bs-toggle="modal" data-bs-target="#loginRequestsModal">
                    <span class="iconify fs-5" data-icon="mdi:login-variant"></span>
                    Login Approvals
                    <span class="badge bg-danger ms-1" id="pendingCount">0</span>
                </button>

                <button type="button" class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-3"
                    data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <span class="iconify fs-5" data-icon="mdi:account-plus-outline"></span>
                    Add User
                </button>
            </div>


        </form>

        <!-- Users Table -->
        <div class="table-container table-2">

            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                <table id="membersTable" class="table align-middle compact-table mb-0">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>LOB</th>
                            <th>Team</th>
                            <th>Departments</th>
                            <th>Role</th>
                            <th>Team Leader</th>
                            <th>Pseudo</th>
                            <th>Extension</th>
                            <!-- <th>Shift</th>
                            <th>PAN Card</th>
                            <th>Aadhar Card</th> -->
                            <th>Status</th>
                            <th class="text-center action-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="membersTableBody">
                        @foreach($members as $key => $member)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
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
                                'bg-orange text-white',
                                'bg-teal text-white'
                                ];
                                $deptColor = $deptColors[($dept->id ?? 0) % count($deptColors)] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $deptColor }} me-1"
                                    style="{{ str_contains($deptColor, 'bg-purple') ? 'background-color: #6f42c1 !important;' : '' }}{{ str_contains($deptColor, 'bg-pink') ? 'background-color: #e83e8c !important;' : '' }}{{ str_contains($deptColor, 'bg-orange') ? 'background-color: #fd7e14 !important;' : '' }}{{ str_contains($deptColor, 'bg-teal') ? 'background-color: #20c997 !important;' : '' }}">
                                    {{ $dept->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @php
                                $role = $member->roleRelation;
                                $roleColors = [
                                'bg-indigo text-white',
                                'bg-cyan text-white',
                                'bg-yellow text-dark',
                                'bg-lime text-dark'
                                ];
                                $roleColor = $roleColors[($role->id ?? 0) % count($roleColors)] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $roleColor }}"
                                    style="{{ str_contains($roleColor, 'bg-indigo') ? 'background-color: #6610f2 !important;' : '' }}{{ str_contains($roleColor, 'bg-cyan') ? 'background-color: #0dcaf0 !important;' : '' }}{{ str_contains($roleColor, 'bg-yellow') ? 'background-color: #ffc107 !important;' : '' }}{{ str_contains($roleColor, 'bg-lime') ? 'background-color: #32cd32 !important;' : '' }}">
                                    {{ $role->name ?? 'N/A' }}
                                </span>
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
                            <!-- <td>{{ $member->currentShift?->shift->name ?? 'No Shift Assigned' }}</td>
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
                            </td> -->
                            <td>
                                <span class="status-toggle"
                                    onclick="toggleStatus({{ $member->id }}, '{{ $member->status == 1 ? 'Deactivate' : 'Activate' }}')"
                                    style="cursor: pointer; font-size: 18px;">
                                    {{ $member->status == 1 ? '✅' : '❌' }}
                                </span>
                            </td>
                            <td class="text-center table-actions">
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#assignShiftTeamModal"
                                    data-url="{{ route('users.assignments', $member->id) }}" class="btn btn-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Assign Shift & Team ">
                                    <span class="iconify" data-icon="mdi:swap-horizontal"></span>
                                </a>
                                <a href="{{ route('members.edit', encode($member->id)) }}" class="btn btn-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit ">
                                    <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                </a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete "
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                        <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row g-4 mb-4 lob-analytics-section">
            <!-- Admin Users -->
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="lob-analytics-card gradient-primary">
                    <div class="lob-analytics-inner">
                        <div class="lob-analytics-icon">
                            <span class="iconify" data-icon="mdi:account-cog-outline"></span>
                        </div>
                        <div class="lob-analytics-content">
                            <h6 class="lob-analytics-title">Admin Users</h6>
                            <p class="lob-analytics-value">{{ $admin_count }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Agents -->
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="lob-analytics-card gradient-indigo">
                    <div class="lob-analytics-inner">
                        <div class="lob-analytics-icon">
                            <span class="iconify" data-icon="mdi:account-group-outline"></span>
                        </div>
                        <div class="lob-analytics-content">
                            <h6 class="lob-analytics-title">Active Agents</h6>
                            <p class="lob-analytics-value">{{ $active_agent_count }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic Team Counts -->
            @foreach($team_counts as $team => $count)
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="lob-analytics-card gradient-warning">
                    <div class="lob-analytics-inner">
                        <div class="lob-analytics-icon">
                            <span class="iconify" data-icon="mdi:account-multiple-outline"></span>
                        </div>
                        <div class="lob-analytics-content">
                            <h6 class="lob-analytics-title">{{ $team }} Team</h6>
                            <p class="lob-analytics-value">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Dynamic Shift Counts -->
            @foreach($shift_counts as $shift => $count)
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="lob-analytics-card gradient-info">
                    <div class="lob-analytics-inner">
                        <div class="lob-analytics-icon">
                            <span class="iconify" data-icon="mdi:clock-outline"></span>
                        </div>
                        <div class="lob-analytics-content">
                            <h6 class="lob-analytics-title">{{ $shift }} Shift</h6>
                            <p class="lob-analytics-value">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Users Analytics Cards -->


    <!-- ADD USER MODAL -->
<div class="modal fade lob-modal-premium" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0" style="overflow:auto !important;">
                <!-- Header -->
                <div class="modal-header text-white  p-4 border-0">
                    <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="addUserModalLabel">
                        <span class="iconify fs-4" data-icon="mdi:account-plus-outline"></span>
                        Add New User
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="addUserForm" class="filter-form lob-filter mb-4 p-4 rounded-3"
                    action="{{ route('members.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="row g-4 align-items-end">

                        <!-- Full Name -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-outline"></span>
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="name"
                                placeholder="Enter full name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pseudo -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-star-outline"></span>
                                Pseudo <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="pseudo"
                                placeholder="Enter pseudo name" value="{{ old('pseudo') }}" required>
                            @error('pseudo')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:email-outline"></span>
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control input-style w-100" name="email"
                                placeholder="Enter email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:phone-outline"></span>
                                Contact <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="phone"
                                placeholder="+1 234 567 890" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Extension -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:phone-in-talk-outline"></span>
                                Extension
                            </label>
                            <input type="text" class="form-control input-style w-100" name="extension"
                                placeholder="1001" value="{{ old('extension') }}">
                            @error('extension')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:key-outline"></span>
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control input-style w-100" name="password"
                                placeholder="Enter password" required>
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- LOB -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:briefcase-outline"></span>
                                LOB (Line of Business) <span class="text-danger">*</span>
                            </label>
                            <select id="lob" name="lob" class="form-control input-style w-100" required>
                                <option value="">Select LOB</option>
                                @foreach($lobs as $lob)
                                <option value="{{ $lob->id }}" {{ old('lob') == $lob->id ? 'selected' : '' }}>
                                    {{ $lob->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('lob')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Team -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-group-outline"></span>
                                Team <span class="text-danger">*</span>
                            </label>
                            <select id="team" name="team" class="form-control input-style w-100" required>
                                <option value="">Select Team</option>
                            </select>
                            @error('team')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                                Department <span class="text-danger">*</span>
                            </label>
                            <select name="department_id" class="form-control input-style w-100" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-badge-outline"></span>
                                Role <span class="text-danger">*</span>
                            </label>
                            <select id="role-select" name="role_id" class="form-control input-style w-100" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" data-role-name="{{ strtolower($role->name) }}">
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Team Leader -->
                        <div class="col-md-12 position-relative" id="team-leader-section" style="display: none;">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-tie-outline"></span>
                                Team Leader
                            </label>
                            <select id="team_leader" name="team_leader" class="form-control input-style w-100">
                                <option value="">Select Team Leader</option>
                            </select>
                            @error('team_leader')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn  button-style d-flex align-items-center gap-2 px-5 py-3"
                                style="background-color: var(--primary); color: #fff!important;">
                                <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                                    style="color: #fff!important;"></span>
                                Save User
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Assign Shift & Team Modal -->
    <div class="modal fade" id="assignShiftTeamModal" tabindex="-1" aria-labelledby="assignModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0">

                <!-- Header -->
                <div class="modal-header text-white p-4 border-0">
                    <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="assignModalLabel">
                        <span class="iconify fs-4" data-icon="mdi:swap-horizontal"></span>
                        Assign Shift & Team
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form id="assignShiftTeamForm" class="filter-form lob-filter mb-4 p-4 rounded-3" method="POST">
                        @csrf

                        <div id="assignModalBody">
                            <!-- Dynamic Content Loaded Here -->
                            <div class="text-center text-muted py-4 fw-semibold">
                                <span class="iconify mb-2 d-block" data-icon="mdi:loading"
                                    style="font-size: 2rem;"></span>
                                Loading...
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="col-md-12 d-flex justify-content-end mt-3">
                            <button type="submit"
                                class="btn button-style d-flex align-items-center gap-2 px-5 py-3 ms-2"
                                style="background-color: var(--primary); color: #fff!important;">
                                <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                                    style="color: #fff!important;"></span>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Login Requests Modal -->
    <div class="modal fade lob-modal-premium" id="loginRequestsModal" tabindex="-1"
        aria-labelledby="loginRequestsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="modal-header text-white p-4 border-0">
                    <h5 class="modal-title fw-semibold d-flex align-items-center gap-2 mb-0"
                        id="loginRequestsModalLabel">
                        <span class="iconify fs-4" data-icon="mdi:login-variant"></span>
                        Pending Login Requests
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">
                    <div id="loginRequestsList" class="filter-form lob-filter p-4 rounded-3 mb-3">
                        <div class="text-center text-muted fw-medium py-4">
                            <span class="iconify d-block mb-2" data-icon="mdi:loading" style="font-size: 2rem;"></span>
                            Loading...
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                        data-bs-dismiss="modal" style="background-color: var(--primary); color: #fff!important;">
                        <span class="iconify fs-5" data-icon="mdi:close"></span>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>

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

// Modal functionality for Assign Shift & Team
const modal = document.getElementById('assignShiftTeamModal');
if (modal) {
    modal.addEventListener('show.bs.modal', function(event) {
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

// LOB and Team functionality for Add User Modal
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                teamLeaderSelect.innerHTML = '<option value="">Error loading team leaders</option>';
            });
    } else if (roleName !== 'agent') {
        teamLeaderSection.style.display = 'none';
    } else {
        teamLeaderSelect.innerHTML = '<option value="">Select LOB and Team first</option>';
    }
}

// Role change handler for Add User Modal
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role-select');
    if (roleSelect) {
        roleSelect.addEventListener('change', updateTeamLeaders);
    }
});

// Form submission handler for Add User Modal - Prevent auto-close
document.addEventListener("DOMContentLoaded", function() {
    const addUserForm = document.querySelector(".add-new-user");
    const offcanvasAddUser = document.getElementById("offcanvasAddUser");
    const submitBtn = addUserForm.querySelector('button[type="submit"]');

    if (!addUserForm || !offcanvasAddUser) return;

    addUserForm.addEventListener("submit", async function(e) {
        e.preventDefault();

        // Clear previous errors
        addUserForm.querySelectorAll(".is-invalid").forEach((el) => el.classList.remove(
            "is-invalid"));
        addUserForm.querySelectorAll(".invalid-feedback").forEach((el) => el.remove());

        // Disable button + show spinner
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            `<span class="spinner-border spinner-border-sm me-2"></span> Saving...`;

        const formData = new FormData(this);

        try {
            const response = await fetch(this.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Accept": "application/json",
                },
                body: formData,
            });

            // Check if JSON or HTML
            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error("HTML received instead of JSON:", text.substring(0, 300));
                throw new Error("Invalid JSON response (Laravel might not detect AJAX)");
            }

            const data = await response.json();

            if (response.status === 422) {
                // ✅ Validation failed: show inline errors
                handleValidationErrors(data.errors);
            } else if (data.success) {
                // ✅ Close offcanvas
                const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasAddUser);
                offcanvasInstance.hide();

                // ✅ Reset form
                addUserForm.reset();

                // ✅ Optional: update user table dynamically
                const tableBody = document.getElementById("membersTableBody");
                if (tableBody && data.user) {
                    const user = data.user;
                    const newRow =
                        `
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                            <td>New</td>
                                                                                                                                                                                                            <td>${user.name}</td>
                                                                                                                                                                                                            <td>${user.email}</td>
                                                                                                                                                                                                            <td><span class="badge bg-primary">${user.lob_name ?? "N/A"}</span></td>
                                                                                                                                                                                                            <td><span class="badge bg-info">${user.team_name ?? "N/A"}</span></td>
                                                                                                                                                                                                            <td><span class="badge bg-warning text-dark">${user.department_name ?? "N/A"}</span></td>
                                                                                                                                                                                                            <td><span class="badge bg-success">${user.role_name ?? "N/A"}</span></td>
                                                                                                                                                                                                            <td>${user.pseudo ?? "-"}</td>
                                                                                                                                                                                                            <td>${user.extension ?? "-"}</td>
                                                                                                                                                                                                            <td><span class="text-muted">No Shift Assigned</span></td>
                                                                                                                                                                                                        </tr>`;
                    tableBody.insertAdjacentHTML("afterbegin", newRow);
                }

                // ✅ Success toast
                showToast("User added successfully!", "success");
            } else {
                showToast("Something went wrong. Please check your inputs.", "danger");
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            showToast("Error saving user. Please try again.", "danger");
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Submit";
        }
    });

    // Show inline validation errors
    function handleValidationErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const input = addUserForm.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add("is-invalid");

                const feedback = document.createElement("div");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = messages[0];

                // Handle form-floating layouts correctly
                if (input.closest(".form-floating")) {
                    input.closest(".form-floating").appendChild(feedback);
                } else {
                    input.parentNode.appendChild(feedback);
                }
            }
        }
    }

    // Toast function
    function showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-4`;
        toast.style.zIndex = 2000;
        toast.innerHTML =
            `
                                                                                                                                                                                            ${message}
                                                                                                                                                                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                                                                                                                                                        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }
});

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    // LOB change handler
    const lobSelect = document.getElementById('searchLob');
    const teamSelect = document.getElementById('searchTeam');

    if (lobSelect && teamSelect) {
        lobSelect.addEventListener('change', function() {
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
        teamSelect.addEventListener('change', function() {
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
        searchInput.addEventListener('input', function() {
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

<style>
/* .modal-content {
                                                                                                        border-radius: 12px;
                                                                                                        border: none;
                                                                                                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                                                                                                    }

                                                                                                    .modal-header {
                                                                                                        border-radius: 12px 12px 0 0;
                                                                                                        padding: 1.5rem;
                                                                                                    }

                                                                                                    .modal-body {
                                                                                                        padding: 2rem;
                                                                                                        max-height: 70vh;
                                                                                                        overflow-y: auto;
                                                                                                    }

                                                                                                    .modal-footer {
                                                                                                        border-radius: 0 0 12px 12px;
                                                                                                        padding: 1.5rem;
                                                                                                        border-top: 1px solid #e9ecef;
                                                                                                    }

                                                                                                    .form-floating {
                                                                                                        margin-bottom: 1rem;
                                                                                                    }

                                                                                                    .modal-lg {
                                                                                                        max-width: 800px;
                                                                                                    }

                                                                                                    /* Custom scrollbar for modal */
/* .modal-body::-webkit-scrollbar {
                                                                                                width: 6px;
                                                                                            }

                                                                                            .modal-body::-webkit-scrollbar-track {
                                                                                                background: #f1f1f1;
                                                                                                border-radius: 10px;
                                                                                            }

                                                                                            .modal-body::-webkit-scrollbar-thumb {
                                                                                                background: #c1c1c1;
                                                                                                border-radius: 10px;
                                                                                            }

                                                                                            .modal-body::-webkit-scrollbar-thumb:hover {
                                                                                                background: #a8a8a8;
                                                                                            } */

*/
</style>

@endsection