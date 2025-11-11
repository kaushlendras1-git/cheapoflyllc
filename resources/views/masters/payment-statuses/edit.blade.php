@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y ">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:credit-card-edit-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Edit Payment Status
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('payment-status.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:credit-card-outline"></span>
                        Payment Status
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:credit-card-edit-outline"></span>
                    Edit Payment Status
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">

            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Edit Payment Status Form -->
            <div class="lob-card p-5">
                <form method="POST" action="{{ route('payment-status.update', $paymentStatus->id) }}"
                    class="filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 align-items-end">

                        <!-- Payment Status Name -->
                        <div class="col-md-4 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" id="paymentStatusName"
                                    class="form-control input-style w-100" placeholder=" "
                                    value="{{ old('name', $paymentStatus->name) }}" required>
                                <label for="paymentStatusName" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:credit-card-outline"></span>
                                    Payment Status Name <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 position-relative">
                            <div class="floating-group lob-card">
                                <select id="status" name="status" class="form-control input-style w-100" required>
                                    <option value="1" {{ $paymentStatus->status == 1 ? 'selected' : '' }}>✅ Active
                                    </option>
                                    <option value="0" {{ $paymentStatus->status == 0 ? 'selected' : '' }}>⛔ Inactive
                                    </option>
                                </select>
                                <label for="status" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:toggle-switch-outline"></span>
                                    Status <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-4 d-flex gap-3 mt-4">


                            <button type="submit"
                                class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                <span class="iconify fs-5" data-icon="mdi:content-save-edit-outline"></span>
                                Update Payment Status
                            </button>
                        </div>

                         <!-- Departments Section -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                                Departments
                            </label>
                            @php
                            $selectedDepartments = is_array($paymentStatus->departments)
                            ? $paymentStatus->departments
                            : json_decode($paymentStatus->departments ?? '[]', true);
                            @endphp
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($departments as $department)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="dept-{{ $department->id }}"
                                        name="departments[]" value="{{ $department->id }}"
                                        {{ in_array($department->id, $selectedDepartments) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="dept-{{ $department->id }}">
                                        {{ $department->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-group-outline"></span>
                                Roles by Department
                            </label>
                            @php
                                $selectedRoles = is_array($paymentStatus->roles)
                                    ? $paymentStatus->roles
                                    : json_decode($paymentStatus->roles ?? '[]', true);
                                $departmentColors = [
                                    'Sales' => 'bg-primary',
                                    'CCV' => 'bg-success', 
                                    'Billing' => 'bg-warning',
                                    'Changes' => 'bg-info',
                                    'Quality' => 'bg-secondary',
                                    'Charge Back' => 'bg-danger',
                                    'No Department' => 'bg-dark'
                                ];
                                $groupedRoles = $roles->groupBy(function($role) {
                                    return $role->department->name ?? 'No Department';
                                });
                            @endphp
                            
                            @foreach($groupedRoles as $departmentName => $departmentRoles)
                                <div class="mb-3 p-3 rounded {{ $departmentColors[$departmentName] ?? 'bg-light' }} bg-opacity-10 border">
                                    <h6 class="mb-2 text-{{ str_replace('bg-', '', $departmentColors[$departmentName] ?? 'dark') }}">
                                        <span class="iconify me-1" data-icon="mdi:office-building"></span>
                                        {{ $departmentName }}
                                    </h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($departmentRoles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}"
                                                    name="roles[]" value="{{ $role->id }}"
                                                    {{ in_array($role->id, $selectedRoles) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role-{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                       

                    </div>
                </form>
            </div>
            <!--  End Form Card -->

        </div>
    </div>
</div>
<!--  End Content Wrapper -->

@endsection