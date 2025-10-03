@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
     <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Payment Status</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" aria-current="page">Payment Status</a>
                <a class="" aria-current="page">Add Payment Status</a>
        </div>
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
                       @foreach($roles as $role)        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{$role->name}}" name="roles[]" value="{{$role->id}}">
                            <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                          @endforeach
                       
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Departments</label>
                        @foreach($departments as $department)   
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{$department->name}}" name="departments[]" value="{{$department->id}}">
                                <label class="form-check-label" for="{{$department->name}}">{{$department->name}}</label>
                            </div>
                        @endforeach
                        
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