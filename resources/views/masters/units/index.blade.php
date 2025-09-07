@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Units</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active">Units</a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <div class="d-flex justify-content-between mb-4">
            <h5>Units List</h5>
            <a href="{{ route('units.create') }}" class="btn btn-primary">Add Unit</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>LOB</th>
                        <th>Team</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($units as $unit)
                    <tr>
                        <td>{{ $unit->id }}</td>
                        <td>{{ $unit->name }}</td>
                        <td>{{ $unit->lob->name ?? 'N/A' }}</td>
                        <td>{{ $unit->team->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('units.edit', $unit) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('units.destroy', $unit) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No units found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $units->links() }}
    </div>
</div>

@endsection