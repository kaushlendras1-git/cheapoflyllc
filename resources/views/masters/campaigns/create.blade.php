@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Campaign</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('campaign.index') }}">Campaigns</a>
                <a class="active" aria-current="page">Add Campaign</a>
        </div>
    </div>
    <div class="row">

        @include('web.layouts.flash')

        <form method="POST" class="mt-3" action="{{ route('campaign.store') }}">
            @csrf
            <!-- Top Bar -->


            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3 booking-form">


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



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
        </form>


    </div>


    <!--/ Content -->
    @endsection