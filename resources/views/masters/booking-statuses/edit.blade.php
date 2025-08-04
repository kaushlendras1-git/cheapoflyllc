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

                <!-- Submit Button -->
                
            </div>
        </form>
    </div>
</div>
<!--/ Content -->

@endsection
