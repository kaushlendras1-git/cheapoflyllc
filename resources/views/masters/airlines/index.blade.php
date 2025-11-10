@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Airlines Management</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#airlineModal">
                Add Airline
            </button>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('airlines.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by code or name...">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                            @if(request('search'))
                                <a href="{{ route('airlines.index') }}" class="btn btn-outline-danger">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="airlinesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($airlines as $key => $airline)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $airline->airline_code }}</td>
                            <td>{{ $airline->airline_name }}</td>
                            <td>
                                <img src="{{ asset('assets/img/airline-logo/' . $airline->airline_code . '.png') }}" width="50" alt="{{ $airline->airline_name }}" onerror="this.style.display='none'">
                            </td>
                            <td>
                                <a href="{{ route('airlines.edit', $airline->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('airlines.destroy', $airline->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
               
                    {{ $airlines->appends(request()->query())->links() }}
               
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="airlineModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Airline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('airlines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection