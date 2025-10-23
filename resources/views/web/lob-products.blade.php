@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Product Performance</h2>
        <div class="breadcrumb">
            <a class="active" href="#">Dashboard</a>
            <a class="active" aria-current="page">Product Performance</a>
        </div>
    </div>
    
    <div class="row gy-6">
        <div class="col-md-12">
            <div class="card p-4">
                <form method="GET">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="marketing-upper-form mb-5 d-flex booking-form gen_form">
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Product Type</label>
                                <select name="product_type" class="form-select input-style w140">
                                    <option value="">All Products</option>
                                    <option value="Flight" {{ request('product_type') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Car" {{ request('product_type') == 'Car' ? 'selected' : '' }}>Car</option>
                                    <option value="Train" {{ request('product_type') == 'Train' ? 'selected' : '' }}>Train</option>
                                    <option value="Cruise" {{ request('product_type') == 'Cruise' ? 'selected' : '' }}>Cruise</option>
                                    <option value="Hotel" {{ request('product_type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Start Date</label>
                                <input type="date" name="start_date" class="form-control input-style" value="{{ request('start_date') }}">
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">End Date</label>
                                <input type="date" name="end_date" class="form-control input-style" value="{{ request('end_date') }}">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style m-auto">
                                    <i class="ri ri-search-line fs-5"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="add-follow-btn export-btn">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel" href="{{ route('lob.products.export', request()->query()) }}" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                                <i class="ri ri-file-excel-2-line fs-5"></i>
                            </a>
                        </div>
                    </div>
                </form>
                
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <th>Product Type</th>
                                <th>Total Bookings</th>
                                <th>Gross Revenue</th>
                                <th>Net Revenue</th>
                                <th>Total Calls</th>
                                <th>Conversion Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productData as $data)
                            <tr>
                                <td>{{ $data->product_type }}</td>
                                <td>{{ $data->total_bookings }}</td>
                                <td>${{ number_format($data->gross_revenue, 2) }}</td>
                                <td>${{ number_format($data->net_revenue, 2) }}</td>
                                <td>{{ $data->total_calls }}</td>
                                <td>{{ number_format($data->conversion_rate, 2) }}%</td>
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
    </div>
</div>

<style>
.table th {
    background-color: #343a40 !important;
    color: white !important;
    font-weight: 600;
    font-size: 0.85rem;
}
.table td {
    font-size: 0.8rem;
    vertical-align: middle;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>

@endsection