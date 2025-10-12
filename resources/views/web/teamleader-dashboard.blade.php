@extends('web.layouts.main')

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y p-70 mt-4">
    <div class="row gy-6 mt-0">
        <!-- Upper Card  -->
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-primary rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-flight-takeoff-line icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 class="mb-0">Flight</h4>
                    <p class="mb-0">{{ $flight_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$flight}}: Calls Logs</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-success rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-hotel-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #56ca00;" class="mb-0">Hotel</h4>
                    <p class="mb-0">{{ $hotel_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$hotel}}: Calls Logs</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-warning rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-ship-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ffb400;" class="mb-0">Cruise</h4>
                    <p class="mb-0">{{ $cruise_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$cruise}}: Calls Logs</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div class="avatar-initial bg-info rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-car-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #16b1ff;" class="mb-0">Car</h4>
                    <p class="mb-0">{{ $car_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$car}}: Calls Logs</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div class="avatar-initial bg-info rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-train-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #16b1ff;" class="mb-0">Train</h4>
                    <p class="mb-0">{{ $train_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$train}}: Calls Logs</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Declined</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Chargeback</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Quality</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Today Score</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Weekly Score</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Monthly Score</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Refund</h4>
                    <p class="mb-0">{{ $pending_booking }}</p>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">{{$pending}}: Calls Logs</p>
                </div>
            </div>
        </div>


        <!--/ Total Earnings -->

        <div class="col-xl-4 col-md-6">
            <div class="card card-space h-100">
                <div class="card-header d-flex align-items-center justify-content-between p-0">
                    <h5 class="card-title m-0 me-2">Incentives</h5>
                </div>
                <div class="card-body p-0">
                    <div class="mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0">$24,895</h3>
                            <span class="text-success ms-2">
                                <i class="icon-base ri ri-arrow-up-s-line icon-sm"></i>
                                <span>10%</span>
                            </span>
                        </div>
                        <p class="mb-0">Compared to $84,325 last year</p>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                <img src="./assets/img/icons/misc/zipcar.png" alt="zipcar" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Zipcar</h6>
                                    <p class="mb-0">Vuejs, React & HTML</p>
                                </div>
                                <div>
                                    <h6 class="mb-2">$24,895.65</h6>
                                    <div class="progress bg-label-primary" style="height: 4px">
                                        <div class="progress-bar bg-primary" style="width: 75%" role="progressbar"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                <img src="./assets/img/icons/misc/bitbank.png" alt="bitbank" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Bitbank</h6>
                                    <p class="mb-0">Sketch, Figma & XD</p>
                                </div>
                                <div>
                                    <h6 class="mb-2">$8,6500.20</h6>
                                    <div class="progress bg-label-info" style="height: 4px">
                                        <div class="progress-bar bg-info" style="width: 75%" role="progressbar"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                <img src="./assets/img/icons/misc/aviato.png" alt="aviato" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Aviato</h6>
                                    <p class="mb-0">HTML & Angular</p>
                                </div>
                                <div>
                                    <h6 class="mb-2">$1,2450.80</h6>
                                    <div class="progress bg-label-secondary" style="height: 4px">
                                        <div class="progress-bar bg-secondary" style="width: 75%" role="progressbar"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

 
        <div class="col-xl-4 col-md-6">
            <div class="card-group h-100">
                <div class="card mb-0 card-space">
                    <div class="card-body p-0">
               
                                            <button type="submit" name="break_type" value="short"
                                                    class="btn btn-warning">
                                                    Short Break
                                                </button>

                                                
                         </div>
                      </div>
                    </div>
        </div>
        <!--/ four cards -->

    </div>
</div>
<!--/ Content -->



@endsection