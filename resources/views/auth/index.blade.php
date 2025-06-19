@extends('web.layouts.main')
@section('content')


            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                  <!-- Filter Card -->
                  <div class="col-12">
                    <div class="card p-4 dark-header">
                      <h6 class="fw-bold mb-1 text-white">Mail History</h6>
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
                              <th>ID</th>
                              <th>PNR</th>
                              <th>Mail Delivery Repoert	</th>
                              <th>Subject</th>
                              <th>Acknowledge</th>
                              <th>User IP	</th>
                              <th>Resend</th>
                              <th>Created On</th>
                            </tr>
                          </thead>
                          <tbody>
                         
                            <tr>
                         
                              <td>1</td>
                              <td></td>
                              <td>DLJASDJHS</td>
                              <td>DHASJDHAS</td>

                              <td>
                                <div>
                                  <span class="badge bg-label-primary rounded-pill float-start me-1">Flight</span>
                                    <span class="badge bg-label-warning rounded-pill float-start me-1">Hotel</span>
                                  <span class="badge bg-label-secondary rounded-pill float-start me-1">Cruise</span>
                                  <span class="badge bg-label-success rounded-pill float-start">Car</span>

                                </div>
                              </td>
                              <td>Airline</td>
                              
                              
                              <td>
                                <span class="badge bg-label-success">Success</span>
                                <span class="badge bg-label-warning">Declined</span>
                              </td>
                              <td>asas</td>
                            </tr>
                            
                            <tr>
                                    <td colspan="13" class="text-center">No call logs available.</td>
                                </tr>
                            
                          </tbody>
                        </table>

                         <!-- Pagination links -->
                        <div class="mt-3">
                       dsds
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
