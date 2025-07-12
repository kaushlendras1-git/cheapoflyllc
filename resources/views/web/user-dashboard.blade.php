@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y p-70">
    <div class="row gy-6">
        <!-- Congratulations card -->
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body text-nowrap">
                    <h5 class="card-title mb-0 flex-wrap text-nowrap">Today Score! 🎉</h5>
                    <p class="mb-2">Best seller of the month</p>
                    <h4 class="text-primary mb-0">${{$today_score}}</h4>
                    <p class="mb-2">78% of target 🚀</p>
                    <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
                </div>
                <img src="./assets/img/illustrations/trophy.png" class="position-absolute bottom-0 end-0 me-5 mb-5"
                    width="83" alt="view sales" />
            </div>
        </div>
        <!--/ Congratulations card -->

        <!-- Transactions -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Customer Touchpoints: Calls Logs / <span class="fs-3 text-primary">Bookings</span></h5>
                        <div class="dropdown">
                            <button class="btn text-body-secondary p-0" type="button" id="transactionID"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-base ri ri-more-2-line icon-24px"></i>
                            </button>
                        </div>
                    </div>
                    <p class="small mb-0"><span class="h6 mb-0">Total 48.5% Growth</span> 😎 this month</p>
                </div>
                <div class="card-body pt-lg-10">
                    <div class="row g-6">
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-primary rounded shadow-xs">
                                        <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Flight</p>
                                    <h5 class="mb-0">{{$flight}} /  <span class="fs-3 text-primary">{{ $flight_booking }}</span> </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-success rounded shadow-xs">
                                        <i class="icon-base ri ri-group-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Hotel</p>
                                    <h5 class="mb-0"><a href="{{route('call-logs.index')}}">{{$hotel}}</a> /  <span class="fs-3 text-primary"> <a href="{{route('booking.index')}}">{{ $hotel_booking }}</a> </span> </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-warning rounded shadow-xs">
                                        <i class="icon-base ri ri-macbook-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Cruise</p>
                                    <h5 class="mb-0">{{$cruise}} /  <span class="fs-3 text-primary">{{ $cruise_booking }}</span> </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-info rounded shadow-xs">
                                        <i class="icon-base ri ri-money-dollar-circle-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Car</p>
                                    <h5 class="mb-0">{{$car}} /  <span class="fs-3 text-primary">{{ $car_booking }}</span> </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-info rounded shadow-xs">
                                        <i class="icon-base ri ri-money-dollar-circle-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Train</p>
                                    <h5 class="mb-0">{{$train}} /  <span class="fs-3 text-primary">{{ $train_booking }}</span> </h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center blinker">
                                <div class="avatar">
                                    <div class="avatar-initial bg-danger rounded shadow-xs">
                                        <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Pending</p>
                                    <h5 class="mb-0">{{$pending}} / <span class="fs-3 text-danger">{{ $pending_booking }}</span> </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--/ Transactions -->

        <!-- Weekly Overview Chart -->
        <div class="col-xl-4 col-md-6">
            <div class="card card-space">
                <div class="card-header p-0">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Weekly Score</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="weeklyOverviewChart"></div>
                    <div class="mt-1">
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="mb-0">${{$weekly_score}}</h4>
                            <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="card card-space">
                <div class="card-header p-0">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Monthly Score</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="weeklyOverviewChart"></div>
                    <div class="mt-1">
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="mb-0">${{$monthly_score}}</h4>
                            <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
                        </div>
                        <div class="d-grid mt-3 mt-md-4">
                            <button class="btn btn-primary" type="button">Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Weekly Overview Chart -->

        <!-- Total Earnings -->
        <div class="col-xl-4 col-md-6">
            <div class="card card-space">
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
            <div class="card-group mt-4">
                <div class="card mb-0 card-space">
                    <div class="card-body card-separator p-0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-0">
                            <h5 class="m-0 me-2">Quality Report</h5>
                            <!-- <a class="fw-medium" href="javascript:void(0);">View all</a> -->
                        </div>
                        <div class="deposit-content pt-2"> booking approved 100/ decline Qc pendind
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Earnings -->

        <!-- Four Cards -->
        <div class="col-xl-4 col-md-6">
            <div class="row gy-6">
                <!-- Total Profit line chart -->
                <div class="col-sm-6 text-white">
                    <div class="card h-100 text-white">
                        <div class="card-header pb-0">
                            <h4 class="mb-0">$258900/<span class="text-primary mb-0">12</span></h4>
                        </div>
                        <div class="card-body">
                            <div id="totalProfitLineChart" class="mb-3"></div>
                            <h6 class="text-center mb-0">ChargeBack</h6>
                        </div>
                    </div>
                </div>
                <!--/ Total Profit line chart -->

                <!-- Total Profit Weekly Project -->
                <div class="col-sm-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="avatar">
                                <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                                    <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                                </div>
                            </div>

                        </div>
                        <div class="card-body ">
                            <h6 class="mb-1">Total Booking</h6>
                            <div class="d-flex flex-wrap mb-1 align-items-center ">
                                <h4 class="mb-0 me-2">$25.6k / 1589</h4>
                            </div>
                            <small>Weekly Project</small>
                        </div>
                    </div>
                </div>
                <!--/ Total Profit Weekly Project -->
                <!-- New Yearly Project -->
                <div class="col-sm-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="avatar">
                                <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                                    <i class="icon-base ri ri-file-word-2-line icon-24px"></i>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <h6 class="mb-1">Refund</h6>
                            <div class="d-flex flex-wrap mb-1 align-items-center">
                                <h4 class="mb-0 me-2">$862 / 7</h4>
                            </div>
                            <small>Yearly Project</small>
                        </div>
                    </div>
                </div>
                <!--/ New Yearly Project -->
                <!-- Sessions chart -->
                <div class="col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <button type="button" class="break-btn" data-bs-toggle="modal"
                                data-bs-target="#breakRequestModal">
                                <img width="15" src="./assets/img/icons/img-icons/request-break.png" alt="">
                            </button>
                            <!-- Break Request Modal -->
                            <div class="modal fade" id="breakRequestModal" tabindex="-1"
                                aria-labelledby="breakRequestModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="breakRequestModalLabel">Request for Break</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="#">
                                                @csrf
                                                <!-- Hidden user ID or other info -->
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <button type="submit" name="break_type" value="short"
                                                    class="btn btn-warning">
                                                    Short Break
                                                </button>
                                                <button type="submit" name="break_type" value="dinner"
                                                    class="btn btn-info">
                                                    Dinner Break
                                                </button>
                                                <button type="submit" name="break_type" value="end"
                                                    class="btn btn-success">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sessionsColumnChart" class="mb-3"></div>
                            <h6 class="mb-1 modal-title" id="breakRequestModalLabel">Pending</h6>
                            <h4 class="mb-0 me-2">2</h4>
                            <small>Break</small>
                        </div>
                    </div>
                </div>
                <!--/ Sessions chart -->
            </div>
        </div>
        <!--/ four cards -->


        <div class="col-xl-12">
            <div class="card-group">
                <div class="card mb-0">
                    <div class="card-body card-separator">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                            <h5 class="m-0 me-2">Quality Report</h5>
                            <!-- <a class="fw-medium" href="javascript:void(0);">View all</a> -->
                        </div>
                        <div class="deposit-content pt-2"> booking approved 100/ decline Qc pendind
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Deposit / Withdraw -->
        <div class="col-xl-12">
            <div class="card-group">
                <div class="card mb-0">
                    <div class="card-body card-separator attendance-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-0">
                            <h5 class="m-0 me-2">Attendance</h5>
                            <!-- <a class="fw-medium" href="javascript:void(0);">View all</a> -->
                        </div>
                        <div class="deposit-content pt-2 attendance-table crm-table">
                            @if (!empty($calendar))
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        @for ($day = 1; $day <= 30; $day++) <th>{{ $day }}</th>
                                            @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>July</th>
                                        @for ($day = 1; $day <= 30; $day++) @php $status=$calendar[$day] ?? '' ;
                                            $bg=match($status) { 'Y'=> '#90EE90', // Green
                                            'N' => '#FF6347', // Red
                                            'P' => '#87CEEB', // Blue
                                            'H' => '#FFFF99', // Yellow
                                            default => '#ffffff'
                                            };
                                            @endphp
                                            <td style="background-color: {{ $bg }}">{{ $status }}</td>
                                            @endfor
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <p>No attendance records found for June 2025.</p>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Deposit / Withdraw -->



    </div>
</div>
<!--/ Content -->

@endsection