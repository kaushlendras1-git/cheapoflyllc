@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-4">

    <!-- Filter Card -->
    <div class="col-12">
      <div class="card p-4 dark-header">
        <h5 class="fw-bold mb-3 text-white">Bookings</h5>
        <div class="d-flex flex-wrap gap-3 align-items-end">
          <div>
            <label class="form-label mb-1">Search By</label>
            <select class="form-select">
              <option selected>Select Criteria</option>
              <option value="pnr">PNR</option>
              <option value="agent">Agent</option>
              <option value="email">Email</option>
            </select>
          </div>

          <div>
            <label class="form-label mb-1">Keyword</label>
            <input type="text" class="form-control" placeholder="e.g. PNR / name / email">
          </div>

          <div>
            <label class="form-label mb-1">Start Date</label>
            <input type="date" class="form-control">
          </div>

          <div>
            <label class="form-label mb-1">End Date</label>
            <input type="date" class="form-control">
          </div>

          <div>
            <label class="form-label mb-1">Booking Status</label>
            <select class="form-select">
              <option selected>Booking Status</option>
              <option>Under Process</option>
              <option>Completed</option>
              <option>Cancelled</option>
            </select>
          </div>

          <div>
            <label class="form-label mb-1">Payment Status</label>
            <select class="form-select">
              <option selected>Payment Status</option>
              <option>Paid</option>
              <option>Pending</option>
            </select>
          </div>

          <div class="ms-auto d-flex gap-2">
            <!-- Search Button -->
            <button type="button" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Search">
              <i class="ri ri-search-line fs-5"></i> Search
            </button>
          
            <!-- Add Button -->
            <a href="{{route('booking-information')}}" type="button" class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add New Entry">
              <i class="ri ri-add-circle-line fs-5"></i> Add
            </a>

          </div>
        </div>
      </div>
    </div>

    <!-- Booking Table Card -->
    <div class="col-12">
      <div class="card p-4">
        <!-- Table -->
        <div class="booking-table-wrapper py-2">
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
              <tr>
                <td><a href="{{route('booking-information')}}">8131</a></td>
                <td>AIRO7043712227</td>
                <td>04/07/25 12:40 PM</td>
                <td>Testagent</td>
                <td><span class="badge bg-label-warning">Under Process</span></td>
                <td><span class="badge bg-label-danger">Pending</span></td>
                <td>12</td>
                <td>12</td>
                <td>Eric Banks</td>
                <td>huforanoc@mailinator.com</td>
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
              <!-- Add more rows as needed -->
            </tbody>
          </table>
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