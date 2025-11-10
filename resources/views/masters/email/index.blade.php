@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:email-multiple-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Email Templates Management
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
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:email-multiple-outline"></span>
                    Email Templates
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row gy-4">
        <div class="col-12">

            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Emails Table Card -->
            <div class="lob-card p-4">

                <!--  Filter Form -->
                <form method="GET" action="{{ route('emails.index') }}" class="filter-form lob-filter p-4 rounded-3">
                    <div class="row g-4 align-items-end">

                        <!-- Keyword Search -->
                        <div class="col-md-3 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="keyword" id="keywordInput" class="form-control input-style"
                                    placeholder=" " value="{{ request('keyword') }}">
                                <label for="keywordInput" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:account-search-outline"></span>
                                    Keyword
                                </label>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="date" name="start_date" id="startDateInput"
                                    class="form-control input-style" placeholder=" "
                                    value="{{ request('start_date') }}">
                                <label for="startDateInput" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:calendar-start"></span>
                                    Start Date
                                </label>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="date" name="end_date" id="endDateInput" class="form-control input-style"
                                    placeholder=" " value="{{ request('end_date') }}">
                                <label for="endDateInput" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                                    End Date
                                </label>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 search-btn">
                                <span class="iconify fs-5" data-icon="mdi:magnify"></span>
                                Search
                            </button>
                        </div>

                        <!-- Add New Button -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" onclick="window.location.href='{{ route('emails.create') }}';"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 search-btn">
                                <span class="iconify" data-icon="mdi:plus-circle-outline"></span>
                                New Email
                            </button>
                        </div>
                    </div>
                </form>

                <!--  Table Section -->
                <div class="table-container table-2">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="serial-col">Serial No.</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Updated At</th>
                                    <th>Created On</th>
                                    <th class="text-center action-col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($email_templates as $email_template)
                                <tr>
                                    <td class="serial-col">{{ $loop->iteration }}</td>
                                    <td>{{ $email_template->name }}</td>
                                    <td>{{ $email_template->subject }}</td>
                                    <td>
                                        {{ $email_template->updated_at ? $email_template->updated_at->format('d M, Y') : '—' }}
                                    </td>
                                    <td>
                                        {{ $email_template->created_at ? $email_template->created_at->format('d M, Y') : '—' }}
                                    </td>
                                    <td class="text-center table-actions">
                                        <a href="{{ route('emails.edit', $email_template->id) }}" class="btn btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                        </a>

                                        <form action="{{ route('emails.destroy', $email_template->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this email template?')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No email templates available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container mt-3">
                        {{ $email_templates->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--  End Card -->
        </div>
    </div>
</div>
<!--  End Content Wrapper -->

@endsection