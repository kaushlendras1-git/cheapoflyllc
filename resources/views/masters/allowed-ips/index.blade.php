@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">IP Access Management</h5>
            <div class="d-flex gap-2">
                @php $openAll = \App\Models\AllowedIp::where('open_all', 1)->where('status', 1)->exists(); @endphp
                <form method="POST" action="{{ route('allowed-ips.toggle-open-all') }}" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-{{ $openAll ? 'danger' : 'success' }}">
                        {{ $openAll ? 'Disable Open All' : 'Enable Open All' }}
                    </button>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ipModal">
                    Add IP Address
                </button>
            </div>
        </div>
        @php $openAll = \App\Models\AllowedIp::where('open_all', 1)->where('status', 1)->exists(); @endphp
        @if($openAll)
            <div class="alert alert-warning m-3">
                <i class="ri ri-alert-line"></i> <strong>Warning:</strong> All IP addresses are currently allowed to access the system.
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IP Address</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ips as $ip)
                        <tr>
                            <td>{{ $ip->id }}</td>
                            <td>{{ $ip->ip_address }}</td>
                            <td>{{ $ip->description }}</td>
                            <td>
                                <span class="badge bg-{{ $ip->status ? 'success' : 'danger' }}">
                                    {{ $ip->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('allowed-ips.edit', $ip->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('allowed-ips.toggle-status', $ip->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-{{ $ip->status ? 'secondary' : 'success' }}">
                                        {{ $ip->status ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('allowed-ips.destroy', $ip->id) }}" style="display:inline;">
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ipModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add IP Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('allowed-ips.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">IP Address</label>
                        <input type="text" class="form-control" name="ip_address" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Optional description">
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