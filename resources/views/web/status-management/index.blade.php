@extends('web.layouts.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Status Management</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Status Management</a>
        </div>
    </div>

    <div class="row">
        <!-- Booking-Payment Status Mappings -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Status Mappings</h5>
                        <div class="btn-group btn-group-sm mt-1" role="group">
                            <input type="radio" class="btn-check" name="mappingType" id="bookingFirst" value="booking" checked>
                            <label class="btn btn-outline-primary" for="bookingFirst">Booking → Payment</label>
                            <input type="radio" class="btn-check" name="mappingType" id="paymentFirst" value="payment">
                            <label class="btn btn-outline-primary" for="paymentFirst">Payment → Booking</label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMappingModal">
                        Add Mapping
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Booking Status</th>
                                    <th>Payment Status</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="mappingTableBody">
                                @foreach($bookingPaymentMappings as $mapping)
                                <tr>
                                    <td class="booking-col">{{ $mapping->bookingStatus->name }}</td>
                                    <td class="payment-col">{{ $mapping->paymentStatus->name }}</td>
                                    <td><span class="badge bg-info"> {{ $mapping->departmentRelation?->name ?? 'N/A' }}</span></td>
                                    <td><span class="badge bg-primary"> {{ $mapping->roleRelation?->name ?? 'N/A' }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteMapping({{ $mapping->id }})">
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

        <!-- Booking Status Dependencies -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Booking Dependencies</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDependencyModal">
                        Add Dependency
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
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
                                    <td><span class="badge bg-info"> {{ $dependency->departmentRelation?->name ?? 'N/A' }}</span></td>
                                    <td><span class="badge bg-primary">{{ $dependency->roleRelation?->name }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteDependency({{ $dependency->id }})">
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

<!-- Add Mapping Modal -->
<div class="modal fade" id="addMappingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Booking-Payment Mapping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addMappingForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select class="form-select" name="department" id="mappingDepartment" required>
                                    <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" id="mappingRole" required>
                                    <option value="">Select Role</option>
                                      @foreach($roles as $role)
                                         <option value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="bookingFirstForm">
                        <div class="mb-3">
                            <label class="form-label">Booking Status</label>
                            <select class="form-select" name="booking_status_id" id="mappingBookingStatus" required>
                                <option value="">Select Booking Status</option>
                                @foreach($bookingStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Statuses</label>
                            <div id="paymentStatusCheckboxes" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($paymentStatuses as $status)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="payment_status_ids[]" value="{{ $status->id }}" id="payment_{{ $status->id }}">
                                    <label class="form-check-label" for="payment_{{ $status->id }}">
                                        {{ $status->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="paymentFirstForm" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select class="form-select" name="payment_status_id" id="mappingPaymentStatus">
                                <option value="">Select Payment Status</option>
                                @foreach($paymentStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Booking Statuses</label>
                            <div id="bookingStatusCheckboxes" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($bookingStatuses as $status)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="booking_status_ids[]" value="{{ $status->id }}" id="booking_{{ $status->id }}">
                                    <label class="form-check-label" for="booking_{{ $status->id }}">
                                        {{ $status->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Mappings</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add Dependency Modal -->
<div class="modal fade" id="addDependencyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Status Dependency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addDependencyForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select class="form-select" name="department" id="dependencyDepartment" required>
                                    <option value="">Select Department</option>
                                      @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" id="dependencyRole" required>
                                    <option value="">Select Role</option>
                                 @foreach($roles as $role)
                                   <option value="{{ $role->id }}">{{ $role->name }}</option>
                                 @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Main Booking Status</label>
                        <select class="form-select" name="booking_status_id" id="dependencyMainStatus" required>
                            <option value="">Select Main Status</option>
                            @foreach($bookingStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dependent Statuses</label>
                        <div id="dependentStatusCheckboxes" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                            @foreach($bookingStatuses as $status)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dependent_status_ids[]" value="{{ $status->id }}" id="dependent_{{ $status->id }}">
                                <label class="form-check-label" for="dependent_{{ $status->id }}">
                                    {{ $status->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Dependencies</button>
                </div>
            </form>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
// Existing mappings and dependencies data
const existingMappings = @json($bookingPaymentMappings->groupBy(function($item) {
    return $item->department . '|' . $item->role . '|' . $item->booking_status_id;
})->map(function($group) {
    return $group->pluck('payment_status_id')->toArray();
}));

const existingDependencies = @json($statusDependencies->groupBy(function($item) {
    return $item->department . '|' . $item->role . '|' . $item->booking_status_id;
})->map(function($group) {
    return $group->pluck('dependent_status_id')->toArray();
}));

// Update checkboxes when mapping form changes
function updateMappingCheckboxes() {
    const department = document.getElementById('mappingDepartment').value;
    const role = document.getElementById('mappingRole').value;
    const bookingStatusId = document.getElementById('mappingBookingStatus').value;
    
    const container = document.getElementById('paymentStatusCheckboxes');
    const checkboxes = Array.from(container.children);
    
    // Clear all checkboxes first
    checkboxes.forEach(div => {
        const cb = div.querySelector('input');
        cb.checked = false;
    });
    
    if (department && role && bookingStatusId) {
        const key = `${department}|${role}|${bookingStatusId}`;
        const existingPaymentIds = existingMappings[key] || [];
        
        existingPaymentIds.forEach(paymentId => {
            const checkbox = document.getElementById(`payment_${paymentId}`);
            if (checkbox) checkbox.checked = true;
        });
    }
    
    // Sort: checked items first
    checkboxes.sort((a, b) => {
        const aChecked = a.querySelector('input').checked;
        const bChecked = b.querySelector('input').checked;
        return bChecked - aChecked;
    });
    
    checkboxes.forEach(div => container.appendChild(div));
}

// Update checkboxes when dependency form changes
function updateDependencyCheckboxes() {
    const department = document.getElementById('dependencyDepartment').value;
    const role = document.getElementById('dependencyRole').value;
    const bookingStatusId = document.getElementById('dependencyMainStatus').value;
    
    const container = document.getElementById('dependentStatusCheckboxes');
    const checkboxes = Array.from(container.children);
    
    // Clear all checkboxes first
    checkboxes.forEach(div => {
        const cb = div.querySelector('input');
        cb.checked = false;
    });
    
    if (department && role && bookingStatusId) {
        const key = `${department}|${role}|${bookingStatusId}`;
        const existingDependentIds = existingDependencies[key] || [];
        
        existingDependentIds.forEach(dependentId => {
            const checkbox = document.getElementById(`dependent_${dependentId}`);
            if (checkbox) checkbox.checked = true;
        });
    }
    
    // Sort: checked items first
    checkboxes.sort((a, b) => {
        const aChecked = a.querySelector('input').checked;
        const bChecked = b.querySelector('input').checked;
        return bChecked - aChecked;
    });
    
    checkboxes.forEach(div => container.appendChild(div));
}

// Toggle between mapping types
document.querySelectorAll('input[name="mappingType"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const isBookingFirst = this.value === 'booking';
        document.getElementById('bookingFirstForm').style.display = isBookingFirst ? 'block' : 'none';
        document.getElementById('paymentFirstForm').style.display = isBookingFirst ? 'none' : 'block';
        
        // Update table headers
        const headers = document.querySelectorAll('#mappingTableBody').parentElement.previousElementSibling.children[0].children;
        if (isBookingFirst) {
            headers[0].textContent = 'Booking Status';
            headers[1].textContent = 'Payment Status';
        } else {
            headers[0].textContent = 'Payment Status';
            headers[1].textContent = 'Booking Status';
        }
        
        // Swap table data
        document.querySelectorAll('#mappingTableBody tr').forEach(row => {
            const bookingCol = row.querySelector('.booking-col');
            const paymentCol = row.querySelector('.payment-col');
            if (!isBookingFirst) {
                const temp = bookingCol.textContent;
                bookingCol.textContent = paymentCol.textContent;
                paymentCol.textContent = temp;
            }
        });
    });
});

// Update checkboxes when payment mapping form changes
function updatePaymentMappingCheckboxes() {
    const department = document.getElementById('mappingDepartment').value;
    const role = document.getElementById('mappingRole').value;
    const paymentStatusId = document.getElementById('mappingPaymentStatus').value;
    
    const container = document.getElementById('bookingStatusCheckboxes');
    const checkboxes = Array.from(container.children);
    
    // Clear all checkboxes first
    checkboxes.forEach(div => {
        const cb = div.querySelector('input');
        cb.checked = false;
    });
    
    if (department && role && paymentStatusId) {
        // Find existing mappings for this payment status
        const existingBookingIds = [];
        Object.keys(existingMappings).forEach(key => {
            const [dept, roleKey, bookingId] = key.split('|');
            if (dept === department && roleKey === role) {
                const paymentIds = existingMappings[key];
                if (paymentIds.includes(parseInt(paymentStatusId))) {
                    existingBookingIds.push(parseInt(bookingId));
                }
            }
        });
        
        existingBookingIds.forEach(bookingId => {
            const checkbox = document.getElementById(`booking_${bookingId}`);
            if (checkbox) checkbox.checked = true;
        });
    }
    
    // Sort: checked items first
    checkboxes.sort((a, b) => {
        const aChecked = a.querySelector('input').checked;
        const bChecked = b.querySelector('input').checked;
        return bChecked - aChecked;
    });
    
    checkboxes.forEach(div => container.appendChild(div));
}

// Add event listeners
document.getElementById('mappingDepartment').addEventListener('change', function() {
    if (document.getElementById('bookingFirst').checked) {
        updateMappingCheckboxes();
    } else {
        updatePaymentMappingCheckboxes();
    }
});

document.getElementById('mappingRole').addEventListener('change', function() {
    if (document.getElementById('bookingFirst').checked) {
        updateMappingCheckboxes();
    } else {
        updatePaymentMappingCheckboxes();
    }
});

document.getElementById('mappingBookingStatus').addEventListener('change', updateMappingCheckboxes);
document.getElementById('mappingPaymentStatus').addEventListener('change', updatePaymentMappingCheckboxes);

document.getElementById('dependencyDepartment').addEventListener('change', updateDependencyCheckboxes);
document.getElementById('dependencyRole').addEventListener('change', updateDependencyCheckboxes);
document.getElementById('dependencyMainStatus').addEventListener('change', updateDependencyCheckboxes);

// Sort checkboxes on checkbox change
document.addEventListener('change', function(e) {
    if (e.target.name === 'payment_status_ids[]') {
        const container = document.getElementById('paymentStatusCheckboxes');
        const checkboxes = Array.from(container.children);
        checkboxes.sort((a, b) => {
            const aChecked = a.querySelector('input').checked;
            const bChecked = b.querySelector('input').checked;
            return bChecked - aChecked;
        });
        checkboxes.forEach(div => container.appendChild(div));
    }
    
    if (e.target.name === 'booking_status_ids[]') {
        const container = document.getElementById('bookingStatusCheckboxes');
        const checkboxes = Array.from(container.children);
        checkboxes.sort((a, b) => {
            const aChecked = a.querySelector('input').checked;
            const bChecked = b.querySelector('input').checked;
            return bChecked - aChecked;
        });
        checkboxes.forEach(div => container.appendChild(div));
    }
    
    if (e.target.name === 'dependent_status_ids[]') {
        const container = document.getElementById('dependentStatusCheckboxes');
        const checkboxes = Array.from(container.children);
        checkboxes.sort((a, b) => {
            const aChecked = a.querySelector('input').checked;
            const bChecked = b.querySelector('input').checked;
            return bChecked - aChecked;
        });
        checkboxes.forEach(div => container.appendChild(div));
    }
});

// Add Mapping
document.getElementById('addMappingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Form submitted');
    
    const formData = new FormData(this);
    const isBookingFirst = document.getElementById('bookingFirst').checked;
    
    console.log('Is booking first:', isBookingFirst);
    
    let checkedStatuses, mainStatusId, department, role;
    
    department = formData.get('department');
    role = formData.get('role');
    
    console.log('Department:', department, 'Role:', role);
    
    if (!department || !role) {
        showAlert('Please select department and role', 'warning');
        return;
    }
    
    if (isBookingFirst) {
        checkedStatuses = Array.from(document.querySelectorAll('input[name="payment_status_ids[]"]:checked')).map(cb => cb.value);
        mainStatusId = formData.get('booking_status_id');
        console.log('Booking status ID:', mainStatusId, 'Payment statuses:', checkedStatuses);
        
        if (!mainStatusId) {
            showAlert('Please select a booking status', 'warning');
            return;
        }
        if (checkedStatuses.length === 0) {
            showAlert('Please select at least one payment status', 'warning');
            return;
        }
    } else {
        checkedStatuses = Array.from(document.querySelectorAll('input[name="booking_status_ids[]"]:checked')).map(cb => cb.value);
        mainStatusId = formData.get('payment_status_id');
        console.log('Payment status ID:', mainStatusId, 'Booking statuses:', checkedStatuses);
        
        if (!mainStatusId) {
            showAlert('Please select a payment status', 'warning');
            return;
        }
        if (checkedStatuses.length === 0) {
            showAlert('Please select at least one booking status', 'warning');
            return;
        }
    }
    
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        console.log('CSRF Token:', csrfToken);
        
        for (const statusId of checkedStatuses) {
            const mappingData = new FormData();
            mappingData.append('department', department);
            mappingData.append('role', role);
            
            if (isBookingFirst) {
                mappingData.append('booking_status_id', mainStatusId);
                mappingData.append('payment_status_id', statusId);
            } else {
                mappingData.append('booking_status_id', statusId);
                mappingData.append('payment_status_id', mainStatusId);
            }
            
            console.log('Sending mapping:', Object.fromEntries(mappingData));
            
            const response = await fetch('/status-management/booking-payment-mapping', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: mappingData
            });
            
            console.log('Response status:', response.status);
            const responseData = await response.json();
            console.log('Response data:', responseData);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
        }
        
        showAlert('Mappings added successfully', 'success');
        bootstrap.Modal.getInstance(document.getElementById('addMappingModal')).hide();
        this.reset();
        setTimeout(() => location.reload(), 1000);
    } catch (error) {
        console.error('Error:', error);
        showAlert('Error adding mappings: ' + error.message, 'danger');
    }
});

// Add Dependency
document.getElementById('addDependencyForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const checkedDependentStatuses = Array.from(document.querySelectorAll('input[name="dependent_status_ids[]"]:checked')).map(cb => cb.value);
    
    if (checkedDependentStatuses.length === 0) {
        showAlert('Please select at least one dependent status', 'warning');
        return;
    }
    
    const department = formData.get('department');
    const role = formData.get('role');
    const bookingStatusId = formData.get('booking_status_id');
    
    try {
        for (const dependentStatusId of checkedDependentStatuses) {
            if (dependentStatusId === bookingStatusId) continue; // Skip same status
            
            const dependencyData = new FormData();
            dependencyData.append('department', department);
            dependencyData.append('role', role);
            dependencyData.append('booking_status_id', bookingStatusId);
            dependencyData.append('dependent_status_id', dependentStatusId);
            
            await fetch('/status-management/status-dependency', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: dependencyData
            });
        }
        
        showAlert('Dependencies added successfully', 'success');
        bootstrap.Modal.getInstance(document.getElementById('addDependencyModal')).hide();
        this.reset();
        setTimeout(() => location.reload(), 1000);
    } catch (error) {
        showAlert('Error adding dependencies', 'danger');
    }
});

// Delete Functions
function deleteMapping(id) {
    if (!confirm('Are you sure you want to delete this mapping?')) return;
    
    fetch(`/status-management/booking-payment-mapping/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        }
    });
}

function deleteDependency(id) {
    if (!confirm('Are you sure you want to delete this dependency?')) return;
    
    fetch(`/status-management/status-dependency/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        }
    });
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