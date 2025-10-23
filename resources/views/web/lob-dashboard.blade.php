@extends('web.layouts.main')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6" style="margin-top: 10px;">

              <!-- 2. Booking Performance Chart -->
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h6 class="mb-0">Booking Performance</h6>
                    </div>
                    <div class="card-body">
                      <canvas id="bookingChart" height="300"></canvas>
                    </div>
                    <div class="card-footer text-end">
                      <a href="/lob/booking-reports" class="text-primary">View More</a>
                    </div>
                  </div>
                </div>

              

                <!-- 1. Profit/Loss Chart -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h6 class="mb-0">Profit/Loss Overview</h6>
                    </div>
                    <div class="card-body">
                      <canvas id="profitLossChart" height="300"></canvas>
                    </div>
                    <div class="card-footer text-end">
                      <a href="/lob/profit-loss" class="text-primary">View More</a>
                    </div>
                  </div>
                </div>

               

                <!-- 3. Campaign Performance Chart -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h6 class="mb-0">Campaign Performance</h6>
                    </div>
                    <div class="card-body">
                      <canvas id="campaignChart" height="300"></canvas>
                    </div>
                    <div class="card-footer text-end">
                      <a href="/lob/campaigns" class="text-primary">View More</a>
                    </div>
                  </div>
                </div>

                <!-- 4. Product Performance Chart -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h6 class="mb-0">Product Performance</h6>
                    </div>
                    <div class="card-body">
                      <canvas id="productChart" height="300"></canvas>
                    </div>
                    <div class="card-footer text-end">
                      <a href="/lob/products" class="text-primary">View More</a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!--/ Content -->

@endsection

@section('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Profit/Loss Chart
    const profitLossCtx = document.getElementById('profitLossChart').getContext('2d');
    new Chart(profitLossCtx, {
        type: 'doughnut',
        data: {
            labels: ['Gross MCO', 'Refunds', 'Chargebacks', 'Net MCO'],
            datasets: [{
                data: [
                    {{ $profitData->gross_mco }},
                    {{ $profitData->refund_amount }},
                    {{ $profitData->chargeback_amount }},
                    {{ $profitData->net_mco }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#007bff']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // 2. Booking Performance Chart - Daily Data for Current Month
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    const dailyBookingData = @json($bookingReportsDaily);
    new Chart(bookingCtx, {
        type: 'line',
        data: {
            labels: dailyBookingData.map(d => `Day ${d.day}`),
            datasets: [{
                label: 'Revenue (Net MCO)',
                data: dailyBookingData.map(d => d.net_mco),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }, {
                label: 'Refunded',
                data: dailyBookingData.map(d => d.refunded_bookings),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                tension: 0.4
            }, {
                label: 'Chargebacks',
                data: dailyBookingData.map(d => d.chargeback_bookings),
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Days in Current Month'
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

    // 3. Campaign Performance Chart
    const campaignCtx = document.getElementById('campaignChart').getContext('2d');
    const campaignData = @json($campaignData);
    new Chart(campaignCtx, {
        type: 'line',
        data: {
            labels: campaignData.map(c => c.name),
            datasets: [{
                label: 'Bookings Converted',
                data: campaignData.map(c => c.bookings_converted),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Bookings'
                    }
                }
            }
        }
    });

    // 4. Product Performance Chart
    const productCtx = document.getElementById('productChart').getContext('2d');
    const productData = @json($productData);
    const labels = Object.keys(productData);
    const bookingsData = labels.map(product => productData[product].bookings);
    const revenueData = labels.map(product => productData[product].net_revenue);
    
    new Chart(productCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Bookings',
                data: bookingsData,
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                yAxisID: 'y'
            }, {
                label: 'Revenue ($)',
                data: revenueData,
                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                type: 'line',
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Bookings'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
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
});
</script>
@endsection