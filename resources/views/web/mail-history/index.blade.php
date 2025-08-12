@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Auth History</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Auth History</a>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Display success message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card p-4">
            <!-- Table -->
            <div class="booking-table-wrapper py-2 crm-table">
                <table class="table table-hover table-sm booking-table w-100 mb-0">
                    <thead class="bg-dark text-white sticky-top">
                        <tr>
                            <th>ID</th>
                            <!-- <th>booking_id</th>
                            <th>billing_details_id</th>
                            <th>travel_billing_details_id</th> -->
                            <th>IP</th>
                            <th>Card last 4 digit </th>
                            <th>user_id</th>
                            <th>sent data-time</th>
                            <th>recvied data-time</th>
                            <th>action</th>
                            <th>type</th>
                            <th>sent_to</th>
                            <th>details</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auth_histories as $auth_history)
                            <tr>
                                <td><i class="ri-eye-off-line" style="color: #1e90ff; font-size: 20px;"></i>
</td>
                                <td>under process</td>
                                <td>William</td>
                                <td>2025-07-11T16:38:45.957</td>
                            </tr>
                        @endforeach
                        
                        
                        
                    </tbody>
                </table>
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