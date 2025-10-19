@extends('web.layouts.main')
@section('content')




<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y p-70 mt-4">
    <!-- Dashboard Title Section -->
    <div class="dashboard-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12 mb-3 mb-md-0">
                    <h1 class="dashboard-title">Performance Dashboard</h1>
                    <p class="dashboard-subtitle">Track your travel booking metrics and performance analytics</p>
                </div>
                <div class="col-md-4 col-12 text-md-end text-center">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
                        <span class="user-role">{{ Auth::user()->role_name ?? 'Travel Agent' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4 gx-4">



        <!-- Charts Section -->
        <div class="col-12 mt-4">
            <div class="row">
                <!-- Performance Trend Chart -->
                <div class="col-lg-8 ">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container primary">
                                    <span class="iconify" data-icon="mdi:trending-up"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Performance Trend</h5>
                                    <small>Last 7 Days Performance</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="performanceTrendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Service Distribution Chart -->
                <div class="col-lg-4 ">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container secondary">
                                    <span class="iconify" data-icon="mdi:chart-pie"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Service Distribution</h5>
                                    <small>Booking Categories</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="serviceDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Today Card -->
        <div class="col-md-6 col-lg-3 ">
            <div class="premium-card primary time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container primary">
                            <span class="iconify" data-icon="mdi:calendar-today"></span>
                        </div>
                        <div class="title-section title-primary">
                            <h5>Today</h5>
                            <small>Daily Performance</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($today_score, 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $today_bookings }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $today_calls }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($today_rpc, 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">80.0%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 80%;">
                            </div>

                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">70.0%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 60%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($today_refund, 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($today_chargeback, 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Today Card Ends -->

        <!-- This Week Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card primary time-period-card">

                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container success">

                            <span class="iconify" data-icon="mdi:chart-bar" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section title-primary-light">
                            <h5>This Week</h5>
                            <small>Weekly Analytics</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($week_score, 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $week_bookings }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $week_calls }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($week_rpc, 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">{{ number_format($week_conversion, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $week_conversion }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">{{ number_format($week_quality, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $week_quality }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($week_refund, 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($week_chargeback, 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- This Week Card Ends -->

        <!-- Fornight Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card primary time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container warning">
                            <span class="iconify" data-icon="mdi:calendar-range" data-width="30"
                                data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>Fortnight</h5>
                            <small>Bi-weekly Stats</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($fortnight_score, 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $fortnight_bookings }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $fortnight_calls }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($fortnight_rpc, 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">{{ number_format($fortnight_conversion, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $fortnight_conversion }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">{{ number_format($fortnight_quality, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $fortnight_quality }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($fortnight_refund, 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($fortnight_chargeback, 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fornight Card Ends -->


        <!-- This Month Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card primary time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container danger">
                            <span class="iconify" data-icon="mdi:calendar-month-outline" data-width="30"
                                data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>This Month</h5>
                            <small>Monthly Overview</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($total_score, 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $total_bookings }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $total_calls }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($rpc, 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">{{ number_format($conversion, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $conversion }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">{{ number_format($quality, 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $quality }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($refund_total, 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($charge_back_total, 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Month Card Ends -->

        <!-- Flight Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card primary">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container info">

                            <span class="iconify" data-icon="mdi:airplane-takeoff" data-width="30"
                                data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>Flight</h5>
                            <small>Flight Metrics</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($flight_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $flight_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $flight_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($flight_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($flight_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $flight_metrics['conversion'] }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($flight_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $flight_metrics['quality'] }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($flight_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($flight_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Flight Card Ends -->


        <!-- Hotel Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card secondary">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container secondary">
                            <span class="iconify" data-icon="mdi:hotel" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>Hotel</h5>
                            <small>Hotel Metrics</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($hotel_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $hotel_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $hotel_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($hotel_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($hotel_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $hotel_metrics['conversion'] }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($hotel_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $hotel_metrics['quality'] }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($hotel_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($hotel_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel Card Ends -->

        <!-- Cruise Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card warning">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container mint">
                            <span class="iconify" data-icon="mdi:ferry" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>Cruise</h5>
                            <small>Cruise Metrics</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($cruise_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $cruise_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $cruise_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($cruise_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($cruise_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $cruise_metrics['conversion'] }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($cruise_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $cruise_metrics['quality'] }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($cruise_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($cruise_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cruise Card Ends -->

        <!-- Car Card Starts -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card info time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container info">
                            <span class="iconify" data-icon="mdi:car" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section title-info">
                            <h5>Car</h5>
                            <small>Car Metrics Overview</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($car_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $car_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $car_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($car_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($car_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $car_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">{{ number_format($car_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $car_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($car_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($car_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Car Card Ends -->

        <!-- Train Card Start -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card info time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container info">
                            <span class="iconify" data-icon="mdi:train" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section title-info">
                            <h5>Train</h5>
                            <small>Train Metrics Overview</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($train_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $train_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $train_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($train_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($train_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $train_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($train_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $train_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($train_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($train_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Train Card Ends -->

        <!-- Package Card Starts -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card danger time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container danger">
                            <span class="iconify" data-icon="mdi:package-variant-closed" data-width="30"
                                data-height="30"></span>
                        </div>
                        <div class="title-section title-danger">
                            <h5>Package</h5>
                            <small>Package Metrics Overview</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($package_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $package_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $package_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($package_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($package_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $package_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($package_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $package_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($package_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($package_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Package Card Ends -->

        <!-- Refund Card Starts -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card accent time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container success">
                            <span class="iconify" data-icon="mdi:cash-refund" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section title-accent">
                            <h5>Refund</h5>
                            <small>Refund Metrics Overview</small>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($refund_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $refund_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $refund_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($refund_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <!-- Progress Bars -->
                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($refund_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $refund_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($refund_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $refund_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($refund_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$0.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refund Card Ends -->

        <!-- Declained Card Starts -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card danger time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container danger">
                            <span class="iconify" data-icon="mdi:close-octagon-outline" data-width="30"
                                data-height="30"></span>
                        </div>
                        <div class="title-section title-danger">
                            <h5>Declined</h5>
                            <small>Declined Metrics Overview</small>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($declined_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $declined_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $declined_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($declined_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <!-- Progress Bars -->
                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($declined_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $declined_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($declined_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $declined_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$0.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$0.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Declained Card Ends -->

        <!-- Quality Score Cards Start -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card mint time-period-card">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container" style="background: linear-gradient(135deg, #9DAC18, #A7B91F);">
                            <span class="iconify" data-icon="mdi:star-circle" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5 style="color: #9DAC18;">Quality Score</h5>
                            <small>Performance & Excellence</small>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($quality_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $quality_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $quality_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Total Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($quality_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <!-- Progress Bars -->
                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($quality_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $quality_metrics['conversion'] }}%;">
                            </div>
                        </div>
                    </div>

                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($quality_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $quality_metrics['quality'] }}%;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($quality_metrics['refund'], 2) }}</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($quality_metrics['chargeback'], 2) }}</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quality Score Cards Ends -->

        <!-- ChargeBack Card -->
        <div class="col-md-6 col-lg-3">
            <div class="premium-card danger">
                <div class="card-header-premium">
                    <div class="header-content">
                        <div class="icon-container rose">
                            <span class="iconify" data-icon="mdi:alert-circle" data-width="30" data-height="30"></span>
                        </div>
                        <div class="title-section">
                            <h5>ChargeBack</h5>
                            <small>Chargeback Metrics</small>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($chargeback_metrics['score'], 2) }}</div>
                        <div class="stat-label-compact">Total Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $chargeback_metrics['bookings'] }}</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">{{ $chargeback_metrics['calls'] }}</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">${{ number_format($chargeback_metrics['rpc'], 2) }}</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span
                                class="progress-value-compact">{{ number_format($chargeback_metrics['conversion'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: {{ $chargeback_metrics['conversion'] }}%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span
                                class="progress-value-compact">{{ number_format($chargeback_metrics['quality'], 2) }}%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: {{ $chargeback_metrics['quality'] }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$0.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">${{ number_format($chargeback_metrics['chargeback'], 2) }}
                        </div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ChargeBack Card Ends-->

        <!-- Incentives Card Start -->


        <!-- Short Break Card -->
        <div class="col-md-6">
            <div
                class="premium-card warning break-button-premium h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="icon-container warning mb-3">
                    <span class="iconify" data-icon="mdi:coffee-outline" data-width="32" data-height="32"></span>
                </div>
                <h5 class="mb-3" style="color: var(--warning); font-weight: 700;">Need a Short Break?</h5>
                <p class="text-muted mb-4" style="font-size: 0.95rem; text-align: center;">
                    Step away for a quick refresh — come back stronger and more productive!
                </p>
                <form action="" method="POST">
                    @csrf
                    <button type="submit" name="break_type" value="short"
                        class="btn btn-warning px-4 py-2 rounded-pill fw-bold shadow-sm">
                        <span class="iconify me-2" data-icon="mdi:clock-outline"></span> Start Short Break
                    </button>
                </form>
            </div>
        </div>


        <!-- Incentives Card Ends -->

    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress bar animations
    const progressBars = document.querySelectorAll('.progress-bar-fill-compact');
    progressBars.forEach((bar, index) => {
        setTimeout(() => {
            bar.classList.add('animate-progress');
        }, 300 + (index * 200));
    });

    // Performance Trend Chart
    const trendCtx = document.getElementById('performanceTrendChart').getContext('2d');
    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                    label: 'Revenue ($)',
                    data: [1250, 1900, 1500, 2100, 1800, 2400, 2200],
                    borderColor: '#1C316D',
                    backgroundColor: 'rgba(28, 49, 109, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Bookings',
                    data: [8, 12, 10, 14, 11, 16, 15],
                    borderColor: '#6C63FF',
                    backgroundColor: 'rgba(108, 99, 255, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });

    // Service Distribution Chart
    const distributionCtx = document.getElementById('serviceDistributionChart').getContext('2d');
    const distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Flights', 'Hotels', 'Cruises', 'Packages'],
            datasets: [{
                data: [45, 30, 15, 10],
                backgroundColor: [
                    '#1C316D',
                    '#6C63FF',
                    '#FFD166',
                    '#4ECDC4'
                ],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
});
</script>

@endsection