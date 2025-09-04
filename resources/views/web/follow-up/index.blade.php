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
                    <div class="row align-items-end w-100 booking-form gen_form">
                        <div class="col-md-4">
                            <div class="position-relative">
                                <label class="form-label mb-1">Keyword</label>
                                <input type="text" name="keyword" class="form-control w-96 input-style"
                                    placeholder="e.g. PNR / name / email / Contact" value="{{ request('keyword') }}">
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
                                <th>Booking Type</th>
                                <th>PNR</th>
                                <th>Created On</th>
                                <th>Pax Name</th>
                                <th>Contact</th>
                                <th>Campaign</th>                              
                                <th>Reservation Source</th>                             
                                <th>Converted</th>
                                <th>Followup Date</th>
                                 @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                    <th>Agent</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($callLogs as $key => $log)
                                <tr>
                                    <td>
                                        <a href="{{ route('call-logs.edit', encode($log->id)) }}">
                                            {{ $callLogs->firstItem() + $key }}
                                        </a>
                                    </td>

                                    <td>
                                        <div style="display: flex; justify-content: center; gap: 4px;">
                                            @if($log->chkflight)
                                                <i class="ri ri-flight-takeoff-line" title="Flight" style="color: #1e90ff; font-size: 18px;"></i>
                                            @endif
                                            @if($log->chkhotel)
                                                <i class="ri ri-hotel-fill" title="Hotel" style="color: #8b4513; font-size: 18px;"></i>
                                            @endif
                                            @if($log->chkcruise)
                                                <i class="ri ri-ship-fill" title="Cruise" style="color: #006994; font-size: 18px;"></i>
                                            @endif
                                            @if($log->chkcar)
                                                <i class="ri ri-car-fill" title="Car" style="color: #228b22; font-size: 18px;"></i>
                                            @endif
                                            @if($log->chktrain)
                                                <i class="ri ri-train-line" title="Train" style="color: #8a2be2; font-size: 18px;"></i>
                                            @endif
                                        </div>
                                    </td>


                                    <td>{{ $log->pnr }}</td>
                                     <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->name }}</td>
                                    <td>{{ $log->phone }}</td>
                                  <td>{{ $log->campaign ? $log->campaign->name : 'No Campaign' }}</td>
                                    
                                    <td>{{ $log->reservation_source }}</td>
                                    <td>
                                        @if($log->call_converted)
                                            <i class="ri ri-check-line" style="color: #228b22; font-size: 18px;"></i>
                                        @else
                                            <i class="ri ri-close-line" style="color: red; font-size: 18px;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $log->updated_at }}</td>
                                    @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                        <td>{{ $log->user_name }}</td>
                                     @endif   
                                   
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