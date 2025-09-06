@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Payment Staus</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payment-status.index') }}">Add Payment Status</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Payment Status</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <form method="POST" action="{{ route('payment-status.store') }}">
            @csrf
            <!-- Top Bar -->


            <!-- payment Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3 payment-form booking-form gen_form">
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 position-relative">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="status" data-sh="Team" name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('Status')
                        <div class="text-danger">{{ $Status }}</div>
                        @enderror
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Roles</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="manager" name="roles[]" value="Manager">
                            <label class="form-check-label" for="manager">Manager</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="user" name="roles[]" value="User">
                            <label class="form-check-label" for="user">User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tleader" name="roles[]" value="TLeader">
                            <label class="form-check-label" for="tleader">Team Leader</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="admin" name="roles[]" value="Admin">
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Departments</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sales" name="departments[]" value="Sales">
                            <label class="form-check-label" for="sales">Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ccv" name="departments[]" value="CCV">
                            <label class="form-check-label" for="ccv">CCV</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="billing" name="departments[]" value="Billing">
                            <label class="form-check-label" for="billing">Billing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changes" name="departments[]" value="Changes">
                            <label class="form-check-label" for="changes">Changes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="quality" name="departments[]" value="Quality">
                            <label class="form-check-label" for="quality">Quality</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chargeback" name="departments[]" value="Charge Back">
                            <label class="form-check-label" for="chargeback">Charge Back</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>


    </div>


    <!--/ Content -->
    @endsection