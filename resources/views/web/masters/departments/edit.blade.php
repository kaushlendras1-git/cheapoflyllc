@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y ">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between">
            <div>
                <h2 class="lob-title mb-1">
                    <span class="iconify" data-icon="mdi:office-building-cog-outline"
                        style="vertical-align: middle; 14px"></span>
                    Edit Department
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
                        <a href="{{ route('departments.index') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:office-building-outline"></span>
                            Departments
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-edit-outline"></span>
                        Edit Department
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Main Row -->
        <div class="row">
            <div class="col-12 col-margin">

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

                <!--  Edit Department Form -->
                <div class="lob-card p-5">
                    <form method="POST" action="{{ route('departments.update', $department->id) }}"
                        class="filter-form lob-filter mb-4 p-4 rounded-3">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 align-items-end">

                            <!-- Department Name -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="name" id="departmentName"
                                        class="form-control input-style w-100" placeholder=" "
                                        value="{{ old('name', $department->name) }}" required>
                                    <label for="departmentName" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:office-building-marker-outline"></span>
                                        Department Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <select name="status" id="departmentStatus" class="form-control input-style w-100"
                                        required>
                                        <option value="1" {{ old('status', $department->status) == 1 ? 'selected' : '' }}>✅
                                            Active</option>
                                        <option value="0" {{ old('status', $department->status) == 0 ? 'selected' : '' }}>⛔
                                            Inactive</option>
                                    </select>
                                    <label for="departmentStatus" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:toggle-switch-outline"></span>
                                        Status <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-4 d-flex  gap-3">
                                <!-- <a href="{{ route('departments.index') }}"
                                            class="btn btn-light d-flex align-items-center gap-2 button-style px-5 py-3">
                                            <span class="iconify fs-5" data-icon="mdi:arrow-left"></span>
                                            Cancel
                                        </a> -->

                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                    <span class="iconify fs-5" data-icon="mdi:content-save-edit-outline"></span>
                                    Update Department
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