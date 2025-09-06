@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Campaign</h2>
        <nav class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('booking-status.index') }}">Booking Status</a>
                <a class="active" aria-current="page">Edit Booking Status</a>
        </nav>
    </div>
    <div class="row">

        @include('web.layouts.flash')

        <!-- Edit Form -->
        <form method="POST" action="{{ route('booking-status.update', $bookingStatus->id) }}">
            @csrf
            @method('PUT')

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="row mb-3 booking-form">
                    <!-- Name Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $bookingStatus->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="status" data-sh="Campaign" name="status" class="form-control">
                            <option value="1" {{ $bookingStatus->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $bookingStatus->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Roles</label>
                        @php
                            $selectedRoles = is_array($bookingStatus->roles) ? $bookingStatus->roles : json_decode($bookingStatus->roles ?? '[]', true);
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="manager" name="roles[]" value="Manager" {{ in_array('Manager', $selectedRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="manager">Manager</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="user" name="roles[]" value="User" {{ in_array('User', $selectedRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="user">User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tleader" name="roles[]" value="TLeader" {{ in_array('TLeader', $selectedRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tleader">Team Leader</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="admin" name="roles[]" value="Admin" {{ in_array('Admin', $selectedRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Departments</label>
                        @php
                            $selectedDepartments = is_array($bookingStatus->departments) ? $bookingStatus->departments : json_decode($bookingStatus->departments ?? '[]', true);
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sales" name="departments[]" value="Sales" {{ in_array('Sales', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sales">Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ccv" name="departments[]" value="CCV" {{ in_array('CCV', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ccv">CCV</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="billing" name="departments[]" value="Billing" {{ in_array('Billing', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="billing">Billing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changes" name="departments[]" value="Changes" {{ in_array('Changes', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="changes">Changes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="quality" name="departments[]" value="Quality" {{ in_array('Quality', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="quality">Quality</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chargeback" name="departments[]" value="Charge Back" {{ in_array('Charge Back', $selectedDepartments) ? 'checked' : '' }}>
                            <label class="form-check-label" for="chargeback">Charge Back</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                
            </div>
        </form>
    </div>
</div>
<!--/ Content -->

@endsection
