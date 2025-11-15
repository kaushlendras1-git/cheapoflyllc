@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">

        <h2 class="lob-title">
            <span class="iconify" data-icon="mdi:airplane-settings"
                style="vertical-align: middle; font-size: 14px;"></span>
            Airlines Management
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
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:airplane"></span>
                    Airlines
                </li>
            </ol>
        </nav>

    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">
            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Table Card -->
            <div class="lob-card">

                <!--  Table Header -->
                <div class="table-container table-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <form method="GET" action="{{ route('airlines.index') }}"
                                class="d-flex align-items-end flex-wrap justify-content-end gap-3">

                                <!-- Search Input -->
                                <div class="position-relative" style="min-width: 380px; max-width: 450px;">
                                    <div class="floating-group lob-card">
                                        <input id="search-airline" type="text" name="search"
                                            value="{{ request('search') }}" class="form-control input-style w-100"
                                            placeholder=" ">
                                        <label for="search-airline" class="form-label">
                                            <span class="iconify me-1" data-icon="mdi:magnify"></span>
                                            Search (Code / Airline Name)
                                        </label>

                                        @if(request('search'))
                                        <span class="clear-icon position-absolute end-0 top-50 translate-middle-y pe-3">
                                            <a href="{{ route('airlines.index') }}" class="text-muted fs-4">&times;</a>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Search Button -->
                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center justify-content-center gap-2 button-style">
                                    <span class="iconify fs-5" data-icon="mdi:magnify"></span> Search
                                </button>

                                <!-- Add Airline Button -->
                                <button type="button"
                                    class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#airlineModal">
                                    <span class="iconify fs-5" data-icon="mdi:plus-circle-outline"></span>
                                    Add Airline
                                </button>
                            </form>
                        </div>
                    </div>



                    <!--  Table -->
                    <div class="table-responsive mt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="serial-col">Serial No.</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($airlines as $key => $airline)
                                <tr>
                                    <td class="serial-col">{{ ($airlines->currentPage() - 1) * $airlines->perPage() + $loop->iteration }}</td>
                                    <td>{{ $airline->airline_code }}</td>
                                    <td>{{ $airline->airline_name }}</td>
                                    <td>
                                        <img src="{{ asset('assets/img/airline-logo/' . $airline->airline_code . '.png') }}"
                                            width="50" alt="{{ $airline->airline_name }}"
                                            onerror="this.style.display='none'">
                                    </td>
                                    <td class="text-center table-actions">
                                        <a href="{{ route('airlines.edit', $airline->id) }}" class="btn btn-sm"
                                            data-bs-toggle="tooltip" title="Edit Airline">
                                            <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                        </a>

                                        <form method="POST" action="{{ route('airlines.destroy', $airline->id) }}"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                                title="Delete Airline"
                                                onclick="return confirm('Are you sure you want to delete this airline?')">
                                                <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--  Pagination -->
                    <div class="pagination-container mt-3">
                        <nav>
                            {{ $airlines->appends(request()->query())->links() }}
                        </nav>
                    </div>

                </div>
            </div>
            <!--  End Table Card -->
        </div>
    </div>
</div>
<!--  End Content Wrapper -->


<!--  Airline Modal  -->
<div class="modal fade lob-modal-premium" id="airlineModal" tabindex="-1" aria-labelledby="airlineModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="airlineModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:airplane-plus"></span>
                    Add Airline
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('airlines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" class="form-control input-style" name="code" id="airlineCode"
                                    placeholder=" " required>
                                <label for="airlineCode" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:barcode"></span>
                                    Airline Code <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" class="form-control input-style" name="name" id="airlineName"
                                    placeholder=" " required>
                                <label for="airlineName" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:airplane"></span>
                                    Airline Name <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 position-relative">
                            <div class="floating-group lob-card">
                                <input type="file" class="form-control input-style" name="logo" id="airlineLogo"
                                    accept="image/*" placeholder=" ">
                                <label for="airlineLogo" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:image-outline"></span>
                                    Upload Logo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-end border-0 p-4">
                    <button type="button" class="btn btn-secondary d-flex align-items-center gap-2 px-4 py-2"
                        data-bs-dismiss="modal">
                        <span class="iconify fs-5" data-icon="mdi:close-circle-outline"></span>
                        Close
                    </button>
                    <button type="submit" class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                        style="background-color: var(--primary); color: #fff !important;">
                        <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                            style="color: #fff !important;"></span>
                        Save Airline
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection