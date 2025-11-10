@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:email-edit-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Edit Email Template
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
                    <a href="{{ route('emails.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:email-multiple-outline"></span>
                        Emails
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:email-edit-outline"></span>
                    Edit Email
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">

            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Edit Email Form -->
            <div class="lob-card p-5">
                <form method="POST" action="{{ route('emails.update', $emailTemplate->id) }}"
                    class="filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 align-items-end">

                        <!-- Email Name -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" id="emailName" class="form-control input-style w-100"
                                    placeholder=" " value="{{ old('name', $emailTemplate->name) }}" required>
                                <label for="emailName" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:account-outline"></span>
                                    Name <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="subject" id="emailSubject"
                                    class="form-control input-style w-100" placeholder=" "
                                    value="{{ old('subject', $emailTemplate->subject) }}" required>
                                <label for="emailSubject" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:email-outline"></span>
                                    Subject <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('subject')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Email Content -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold text-dark mb-2"
                                style="font-size: 12px; color: #1c316d !important;">
                                <span class="iconify me-1" data-icon="mdi:file-document-edit-outline"></span>
                                Email Content
                            </label>
                            <div class="floating-group lob-card">
                                <textarea name="content" id="emailContent" class="form-control input-style w-100"
                                    rows="6"
                                    placeholder="Write email content here...">{{ old('content', $emailTemplate->content) }}</textarea>
                            </div>
                            @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-12 d-flex justify-content-end gap-3 mt-4">


                            <button type="submit"
                                class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                <span class="iconify fs-5" data-icon="mdi:content-save-edit-outline"></span>
                                Update Email
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