@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit IP Address</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('allowed-ips.update', $allowedIp->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">IP Address</label>
                    <input type="text" class="form-control" name="ip_address" value="{{ $allowedIp->ip_address }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ $allowedIp->description }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('allowed-ips.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection