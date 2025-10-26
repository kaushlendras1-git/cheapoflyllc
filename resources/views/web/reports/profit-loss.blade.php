@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Profit & Loss Details</h2>
        <div class="d-flex align-items-center gap-3">
            
            <div class="breadcrumb">
                <a class="active" href="#">Dashboard</a>
                <a class="active" href="#">Analytics</a>
                <a class="active" aria-current="page">Profit & Loss</a>
            </div>
        </div>
    </div>
    
    <div class="row gy-6">
        <div class="col-md-12">
            <div class="card p-4">
                <form method="GET">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="marketing-upper-form mb-5 d-flex booking-form gen_form flex-wrap">
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">LOB</label>
                                <select name="lob" class="form-select input-style w140">
                                    <option value="">All LOBs</option>
                                    @foreach(\App\Models\Department::all() as $dept)
                                        <option value="{{ $dept->id }}" {{ request('lob') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Team (Unit)</label>
                                <select name="team" class="form-select input-style w140">
                                    <option value="">All Teams</option>
                                    @foreach(\App\Models\Team::all() as $team)
                                        <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Team Leader</label>
                                <select name="team_leader" class="form-select input-style w140">
                                    <option value="">All Leaders</option>
                                    @foreach(\App\Models\User::where('role_id', 2)->where('department_id', 2)->get() as $leader)
                                        <option value="{{ $leader->id }}" {{ request('team_leader') == $leader->id ? 'selected' : '' }}>{{ $leader->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Company Card</label>
                                <select name="company_card" class="form-select input-style w140">
                                    <option value="">All Companies</option>
                                    <option value="1" {{ request('company_card') == '1' ? 'selected' : '' }}>FlyDreamz</option>
                                    <option value="2" {{ request('company_card') == '2' ? 'selected' : '' }}>FareTicketsUS</option>
                                    <option value="3" {{ request('company_card') == '3' ? 'selected' : '' }}>FareTicketsLLC</option>
                                    <option value="4" {{ request('company_card') == '4' ? 'selected' : '' }}>CruiseLineService</option>
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
                        <div class="add-follow-btn export-btn d-flex gap-2">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel" href="{{ route('lob.profit-loss.export', request()->query()) }}" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                                <i class="ri ri-file-excel-2-line fs-5"></i>
                            </a>
                            <select class="form-select input-style w140" onchange="if(this.value) window.location.href=this.value">
                                <option value="">Analytics</option>
                                <option value="{{ url('/lob/booking-reports') }}">Booking Reports</option>
                                <option value="{{ route('reports.campaign-calls') }}">Campaign Calls</option>
                                <option value="{{ url('/lob/campaigns') }}">Campaigns Report</option>
                                <option value="{{ route('reports.company') }}">Company Reports</option>
                                <option value="{{ url('/lob/dashboard') }}">Dashboard</option>
                                <option value="{{ route('score.details') }}">My Score</option>
                                <option value="{{ url('/lob/products') }}">Product Performance</option>
                                <option value="{{ route('reports.revenue') }}">Revenue Report</option>
                                <option value="{{ route('reports.team') }}">Team Reports</option>
                                <option value="{{ route('reports.unit') }}">Unit Reports</option>
                            </select>
                        </div>
                    </div>
                </form>
                
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <th>Date</th>
                                <th>Gross MCO</th>
                                <th>Merchant Fee</th>
                                <th>Company Card</th>
                                <th>Insurance Fee</th>
                                <th>FXL Insurance Fee</th>
                                <th>Net MCO</th>
                                <th>Refund</th>
                                <th>Refund%</th>
                                <th>Chargeback</th>
                                <th>Chargeback%</th>
                                <th>Number of Calls</th>
                                <th>Calls Cost</th>
                                <th>Total Salary</th>
                                <th>Daily Incentive</th>
                                <th>Monthly Incentive</th>
                                <th>Transport Cost</th>
                                <th>Net Profit</th>
                                <th>RPC</th>
                                <th>Conversion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($profitLossData as $data)
                            <tr>
                                <td>{{ $data->date }}</td>
                                <td>${{ number_format($data->gross_mco, 2) }}</td>
                                <td>${{ number_format($data->merchant_fee, 2) }}</td>
                                <td>{{ $data->company_name }}</td>
                                <td>${{ number_format($data->insurance_fee, 2) }}</td>
                                <td>${{ number_format($data->fxl_insurance_fee, 2) }}</td>
                                <td>${{ number_format($data->net_mco, 2) }}</td>
                                <td>${{ number_format($data->refund, 2) }}</td>
                                <td>{{ number_format($data->refund_percentage, 2) }}%</td>
                                <td>${{ number_format($data->chargeback, 2) }}</td>
                                <td>{{ number_format($data->chargeback_percentage, 2) }}%</td>
                                <td>{{ $data->number_of_calls }}</td>
                                <td>${{ number_format($data->calls_cost, 2) }}</td>
                                <td>${{ number_format($data->total_salary, 2) }}</td>
                                <td>0</td>
                                <td>${{ number_format($data->monthly_incentive, 2) }}</td>
                                <td>${{ number_format($data->transport_cost, 2) }}</td>
                                <td>${{ number_format($data->net_profit, 2) }}</td>
                                <td>${{ number_format($data->rpc, 2) }}</td>
                                <td>{{ number_format($data->conversion, 2) }}%</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="20" class="text-center">No data available</td>
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