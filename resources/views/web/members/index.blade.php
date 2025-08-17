@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Users</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Users</a>
        </div>
    </div>


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif





    <div class="card">
        <div class="card-datatable p-4">
            <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                <div class="d-flex align-items-center justify-content-between booking-form gen_form mb-2">
                    
                    <div class="add-user-btn text-end">
                        <button class="btn add-new btn-primary button-style" style="font-size: 12px;" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAddUser"><span>
                                <i class="icon-base ri ri-add-line icon-sm me-0 me-sm-2 d-sm-none d-inline-block"></i>
                                <span class="d-none d-sm-inline-block">Add User</span></span></button>
                    </div>
                </div>
                <div class="justify-content-between dt-layout-table">
                    <div class="d-md-flex justify-content-between align-items-center dt-layout-full crm-table">
                        <table class=" table dataTable dtr-column table-responsive">
                            <thead>
                                <tr>
                                    <th><span class="dt-column-title" role="button">S.No.</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Name</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Username</span>
                                        <spanclass="dt-column-order"></span>
                                    </th>
                                    <th><span class="dt-column-title" role="button">Deartments</span>
                                        <spanclass="dt-column-order"></span>
                                    </th>

                                    <th><span class="dt-column-title" role="button">Pseudo</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Role</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Shift</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Team</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title" role="button">Status</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title">Actions</span><span
                                            class="dt-column-order"></span></th>
                                    <th><span class="dt-column-title">Documents</span><span
                                            class="dt-column-order"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                @php
                                $name = $member->name ? $member->name : '';
                                $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr($word, 0,
                                2)))->join('');
                                @endphp

                                <tr>
                                    <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                    <td class="dt-select">
                                        {{ $member->id }}
                                    </td>
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-sm me-4">
                                                    <div class="rounded-circle   @if($member->role == 'admin') bg-danger  @else bg-primary @endif text-white d-flex justify-content-center align-items-center"
                                                        style="width: 30px; height: 30px;">
                                                        <span
                                                            style="font-size: 14px; font-weight: bold;">{{ $initials }}</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-medium">{{ $member->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span>{{ $member->departments }}</span></td>
                                    <td><span>{{ $member->email }}</span></td>
                                    <td><span>{{ $member->pseudo }}</span></td>
                                    <td> {{$member->role }}</td>
                                    <td>{{ $member->currentShift?->shift->name ?? 'No Shift Assigned' }}</td>
                                    <td>{{ $member->currentTeam?->team->name ?? 'No Team Assigned' }}</td>
                                    <td>
                                        @if($member->status == 1)
                                        <span class="badge bg-label-success">Active</span>
                                        @else
                                        <span class="badge bg-label-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="action-icons d-flex align-items-center">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" class="me-2"
                                                    data-bs-target="#assignShiftTeamModal"
                                                    data-url="{{ route('users.assignments', $member->id) }}">
                                                    <img width="30"
                                                        src="{{asset('assets/img/icons/img-icons/shift.png')}}"
                                                        alt="shift-change">
                                                </a>
                                                <a href="{{ route('members.edit', $member->hashid) }}" class="me-2">
                                                    <img width="20"
                                                        src="{{asset('assets/img/icons/img-icons/edit.png')}}"
                                                        alt="edit-change">
                                                </a>
                                                <form action="{{ route('members.destroy', $member) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="no-btn p-0"
                                                        onclick="return confirm('Are you sure you want to delete this call type?')">
                                                        <img width="25"
                                                            src="{{asset('assets/img/icons/img-icons/delete.png')}}"
                                                            alt="shift-change">
                                                    </button>
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
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-md-0 mt-5">
                    </div>
                </div>
            </div>



            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 h-100">


                    <form class="add-new-user pt-0" action="{{ route('members.store') }}" method="post">
                        @csrf

                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="name" aria-label="John Doe" required="">
                            <label for="add-user-fullname">Full Name</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="pseudo" aria-label="John Doe" required="">
                            <label for="add-user-fullname">Pseudo</label>
                        </div>


                        <!-- Email Field -->
                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="email" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email"
                                required="">
                            <label for="add-user-email">Email</label>
                        </div>

                        <!-- Contact Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="phone" required="">
                            <label for="add-user-contact">Contact</label>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="password" id="add-user-password" class="form-control" placeholder="Password"
                                aria-label="Password" name="password" required="">
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

                        <div class="form-floating form-floating-outline mb-5">
                            <select id="lob" name="lob" class="form-select" required="">
                                <option value="1">Jacob Bethell</option>
                                <option value="2">Joe Root</option>
                                <option value="3">Ollie Pope</option>
                                <option value="4">Ben Duckett</option>
                                <option value="5">Zak Crawley</option>
                                <option value="6">Harry Brook</option>
                            </select>
                            <label for="lob">LOB</label>
                        </div>



                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light" style="padding: 5px; font-size: 12px;">Submit</button>
                    </form>


                </div>
            </div>


        </div>


        <!-- ______________________________   Users List Table ______________________________  -->



        <!-- Shift & Team Assignment Modal -->
        <div class="modal fade" id="assignShiftTeamModal" tabindex="-1" aria-labelledby="assignModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignModalLabel">Assign Shift & Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="assignModalBody">
                        <div class="text-center text-muted">Loading...</div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="row g-6 mb-6 mt-1">
        <div class="container mt-4">
            <div class="row justify-content-start user_anyletics">
                <div class="col-2">
                    <div class="card text-white bg-primary mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">Admin Users</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$admin_count}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card text-white bg-primary mb-3"
                        style="font-size: 0.85rem; background-color: #5356d4 !important;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{$active_agent_count}}</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">14</p>
                        </div>
                    </div>
                </div>
                @foreach($team_counts as $team => $count)
                <div class="col-2">
                    <div class="card text-white bg-warning mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{ $team }} Team</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$count}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach($shift_counts as $shift => $count)
                <div class="col-2">
                    <div class="card text-white bg-info mb-3" style="font-size: 0.85rem;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-white mb-1">{{ $shift }} - Shift</h6>
                            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">{{$count}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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


<!--  ______________________________  Users List Table ______________________________  -->



<!--/ Content -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('assignShiftTeamModal');

    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const modalBody = modal.querySelector('#assignModalBody');

        // Load the content via AJAX
        fetch(url)
            .then(response => response.text())
            .then(html => {
                modalBody.innerHTML = html;
            })
            .catch(error => {
                modalBody.innerHTML =
                    '<div class="alert alert-danger">Failed to load form.</div>';
            });
    });
});
</script>
@endsection