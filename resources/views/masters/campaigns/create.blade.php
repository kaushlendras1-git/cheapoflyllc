@extends('web.layouts.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Add Campaign</h2>
            <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('campaign.index') }}">Campaigns</a>
                <a class="active" aria-current="page">Add Campaign</a>
            </div>
        </div>
        <div class="row card">

            @include('web.layouts.flash')

            <form method="POST" class="mt-3" action="{{ route('campaign.store') }}">
                @csrf

                <div class="  p-4 mb-4">
                    <div class="row align-items-end  w-100 booking-form gen_form g-3">

                        <!-- Campaign Name -->
                        <div class="col-md-4 position-relative">
                            <label class="form-label mb-1">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control input-style w-100"
                                placeholder="Enter campaign name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
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
                </div>
            </form>



        </div>


        <!--/ Content -->
@endsection