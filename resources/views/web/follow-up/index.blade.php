@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Follow Ups</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Follow Ups</a>
        </div>
    </div>
    <div class="row gy-6">
        <div class="col-md-12">
            <!-- Display success message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card p-4">
                <form class="d-flex align-items-end justify-content-between mb-4" method="GET" action="{{ route('call-logs.index') }}">
                    <div class="row align-items-end w-100">
                        <div class="col-md-4">
                            <div>
                                <label class="form-label mb-1">Keyword</label>
                                <input type="text" name="keyword" class="form-control w-96 input-style"
                                    placeholder="e.g. PNR / name / email / Contact" value="{{ request('keyword') }}">
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
                </form>
                <!-- Table -->
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Followup Date</th>
                                <th>Pax Name</th>
                                <th>Contact</th>
                                <th>Campaign</th>
                                <th>Type</th>
                                <th>Query Type</th>
                                <th>Airline</th>
                                <th>Converted</th>
                                <th>Agent</th>
                                <th>Assign</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($callLogs as $key => $log)
                            <tr>
                                @if($log->call_converted)
                                <td>{{ $callLogs->firstItem() + $key }}</td>
                                @else
                                <td><a href="{{ route('call-logs.edit', Hashids::encode($log->id)) }}">
                                        {{ $callLogs->firstItem() + $key }}</a></td>
                                @endif

                                <td>{{ $log->pnr }}</td>
                                <td>{{ $log->name }}</td>
                                <td>{{ $log->phone }}</td>
                                <td>{{ $log->campaign }}</td>
                                <!-- <td>{{ $log->team }}</td> -->
                                <td>{{ $log->call_type }}</td>
                                <td>
                                    <div>
                                        <span class="badge bg-label-primary rounded-pill float-start me-1">Flight</span>
                                        <span class="badge bg-label-warning rounded-pill float-start me-1">Hotel</span>
                                        <span
                                            class="badge bg-label-secondary rounded-pill float-start me-1">Cruise</span>
                                        <span class="badge bg-label-success rounded-pill float-start">Car</span>
                                    </div>
                                </td>
                                <td>Airline</td>
                                <td>
                                    @if($log->call_converted)
                                    <span class="badge bg-label-success">Close</span>
                                    @else
                                    <span class="badge bg-label-warning">Open</span>
                                    @endif
                                </td>
                                <td>{{$log->user_name}}</td>
                                <td>{{$log->assign_name}}</td>
                                <td>{{$log->created_at}}</td>
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
                        {{ $callLogs->links('pagination::bootstrap-4') }}
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