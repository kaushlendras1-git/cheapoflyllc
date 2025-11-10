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

            <div class="payment-table-wrapper py-2 crm-table">
                <table class="table table-hover table-sm payment-table w-100 mb-0">
                    <thead class="bg-dark text-white sticky-top">
                        <tr>
                            <th class="serial-col">Serial No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $key => $department)
                            <tr>
                                <td class="serial-col">{{ $key + 1 }}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $department->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="me-2">
                                        <img width="25" src="../../../assets/img/icons/img-icons/edit.png" alt="edit-icon">
                                    </a>

                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-btn p-0"
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                            <img width="25" src="../../../assets/img/icons/img-icons/delete.png"
                                                alt="delete-icon">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination links (optional, if applicable) -->
                <div class="mt-3">
                    {{ $departments->links() }}
                </div>
            </div>


            {{ $departments->links() }}
        </div>
    </div>
@endsection