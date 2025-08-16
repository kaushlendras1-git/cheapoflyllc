@extends('web.layouts.main')
@section('content')

@section('head')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Email</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('emails.index') }}">Emails</a>
                <a class="active" aria-current="page">Edit Email</a>
        </div>
    </div>
    <div class="row gy-6">
        <!-- Edit Form -->
        <form method="POST" action="{{ route('emails.store') }}">
            @csrf
          
            @include('web.layouts.flash')

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="row mb-3 booking-form">
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 booking-form">
                    <div class="col-md-12 position-relative">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control">{{ old('content') }}</textarea>

                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
            </div>
        </form>
    </div>
</div>
@endsection

            
              
@endsection


@section('footer')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/highlight/highlight.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endsection



