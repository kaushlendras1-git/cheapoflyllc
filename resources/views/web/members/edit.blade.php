@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit User</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
    <div class="row gy-6">
        <!-- <h4>Team</h4> -->
        <div class="card p-5">
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

            <form class="edit-user pt-0" action="{{ route('members.update', $hashid) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="edit-user-fullname" placeholder="John Doe"
                                name="name" aria-label="John Doe" value="{{ old('name', $member->name) }}" required>
                            <label for="edit-user-fullname">Full Name</label>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="file" class="form-control" id="edit-user-profile-picture"
                                name="profile_picture" accept="image/jpeg,image/png,image/jpg"
                                aria-label="Profile Picture">
                            <label for="edit-user-profile-picture">Profile Picture (JPEG/PNG, Max 2MB)</label>
                            @if ($member->profile_picture)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $member->profile_picture) }}"
                                    alt="Current Profile Picture" class="img-thumbnail"
                                    style="max-width: 150px; max-height: 150px;">
                                <p class="mt-1">Current Profile Picture</p>
                            </div>
                            @else
                            <p style="font-size: 10px;" class="mt-1 text-muted">No profile picture uploaded</p>
                            @endif
                            @error('profile_picture')
                            <div style="font-size: 10px;" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="email" id="edit-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email"
                                value="{{ old('email', $member->email) }}" required>
                            <label for="edit-user-email">Email</label>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" id="edit-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="phone"
                                value="{{ old('phone', $member->phone) }}" required>
                            <label for="edit-user-contact">Contact</label>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="password" id="edit-user-password" class="form-control" placeholder="Password"
                                aria-label="Password" name="password">
                            <label for="edit-user-password">Password (Leave blank to keep unchanged)</label>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5">
                            <select id="edit-user-department" name="departments" class="form-select" required>
                                <option value="Quality"
                                    {{ old('departments', $member->departments) == 'Quality' ? 'selected' : '' }}>
                                    Quality
                                </option>
                                <option value="Changes"
                                    {{ old('departments', $member->departments) == 'Changes' ? 'selected' : '' }}>
                                    Changes
                                </option>
                                <option value="Billing"
                                    {{ old('departments', $member->departments) == 'Billing' ? 'selected' : '' }}>
                                    Billing
                                </option>
                                <option value="CCV"
                                    {{ old('departments', $member->departments) == 'CCV' ? 'selected' : '' }}>
                                    CCV</option>
                                <option value="Charge Back"
                                    {{ old('departments', $member->departments) == 'Charge Back' ? 'selected' : '' }}>
                                    Charge
                                    Back</option>
                                <option value="Sales"
                                    {{ old('departments', $member->departments) == 'Sales' ? 'selected' : '' }}>Sales
                                </option>
                            </select>
                            <label for="edit-user-department">Departments</label>
                            @error('departments')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline mb-5">
                            <select id="edit-user-role" name="role" class="form-select" required>
                                <option value="Agent" {{ old('role', $member->role) == 'Agent' ? 'selected' : '' }}>
                                    Agent
                                </option>
                                <option value="TLeader" {{ old('role', $member->role) == 'TLeader' ? 'selected' : '' }}>
                                    TLeader
                                </option>
                                <option value="Manager" {{ old('role', $member->role) == 'Manager' ? 'selected' : '' }}>
                                    Manager
                                </option>
                                <option value="Admin" {{ old('role', $member->role) == 'Admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                            <label for="edit-user-role">User Role</label>
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="forms-button">
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light">Update</button>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary waves-effect">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/ Content -->

@endsection