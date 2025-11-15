@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Booking Status Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $bookingStatus->name }}</p>
                    <p><strong>Status:</strong> {{ $bookingStatus->status ? 'Active' : 'Inactive' }}</p>
                    <p><strong>Departments:</strong> {{ is_array($bookingStatus->departments) ? implode(', ', $bookingStatus->departments) : $bookingStatus->departments }}</p>
                    <p><strong>Roles:</strong> {{ is_array($bookingStatus->roles) ? implode(', ', $bookingStatus->roles) : $bookingStatus->roles }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('booking-status.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('booking-status.edit', $bookingStatus) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection