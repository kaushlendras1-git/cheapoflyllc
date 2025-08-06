@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Emails</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Emails</a>
        </div>
    </div>
    <div class="row gy-6">
        <!-- Filter Card -->
        <div class="col-md-12">

            @include('web.layouts.flash')

            <div class="card p-4">
                <form method="GET" action="{{ route('emails.index') }}"
                    class="d-flex align-items-end justify-content-between mb-4">
                    <div class="row align-items-end w-100">
                        <div class="col-md-4">
                            <div>
                                <label class="form-label mb-1">Keyword</label>
                                <input type="text" name="keyword" class="form-control input-style"
                                    placeholder="e.g. Name / Subject" value="{{ request('keyword') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label class="form-label mb-1">Start Date</label>
                                <input type="date" name="start_date" class="form-control input-style"
                                    value="{{ request('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label class="form-label mb-1">End Date</label>
                                <input type="date" name="end_date" class="form-control input-style"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <button type="submit"
                                    class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style">
                                    <i class="ri ri-search-line fs-5"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="add-follow-btn">
                        <a href="{{route('emails.create')}}" type="button"
                            class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light button-style"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add New Entry">
                            <i class="ri ri-add-circle-line fs-5"></i> Add
                        </a>
                    </div>
                </form>
                <!-- Table -->
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Update By</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($email_templates as $key => $email_template)
                            <tr>
                                <td>{{ $email_template->name }}</td>
                                <td>{{ $email_template->subject }}</td>
                                <td>{{$email_template->updated_at}}</td>
                                <td>{{$email_template->created_at}}</td>
                                <td>
                                    <!-- Edit button -->
                                    <a href="{{ route('emails.edit', $email_template->id) }}"
                                        class="">
                                      <img width="25" src="../../../assets/img/icons/img-icons/edit.png" alt="edit-change">
                                      </a>

                                    <!-- Delete button -->
                                    <form action="{{ route('emails.destroy', $email_template->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-btn p-0 ms-3"
                                            onclick="return confirm('Are you sure you want to delete this template?')">
                                          <img width="25" src="../../../assets/img/icons/img-icons/delete.png" alt="shift-change">
                                          </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center">No call logs available.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <div class="mt-3">
                        {{ $email_templates->links('pagination::bootstrap-4') }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Content -->






<!-- Custom Styles -->
<style>
.dark-header {
    background-color: #312d4b;
    color: #fff;
    border-radius: 0.5rem;
}

.dark-header .form-control,
.dark-header .form-select {
    background-color: #fff;
    color: #000;
    border: 1px solid #ced4da;
}

.dark-header .form-label {
    color: #fff;
}

.dark-header .form-control::placeholder {
    color: #666;
}

.dark-header .btn-warning {
    color: #000;
}

.table td,
.table th {
    font-size: 0.75rem;
}
</style>
@endsection