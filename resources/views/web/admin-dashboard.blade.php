@extends('web.layouts.main')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                <!-- Agent Login Requests -->
                
           


                <!-- Congratulations card -->
                <div class="col-md-12 col-lg-4" style="margin-top: 30px;">
                  <div class="card">
                    <div class="card-body text-nowrap">
                      <h5 class="card-title mb-0 flex-wrap text-nowrap">Today Score! 🎉</h5>
                      <h5 class="text-primary mb-0">${{ number_format($today_score, 2) }}</h5>
                    </div>
                  </div>
                </div>
                <!--/ Congratulations card -->

                <!-- Transactions -->
                <div class="col-lg-8" style="margin-top: 30px;">
                  <div class="card">                    
                    <div class="card-body">
                      <div class="row g-6">
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-primary rounded shadow-xs">
                                <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Flight</p>
                              <h5 class="mb-0">${{ number_format($flight_score, 2) }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-success rounded shadow-xs">
                                <i class="icon-base ri ri-group-line icon-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Hotel</p>
                              <h5 class="mb-0">${{ number_format($hotel_score, 2) }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-warning rounded shadow-xs">
                                <i class="icon-base ri ri-macbook-line icon-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Cruise</p>
                              <h5 class="mb-0">${{ number_format($cruise_score, 2) }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-info rounded shadow-xs">
                                <i class="icon-base ri ri-money-dollar-circle-line icon-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Car</p>
                              <h5 class="mb-0">${{ number_format($car_score, 2) }}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->



                <!-- Daily Overview Chart -->
                <div class="col-xl-12 col-md-6">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Daily Overview (Last 2 Months)</h5>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="height: 300px;">
                        <canvas id="dailyBarChart"></canvas>
                      </div>
                      <div class="mt-3">
                        <div class="d-flex align-items-center gap-4">
                          <h4 class="mb-0">${{ number_format($today_score, 2) }}</h4>
                          <p class="mb-0">Today's net profit</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Daily Overview Chart -->

                                <!-- Weekly Overview Chart -->
                <div class="col-xl-6 col-md-6">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Weekly Overview</h5>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="height: 300px;">
                        <canvas id="weeklyBarChart"></canvas>
                      </div>
                      <div class="mt-3">
                        <div class="d-flex align-items-center gap-4">
                          <h4 class="mb-0">${{ number_format($weekly_score, 2) }}</h4>
                          <p class="mb-0">Weekly net profit</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Weekly Overview Chart -->

                <!-- Monthly Overview Chart -->
                <div class="col-xl-6 col-md-6">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Monthly Overview</h5>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="height: 300px;">
                        <canvas id="monthlyBarChart"></canvas>
                      </div>
                      <div class="mt-3">
                        <div class="d-flex align-items-center gap-4">
                          <h4 class="mb-0">${{ number_format($monthly_score, 2) }}</h4>
                          <p class="mb-0">Monthly net profit</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Monthly Overview Chart -->

                <!-- Booking Types Line Chart -->
                <div class="col-xl-12 col-md-6">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Booking Types Performance (Last 2 Months)</h5>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="height: 300px;">
                        <canvas id="bookingTypesLineChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Booking Types Line Chart -->

                <!-- Queues Status -->
                <div class="col-xl-6">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="m-0 me-2">Queues Status</h5>
                      <input type="date" id="queueDate" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" onchange="filterQueues()" style="width: 150px;">
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-sm" id="queueTable">
                          <thead>
                            <tr>
                              <th>Status Name</th>
                              <th>Count</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($queueStatus as $status)
                            <tr>
                              <td>{{ $status->status_name }}</td>
                              <td>{{ $status->count }}</td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="2" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Queues Status -->

                <!-- Revenue Status -->
                <div class="col-xl-6 col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="m-0 me-2">Revenue Status</h5>
                      <div class="d-flex gap-2">
                        <input type="date" id="revenueDateFrom" class="form-control form-control-sm" value="{{ date('Y-m-01') }}">
                        <input type="date" id="revenueDateTo" class="form-control form-control-sm" value="{{ date('Y-m-t') }}">
                        <button class="btn btn-primary btn-sm" onclick="filterRevenue()">Filter</button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-sm" id="revenueTable">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Count</th>
                              <th>Gross</th>
                              <th>Net</th>
                              <th>Deductions</th>
                              <th>Total</th>
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
                              <td>${{ number_format($revenue->total, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="6" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                          </tbody>
                          <tfoot>
                            <tr class="fw-bold">
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
                <!--/ Revenue Status -->

                <!-- Users Score -->
                <div class="col-xl-12 col-md-6">
                  <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">User Performance</h5>
                      <div class="d-flex gap-2">
                        <input type="date" id="dateFrom" class="form-control form-control-sm" value="{{ date('Y-m-01') }}">
                        <input type="date" id="dateTo" class="form-control form-control-sm" value="{{ date('Y-m-t') }}">
                        <button class="btn btn-primary btn-sm" onclick="filterData()">Filter</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-sm" id="userPerformanceTable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Gross MCO</th>
                            <th>Net MCO</th>
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
                            <td>${{ number_format($user->net_value, 2) }}</td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6" class="text-center">No data available</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /Users Score -->

              </div>
            </div>
            <!--/ Content -->

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
            html += `
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
                body: JSON.stringify({ action })
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
        const alertHtml = `
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
        let totals = { count: 0, gross: 0, net: 0, deductions: 0, total: 0 };
        
        data.forEach(revenue => {
            html += `
                <tr>
                    <td>${revenue.date}</td>
                    <td>${revenue.count}</td>
                    <td>$${parseFloat(revenue.gross).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                    <td>$${parseFloat(revenue.net).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                    <td>$${parseFloat(revenue.deductions).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                    <td>$${parseFloat(revenue.total).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                </tr>
            `;
            totals.count += parseInt(revenue.count);
            totals.gross += parseFloat(revenue.gross);
            totals.net += parseFloat(revenue.net);
            totals.deductions += parseFloat(revenue.deductions);
            totals.total += parseFloat(revenue.total);
        });
        
        tbody.innerHTML = html;
        tfoot.innerHTML = `
            <tr class="fw-bold">
                <td>Total</td>
                <td>${totals.count}</td>
                <td>$${totals.gross.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                <td>$${totals.net.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                <td>$${totals.deductions.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                <td>$${totals.total.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
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
            html += `
                <tr>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role_name}</td>
                    <td>${user.department_name}</td>
                    <td>$${parseFloat(user.gross_value).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                    <td>$${parseFloat(user.net_value).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
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
            html += `
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