@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <div class="col-md-12">
            <!-- Display success message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif


            <div class="card p-4">
                <form method="GET" action="{{ route('call-logs.index') }}" class="d-flex align-items-end justify-content-between mb-4">
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
                        <a href="{{route('call-logs.create')}}" type="button"
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
                                <th>ID</th>
                                <th>PNR</th>
                                <th>Pax Name</th>
                                <th>Contact</th>
                                <th>Campaign</th>
                                <!-- <th>Team</th> -->
                                <th>Type</th>
                                <th>Query Type</th>
                                <th>Airline</th>
                                <th>Converted</th>
                                <th>Followup Date</th>
                                <th>Agent</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($callLogs as $key => $log)
                            <tr>
                                @if($log->call_converted)
                                <!-- <td>{{ $callLogs->firstItem() + $key }}</td>  -->
                                <td><a href="{{ route('call-logs.edit',$hashids->encode($log->id)) }}">
                                        {{ $callLogs->firstItem() + $key }}</a></td>
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
                                        @if($log->chkflight)
                                        <span class="badge bg-label-primary rounded-pill float-start me-1">Flight</span>
                                        @endif

                                        @if($log->chkhotel)
                                        <span class="badge bg-label-warning rounded-pill float-start me-1">Hotel</span>
                                        @endif

                                        @if($log->chkcruise)
                                        <span
                                            class="badge bg-label-secondary rounded-pill float-start me-1">Cruise</span>
                                        @endif

                                        @if($log->chkcar)
                                        <span class="badge bg-label-success rounded-pill float-start">Car</span>
                                        @endif

                                    </div>
                                </td>
                                <td>Airline</td>


                                <td>
                                    @if($log->call_converted)
                                    <span class="badge bg-label-success">Success</span>
                                    @else
                                    <span class="badge bg-label-warning">Declined</span>
                                    @endif
                                </td>


                                <td>{{$log->updated_at}}</td>
                                <td>{{$log->user_name}}</td>
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
                        {{ $callLogs->links('vendor.pagination.bootstrap-5') }}
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