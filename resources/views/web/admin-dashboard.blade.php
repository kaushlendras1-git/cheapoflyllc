@extends('web.layouts.main')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')




<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y p-70 mt-4">
    <!-- Dashboard Title Section -->
    <!-- <div class="dashboard-header mb-4">
                                                                            <div class="container">
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
                                                                        </div> -->

    <div class="row gy-4 gx-4">



        <!-- Charts Section -->
        <div class="col-12 mt-4">
            <div class="row gy-4">
                <!-- 1️ Performance Trend (Line Chart) -->
                <div class="col-lg-8">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container primary">
                                    <span class="iconify" data-icon="mdi:trending-up"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Performance Trend</h5>
                                    <small>Last 7 Days Revenue & Bookings</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="performanceTrendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!--  Service Distribution (Doughnut Chart) -->
                <div class="col-lg-4">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container secondary">
                                    <span class="iconify" data-icon="mdi:chart-pie"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Service Distribution</h5>
                                    <small>By Booking Categories</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="serviceDistributionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!--  Weekly KPIs (Radar Chart) -->
                <div class="col-lg-4">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container success">
                                    <span class="iconify" data-icon="mdi:chart-bar"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Weekly KPIs</h5>
                                    <small>Overall Performance Metrics</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="weeklyKpiChart"></canvas>
                        </div>
                    </div>
                </div>

                <!--  Daily Sales (Bar Chart) -->
                <div class="col-lg-8">
                    <div class="premium-card chart-card">
                        <div class="card-header-premium">
                            <div class="header-content">
                                <div class="icon-container success">
                                    <span class="iconify" data-icon="mdi:chart-bar"></span>
                                </div>
                                <div class="title-section">
                                    <h5>Daily Sales Overview</h5>
                                    <small>Sales Volume This Week</small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="dailySalesChart"></canvas>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Charts Section Ends -->

        <!-- ================= Revenue Status ================= -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card premium-dashboard-card h-100 shadow-sm border-0">
                <div
                    class="card-header d-flex align-items-center justify-content-between premium-header py-3 rounded-top">
                    <h5 class="m-0 d-flex align-items-center gap-2 text-white fw-semibold">
                        <span class="iconify" data-icon="mdi:finance" data-width="22"></span> Revenue Status
                    </h5>
                    <div class="d-flex gap-2">
                        <input type="date" id="revenueDateFrom" class="form-control form-control-sm premium-input-date"
                            value="{{ date('Y-m-01') }}">
                        <input type="date" id="revenueDateTo" class="form-control form-control-sm premium-input-date"
                            value="{{ date('Y-m-t') }}">
                        <button class="btn btn-light btn-sm fw-semibold premium-filter-btn" onclick="filterRevenue()">
                            <span class="iconify" data-icon="mdi:filter"></span> Filter
                        </button>
                    </div>

                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 premium-dashboard-table" id="revenueTable">
                            <thead class="premium-dashboard-thead">
                                <tr>
                                    <th><span class="iconify me-1" data-icon="mdi:calendar"></span> Date</th>
                                    <th><span class="iconify me-1" data-icon="mdi:counter"></span> Count</th>
                                    <th><span class="iconify me-1" data-icon="mdi:cash"></span> Gross</th>
                                    <th><span class="iconify me-1" data-icon="mdi:bank"></span> Net</th>
                                    <th><span class="iconify me-1" data-icon="mdi:chart-line"></span> Deductions</th>
                                    <th><span class="iconify me-1" data-icon="mdi:currency-usd"></span> Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($revenueData as $revenue)
                                <tr>
                                    <td>{{ $revenue->date }}</td>
                                    <td>{{ $revenue->count }}</td>
                                    <td>${{ number_format($revenue->gross, 2) }}</td>
                                    <td>${{ number_format($revenue->net, 2) }}</td>
                                    <td>${{ number_format($revenue->deductions, 2) }}</td>
                                    <td class="fw-semibold text-success">${{ number_format($revenue->total, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="premium-dashboard-tfoot">
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $revenueData->sum('count') }}</td>
                                    <td>${{ number_format($revenueData->sum('gross'), 2) }}</td>
                                    <td>${{ number_format($revenueData->sum('net'), 2) }}</td>
                                    <td>${{ number_format($revenueData->sum('deductions'), 2) }}</td>
                                    <td>${{ number_format($revenueData->sum('total'), 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= User Performance ================= -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card premium-dashboard-card shadow-sm border-0">
                <div
                    class="card-header d-flex justify-content-between align-items-center premium-header py-3 rounded-top">
                    <h5 class="mb-0 d-flex align-items-center gap-2 text-white fw-semibold">
                        <span class="iconify" data-icon="mdi:account-multiple-check-outline" data-width="22"></span>
                        User Performance
                    </h5>
                    <div class="d-flex gap-2">
                        <input type="date" id="dateFrom" class="form-control form-control-sm premium-input-date"
                            value="{{ date('Y-m-01') }}">
                        <input type="date" id="dateTo" class="form-control form-control-sm premium-input-date"
                            value="{{ date('Y-m-t') }}">
                        <button class="btn btn-light btn-sm fw-semibold premium-filter-btn" onclick="filterData()">
                            <span class="iconify" data-icon="mdi:filter"></span> Filter
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 premium-dashboard-table"
                        id="userPerformanceTable">
                        <thead class="premium-dashboard-thead">
                            <tr>
                                <th><span class="iconify me-1" data-icon="mdi:account"></span> Name</th>
                                <th><span class="iconify me-1" data-icon="mdi:email"></span> Email</th>
                                <th><span class="iconify me-1" data-icon="mdi:shield-account-outline"></span> Role</th>
                                <th><span class="iconify me-1" data-icon="mdi:domain"></span> Department</th>
                                <th><span class="iconify me-1" data-icon="mdi:cash-multiple"></span> Gross MCO</th>
                                <th><span class="iconify me-1" data-icon="mdi:bank"></span> Net MCO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userPerformance as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_name }}</td>
                                <td>{{ $user->department_name }}</td>
                                <td>${{ number_format($user->gross_value, 2) }}</td>
                                <td class="fw-semibold text-success">${{ number_format($user->net_value, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= Queues Status ================= -->
        <div class="col-xl-12 mb-4">
            <div class="card premium-dashboard-card shadow-sm border-0">
                <div
                    class="card-header d-flex justify-content-between align-items-center premium-header py-3 rounded-top">
                    <h5 class="m-0 d-flex align-items-center gap-2 text-white fw-semibold">
                        <span class="iconify" data-icon="mdi:queue-first-in-last-out" data-width="22"></span> Queues
                        Status
                    </h5>
                    <input type="date" id="queueDate" class="form-control form-control-sm premium-input-date"
                        value="{{ date('Y-m-d') }}" onchange="filterQueues()" style="width: 160px;">
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 premium-dashboard-table" id="queueTable">
                            <thead class="premium-dashboard-thead">
                                <tr>
                                    <th><span class="iconify me-1" data-icon="mdi:check-decagram-outline"></span> Status
                                        Name</th>
                                    <th><span class="iconify me-1" data-icon="mdi:counter"></span> Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($queueStatus as $status)
                                <tr>
                                    <td>{{ $status->status_name }}</td>
                                    <td class="fw-semibold">{{ $status->count }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-4">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





        <!-- Flight Card -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$2,450.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">185</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">920</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$13.24</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">72.5%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 72.5%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">85.4%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 85.4%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$180.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$95.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Flight Card Ends -->


        <!-- Hotel Card -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$1,980.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">145</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">740</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$11.65</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">68.3%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 68.3%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">82.1%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 82.1%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$150.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$80.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel Card Ends -->


        <!-- Cruise Card -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$1,250.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">88</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">460</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$9.30</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">61.4%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 61.4%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">77.9%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 77.9%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$90.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$55.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cruise Card Ends -->


        <!-- Car Card -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$980.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">62</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">310</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$7.90</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Conversion</span>
                            <span class="progress-value-compact">58.6%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 58.6%;">
                            </div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact">
                            <span class="progress-label-compact">Quality</span>
                            <span class="progress-value-compact">74.2%</span>
                        </div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 74.2%;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$70.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$42.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Car Card Ends -->

        <!-- Train Card Start -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$1,560.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">120</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">610</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$12.98</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">65.4%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 65.4%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">81.2%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 81.2%;"></div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$120.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$55.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Train Card Ends -->

        <!-- Package Card Starts -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$1,780.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">135</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">720</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$14.22</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">70.8%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 70.8%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">83.5%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 83.5%;"></div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$130.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$70.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Package Card Ends -->

        <!-- Refund Card Starts -->
        <div class="col-md-3 col-lg-3">
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

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$650.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">58</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">240</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$5.45</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">45.2%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 45.2%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">62.8%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 62.8%;"></div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$85.00</div>
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

        <!-- Declined Card Starts -->
        <div class="col-md-3 col-lg-3">
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

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$340.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">22</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">140</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$2.43</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">21.7%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 21.7%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">49.5%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 49.5%;"></div>
                        </div>
                    </div>
                </div>

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
        <!-- Declined Card Ends -->

        <!-- Quality Score Cards Start -->
        <div class="col-md-3 col-lg-3">
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

                <div class="stats-grid-compact">
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$1,220.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">108</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">510</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$10.45</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">78.9%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 78.9%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">91.4%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 91.4%;"></div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$110.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$65.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quality Score Cards Ends -->

        <!-- ChargeBack Card -->
        <div class="col-md-3 col-lg-3">
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
                        <div class="stat-value-compact">$890.00</div>
                        <div class="stat-label-compact">Score</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">76</div>
                        <div class="stat-label-compact">Bookings</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">350</div>
                        <div class="stat-label-compact">Calls</div>
                    </div>
                    <div class="stat-item-compact">
                        <div class="stat-value-compact">$8.14</div>
                        <div class="stat-label-compact">RPC</div>
                    </div>
                </div>

                <div class="progress-section-compact">
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Conversion</span><span
                                class="progress-value-compact">55.6%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact conversion animate-progress"
                                style="--target-width: 55.6%;"></div>
                        </div>
                    </div>
                    <div class="progress-item-compact">
                        <div class="progress-header-compact"><span class="progress-label-compact">Quality</span><span
                                class="progress-value-compact">72.0%</span></div>
                        <div class="progress-bar-container-compact">
                            <div class="progress-bar-fill-compact quality animate-progress"
                                style="--target-width: 72.0%;"></div>
                        </div>
                    </div>
                </div>

                <div class="footer-stats-compact">
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$0.00</div>
                        <div class="footer-label-compact">Refund</div>
                    </div>
                    <div class="footer-stat-compact">
                        <div class="footer-value-compact">$210.00</div>
                        <div class="footer-label-compact">Chargeback</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ChargeBack Card Ends -->









        <!-- Short Break Card -->
        <div class="col-md-6">
            <div
                class="premium-card warning break-button-premium h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="icon-container warning mb-3">
                    <span class="iconify" data-icon="mdi:coffee-outline" data-width="32" data-height="32"></span>
                </div>
                <h5 class="mb-3" style="color: var(--warning); font-weight: 700; font-size:14px;">Need a Short Break?
                </h5>
                <p class="text-muted mb-4" style="font-size:14px; text-align: center;">
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1️⃣ Performance Trend - Line Chart
    new Chart(document.getElementById('performanceTrendChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                    label: 'Revenue ($)',
                    data: [1200, 1500, 1800, 1400, 2000, 2200, 2500],
                    borderColor: '#1C316D',
                    backgroundColor: 'rgba(28, 49, 109, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Bookings',
                    data: [5, 9, 7, 10, 12, 15, 13],
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
                    position: 'top'
                }
            }
        }
    });

    // 2️⃣ Service Distribution - Doughnut Chart
    new Chart(document.getElementById('serviceDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Flights', 'Hotels', 'Cruises', 'Packages'],
            datasets: [{
                data: [45, 30, 15, 10],
                backgroundColor: ['#1C316D', '#6C63FF', '#FFD166', '#4ECDC4'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // 3️⃣ Daily Sales - Bar Chart
    new Chart(document.getElementById('dailySalesChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Sales ($)',
                data: [500, 800, 750, 900, 1100, 1400, 1600],
                backgroundColor: 'linear-gradient(135deg, #1C316D, #2e4aa7)',
                backgroundColor: '#2e4aa7',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // 4️ Weekly KPIs - Radar Chart
    new Chart(document.getElementById('weeklyKpiChart'), {
        type: 'radar',
        data: {
            labels: ['Revenue', 'Calls', 'Bookings', 'Conversion', 'RPC'],
            datasets: [{
                label: 'KPI Score',
                data: [85, 90, 80, 75, 88],
                backgroundColor: 'rgba(28, 49, 109, 0.2)',
                borderColor: '#1C316D',
                pointBackgroundColor: '#6C63FF',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    suggestedMin: 0,
                    suggestedMax: 100,
                    grid: {
                        color: 'rgba(28,49,109,0.1)'
                    },
                    pointLabels: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>




@endsection

@section('footer')
<script>
let requestsInterval;

document.addEventListener('DOMContentLoaded', function() {
    loadPendingRequests();
    requestsInterval = setInterval(loadPendingRequests, 3000); // Check every 3 seconds
});

async function loadPendingRequests() {
    try {
        const response = await fetch('/agent/pending-requests', {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const requests = await response.json();
        displayRequests(requests);
    } catch (error) {
        console.error('Error loading requests:', error);
    }
}

function displayRequests(requests) {
    const container = document.getElementById('loginRequests');
    const countBadge = document.getElementById('pendingCount');

    countBadge.textContent = requests.length;

    if (requests.length === 0) {
        container.innerHTML = '<p class="text-muted text-center">No pending requests</p>';
        return;
    }

    let html = '';
    requests.forEach(request => {
        const timeLeft = getTimeLeft(request.expired_at);
        html +=
            `
                                                                                                                                                                                              <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                                                                                                                                                                                                  <div>
                                                                                                                                                                                                      <h6 class="mb-1">${request.user.name || request.user.email}</h6>
                                                                                                                                                                                                      <small class="text-muted">Expires in: ${timeLeft}</small>
                                                                                                                                                                                                  </div>
                                                                                                                                                                                                  <div>
                                                                                                                                                                                                      <button class="btn btn-sm btn-success me-1" onclick="approveRequest(${request.id}, 'approve')">
                                                                                                                                                                                                          <i class="ri-check-line"></i>
                                                                                                                                                                                                      </button>
                                                                                                                                                                                                      <button class="btn btn-sm btn-danger" onclick="approveRequest(${request.id}, 'reject')">
                                                                                                                                                                                                          <i class="ri-close-line"></i>
                                                                                                                                                                                                      </button>
                                                                                                                                                                                                  </div>
                                                                                                                                                                                              </div>
                                                                                                                                                                                          `;
    });

    container.innerHTML = html;
}

function getTimeLeft(expiredAt) {
    const now = new Date();
    const expiry = new Date(expiredAt);
    const timeLeft = expiry - now;

    if (timeLeft <= 0) return 'Expired';

    const minutes = Math.floor(timeLeft / 60000);
    const seconds = Math.floor((timeLeft % 60000) / 1000);
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
}

async function approveRequest(requestId, action) {
    try {
        const response = await fetch(`/agent/login-approval/${requestId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                action
            })
        });

        const result = await response.json();

        if (result.success) {
            loadPendingRequests(); // Refresh the list

            // Show notification
            const message = action === 'approve' ? 'Request approved successfully' : 'Request rejected';
            showNotification(message, 'success');
        } else {
            showNotification(result.error || 'Failed to process request', 'error');
        }
    } catch (error) {
        showNotification('Error processing request', 'error');
    }
}

function showNotification(message, type) {
    // Simple notification - you can replace with your preferred notification system
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml =
        `
                                                                                                                                                                                          <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                                                                                                                                                                                               style="top: 20px; right: 20px; z-index: 9999;" role="alert">
                                                                                                                                                                                              ${message}
                                                                                                                                                                                              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                                                                                                                                                          </div>
                                                                                                                                                                                      `;

    document.body.insertAdjacentHTML('beforeend', alertHtml);

    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.remove();
    }, 3000);
}

async function filterRevenue() {
    const dateFrom = document.getElementById('revenueDateFrom').value;
    const dateTo = document.getElementById('revenueDateTo').value;

    try {
        const response = await fetch(`/admin/revenue-data?date_from=${dateFrom}&date_to=${dateTo}`, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        updateRevenueTable(data);
    } catch (error) {
        console.error('Error filtering revenue data:', error);
    }
}

function updateRevenueTable(data) {
    const tbody = document.querySelector('#revenueTable tbody');
    const tfoot = document.querySelector('#revenueTable tfoot');
    let html = '';
    let totals = {
        count: 0,
        gross: 0,
        net: 0,
        deductions: 0,
        total: 0
    };

    data.forEach(revenue => {
        html +=
            `
                                                                                                                                                                                              <tr>
                                                                                                                                                                                                  <td>${revenue.date}</td>
                                                                                                                                                                                                  <td>${revenue.count}</td>
                                                                                                                                                                                                  <td>$${parseFloat(revenue.gross).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                                  <td>$${parseFloat(revenue.net).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                                  <td>$${parseFloat(revenue.deductions).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                                  <td>$${parseFloat(revenue.total).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                              </tr>
                                                                                                                                                                                          `;
        totals.count += parseInt(revenue.count);
        totals.gross += parseFloat(revenue.gross);
        totals.net += parseFloat(revenue.net);
        totals.deductions += parseFloat(revenue.deductions);
        totals.total += parseFloat(revenue.total);
    });

    tbody.innerHTML = html;
    tfoot.innerHTML =
        `
                                                                                                                                                                                          <tr class="fw-bold">
                                                                                                                                                                                              <td>Total</td>
                                                                                                                                                                                              <td>${totals.count}</td>
                                                                                                                                                                                              <td>$${totals.gross.toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                              <td>$${totals.net.toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                              <td>$${totals.deductions.toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                              <td>$${totals.total.toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                          </tr>
                                                                                                                                                                                      `;
}

async function filterData() {
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;

    try {
        const response = await fetch(`/admin/user-performance?date_from=${dateFrom}&date_to=${dateTo}`, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        updateTable(data);
    } catch (error) {
        console.error('Error filtering data:', error);
    }
}

function updateTable(users) {
    const tbody = document.querySelector('#userPerformanceTable tbody');
    let html = '';

    users.forEach(user => {
        html +=
            `
                                                                                                                                                                                              <tr>
                                                                                                                                                                                                  <td>${user.name}</td>
                                                                                                                                                                                                  <td>${user.email}</td>
                                                                                                                                                                                                  <td>${user.role_name}</td>
                                                                                                                                                                                                  <td>${user.department_name}</td>
                                                                                                                                                                                                  <td>$${parseFloat(user.gross_value).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                                  <td>$${parseFloat(user.net_value).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                                                                                                                                                                              </tr>
                                                                                                                                                                                          `;
    });

    tbody.innerHTML = html;
}

async function filterQueues() {
    const date = document.getElementById('queueDate').value;

    try {
        const response = await fetch(`/admin/queue-status?date=${date}`, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        updateQueueTable(data);
    } catch (error) {
        console.error('Error filtering queue data:', error);
    }
}

function updateQueueTable(data) {
    const tbody = document.querySelector('#queueTable tbody');
    let html = '';

    data.forEach(status => {
        html +=
            `
                                                                                                                                                                                              <tr>
                                                                                                                                                                                                  <td>${status.status_name}</td>
                                                                                                                                                                                                  <td>${status.count}</td>
                                                                                                                                                                                              </tr>
                                                                                                                                                                                          `;
    });

    tbody.innerHTML = html;
}

// Initialize charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});

function initializeCharts() {
    // Weekly Bar Chart
    const weeklyData = @json($weeklyData);
    const weeklyCtx = document.getElementById('weeklyBarChart').getContext('2d');
    new Chart(weeklyCtx, {
        type: 'bar',
        data: {
            labels: weeklyData.map(item => item.label),
            datasets: [{
                label: 'Net Profit',
                data: weeklyData.map(item => item.value),
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Week Period'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Net Profit ($)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Monthly Bar Chart
    const monthlyData = @json($monthlyData);
    const monthlyCtx = document.getElementById('monthlyBarChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: monthlyData.map(item => item.label),
            datasets: [{
                label: 'Net Profit',
                data: monthlyData.map(item => item.value),
                backgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Net Profit ($)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Daily Bar Chart
    const dailyData = @json($dailyData);
    const dailyCtx = document.getElementById('dailyBarChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'bar',
        data: {
            labels: dailyData.map(item => item.label),
            datasets: [{
                label: 'Net Profit',
                data: dailyData.map(item => item.value),
                backgroundColor: '#ffc107'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Net Profit ($)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Booking Types Line Chart
    const lineChartData = @json($lineChartData);
    const lineCtx = document.getElementById('bookingTypesLineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: lineChartData.map(item => item.label),
            datasets: [{
                label: 'Flight',
                data: lineChartData.map(item => item.flight),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }, {
                label: 'Hotel',
                data: lineChartData.map(item => item.hotel),
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4
            }, {
                label: 'Cruise',
                data: lineChartData.map(item => item.cruise),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                tension: 0.4
            }, {
                label: 'Car',
                data: lineChartData.map(item => item.car),
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Net Profit ($)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}

// Clean up interval when page unloads
window.addEventListener('beforeunload', function() {
    if (requestsInterval) {
        clearInterval(requestsInterval);
    }
});
</script>
@endsection