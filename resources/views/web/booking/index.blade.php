@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-4">
    <!-- Booking Table Card -->
    <div class="col-12">
      <div class="card p-4">
        <!-- Table -->
        <div class="booking-table-wrapper py-2 crm-table">
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
            @foreach ($bookings as $booking)
              <tr>
                <td><a href="{{ route('booking.show', ['id' => $hashids->encode($booking->id)]) }}">{{ $booking->id }}</a></td>
                <td>{{$booking->pnr}}</td>
                <td>{{$booking->created_at}}</td>
                <td>Testagent</td>
                <td><span class="badge bg-label-warning">{{$booking->pnr}}</span></td>
                <td><span class="badge bg-label-danger">{{$booking->pnr}}</span></td>
                <td>12</td>
                <td>12</td>
                <td>{{$booking->name}}</td>
                <td>{{$booking->email}}</td>
                <td>
                  <div class="dropdown">
                    <button class="btn p-0 dropdown-toggle hide-arrow shadow-none" data-bs-toggle="dropdown">
                      <i class="icon-base ri ri-more-2-line icon-18px"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#"><i class="ri ri-eye-line me-1"></i> View</a>
                      <a class="dropdown-item" href="#"><i class="ri ri-delete-bin-line me-1"></i> Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach  
              <!-- Add more rows as needed -->
              <!-- Render pagination links -->
            </tbody>
          </table>

            {{ $bookings->links('vendor.pagination.bootstrap-5') }}

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