@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between ">
            <div>
                <h2 class="lob-title ">
                    <span class="iconify" data-icon="mdi:folder-plus-outline"
                        style="vertical-align: middle; font-size: 14px;"></span>
                    {{ isset($lob) ? 'Edit Lob' : 'Add Lob' }}
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
                        <a href="{{ route('lobs.index') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:folder-outline"></span>
                            Lobs
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:folder-plus-outline"></span>
                        {{ isset($lob) ? 'Edit Lob' : 'Add Lob' }}
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Form Row -->
        <div class="row">
            <div class="col-12">

                <!--  Validation Errors -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <strong>Whoops!</strong> Please fix the following errors:
                        <ul class="mt-2 mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!--  Add/Edit Form Card -->
                <div class="lob-card p-5">
                    <form method="POST" action="{{ isset($lob) ? route('lobs.update', $lob->id) : route('lobs.store') }}"
                        class="filter-form lob-filter mb-4 p-4 rounded-3 ">
                        @csrf
                        @if(isset($lob))
                            @method('PUT')
                        @endif

                        <div class="row g-4 align-items-end">
                            <!--  Name Field -->
                            <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="name" id="lobName" class="form-control input-style"
                                        placeholder=" " value="{{ old('name', $lob->name ?? '') }}" required>
                                    <label for="lobName" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:account-edit-outline"></span>
                                        Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="email" id="lobEmail" class="form-control input-style"
                                        placeholder=" " value="{{ old('email', $lob->email ?? '') }}" {{ isset($lob) ? 'readonly' : 'required' }}>
                                    <label for="lobEmail" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:email-outline"></span>
                                        Email <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>

                            <!-- <div class="col-md-3 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="password" id="lobPassword" class="form-control input-style"
                                        placeholder=" " value="" required>
                                    <label for="lobPassword" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:lock-outline"></span>
                                        Password <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div> -->







                            <!--  Submit Button -->
                            <div class="col-md-3 ">
                                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 button-style ">
                                    <span class="iconify fs-5" data-icon="mdi:content-save-outline"></span>
                                    {{ isset($lob) ? 'Update Lob' : 'Submit' }}
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