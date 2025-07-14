@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <h4 class="page-name">Edit Campaign</h4>

        @include('web.layouts.flash')

        <!-- Edit Form -->
        <form method="POST" action="{{ route('campaign.update', $campaign->id) }}">
            @csrf
            @method('PUT')

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3 booking-form">
                    <!-- Name Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $campaign->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="status" data-sh="Campaign" name="status" class="form-control">
                            <option value="1" {{ $campaign->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $campaign->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ Content -->

@endsection
