@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <!-- Filter Card -->
        <div class="col-md-12">

            @include('web.layouts.flash')

            <div class="card p-4">
                <form method="GET" action="{{ route('agents') }}">
                    <div class="marketing-upper-form">
                        <div class="me-4">
                            <label class="form-label mb-1">Search By</label>
                            <select name="criteria" class="form-select input-style">
                                <option value="">Select Criteria</option>
                            </select>
                        </div>
                        <div class="me-4">
                            <label class="form-label mb-1">Keyword</label>
                            <input type="text" name="keyword" class="form-control w-96 input-style"
                                placeholder="e.g. PNR / name / email / Contact" value="{{ request('keyword') }}">
                        </div>
                        <div class="me-4">
                            <label class="form-label mb-1">Start Date</label>
                            <input type="date" name="start_date" class="form-control input-style"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="me-4">
                            <label class="form-label mb-1">End Date</label>
                            <input type="date" name="end_date" class="form-control input-style" value="{{ request('end_date') }}">
                        </div>
                        <div class="me-4">
                            <label class="form-label mb-1">Booking Status</label>
                            <select name="booking_status" class="form-select input-style">
                                <option value="">Booking Status</option>
                            </select>
                        </div>
                        <div class="me-4">
                            <label class="form-label mb-1">Payment Status</label>
                            <select name="payment_status" class="form-select input-style">
                                <option value="">Payment Status</option>
                            </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style m-auto">
                                <i class="ri ri-search-line fs-5"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>dsds</td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <div class="mt-3">
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