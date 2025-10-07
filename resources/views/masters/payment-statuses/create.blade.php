@extends('web.layouts.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Add Payment Status</h2>
            <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Payment Status</a>
                <a class="" aria-current="page">Add Payment Status</a>
            </div>
        </div>


        <div class="row">

            <div class="card p-4 mb-4">
                <form method="POST" action="{{ route('payment-status.store') }}">
                    @csrf

                    <div class="p-4 mb-4">
                        <!-- Top Row: Name + Status + Submit -->
                        <div class="row align-items-end  w-100 booking-form gen_form g-3">

                            <!-- Name Field -->
                            <div class="col-md-4 position-relative">
                                <label class="form-label mb-1">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control input-style w-100"
                                    placeholder="Enter payment status name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Field -->
                            <div class="col-md-4 position-relative">
                                <label class="form-label mb-1">Status <span class="text-danger">*</span></label>
                                <select id="status" data-sh="Team" name="status" class="form-control input-style w-100"
                                    required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button (Right Corner) -->
                            <div class="col-md-auto text-end d-flex gap-2 align-items-end">
                                <button type="submit"
                                    class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style">
                                    <i class="ri ri-save-line fs-5"></i> Submit
                                </button>
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold mb-2">Roles</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{ $role->name }}"
                                                name="roles[]" value="{{ $role->id }}">
                                            <label class="form-check-label" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Departments Section (Below Roles) -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold mb-2">Departments</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($departments as $department)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{ $department->name }}"
                                                name="departments[]" value="{{ $department->id }}">
                                            <label class="form-check-label" for="{{ $department->name }}">
                                                {{ $department->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>


        </div>


        <!--/ Content -->
@endsection