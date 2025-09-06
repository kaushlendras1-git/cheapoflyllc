@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Campaign</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payment-status.index') }}">Payment Status</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Payment Status</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        @include('web.layouts.flash')

        <!-- Edit Form -->
        <form method="POST" action="{{ route('payment-status.update', $paymentStatus->id) }}">
            @csrf
            @method('PUT')

            <!-- payment Form Card -->
            <div class="card p-4 mb-4">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="row mb-3 payment-form">
                    <!-- Name Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $paymentStatus->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="status" data-sh="Campaign" name="status" class="form-control">
                            <option value="1" {{ $paymentStatus->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $paymentStatus->status == 0 ? 'selected' : '' }}>Inactive</option>
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
                            $selectedRoles = is_array($paymentStatus->roles) ? $paymentStatus->roles : json_decode($paymentStatus->roles ?? '[]', true);
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
                            $selectedDepartments = is_array($paymentStatus->departments) ? $paymentStatus->departments : json_decode($paymentStatus->departments ?? '[]', true);
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
