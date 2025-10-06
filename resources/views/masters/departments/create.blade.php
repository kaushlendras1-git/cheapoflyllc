@extends('web.layouts.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Department</h2>
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('departments.index') }}" class="active">Departments</a>
            <a href="javascript:void(0);">Add</a>
        </div>
    </div>

    <div class="card p-4">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection