@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Booking Status</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active"href="{{ route('booking-status.index') }}">Add Booking Status</a>
                <a class="active">Add Booking Status</a>
        </div>
    </div>
    <div class="row">

        <form method="POST" action="{{ route('booking-status.store') }}">
            @csrf
            <!-- Top Bar -->

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

     </div>

        <div class="row">
            <div class="col-mb-12 ">
                <label class="form-label">Roles</label>
                 @foreach($roles as $role)   
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{$role->name}}" name="roles[]" value="{{$role->id}}">
                        <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
                    </div>
                @endforeach
            </div>
        
        </div>

        <div class="row">

           <div class="col-mb-12">
                <label class="form-label">Department</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sales" name="departments[]" value="Sales">
                    <label class="form-check-label" for="sales">Sales</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ccv" name="departments[]" value="CCV">
                    <label class="form-check-label" for="ccv">CCV</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="billings" name="departments[]" value="Billing">
                    <label class="form-check-label" for="billings">Billing</label>
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
                    <input class="form-check-input" type="checkbox" id="ChargeBack" name="departments[]" value="Charge Back">
                    <label class="form-check-label" for="ChargeBack">Charge Back</label>
                </div>
            </div>
     

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
     

        </form>
    </div>


    <!--/ Content -->
    @endsection