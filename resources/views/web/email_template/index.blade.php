@extends('web.layouts.main')
@section('content')


            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                  <!-- Filter Card -->
                  <div class="col-12">
                    <div class="card p-4 dark-header">
                      <h6 class="fw-bold mb-1 text-white">Email Template</h6>

                      <form method="GET" action="{{ route('emails.index') }}">

                      <div class="d-flex flex-wrap gap-3 align-items-end">
                        <!-- <div>
                          <label class="form-label mb-1">Search By</label>
                            <select name="criteria" class="form-select">
                                <option value="">Select Criteria</option>
                                <option value="pnr" {{ request('criteria') == 'pnr' ? 'selected' : '' }}>PNR</option>
                                <option value="agent" {{ request('criteria') == 'agent' ? 'selected' : '' }}>Agent</option>
                                <option value="email" {{ request('criteria') == 'email' ? 'selected' : '' }}>Email</option>
                            </select>
                        </div> -->


                        <div>
                          <label class="form-label mb-1">Keyword</label>
                          <input type="text" name="keyword" style="width: 30rem;" class="form-control w-96" placeholder="e.g. Name / Subject" value="{{ request('keyword') }}">
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
                        <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 ">
                            <i class="ri ri-search-line fs-5"></i> Search
                        </button>
                        </div>

                        <!-- <div>
                          <label class="form-label mb-1">Booking Status</label>
                            <select name="booking_status" class="form-select">
                                <option value="">Booking Status</option>
                                <option value="Under Process" {{ request('booking_status') == 'Under Process' ? 'selected' : '' }}>Under Process</option>
                                <option value="Completed" {{ request('booking_status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ request('booking_status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div> -->

                        <!-- <div>
                          <label class="form-label mb-1">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="">Payment Status</option>
                                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div> -->

                        <div class="ms-auto d-flex gap-2">

                          <!-- Add Button -->
                          <a href="{{route('emails.create')}}" type="button" class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add New Entry">
                            <i class="ri ri-add-circle-line fs-5"></i> Add
                          </a>

                        </div>
                      </div>

                  </form>
                </div>

                
              </div>


                  <div class="col-md-12">
                 
                  @include('web.layouts.flash')
                  
                    <div class="card p-4">
                      <!-- Table -->
                      <div class="booking-table-wrapper py-2 crm-table">
                        <table class="table table-hover table-sm booking-table w-100 mb-0">
                          <thead class="bg-dark text-white sticky-top">
                            <tr>
                              <!-- <th>ID</th> -->
                              <th>Name</th>
                              <th>Subject</th>
                              <th>Update By</th>
                              <th>Created On</th>
                              <th>Actions</th> 
                            </tr>
                          </thead>
                          <tbody>
                          @forelse  ($email_templates as $key => $email_template)
                            <tr>
                              <td>{{ $email_template->name }}</td>
                              <td>{{ $email_template->subject }}</td>
                              <td>{{$email_template->updated_at}}</td>
                              <td>{{$email_template->created_at}}</td>
                              <td>
                                <!-- Edit button -->
                                <a href="{{ route('emails.edit', $email_template->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Delete button -->
                                <form action="{{ route('emails.destroy', $email_template->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this template?')">Delete</button>
                                </form>
                            </td>
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
                        {{ $email_templates->links('pagination::bootstrap-4') }}
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