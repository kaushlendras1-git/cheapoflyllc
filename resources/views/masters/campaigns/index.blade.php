@extends('web.layouts.main')
@section('content')


            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                  <!-- Filter Card -->
                  <div class="col-12">
                    <div class="card p-4 dark-header">
                      <h6 class="fw-bold mb-1 text-white">Campaigns</h6>

                      <form method="GET" action="{{ route('campaign.index') }}">

                      <div class="d-flex flex-wrap gap-3 align-items-end">
                      


                        <div>
                          <label class="form-label mb-1">Keyword</label>
                          <input type="text" name="keyword" style="width: 30rem;" class="form-control w-96" placeholder="e.g. name " value="{{ request('keyword') }}">
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

                        <div class="ms-auto d-flex gap-2">

                          <!-- Add Button -->
                          <a href="{{route('campaign.create')}}" type="button" class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add New Entry">
                            <i class="ri ri-add-circle-line fs-5"></i> Add
                          </a>

                        </div>
                      </div>

                  </form>
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
                      <div class="booking-table-wrapper py-2">
                      <table class="table table-hover table-sm booking-table w-100 mb-0">
    <thead class="bg-dark text-white sticky-top">
        <tr>
            <th>Serial No.</th> <!-- Serial number column -->
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @forelse($campaigns as $campaign)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Serial number -->
            <td>{{ $campaign->name }}</td>
            <td>
              @if( $campaign->status ==1)
                <span class="badge bg-label-success">Active</span>
              @else
               <span class="badge bg-label-warning">inactive</span>
              @endif
             
            
            </td>
            <td>
                <!-- Edit button -->
                <a href="{{ route('campaign.edit', $campaign->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Delete button -->
                <form action="{{ route('campaign.destroy', $campaign->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this campaign?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">No campaigns available.</td> <!-- Adjusted colspan to 4 to match the number of columns -->
        </tr>
    @endforelse
    </tbody>
</table>


                         <!-- Pagination links -->
                        <div class="mt-3">
                        {{ $campaigns->links('pagination::bootstrap-4') }}
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