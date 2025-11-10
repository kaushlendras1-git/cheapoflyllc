@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y ">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between">
            <div>
                <h2 class="lob-title mb-1">
                    <span class="iconify" data-icon="mdi:account-multiple-plus-outline"
                        style="vertical-align: middle; font-size: 14px"></span>
                    Add Team
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
                        <a href="{{ route('teams.index') }}" class=" lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-group-outline"></span>
                            Teams
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-multiple-plus-outline"></span>
                        Add Team
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Main Row -->
        <div class="row">
            <div class="col-12">

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

                <!--  Add Team Form -->
                <div class="lob-card p-5">
                    <form method="POST" action="{{ route('teams.store') }}"
                        class=" filter-form lob-filter mb-4 p-4 rounded-3 ">
                        @csrf

                        <div class="row g-4 align-items-end">

                            <!-- Team Name -->
                            <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="name" id="teamName" class="form-control input-style w-100"
                                        placeholder=" " value="{{ old('name') }}" required>
                                    <label for="teamName" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:account-edit-outline"></span>
                                        Team Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- LOB Selection -->
                            <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <select name="lob_id" id="lobSelect" class="form-control input-style w-100" required>
                                        <option value="" disabled {{ old('lob_id') ? '' : 'selected' }}>Select LOB</option>
                                        @foreach($lobs as $lob)
                                            <option value="{{ $lob->id }}" {{ old('lob_id') == $lob->id ? 'selected' : '' }}>
                                                {{ $lob->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="lobSelect" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:briefcase-outline"></span>
                                        LOB (Line of Business) <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('lob_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <select name="status" id="teamStatus" class="form-control input-style w-100" required>
                                        <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>✅ Active</option>
                                        <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>⛔ Inactive</option>
                                    </select>
                                    <label for="teamStatus" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:toggle-switch"></span>
                                        Status <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-3 ">
                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                    <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"></span>
                                    Save Team
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