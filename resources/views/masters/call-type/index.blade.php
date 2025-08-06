@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Call Types</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Call Types</a>
        </div>
    </div>
    <div class="row gy-6">
        <!-- Filter Card -->
        <div class="col-md-12">
            <!-- Display success message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif


            <div class="card p-4">
                <form method="GET" action="{{ route('call-types.index') }}"
                    class="d-flex align-items-end justify-content-between mb-4">
                    <div class="row align-items-end w-100 booking-form gen_form">
                        <div class="col-md-4">
                            <div class="position-relative">
                            <label class="form-label mb-1">Keyword</label>
                            <input type="text" name="keyword" style="width: 30rem;" class="form-control input-style w-100"
                                placeholder="e.g. name " value="{{ request('keyword') }}">
                        </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative">
                            <label class="form-label mb-1">Start Date</label>
                            <input type="date" name="start_date" class="form-control input-style"
                                value="{{ request('start_date') }}">
                        </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative">
                            <label class="form-label mb-1">End Date</label>
                            <input type="date" name="end_date" class="form-control input-style" value="{{ request('end_date') }}">
                        </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                            <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style">
                                <i class="ri ri-search-line fs-5"></i> Search
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="add-follow-btn">
                        <a href="{{route('call-types.create')}}" type="button"
                                class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light button-style short-add"
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
                                <th>Serial No.</th> <!-- Serial number column -->
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($call_types as $call_type)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Serial number -->
                                <td>{{ $call_type->name }}</td>
                                <td>
                                    @if( $call_type->status ==1)
                                    <span class="badge bg-label-success">Active</span>
                                    @else
                                    <span class="badge bg-label-warning">inactive</span>
                                    @endif


                                </td>
                                <td>
                                    <!-- Edit button -->
                                    <a href="{{ route('call-types.edit', $call_type->id) }}"
                                        class="">
                                      <img width="25" src="../../../assets/img/icons/img-icons/edit.png" alt="edit-change">
                                      </a>

                                    <!-- Delete button -->
                                    <form action="{{ route('call-types.destroy', $call_type->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-btn p-0 ms-3"
                                            onclick="return confirm('Are you sure you want to delete this call type?')">
                                          <img width="25" src="../../../assets/img/icons/img-icons/delete.png" alt="shift-change">
                                          </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No call types available.</td>
                                <!-- Adjusted colspan to 4 to match the number of columns -->
                            </tr>
                            @endforelse
                        </tbody>
                    </table>


                    <!-- Pagination links -->
                    <div class="mt-3">
                        {{ $call_types->links('pagination::bootstrap-4') }}
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