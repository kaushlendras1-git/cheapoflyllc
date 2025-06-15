@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        
        <div class="col-md-8 p-0 h-100">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h5 class="card-action-title mb-0 d-flex align-items-center">
                                <i class="icon-base ri ri-bar-chart-2-line icon-24px text-body me-3"></i>User History
                            </h5>
                            <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                                <span class="icon-base ri ri-information-2-fill icon-22px"></span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <ul class="timeline card-timeline mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">12 Invoices have been paid</h6>
                                <small class="text-body-secondary">12 min ago</small>
                            </div>
                            <p class="mb-2">Invoices have been paid to the company</p>
                            <div class="d-flex align-items-center mb-1">
                                <div class="badge bg-lightest">
                                <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="15" class="me-2">
                                <span class="h6 mb-0">invoices.pdf</span>
                                </div>
                            </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">Client Meeting</h6>
                                <small class="text-body-secondary">45 min ago</small>
                            </div>
                            <p class="mb-2">Project meeting with john @10:15am</p>
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div class="d-flex flex-wrap align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                    <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                    <small>CEO of ThemeSelection</small>
                                </div>
                                </div>
                            </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">Create a new project for client</h6>
                                <small class="text-body-secondary">2 Day Ago</small>
                            </div>
                            <p class="mb-2">6 team members in a project</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                <div class="d-flex flex-wrap align-items-center">
                                    <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                        <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                                        <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                                        <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                                    </li>
                                    <li class="avatar">
                                        <span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                                    </li>
                                    </ul>
                                </div>
                                </li>
                            </ul>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
                <!-- PNR Details Section -->
                <div class="card card-action mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-action-title mb-0 d-flex align-items-center">
                        <i class="icon-base ri ri-flight-takeoff-line icon-24px text-body me-3"></i>PNR Details
                        </h5>
                        <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                        <i class="ri ri-edit-2-fill"></i>
                        </button>
                    </div>
                    <div class="card-body py-3 px-4">
                        <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>GK Pnr</th>
                                <th>HK PNR</th>
                                <th>Supplier</th>
                                <th>Call Que</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>GGF4M2</td>
                                <td>GGF4M2</td>
                                <td>DL</td>
                                <td>NCC</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- Users Detail Section -->
                <div class="card card-action mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-action-title mb-0 d-flex align-items-center">
                        <i class="icon-base ri ri-user-3-line icon-24px text-body me-3"></i>Users Detail
                        </h5>
                        <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                        <i class="ri ri-information-2-fill"></i>
                        </button>
                    </div>
                    <div class="card-body py-3 px-4">
                        <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Traveler Type</th>
                                <th>Booking Type</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>ADT</td>
                                <td>New Booking</td>
                                <td>Joseph</td>
                                <td>Lincoln Halladay</td>
                                <td></td>
                                <td>Male</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pe-0">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Popular Instructors</h5>
                        </div>
                        <div class="dropdown">
                        <button class="btn text-body-secondary p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base ri ri-more-2-line icon-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Share</a>
                        </div>
                        </div>
                    </div>
                    <div class="px-5 py-4 border border-start-0 border-end-0">
                        <div class="d-flex justify-content-between align-items-center">
                        <small class="text-heading text-uppercase">Instructors</small>
                        <small class="text-heading text-uppercase">courses</small>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-4">
                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div>
                            <div>
                                <h6 class="mb-1 text-truncate">Maven Analytics</h6>
                                <p class="mb-0 text-truncate">Business Intelligence</p>
                            </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">33</h6>
                        </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-4">
                            <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div>
                            <div>
                                <h6 class="mb-1 text-truncate">Bentlee Emblin</h6>
                                <p class="mb-0 text-truncate">Digital Marketing</p>
                            </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">52</h6>
                        </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-4">
                            <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div>
                            <div>
                                <h6 class="mb-1 text-truncate">Benedetto Rossiter</h6>
                                <p class="mb-0 text-truncate">UI/UX Design</p>
                            </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">12</h6>
                        </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-4">
                            <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div>
                            <div>
                                <h6 class="mb-1 text-truncate">Beverlie Krabbe</h6>
                                <p class="mb-0 text-truncate">React Native</p>
                            </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">8</h6>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Address Box -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Billing Info</h5>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-secondary">
                            <i class="ri ri-information-line"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                        1259 Merribrook Ln<br />
                        SC , Lancaster<br />
                        29720 , United States
                        </p>

                    </div>
                </div>

                <!-- Auth Section -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Auth</h5>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-secondary">
                        <i class="ri ri-information-line"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="authOption" id="authYes" value="yes">
                        <label class="form-check-label" for="authYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="authOption" id="authNo" value="no">
                        <label class="form-check-label" for="authNo">No</label>
                        </div>
                        <br />
                        <button class="btn btn-primary mt-2">Submit</button>
                    </div>
                </div>

                <!-- Customer Info Section -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customer Info</h5>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-secondary">
                        <i class="ri ri-information-line"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">JOE*****DAYUSW@GMAIL.COM</p>
                        <p class="mb-0">406*****41</p>
                    </div>
                </div>
            </div>

    </div>              
</div>
<!--/ Content -->
@endsection          