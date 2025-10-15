@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y p-70 mt-4">
    <div class="row gy-6 mt-0">
        <!-- Upper Card  -->
        
         <!-- Congratulations card -->
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Today</h4>

                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($today_score, 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $today_bookings }}</p>
                    <p class="mb-0">Total Calls: {{ $today_calls }}</p>
                    <p class="mb-0">RPC: ${{ number_format($today_rpc, 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($today_conversion, 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($today_quality, 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($today_refund, 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($today_chargeback, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">This Week</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($week_score, 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $week_bookings }}</p>
                    <p class="mb-0">Total Calls: {{ $week_calls }}</p>
                    <p class="mb-0">RPC: ${{ number_format($week_rpc, 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($week_conversion, 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($week_quality, 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($week_refund, 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($week_chargeback, 2) }}</p>
                </div>
            </div>
        </div>
      
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Fortnight</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($fortnight_score, 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $fortnight_bookings }}</p>
                    <p class="mb-0">Total Calls: {{ $fortnight_calls }}</p>
                    <p class="mb-0">RPC: ${{ number_format($fortnight_rpc, 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($fortnight_conversion, 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($fortnight_quality, 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($fortnight_refund, 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($fortnight_chargeback, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">This Month</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($total_score, 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $total_bookings }}</p>
                    <p class="mb-0">Total Calls: {{ $total_calls }}</p>
                    <p class="mb-0">RPC: ${{ number_format($rpc, 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($conversion, 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($quality, 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($refund_total, 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($charge_back_total, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Transactions -->

        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-primary rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-flight-takeoff-line icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 class="mb-0">Flight</h4>
                 
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($flight_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $flight_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $flight_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($flight_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($flight_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($flight_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($flight_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($flight_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-success rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-hotel-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #56ca00;" class="mb-0">Hotel</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($hotel_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $hotel_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $hotel_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($hotel_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($hotel_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($hotel_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($hotel_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($hotel_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-warning rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-ship-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ffb400;" class="mb-0">Cruise</h4>
                    
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($cruise_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $cruise_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $cruise_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($cruise_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($cruise_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($cruise_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($cruise_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($cruise_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div class="avatar-initial bg-info rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-car-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #16b1ff;" class="mb-0">Car</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($car_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $car_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $car_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($car_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($car_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($car_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($car_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($car_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div class="avatar-initial bg-info rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-train-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #16b1ff;" class="mb-0">Train</h4>
                    
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($train_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $train_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $train_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($train_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($train_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($train_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($train_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($train_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Package</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($package_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $package_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $package_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($package_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($package_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($package_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($package_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($package_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">ChargeBack</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($chargeback_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $chargeback_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $chargeback_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($chargeback_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($chargeback_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($chargeback_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: $0.00</p>
                    <p class="mb-0">Chargeback: ${{ number_format($chargeback_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Refund</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($refund_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $refund_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $refund_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($refund_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($refund_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($refund_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($refund_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: $0.00</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial bg-danger rounded shadow-xs d-flex align-items-center justify-content-center">
                    <i class="icon-base ri ri-pass-pending-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #ff4c51;" class="mb-0">Declined</h4>
                   
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($declined_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $declined_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $declined_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($declined_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($declined_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($declined_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: $0.00</p>
                    <p class="mb-0">Chargeback: $0.00</p>
                </div>
            </div>
        </div>
        
    
        <div class="col-md-3">
            <div class="card insights-upper position-relative">
                <div
                    class="avatar-initial rounded shadow-xs d-flex align-items-center justify-content-center"
                    style="background-color: #9dac18ff; color: #fff;" >
                    <i class="icon-base ri ri-star-fill icon-24px"></i>
                </div>
                <div class="booking text-end">
                    <h4 style="color: #9dac18ff;" class="mb-0">Quality Score</h4>
                </div>
                <div class="call-log text-start">
                    <p class="mb-0">Total score: ${{ number_format($quality_metrics['score'], 2) }}</p>
                    <p class="mb-0">Total Bookings: {{ $quality_metrics['bookings'] }}</p>
                    <p class="mb-0">Total Calls: {{ $quality_metrics['calls'] }}</p>
                    <p class="mb-0">RPC: ${{ number_format($quality_metrics['rpc'], 2) }}</p>
                    <p class="mb-0">Conversion: {{ number_format($quality_metrics['conversion'], 2) }}%</p>
                    <p class="mb-0">Quality: {{ number_format($quality_metrics['quality'], 2) }}%</p>
                    <p class="mb-0">Refund: ${{ number_format($quality_metrics['refund'], 2) }}</p>
                    <p class="mb-0">Chargeback: ${{ number_format($quality_metrics['chargeback'], 2) }}</p>
                </div>
            </div>
        </div>


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