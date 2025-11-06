@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Merchants</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#merchantModal">Add Merchant</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($merchants as $merchant)
                    <tr>
                        <td>{{ $merchant->id }}</td>
                        <td>
                            @if($merchant->logo)
                                <img src="{{ asset('storage/' . $merchant->logo) }}" alt="Logo" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <span class="text-muted">No Logo</span>
                            @endif
                        </td>
                        <td>{{ $merchant->name }}</td>
                        <td>{{ $merchant->email }}</td>
                        <td>{{ $merchant->phone }}</td>
                        <td>
                            <span class="badge bg-{{ $merchant->status ? 'success' : 'danger' }}">
                                {{ $merchant->status ? 'Active' : 'Inactive' }}
            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editMerchant({{ $merchant }})">Edit</button>
                            <form method="POST" action="{{ route('merchants.destroy', $merchant->id) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="merchantModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="merchantForm" method="POST" action="{{ route('merchants.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Merchant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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

<script>
function editMerchant(merchant) {
    document.getElementById('merchantForm').action = `/masters/merchants/${merchant.id}`;
    document.getElementById('merchantForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
    document.querySelector('.modal-title').textContent = 'Edit Merchant';
    document.querySelector('[name="name"]').value = merchant.name;
    document.querySelector('[name="email"]').value = merchant.email;
    document.querySelector('[name="phone"]').value = merchant.phone || '';
    document.querySelector('[name="address"]').value = merchant.address || '';
    document.querySelector('[name="status"]').value = merchant.status;
    document.querySelector('[name="logo"]').value = '';
    new bootstrap.Modal(document.getElementById('merchantModal')).show();
}
</script>

@endsection