@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:credit-card-plus-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Add Payment Status
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class=" lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('payment-status.index') }}" class=" lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:credit-card-outline"></span>
                        Payment Status
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:credit-card-plus-outline"></span>
                    Add Payment Status
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">

            <!--  Flash Messages -->
            @if(session('success'))
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
            @endif

            <!--  Add Payment Status Form -->
            <div class="lob-card p-5">
                <form method="POST" action="{{ route('payment-status.store') }}"
                    class=" filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf

                    <div class="row g-4 align-items-end">

                        <!-- Payment Status Name -->
                        <div class="col-md-4 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" id="paymentStatusName"
                                    class="form-control input-style w-100" placeholder=" " value="{{ old('name') }}"
                                    required>
                                <label for=" paymentStatusName" class="form-label">
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
                                    <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>✅ Active</option>
                                    <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>⛔ Inactive</option>
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
                                <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"></span>
                                Save Payment Status
                            </button>
                        </div>

                        <!-- Roles -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:account-group-outline"></span>
                                Roles
                            </label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}"
                                        name=" roles[]" value="{{ $role->id }}">
                                    <label class=" form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Departments -->
                        <div class=" col-md-12 mt-3">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                                Departments
                            </label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($departments as $department)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="dept-{{ $department->id }}"
                                        name=" departments[]" value="{{ $department->id }}">
                                    <label class=" form-check-label" for="dept-{{ $department->id }}">
                                        {{ $department->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
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