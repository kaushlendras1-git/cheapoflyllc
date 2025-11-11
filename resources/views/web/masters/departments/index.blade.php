@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between ">
            <div>
                <h2 class="lob-title mb-1">
                    <span class="iconify" data-icon="mdi:office-building-cog-outline"
                        style="vertical-align: middle; font-size:14px"></span>
                    Department Management
                </h2>
            </div>

            <!--  Breadcrumb -->
            <nav aria-label="breadcrumb" class="lob__breadcrumb">
                <ol class="lob__breadcrumb-list mb-0">
                    <li class="lob__breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:office-building-outline"></span>
                        Departments
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Main Row -->
        <div class="row gy-4">
            <div class="col-12 col-margin">

                <!--  Flash Messages -->
                @include('web.layouts.flash')

                <!--  Modern Table Card -->
                <div class="lob-card">

                    <!--  Table -->
                    <div class="table-container table-2">
                        <div class="table-header">

                            <a href="{{ route('departments.create') }}" class="add-btn">
                                <span class="iconify" data-icon="mdi:plus-circle-outline" style="font-size: 1rem;"></span>
                                Add New Department
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th class="serial-col">Serial No.</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $key => $department)
                                        <tr>
                                            <td class="serial-col">{{ $key + 1 }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td>
                                                @if($department->status == 1)
                                                    <span class="badge bg-label-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-label-warning">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center table-actions">
                                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                                </a>
                                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete "
                                                        onclick="return confirm('Are you sure you want to delete this department?')">
                                                        <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--  Pagination -->
                        <div class="pagination-container"> {{ $departments->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <!--  End Card -->

                </div>
            </div>
        </div>
        <!--  End Content Wrapper -->

@endsection