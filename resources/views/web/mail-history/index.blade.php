@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between ">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:shield-check-outline" style="vertical-align: middle; font-size: 14px;"></span>
                Auth History
            </h2>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>

                <li class="lob__breadcrumb-item">
                    <a href="{{ route('booking.show', ['id' => request()->segment(2)]) }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:clipboard-text-outline"></span>
                        Booking
                    </a>
                </li>

                <li class="lob__breadcrumb-item active">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:shield-check-outline"></span>
                    Auth History
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <!-- Auth History Card -->
    <div class="lob-card ">

        <!-- Table Container -->
        <div class="table-container table-2">
            <div class="table-wrapper">
                <div class="table-scroll">

                    <table class="table align-middle compact-table mb-0">
                        <thead class="table-light sticky-header">
                            <tr>
                                <th>ID</th>
                                <th>Auth</th>
                                <th>Sent By</th>
                                <th>Sent To</th>
                                <th>Details</th>
                                <th>Card Last 4</th>
                                <th>Sent Date-Time</th>
                                <th>Status</th>
                                <!-- <th>PDF</th> -->
                                <th>Certificate</th>
                                <!-- <th>Created On</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($auth_histories as $auth_history)
                                @php
                                    $card_details = \App\Models\TravelBillingDetail::find($auth_history->card_billing_id);
                                    $refund_status = $auth_history->refund_status ? "non_refundable" : "refundable";
                                @endphp

                                <tr>
                                    <td>
                                        <a href="{{ route('booking.show', ['id' => encode($auth_history->booking_id)]) }}"
                                           title="{{ $auth_history->booking_id }}"
                                           class="text-primary fw-semibold">
                                            {{ $auth_history->id }}
                                        </a>
                                    </td>

                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#signatureModal"
                                                data-url="{{ url('i_authorized/' . encode($auth_history->booking_id) . '/' . encode($auth_history->card_id) . '/' . encode($auth_history->card_billing_id) . '/' . $refund_status) }}"
                                                >
                                            <span class="iconify" data-icon="mdi:eye-outline"></span>
                                        </button>
                                    </td>

                                    <td>{{ $auth_history->user?->pseudo ?? 'N/A' }}</td>
                                    <td>{{ $auth_history->sent_to ?? 'N/A' }}</td>
                                    <td>{{ $auth_history->details ?? 'N/A' }}</td>

                                    <td>{{ $card_details ? '****' . substr($card_details->cc_number, -4) : 'N/A' }}</td>

                                    <td>{{ $auth_history->created_at->format('d-m-Y H:i:s') }}</td>

                                    <td data-auth-id="{{ $auth_history->id }}">
                                        @if($auth_history->auth_status)
                                            <span class="badge bg-info">{{ ucfirst($auth_history->auth_status) }}</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>

                                    <!-- <td>
                                        <a target="_blank" 
                                           href="{{ route('download-auth-pdf', ['id' => $auth_history->booking_id]) }}"
                                           class="btn btn-primary btn-sm">
                                            <span class="iconify" data-icon="mdi:file-eye-outline"></span>
                                        </a>
                                    </td> -->

                                    <td>
                                        @if($auth_history->auth_status == 'completed')
                                            <a target="_blank"
                                               href="{{ route('zoho-certificate.download', ['requestId' => $auth_history->zoho_document_id]) }}"
                                               class="btn btn-danger btn-sm">
                                                <span class="iconify" data-icon="mdi:download-outline"></span>
                                            </a>
                                        @endif
                                    </td>

                                    <!-- <td>{{ $auth_history->created_at->format('d-m-Y') }}</td> -->
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div> <!-- lob-card -->

</div>


<!-- Signature Modal (Theme Matched) -->
<div class="modal fade lob-modal-premium" id="signatureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2">
                    <span class="iconify fs-4" data-icon="mdi:clipboard-text-search-outline"></span>
                    View Authorization
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="modalContent" style="overflow:auto;">
                Loading...
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // Auto-update Zoho status
    @foreach($auth_histories as $auth_history)
        @if($auth_history->zoho_document_id && $auth_history->auth_status !='completed')
            updateAuthStatus({{ $auth_history->id }});
        @endif
    @endforeach

    // Modal load
    const modal = document.getElementById('signatureModal');
    modal.addEventListener('show.bs.modal', function (e) {
        const url = e.relatedTarget.getAttribute('data-url');
        modalContent.innerHTML = 'Loading...';

        fetch(url)
            .then(res => res.text())
            .then(html => modalContent.innerHTML = html)
            .catch(() => modalContent.innerHTML = 'Error loading content');
    });

});

// Update Status
function updateAuthStatus(id) {
    fetch('{{ route("update-auth-status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ auth_history_id: id })
    })
    .then(res => res.json())
    .then(data => {
        document.querySelector(`td[data-auth-id="${id}"]`).innerHTML =
            `<span class="badge bg-info">${data.status}</span>`;
    })
    .catch(() => {
        document.querySelector(`td[data-auth-id="${id}"]`).innerHTML =
            '<span class="badge bg-secondary">Sent</span>';
    });
}
</script>

@endsection
