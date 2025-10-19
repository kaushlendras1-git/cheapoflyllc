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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($flight_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $flight_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $flight }}
                            </div>
                            <div class="footer-label-compact calls-label">Calls Logs</div>
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($hotel_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $hotel_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $hotel }}
                            </div>
                            <div class="footer-label-compact calls-label">Calls Logs</div>
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($cruise_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $cruise_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $cruise }}
                            </div>
                            <div class="footer-label-compact calls-label">Calls Logs</div>
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($car_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $car_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $car }}
                            </div>
                            <div class="footer-label-compact calls-label">Calls Logs</div>
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($train_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $train_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                {{ $train }}
                            </div>
                            <div class="footer-label-compact calls-label">Calls Logs</div>
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($package_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $package_booking }}
                            </div>
                            <div class="stat-label-compact">Bookings</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Total
                            </div>
                            <div class="footer-label-compact calls-label">Overview</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Declained Card -->
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
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($declined_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $declined_count }}
                            </div>
                            <div class="stat-label-compact">Declined</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Total
                            </div>
                            <div class="footer-label-compact calls-label">Overview</div>
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

                    <!-- Stats Section - SAME ROW -->
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($chargeback_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $chargeback_count }}
                            </div>
                            <div class="stat-label-compact">Chargebacks</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Total
                            </div>
                            <div class="footer-label-compact calls-label">Overview</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Quality Card -->
            <div class="col-md-3">
                <div class="premium-card mint h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container mint">
                                <span class="iconify" data-icon="mdi:star-circle-outline"></span>
                            </div>
                            <div class="title-section" style="color: var(--mint);">
                                <h5>Quality</h5>
                                <small>Performance Quality</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $quality_avg }}%
                            </div>
                            <div class="stat-label-compact">Team Average</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ⭐
                            </div>
                            <div class="stat-label-compact">Overall Rating</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Avg
                            </div>
                            <div class="footer-label-compact calls-label">Quality Score</div>
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
                                <h5>Today Score</h5>
                                <small>Daily Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($today_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                📊
                            </div>
                            <div class="stat-label-compact">Today Overview</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Total
                            </div>
                            <div class="footer-label-compact calls-label">Performance Summary</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Weekly Card  -->
            <div class="col-md-3">
                <div class="premium-card success h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container success">
                                <span class="iconify" data-icon="mdi:calendar-week"></span>
                            </div>
                            <div class="title-section title-success">
                                <h5>Weekly Score</h5>
                                <small>Weekly Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="stats-grid-compact dual-stat">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($weekly_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Score</div>
                        </div>
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                📆
                            </div>
                            <div class="stat-label-compact">Weekly Insights</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">
                                Team Total
                            </div>
                            <div class="footer-label-compact calls-label">Performance Summary</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Monthly Score Card -->
            <div class="col-md-3">
                <div class="premium-card info h-100">
                    <!-- Header -->
                    <div class="card-header-premium">
                        <div class="header-content">
                            <div class="icon-container info">
                                <span class="iconify" data-icon="mdi:calendar-month"></span>
                            </div>
                            <div class="title-section title-info">
                                <h5>Monthly Score</h5>
                                <small>Team Performance</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="" style="margin-bottom: 16px;">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                ${{ number_format($monthly_score, 2) }}
                            </div>
                            <div class="stat-label-compact">Total Monthly Score</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">Team Total</div>
                            <div class="footer-label-compact calls-label">Overall Monthly Performance</div>
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

                    <!-- Stats Section -->
                    <div class="" style="margin-bottom:16px;">
                        <div class="stat-item-compact highlight-stat">
                            <div class="stat-value-compact main-stat">
                                {{ $refund_count }}
                            </div>
                            <div class="stat-label-compact">Total Refunds</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-stats-compact single-footer">
                        <div class="footer-stat-compact calls-log-card">
                            <div class="footer-value-compact calls-value">Team Total</div>
                            <div class="footer-label-compact calls-label">Overall Refund Requests</div>
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