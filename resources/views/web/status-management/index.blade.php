@extends('web.layouts.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Status Management</h2>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="statusTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="booking-status-tab" data-bs-toggle="tab" data-bs-target="#booking-status" type="button" role="tab">
                Booking Status
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payment-status-tab" data-bs-toggle="tab" data-bs-target="#payment-status" type="button" role="tab">
                Payment Status
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="status-mapping-tab" data-bs-toggle="tab" data-bs-target="#status-mapping" type="button" role="tab">
                Status Mapping
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dependencies-tab" data-bs-toggle="tab" data-bs-target="#dependencies" type="button" role="tab">
                Dependencies
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="interdependencies-tab" data-bs-toggle="tab" data-bs-target="#interdependencies" type="button" role="tab">
                Interdependencies
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="statusTabsContent">
        <!-- Booking Status Tab -->
        <div class="tab-pane fade show active" id="booking-status" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Booking Status Management</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBookingStatusModal">
                        Add Booking Status
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingStatuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td>{{ $status->department }}</td>
                                    <td>{{ $status->role }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editBookingStatus({{ $status->id }}, '{{ $status->name }}')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteBookingStatus({{ $status->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Tab -->
        <div class="tab-pane fade" id="payment-status" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Payment Status Management</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPaymentStatusModal">
                        Add Payment Status
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentStatuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editPaymentStatus({{ $status->id }}, '{{ $status->name }}')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deletePaymentStatus({{ $status->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Mapping Tab -->
        <div class="tab-pane fade" id="status-mapping" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Booking-Payment Status Mapping</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMappingModal">
                        Add Mapping
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking Status</th>
                                    <th>Payment Status</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingPaymentMappings as $mapping)
                                <tr>
                                    <td>{{ $mapping->bookingStatus->name }}</td>
                                    <td>{{ $mapping->paymentStatus->name }}</td>
                                    <td><span class="badge bg-info">{{ $mapping->departmentRelation?->name ?? 'N/A' }}</span></td>
                                    <td><span class="badge bg-primary">{{ $mapping->roleRelation?->name ?? 'N/A' }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteMapping({{ $mapping->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dependencies Tab -->
        <div class="tab-pane fade" id="dependencies" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Status Dependencies</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDependencyModal">
                        Add Dependency
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Main Status</th>
                                    <th>Dependent Status</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statusDependencies as $dependency)
                                <tr>
                                    <td>{{ $dependency->bookingStatus->name }}</td>
                                    <td>{{ $dependency->dependentStatus->name }}</td>
                                    <td><span class="badge bg-info">{{ $dependency->departmentRelation?->name ?? 'N/A' }}</span></td>
                                    <td><span class="badge bg-primary">{{ $dependency->roleRelation?->name ?? 'N/A' }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteDependency({{ $dependency->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interdependencies Tab -->
        <div class="tab-pane fade" id="interdependencies" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Status Interdependencies</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addInterdependencyModal">
                        Add Interdependency
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking Status</th>
                                    <th>Payment Status</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Direction</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statusInterdependencies as $interdep)
                                <tr>
                                    <td>{{ $interdep->bookingStatus->name }}</td>
                                    <td>{{ $interdep->paymentStatus->name }}</td>
                                    <td><span class="badge bg-info">{{ $interdep->department->name }}</span></td>
                                    <td><span class="badge bg-primary">{{ $interdep->role->name }}</span></td>
                                    <td>
                                        @if($interdep->direction == 'bidirectional')
                                            <span class="badge bg-success">↔ Bidirectional</span>
                                        @elseif($interdep->direction == 'booking_to_payment')
                                            <span class="badge bg-warning">→ Booking to Payment</span>
                                        @else
                                            <span class="badge bg-info">← Payment to Booking</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteInterdependency({{ $interdep->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Add Booking Status Modal -->
<div class="modal fade" id="addBookingStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Booking Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="bookingStatusForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Payment Status Modal -->
<div class="modal fade" id="addPaymentStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="paymentStatusForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Mapping Modal -->
<div class="modal fade" id="addMappingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Status Mapping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="mappingForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="department" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Booking Status</label>
                        <select class="form-select" name="booking_status_id" required>
                            <option value="">Select Booking Status</option>
                            @foreach($bookingStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status_id" required>
                            <option value="">Select Payment Status</option>
                            @foreach($paymentStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Dependency Modal -->
<div class="modal fade" id="addDependencyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Status Dependency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="dependencyForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="department" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Main Status</label>
                        <select class="form-select" name="booking_status_id" required>
                            <option value="">Select Main Status</option>
                            @foreach($bookingStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dependent Status</label>
                        <select class="form-select" name="dependent_status_id" required>
                            <option value="">Select Dependent Status</option>
                            @foreach($bookingStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Interdependency Modal -->
<div class="modal fade" id="addInterdependencyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Status Interdependency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="interdependencyForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role_id" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Booking Status</label>
                        <select class="form-select" name="booking_status_id" required>
                            <option value="">Select Booking Status</option>
                            @foreach($bookingStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status_id" required>
                            <option value="">Select Payment Status</option>
                            @foreach($paymentStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direction</label>
                        <select class="form-select" name="direction" required>
                            <option value="">Select Direction</option>
                            <option value="booking_to_payment">Booking → Payment</option>
                            <option value="payment_to_booking">Payment → Booking</option>
                            <option value="bidirectional">Bidirectional ↔</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
// Form submissions
document.getElementById('mappingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/status-management/booking-payment-mapping', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Mapping added successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('addMappingModal')).hide();
            location.reload();
        }
    });
});

document.getElementById('dependencyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/status-management/status-dependency', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Dependency added successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('addDependencyModal')).hide();
            location.reload();
        }
    });
});

document.getElementById('paymentStatusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/status-management/payment-status', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Payment status added successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('addPaymentStatusModal')).hide();
            location.reload();
        }
    });
});

// Delete functions
function deleteMapping(id) {
    if (confirm('Delete this mapping?')) {
        fetch(`/status-management/booking-payment-mapping/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Mapping deleted', 'success');
                location.reload();
            }
        });
    }
}

function deleteDependency(id) {
    if (confirm('Delete this dependency?')) {
        fetch(`/status-management/status-dependency/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Dependency deleted', 'success');
                location.reload();
            }
        });
    }
}

function deletePaymentStatus(id) {
    if (confirm('Delete this payment status?')) {
        fetch(`/status-management/payment-status/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Payment status deleted', 'success');
                location.reload();
            }
        });
    }
}

document.getElementById('interdependencyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/masters/status-management/interdependency', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Interdependency added successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('addInterdependencyModal')).hide();
            location.reload();
        }
    });
});

function deleteInterdependency(id) {
    if (confirm('Delete this interdependency?')) {
        fetch(`/masters/status-management/interdependency/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Interdependency deleted', 'success');
                location.reload();
            }
        });
    }
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
    document.querySelector('.container-xxl').insertBefore(alertDiv, document.querySelector('.container-xxl').firstChild);
    setTimeout(() => alertDiv.remove(), 3000);
}
</script>
@endsection