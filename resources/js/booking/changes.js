import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';
import {route} from "ziggy-js";

document.addEventListener('DOMContentLoaded', function() {
    const changesTableBody = document.querySelector('#changes tbody');
    const bookingId = window.bookingId || document.querySelector('[data-booking-id]')?.dataset.bookingId;

    // Load existing changes on page load
    loadChanges();

    // Handle button click
    const submitBtn = document.getElementById('submitChangeBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', function() {
            submitChange();
        });
    }

    function submitChange() {
       
        const formData = {
            booking_id: bookingId,
            amount: document.getElementById('amount')?.value.trim() || '',
            description: document.getElementById('description')?.value.trim() || '',
            remarks: document.getElementById('changes_remarks')?.value || '',
            progress_status: document.getElementById('progress_status')?.value || ''
        };
        
        console.log('Form data being sent:', formData);

        axios.post('/api/travel-changes', formData)
        .then(response => {
            if (response.data.status === 'success') {
                // Clear form
                document.getElementById('amount').value = '';
                document.getElementById('description').value = '';
                document.getElementById('changes_remarks').value = '';
                document.getElementById('progress_status').value = '';
                
                // Add new change to table without reload
                addChangeToTable(response.data.change);
                
                // Show success message from server
                showToast(response.data.message, 'success');
            } else {
                showToast(response.data.message || 'Error adding change', 'error');
            }
        })
        .catch(error => {
            if (error.response && error.response.data && error.response.data.error) {
                showToast(error.response.data.error, 'error');
            } else {
                showToast('Error adding change', 'error');
            }
        });
    }

    function loadChanges() {
        if (!bookingId) return;

        axios.get(`/api/travel-changes/${bookingId}`)
        .then(response => {
            displayChanges(response.data.changes || []);
        })
        .catch(error => {
            console.error('Error loading changes:', error);
        });
    }

    function displayChanges(changes) {
        if (!changesTableBody) return;

        changesTableBody.innerHTML = '';
        
        if (changes.length === 0) {
            changesTableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No changes recorded yet</td></tr>';
            return;
        }

        changes.forEach((change, index) => {
            const statusBadge = getStatusBadge(change.progress_status);
            const row = `
                <tr data-id="${change.id}">
                    <td>${index + 1}</td>
                    <td>${statusBadge}</td>
                    <td>${change.amount ? '$' + change.amount : ''} ${change.description ? '/ ' + change.description : ''}</td>
                    <td>${change.remarks || '-'}</td>
                    <td>${change.user ? change.user.name : 'Unknown'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-change" data-id="${change.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-change" data-id="${change.id}">Delete</button>
                    </td>
                </tr>
            `;
            changesTableBody.innerHTML += row;
        });
    }

    function getStatusBadge(status) {
        const badges = {
            'pending': '<span class="badge bg-warning text-dark">Pending with Agent</span>',
            'in_progress': '<span class="badge bg-info text-dark">Under Follow-Up</span>',
            'completed': '<span class="badge bg-primary text-white">Pending with Airlines/Cruises</span>',
            'under_review': '<span class="badge bg-success text-white">Closed</span>'
        };
        return badges[status] || '<span class="badge bg-secondary">Unknown</span>';
    }

    function addChangeToTable(change) {
        const tbody = changesTableBody;
        if (!tbody) return;
        
        // Remove "no changes" message if it exists
        const noDataRow = tbody.querySelector('td[colspan="6"]');
        if (noDataRow) {
            noDataRow.parentElement.remove();
        }
        
        // Get current row count for serial number
        const currentRows = tbody.querySelectorAll('tr').length;
        const statusBadge = getStatusBadge(change.progress_status);
        
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-id', change.id);
        newRow.innerHTML = `
            <td>${currentRows + 1}</td>
            <td>${statusBadge}</td>
            <td>${change.amount ? '$' + change.amount : ''} ${change.description ? '/ ' + change.description : ''}</td>
            <td>${change.remarks || '-'}</td>
            <td>${change.user ? change.user.name : 'Unknown'}</td>
            <td>
                <button class="btn btn-sm btn-primary edit-change" data-id="${change.id}">Edit</button>
                <button class="btn btn-sm btn-danger delete-change" data-id="${change.id}">Delete</button>
            </td>
        `;
        
        // Add to top of table
        tbody.insertBefore(newRow, tbody.firstChild);
        
        // Update serial numbers
        updateSerialNumbers();
    }
    
    function updateSerialNumbers() {
        const rows = changesTableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            const firstCell = row.querySelector('td:first-child');
            if (firstCell && !firstCell.hasAttribute('colspan')) {
                firstCell.textContent = index + 1;
            }
        });
    }

    // Event listeners for edit and delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-change')) {
            const changeId = e.target.getAttribute('data-id');
            editChange(changeId);
        }
        
        if (e.target.classList.contains('delete-change')) {
            const changeId = e.target.getAttribute('data-id');
            deleteChange(changeId);
        }
    });
    
    // Update change button
    document.getElementById('updateChangeBtn').addEventListener('click', updateChange);
    
    function editChange(changeId) {
        // Find change data from current table
        const row = document.querySelector(`tr[data-id="${changeId}"]`);
        if (!row) return;
        
        // Get change data from API
        axios.get(`/api/travel-changes/single/${changeId}`)
        .then(response => {
            const change = response.data.change;
            document.getElementById('editChangeId').value = change.id;
            document.getElementById('editAmount').value = change.amount || '';
            document.getElementById('editDescription').value = change.description || '';
            document.getElementById('editRemarks').value = change.remarks || '';
            document.getElementById('editProgressStatus').value = change.progress_status || '';
            
            // Show modal
            new bootstrap.Modal(document.getElementById('editChangeModal')).show();
        })
        .catch(error => {
            console.error('Error loading change:', error);
            showToast('Error loading change data', 'error');
        });
    }
    
    function updateChange() {
        const changeId = document.getElementById('editChangeId').value;
        const formData = {
            amount: document.getElementById('editAmount').value.trim(),
            description: document.getElementById('editDescription').value,
            remarks: document.getElementById('editRemarks').value.trim(),
            progress_status: document.getElementById('editProgressStatus').value
        };
        
        axios.put(`/api/travel-changes/${changeId}`, formData)
        .then(response => {
            if (response.data.status === 'success') {
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('editChangeModal')).hide();
                
                // Reload changes
                loadChanges();
                
                showToast(response.data.message, 'success');
            } else {
                showToast(response.data.message || 'Error updating change', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.response && error.response.data && error.response.data.error) {
                showToast(error.response.data.error, 'error');
            } else {
                showToast('Error updating change', 'error');
            }
        });
    }
    
    function deleteChange(changeId) {
        if (!confirm('Are you sure you want to delete this change?')) {
            return;
        }
        
        axios.delete(`/api/travel-changes/${changeId}`)
        .then(response => {
            if (response.data.status === 'success') {
                // Remove row from table
                const row = document.querySelector(`tr[data-id="${changeId}"]`);
                if (row) {
                    row.remove();
                    updateSerialNumbers();
                }
                
                showToast(response.data.message, 'success');
            } else {
                showToast(response.data.message || 'Error deleting change', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.response && error.response.data && error.response.data.error) {
                showToast(error.response.data.error, 'error');
            } else {
                showToast('Error deleting change', 'error');
            }
        });
    }
    
    // showToast is now imported from toast.js
});