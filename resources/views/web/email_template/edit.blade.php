
@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <!-- Edit Form -->
        <form method="POST" action="{{ route('emails.update', $emailTemplate->id) }}">
            @csrf
            @method('PUT')  <!-- Add PUT method for updating -->

            @include('web.layouts.flash')

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3 booking-form">
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $emailTemplate->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" value="{{ old('subject', $emailTemplate->subject) }}">
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 booking-form">
                    <div class="col-md-12 position-relative">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control">{{ old('content', $emailTemplate->content) }}</textarea>

                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection