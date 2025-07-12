@extends('web.layouts.main')
@section('content')


            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              

                
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
                              <th>type</th>
                              <th>Sent by</th>
                              <th>Created On</th>
                            </tr>
                          </thead>
                        <tbody><tr><td class="sorting_1"><button title="View" class="viewbtn btn btn-icon btn-circle btn-light-warning w-25px h-25px" data-tp="st" data-bs-dismiss="modal" data-bs-target="#mailModal" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></button></td><td>under process</td><td>William</td><td>2025-07-11T16:38:45.957</td></tr><tr><td class="sorting_1"><button title="View" class="viewbtn btn btn-icon btn-circle btn-light-warning w-25px h-25px" data-tp="st" data-bs-dismiss="modal" data-bs-target="#mailModal" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></button></td><td>under process</td><td>William</td><td>2025-07-11T16:41:10.457</td></tr><tr><td class="sorting_1"><button title="View" class="viewbtn btn btn-icon btn-circle btn-light-warning w-25px h-25px" data-tp="st" data-bs-dismiss="modal" data-bs-target="#mailModal" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></button></td><td>under process</td><td>William</td><td>2025-07-11T16:47:50.79</td></tr><tr><td class="sorting_1"><button title="View" class="viewbtn btn btn-icon btn-circle btn-light-warning w-25px h-25px" data-tp="st" data-bs-dismiss="modal" data-bs-target="#mailModal" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></button></td><td>under process</td><td>William</td><td>2025-07-11T16:40:27.69</td></tr><tr><td class="sorting_1"><button title="View" class="viewbtn btn btn-icon btn-circle btn-light-warning w-25px h-25px" data-tp="st" data-bs-dismiss="modal" data-bs-target="#mailModal" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></button></td><td>under process</td><td>Zee</td><td>2025-07-11T16:48:17.53</td></tr></tbody>
                        </table>

          

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