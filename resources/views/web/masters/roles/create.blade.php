@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y ">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between">
            <div>
                <h2 class="lob-title mb-1">
                    <span class="iconify" data-icon="mdi:shield-account-plus-outline"
                        style="vertical-align: middle; font-size: 1.8rem;"></span>
                    Add Role
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
                        <a href="{{ route('roles.index') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:shield-account-outline"></span>
                            Roles
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:plus-circle-outline"></span>
                        Add Role
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Main Row -->
        <div class="row">
            <div class="col-12 col-margin">

                <!--  Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!--  Error Messages -->
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

                <!--  Add Role Form -->
                <div class="lob-card p-5">
                    <form method="POST" action="{{ route('roles.store') }}"
                        class="filter-form lob-filter mb-4 p-4 rounded-3">
                        @csrf

                        <div class="row g-4 align-items-end">

                            <!-- Role Name -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="name" id="roleName" class="form-control input-style w-100"
                                        placeholder=" " value="{{ old('name') }}" required>
                                    <label for="roleName" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:shield-account-outline"></span>
                                        Role Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Department Selection -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <select name="department_id" id="roleDepartment" class="form-control input-style w-100"
                                        required>
                                        <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Select
                                            Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="roleDepartment" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                                        Department <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('department_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-4 d-flex gap-3">
                                <!-- <a href="{{ route('roles.index') }}"
                                    class="btn btn-light d-flex align-items-center gap-2 button-style px-5 py-3">
                                    <span class="iconify fs-5" data-icon="mdi:arrow-left"></span>
                                    Cancel
                                </a> -->

                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                    <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"></span>
                                    Save Role
                                </button>
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