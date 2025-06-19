@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-6 mb-6">
   
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="me-1">
              <p class="text-heading mb-1">Admin Users</p>
              <div class="d-flex align-items-center">
                <h4 class="mb-1 me-2">{{$admin_count}}</h4>
              </div>
            </div>
            <div class="avatar">
              <div class="avatar-initial bg-label-danger rounded">
                <div class="icon-base ri ri-user-add-line icon-26px scaleX-n1"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="me-1">
              <p class="text-heading mb-1">Active Agents</p>
              <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">{{$active_agent_count}}</h4>
              </div>
            </div>
            <div class="avatar">
              <div class="avatar-initial bg-label-success rounded">
                <div class="icon-base ri ri-user-follow-line icon-26px"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="me-1">
              <p class="text-heading mb-1">Pending Agents</p>
              <div class="d-flex align-items-center">
                <h4 class="mb-1 me-2">{{$inactive_agent_count }}</h4>
              </div>
            </div>
            <div class="avatar">
              <div class="avatar-initial bg-label-warning rounded">
                <div class="icon-base ri ri-user-search-line icon-26px"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="row m-5 my-2 mt-2 justify-content-between">

<div class="d-md-flex align-items-center dt-layout-end col-md-auto ms-auto d-flex gap-md-4 justify-content-md-between justify-content-center gap-md-2 flex-wrap mt-0">
    <div class="dt-buttons btn-group flex-wrap d-md-flex d-block gap-4 mb-md-0 mb-5 justify-content-center"><button class="btn add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="icon-base ri ri-add-line icon-sm me-0 me-sm-2 d-sm-none d-inline-block"></i><span class="d-none d-sm-inline-block">Add New User</span></span></button> </div>
</div>
</div>


  <!--  ______________________________  Users List Table ______________________________  -->


      <div class="card">

        <div class="card-datatable">
        <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">




    <div class="justify-content-between dt-layout-table">
      <div class="d-md-flex justify-content-between align-items-center dt-layout-full">
          <table class=" table dataTable dtr-column table-responsive">

            <thead>
                <tr>
                  <th><span class="dt-column-title" role="button">Sno</span><span class="dt-column-order"></span></th>
                  <th><span class="dt-column-title" role="button">User</span><span class="dt-column-order"></span></th>
                  <th><span class="dt-column-title" role="button">Email</span><span class="dt-column-order"></span></th>
                  <th><span class="dt-column-title" role="button">Role</span><span class="dt-column-order"></span></th>
                  <th><span class="dt-column-title" role="button">Status</span><span class="dt-column-order"></span></th>
                  <th><span class="dt-column-title">Actions</span><span class="dt-column-order"></span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                  <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                  <td class="dt-select">
                      {{ $member->id }}
                  </td>
                  <td class="sorting_1">
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-4">
                              <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar" class="rounded-circle">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fw-medium">{{ $member->name }}</span>
                            <small>@departments</small>
                        </div>
                      </div>
                  </td>
                  <td><span>{{ $member->email }}</span></td>
                  <td>
                      <span class="text-truncate d-flex align-items-center text-heading">
                        @if($member->role == 'admin')
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                              <div class="icon-base ri ri-group-line icon-26px"></div>
                            </div>
                        </div>
                        &nbsp; {{$member->role }}
                        @else
                        <div class="avatar">
                            <div class="avatar-initial bg-label-danger rounded">
                              <div class="icon-base ri ri-user-add-line icon-26px scaleX-n1"></div>
                            </div>
                        </div>
                        &nbsp; {{ $member->role  }}
                        @endif
                      </span>
                  </td>
                  <td>
                      @if( $member->status ==1)
                      <span class="badge bg-label-success">Active</span>
                      @else
                      <span class="badge bg-label-warning">inactive</span>
                      @endif
                  </td>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="action-icons">
                            <!-- Edit Icon -->
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-warning" title="Edit">Edit </a>
                            <!-- Delete Icon -->
                            <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this call type?')">Delete</button>
                            </form>
                        </div>
                      </div>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>

      
      <div class="row mx-3 justify-content-between">
        <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-md-0 mt-5">
          
      </div></div>
    </div>
    
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 h-100">
      

      <form class="add-new-user pt-0" action="{{ route('members.store') }}" method="post">
    @csrf
      
    <div class="form-floating form-floating-outline mb-5 form-control-validation">
        <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name" aria-label="John Doe" required="">
        <label for="add-user-fullname">Full Name</label>
    </div>

    <!-- Email Field -->
    <div class="form-floating form-floating-outline mb-5 form-control-validation">
        <input type="email" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email" required="">
        <label for="add-user-email">Email</label>
    </div>

    <!-- Contact Field -->
    <div class="form-floating form-floating-outline mb-5">
        <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="phone" required="">
        <label for="add-user-contact">Contact</label>
    </div>

    <!-- Password Field -->
    <div class="form-floating form-floating-outline mb-5">
        <input type="password" id="add-user-password" class="form-control" placeholder="Password" aria-label="Password" name="password" required="">
        <label for="add-user-password">Password</label>
    </div>

        <!-- User Role Field -->
      <div class="form-floating form-floating-outline mb-5">
        <select id="user-role" name="departments" class="form-select" required="">
            <option value="Quality">Quality</option>
            <option value="Changes">Changes</option>
            <option value="Billing">Billing</option>
            <option value="CCV">CCV</option>
            <option value="Charge Back">Charge Back</option>
            <option value="Sales">Sales</option>
        </select>
        <label for="user-role">Departments</label>
      </div>


    <!-- User Role Field -->
    <div class="form-floating form-floating-outline mb-5">
        <select id="user-role" name="role" class="form-select" required="">
            <option value="Agent">Agent</option>
            <option value="TLeader">TLeader</option>
            <option value="Manager">Manager</option>
            <option value="Admin">Admin</option>
        </select>
        <label for="user-role">User Role</label>
    </div>



    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light">Submit</button>
</form>


      </div>
    </div>

    
  </div>


  <!-- ______________________________   Users List Table ______________________________  -->





    

</div>
<!--/ Content -->
@endsection