@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Score</h2>
        <div class="breadcrumb">
                <a  class="active" href="#">Dashboard</a>
                <a class="active" aria-current="page">Score</a>
        </div>
    </div>
    <div class="row gy-6">
        <!-- Filter Card -->
        <div class="col-md-12">

            @include('web.layouts.flash')

            <div class="card p-4">
                <form method="GET" action="{{ route('agents') }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="marketing-upper-form mb-5 d-flex booking-form gen_form">
                       
                        <div class="me-4 position-relative">
                            <label class="form-label mb-1">Keyword</label>
                            <input type="text" name="keyword" class="form-control w-96"
                                placeholder="e.g. Name / email / Contact" value="{{ request('keyword') }}">
                        </div>
                        <div class="me-4 position-relative">
                            <label class="form-label mb-1">Start Date</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="me-4 position-relative">
                            <label class="form-label mb-1">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>

                        <div class="me-4 position-relative">
                            <label class="form-label mb-1">LOB</label>
                            <select name="lobs" class="form-select input-style w140">
                                <option value="">Select</option>
                                @foreach($lobs as $lob)
                                     <option value="{{$lob->id}}">{{$lob->name}}</option>
                                @endforeach
                            </select>
                        </div>

                         <div class="me-4 position-relative">
                            <label class="form-label mb-1">Booking Status</label>
                            <select name="booking_status" class="form-select input-style w140">
                                <option value="">Booking Status</option>
                                @foreach($booking_status as $booking)
                                     <option value="{{$booking->id}}">{{$booking->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-4 position-relative">
                            <label class="form-label mb-1">Payment Status</label>
                            <select name="payment_status" class="form-select input-style w140">
                                <option value="">Payment Status</option>
                                 @foreach($payment_status as $payment)
                                     <option value="{{$payment->id}}">{{$payment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="">
                            <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 ">
                                <i class="ri ri-search-line fs-5"></i> Search
                            </button>
                        </div>
                    </div>
                        <div class="add-follow-btn export-btn">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel"
                                href="#" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                                <i class="ri ri-file-excel-2-line fs-5"></i> </a>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div class="booking-table-wrapper py-2 crm-table">
                        <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                
                              <th>ID</th>
                                <th>Agent Name</th>
                                <th>Total No. Calls</th>
                                <th>RPC</th>
                               <th>Total Gross MCO</th>
                               <th>Total  Net MCO</th>
                               <th> Quality Score (%)</th>
                               <th> Email Status (%)</th>
                               <th> Auth Status (%)</th>
                            </tr>
                        </thead>
                        <tbody>

                           <tr>

                            <th>ID</th>
                                <th>Agent Name</th>
                                <th>Total No. Calls</th>
                                <th>RPC</th>
                               <th>Total Gross MCO</th>
                               <th>Total  Net MCO</th>
                               <th> Quality Score (%)</th>
                               <th> Email Status (%)</th>
                               <th> Auth Status (%)</th>
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