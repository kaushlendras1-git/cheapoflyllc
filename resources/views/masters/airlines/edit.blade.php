@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <h2 class="lob-title">
            <span class="iconify" data-icon="mdi:airplane-edit" style="vertical-align: middle; font-size: 14px;"></span>
            Edit Airline
        </h2>

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
                    <a href="{{ route('airlines.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:airplane"></span>
                        Airlines
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:pencil-outline"></span>
                    Edit
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">

            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Form Card -->
            <div class="lob-card p-4">
                <form method="POST" action="{{ route('airlines.update', $airline->id) }}" enctype="multipart/form-data"
                    class="filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 align-items-end">

                        <!-- Airline Code -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="code" id="airlineCode" class="form-control input-style"
                                    placeholder=" " value="{{ $airline->airline_code }}" required>
                                <label for="airlineCode" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:barcode"></span>
                                    Airline Code <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Airline Name -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" id="airlineName" class="form-control input-style"
                                    placeholder=" " value="{{ $airline->airline_name }}" required>
                                <label for="airlineName" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:airplane"></span>
                                    Airline Name <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="file" name="logo" id="airlineLogo" class="form-control input-style"
                                    accept="image/*" placeholder=" ">
                                <label for="airlineLogo" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:image-outline"></span>
                                    Upload Logo
                                </label>
                            </div>


                        </div>
                        <div class="col-md-2 position-relative">
                            <div class="mt-2 ms-1">
                                <img src="{{ asset('assets/img/airline-logo/' . $airline->airline_code . '.png') }}"
                                    width="50" alt="Current Logo" onerror="this.style.display='none'"
                                    style="margin-bottom:0px;">
                                <small class="text-muted d-block" style="font-size: 10px;">Current logo</small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-4 d-flex gap-3 mt-4">
                            <a href="{{ route('airlines.index') }}"
                                class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="background-color:var(--muted);>
                                <span class=" iconify fs-5" data-icon="mdi:close-circle-outline"></span>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 px-5 py-3"
                                style="background-color: var(--primary); color: #fff !important;">
                                <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                                    style="color: #fff !important;"></span>
                                Update Airline
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