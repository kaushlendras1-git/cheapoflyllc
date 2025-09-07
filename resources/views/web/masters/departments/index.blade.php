@extends('web.layouts.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Departments</h2>
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}" class="active">Dashboard</a>
            <a href="javascript:void(0);">Departments</a>
        </div>
    </div>

    @include('web.layouts.flash')

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Department List</h5>
            <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>
                            <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $department->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $departments->links() }}
    </div>
</div>
@endsection