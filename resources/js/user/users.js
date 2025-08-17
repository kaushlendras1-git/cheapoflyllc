import axios from "axios";
import 'datatables.net';
import 'datatables.net-bs5';
import { route } from 'ziggy-js';

$(document).ready(function () {
    const table = $('#membersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('users.index'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_with_initials', name: 'name', orderable: true, searchable: true },
            { data: 'email', name: 'email' },
            { data: 'departments', name: 'departments' },
            { data: 'pseudo', name: 'pseudo' },
            { data: 'role', name: 'role' },
            { data: 'shift', name: 'currentShift.shift.name' },
            { data: 'team', name: 'currentTeam.team.name' },
            { data: 'status', name: 'status', orderable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
            { data: 'documents', name: 'documents', orderable: false, searchable: false }
        ],
        pageLength: 15,
        responsive: true,
        order: [[0, 'asc']],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
        }
    });

    // Handle status toggle with axios
    $('#membersTable').on('click', '.status-toggle', function () {
        const button = $(this);
        const userId = button.data('id');
        const currentStatus = button.data('status');
        const newStatus = currentStatus == 1 ? 0 : 1;

        axios.post(route('users.change-status', userId), {
            status: newStatus,
            _token: window.Laravel.csrfToken // CSRF token from Blade
        })
        .then(response => {
            if (response.data.success) {
                button.html(response.data.badge);
                button.data('status', response.data.status);
                table.draw(false); // Redraw table without resetting pagination
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Failed to update status.');
        });
    });
});