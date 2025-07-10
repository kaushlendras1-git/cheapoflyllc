@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-4">

    <!-- Filter Card -->
    <div class="col-12">
      <form method="GET" action="{{ route('booking.search') }}">
      @csrf
      <div class="card p-4 dark-header upper-search-boking">
        <h5 class="fw-bold mb-3 text-white">Bookings</h5>
        <div class="d-flex flex-wrap gap-3 align-items-end">
        

          <div>
            <label class="form-label mb-1">Keyword</label>
            <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="e.g. PNR / name / email">

          </div>

          <div>
            <label class="form-label mb-1">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
          </div>
          
          <div>
            <label class="form-label mb-1">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">

          </div>

          <div>
            <label class="form-label mb-1">Booking Status</label>
             <select class="form-control" name="booking_status">
              <option value="">All</option>
              @foreach($booking_status as $status)
                <option value="{{ $status->id }}" {{ request('booking_status') == $status->id ? 'selected' : '' }}>
                  {{ $status->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="form-label mb-1">Payment Status</label>
              <select class="form-control" name="payment_status">
              <option value="">All</option>
              @foreach($payment_status as $payment)
                <option value="{{ $payment->id }}" {{ request('payment_status') == $payment->id ? 'selected' : '' }}>
                  {{ $payment->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="ms-auto d-flex gap-2">
            <!-- Search Button -->
            <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light">
              <i class="ri ri-search-line fs-5"></i> Search
            </button>
            <!-- Add Button -->          
          </div>
        </div>
      </div>
      </form>

      <a href="{{ route('booking.export', request()->all()) }}" class="btn btn-success px-4 py-3 d-flex align-items-center gap-1">
  <i class="ri ri-file-excel-2-line fs-5"></i> Export to Excel
</a>

    </div>


    <!-- Booking Table Card -->
    <div class="col-12">
      <div class="card p-4">

      


        <!-- Table -->
        <div class="booking-table-wrapper py-2 crm-table">
         @if($bookings)   
          <table class="table table-hover table-sm booking-table w-100 mb-0">
            <thead class="bg-dark text-white sticky-top">
              <tr>
                <th>ID</th>
                <th>PNR</th>
                <th>Booking Date</th>
                <th>Agent</th>
                <th>Booking Status</th>
                <th>Payment Status</th>
                <th>Total</th>
                <th>Agent MCO</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
          @foreach ($bookings as $booking)
          <tr>
              <td>
                  <a href="{{ route('booking.show', ['id' => $hashids->encode($booking->id)]) }}">
                      {{ $booking->id }}
                  </a>
              </td>
              <td>{{ $booking->pnr }}</td>
              <td>{{ $booking->created_at }}</td>
              <td>{{ $booking->user->name ?? 'N/A' }}</td>
              
              <!-- Booking Status -->
              <td>
                  @if($booking->bookingStatus)
                      <span class="badge" style="background-color: {{ $booking->bookingStatus->color }}">
                          {{ $booking->bookingStatus->name }}
                      </span>
                  @else
                      <span class="badge bg-secondary">N/A</span>
                  @endif
              </td>

              <!-- Payment Status -->
              <td>
                  @if($booking->paymentStatus)
                      <span class="badge" style="background-color: {{ $booking->paymentStatus->color }}">
                          {{ $booking->paymentStatus->name }}
                      </span>
                  @else
                      <span class="badge bg-secondary">N/A</span>
                  @endif
              </td>

              <td>{{ $booking->pricingDetails->sum('total_amount') }}</td>
              <td>{{ $booking->pricingDetails->sum('advisor_mco') }}</td>
              <td>{{ $booking->name }}</td>
              <td>{{ $booking->email }}</td>
          </tr>
          @endforeach


              <!-- Add more rows as needed -->
              <!-- Render pagination links -->
            </tbody>
          </table>

            {{ $bookings->links('vendor.pagination.bootstrap-5') }}
        @endif

        </div>
      </div>
    </div>
  </div>
</div>

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