
@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Email</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('emails.index') }}">Emails</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Email</li>
            </ol>
        </nav>
    </div>
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