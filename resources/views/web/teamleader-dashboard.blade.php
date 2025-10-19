@extends('web.layouts.main')

@section('content')


    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y p-70 mt-4">
        <!-- Dashboard Title Section -->
       
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
                                        <h5>Overall Score</h5>
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

            <!-- New Graph Section -->
            <div class="col-12 mt-4">
                <div class="row">
                    <!-- Top 10 Agents Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="premium-card chart-card">
                            <div class="card-header-premium">
                                <div class="header-content">
                                    <div class="icon-container primary">
                                        <span class="iconify" data-icon="mdi:account-star"></span>
                                    </div>
                                    <div class="title-section">
                                        <h5>Top 10 Agents</h5>
                                        <small>Team Performance Ranking</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="top10AgentsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Shift Wise Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="premium-card chart-card">
                            <div class="card-header-premium">
                                <div class="header-content">
                                    <div class="icon-container success">
                                        <span class="iconify" data-icon="mdi:clock-outline"></span>
                                    </div>
                                    <div class="title-section">
                                        <h5>Shift Wise Performance</h5>
                                        <small>Performance by Shifts</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="shiftWiseChart"></canvas>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Daily Score Chart -->
                    <div class="col-lg-12 mb-4">
                        <div class="premium-card chart-card">
                            <div class="card-header-premium">
                                <div class="header-content">
                                    <div class="icon-container info">
                                        <span class="iconify" data-icon="mdi:chart-line"></span>
                                    </div>
                                    <div class="title-section">
                                        <h5>Daily Performance (30 Days)</h5>
                                        <small>Daily Score Trend</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="dailyScoreChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Merchant Wise Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="premium-card chart-card">
                            <div class="card-header-premium">
                                <div class="header-content">
                                    <div class="icon-container warning">
                                        <span class="iconify" data-icon="mdi:domain"></span>
                                    </div>
                                    <div class="title-section">
                                        <h5>Merchant</h5>
                                        <small>Performance by Company</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="merchantWiseChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- MCO Comparison Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="premium-card chart-card">
                            <div class="card-header-premium">
                                <div class="header-content">
                                    <div class="icon-container danger">
                                        <span class="iconify" data-icon="mdi:cash-multiple"></span>
                                    </div>
                                    <div class="title-section">
                                        <h5>MCO Comparison</h5>
                                        <small>Gross MCO vs Net MCO</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="mcoComparisonChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flight Card  -->
            <div class="col-md-3">
                <div class="premium-card primary h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container primary">
                                <span class="iconify" data-icon="mdi:airplane-takeoff"></span>
                            </div>
                            <div class="title-section title-primary">
                                <h5>Flight</h5>
                                <small>Flight Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $flight_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $flight_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $flight_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $flight_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($flight_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($flight_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($flight_score, 2) }}
                            </div>
                            <div class="footer-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Hotel Cards -->
            <div class="col-md-3">
                <div class="premium-card success h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container success">
                                <span class="iconify" data-icon="mdi:hotel"></span>
                            </div>
                            <div class="title-section title-success">
                                <h5>Hotel</h5>
                                <small>Hotel Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $hotel_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $hotel_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $hotel_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $hotel_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($hotel_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($hotel_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($hotel_score, 2) }}
                            </div>
                            <div class="footer-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cruise Card -->
            <div class="col-md-3">
                <div class="premium-card warning h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container warning">
                                <span class="iconify" data-icon="mdi:ferry"></span>
                            </div>
                            <div class="title-section title-warning">
                                <h5>Cruise</h5>
                                <small>Cruise Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $cruise_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $cruise_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $cruise_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $cruise_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($cruise_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($cruise_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($cruise_score, 2) }}
                            </div>
                            <div class="stat-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Car Card -->
            <div class="col-md-3">
                <div class="premium-card info h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container info">
                                <span class="iconify" data-icon="mdi:car"></span>
                            </div>
                            <div class="title-section title-info">
                                <h5>Car</h5>
                                <small>Car Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $car_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $car_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $car_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $car_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($car_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($car_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($car_score, 2) }}
                            </div>
                            <div class="stat-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Train Card -->
            <div class="col-md-3">
                <div class="premium-card info h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container info">
                                <span class="iconify" data-icon="mdi:train"></span>
                            </div>
                            <div class="title-section title-info">
                                <h5>Train</h5>
                                <small>Train Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $train_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $train_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $train_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $train_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($train_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($train_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($train_score, 2) }}
                            </div>
                            <div class="stat-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Packages Card -->
            <div class="col-md-3">
                <div class="premium-card secondary h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container secondary">
                                <span class="iconify" data-icon="mdi:package-variant-closed"></span>
                            </div>
                            <div class="title-section title-secondary">
                                <h5>Package</h5>
                                <small>Package Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $package_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $package_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $package_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $package_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($package_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($package_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($package_score, 2) }}
                            </div>
                            <div class="footer-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today Score Card -->
            <div class="col-md-3">
                <div class="premium-card primary h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container primary">
                                <span class="iconify" data-icon="mdi:calendar-check-outline"></span>
                            </div>
                            <div class="title-section title-primary">
                                <h5>Today</h5>
                                <small>Today Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $today_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $today_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $today_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $today_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($today_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($today_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($today_score, 2) }}
                            </div>
                            <div class="footer-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Card -->
            <div class="col-md-3">
                <div class="premium-card success h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container success">
                                <span class="iconify" data-icon="mdi:calendar-week"></span>
                            </div>
                            <div class="title-section title-success">
                                <h5>Weekly</h5>
                                <small>Weekly Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $weekly_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $weekly_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $weekly_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $weekly_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($weekly_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($weekly_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($weekly_score, 2) }}
                            </div>
                            <div class="footer-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Card -->
            <div class="col-md-3">
                <div class="premium-card info h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container info">
                                <span class="iconify" data-icon="mdi:calendar-month"></span>
                            </div>
                            <div class="title-section title-info">
                                <h5>Monthly</h5>
                                <small>Monthly Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $monthly_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $monthly_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $monthly_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $monthly_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($monthly_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($monthly_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                ${{ number_format($monthly_score, 2) }}
                            </div>
                            <div class="stat-label-compact calls-label">Total Score</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Declined Card -->
            <div class="col-md-3">
                <div class="premium-card danger h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container danger">
                                <span class="iconify" data-icon="mdi:close-circle-outline"></span>
                            </div>
                            <div class="title-section title-danger">
                                <h5>Declined</h5>
                                <small>Declined Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $declined_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $declined_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $declined_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $declined_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($declined_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($declined_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $declined_count }}
                            </div>
                            <div class="footer-label-compact calls-label">Declined Count</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chargeback Card -->
            <div class="col-md-3">
                <div class="premium-card danger h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container danger">
                                <span class="iconify" data-icon="mdi:credit-card-off-outline"></span>
                            </div>
                            <div class="title-section title-danger">
                                <h5>Chargeback</h5>
                                <small>Chargeback Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $chargeback_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $chargeback_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $chargeback_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $chargeback_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($chargeback_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($chargeback_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $chargeback_count }}
                            </div>
                            <div class="footer-label-compact calls-label">Chargeback Count</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refund Card -->
            <div class="col-md-3">
                <div class="premium-card warning h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container warning">
                                <span class="iconify" data-icon="mdi:cash-refund"></span>
                            </div>
                            <div class="title-section title-warning">
                                <h5>Refund</h5>
                                <small>Refund Overview</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -  -->
                    <div class="stats-grid-compact">
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $refund_calls }}</div>
                            <div class="stat-label-compact">Total Calls</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ $refund_rpc }}</div>
                            <div class="stat-label-compact">RPC</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $refund_conversion }}%</div>
                            <div class="stat-label-compact">Conversion</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">{{ $refund_quality }}%</div>
                            <div class="stat-label-compact">Quality</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($refund_refund, 2) }}</div>
                            <div class="stat-label-compact">Refund</div>
                        </div>
                        <div class="stat-item-compact">
                            <div class="stat-value-compact">${{ number_format($refund_chargeback, 2) }}</div>
                            <div class="stat-label-compact">Chargeback</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $refund_count }}
                            </div>
                            <div class="footer-label-compact calls-label">Refund Count</div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Short Break Card -->
            <div class="col-md-9">
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


        </div>
    </div>


    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    labels: ['Total Amount', 'Refund', 'Chargeback', 'Declined'],
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

            // Top 10 Agents Chart
            const top10AgentsCtx = document.getElementById('top10AgentsChart').getContext('2d');
            const agentNames = {!! json_encode($top10Agents->pluck('name')) !!} || ['No Data'];
            const agentScores = {!! json_encode($top10Agents->pluck('total_score')) !!} || [0];
            new Chart(top10AgentsCtx, {
                type: 'bar',
                data: {
                    labels: agentNames,
                    datasets: [{
                        label: 'Total Score ($)',
                        data: agentScores,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Shift Wise Chart
            const shiftWiseCtx = document.getElementById('shiftWiseChart').getContext('2d');
            const shiftIds = {!! json_encode($shiftWiseData->pluck('shift_id')) !!} || ['No Shift'];
            const shiftScores = {!! json_encode($shiftWiseData->pluck('total_score')) !!} || [0];
            const shiftLabels = shiftIds.map(id => `Shift ${id}`);
            new Chart(shiftWiseCtx, {
                type: 'doughnut',
                data: {
                    labels: shiftLabels,
                    datasets: [{
                        data: shiftScores,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Merchant Wise Chart
            const merchantWiseCtx = document.getElementById('merchantWiseChart').getContext('2d');
            const merchantIds = {!! json_encode($merchantWiseData->pluck('selected_company')) !!} || [1];
            const merchantScores = {!! json_encode($merchantWiseData->pluck('total_score')) !!} || [0];
            const merchantNames = merchantIds.map(id => {
                const names = {1: 'Flydreamz', 2: 'Fareticketsus', 3: 'Fareticketsllc', 4: 'Cruiselineservice'};
                return names[id] || 'Unknown';
            });
            new Chart(merchantWiseCtx, {
                type: 'pie',
                data: {
                    labels: merchantNames,
                    datasets: [{
                        data: merchantScores,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Daily Score Chart
            const dailyScoreCtx = document.getElementById('dailyScoreChart').getContext('2d');
            const dailyDates = {!! json_encode($dailyScoreData->pluck('date')) !!} || ['No Data'];
            const dailyScores = {!! json_encode($dailyScoreData->pluck('daily_score')) !!} || [0];
            new Chart(dailyScoreCtx, {
                type: 'line',
                data: {
                    labels: dailyDates,
                    datasets: [{
                        label: 'Daily Score ($)',
                        data: dailyScores,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // MCO Comparison Chart
            const mcoComparisonCtx = document.getElementById('mcoComparisonChart').getContext('2d');
            const grossMco = {{ $mcoComparison['gross_mco'] ?? 0 }};
            const netMco = {{ $mcoComparison['net_mco'] ?? 0 }};
            new Chart(mcoComparisonCtx, {
                type: 'bar',
                data: {
                    labels: ['Gross MCO', 'Net MCO'],
                    datasets: [{
                        label: 'Amount ($)',
                        data: [grossMco, netMco],
                        backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)'],
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

@endsection