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
            <div class="row gy-6 mt-1">
                <div class="card p-4 mb-4">
                    <form method="POST" action="{{ route('emails.store') }}">
                        @csrf

                        @include('web.layouts.flash')

                        <div class="p-4 mb-4">
                            <!-- Top Row: Name + Subject + Submit -->
                            <div class="row align-items-end  w-100 booking-form gen_form g-3">

                                <!-- Name Field -->
                                <div class="col-md-4 position-relative">
                                    <label class="form-label mb-1">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control input-style w-100"
                                        placeholder="Enter sender name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Subject Field -->
                                <div class="col-md-4 position-relative">
                                    <label class="form-label mb-1">Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control input-style w-100"
                                        placeholder="Enter email subject" value="{{ old('subject') }}" required>
                                    @error('subject')
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

                            <!-- Content Section -->
                            <div class="row mt-4">
                                <div class="col-md-8 position-relative">
                                    <label class="form-label fw-semibold mb-2">Content</label>
                                    <textarea name="content" class="form-control input-style w-100" rows="6"
                                        placeholder="Enter email content here...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

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