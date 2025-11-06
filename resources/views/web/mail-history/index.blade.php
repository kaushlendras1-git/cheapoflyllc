@extends('web.layouts.main')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Auth History</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" href="{{ route('booking.show', ['id' => request()->segment(2)]) }}">Booking</a>
            <a class="active" aria-current="page">Auth History</a>
        </div>
    </div>
    
    <div class="col-md-12">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="card p-4">
            <div class="booking-table-wrapper py-2 crm-table">
                <table class="table table-hover table-sm booking-table w-100 mb-0">
                    <thead class="bg-dark text-white sticky-top">
                        <tr>
                            <th>ID</th>
                            <th>Auth</th>
                            <th>Sent By</th>
                            <th>Sent To</th>
                            <th>Details</th>
                            <th>Card last 4 digit</th>
                            <th>Sent Date-Time</th>
                            <th>Auth Status</th>
                            <th>PDF</th>
                            <th>Certificate</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auth_histories as $key => $auth_history)
                            @php
                                $card_details = \App\Models\TravelBillingDetail::where('id', $auth_history->card_billing_id)->first();
                            @endphp

                            <tr>
                                <td>
                                    <a title="{{ $auth_history->booking_id }}" href="{{ route('booking.show', ['id' => encode($auth_history->booking_id)]) }}">
                                        {{ $auth_history->id }}
                                    </a>
                                </td>
                                
                               <td>
                                    @php

                                        if($auth_history->refund_status == 1){
                                            $refund_status = "non_refundable";
                                        }
                                        else{
                                            $refund_status = "refundable";
                                        }
                                    @endphp
                                    <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#signatureModal"
                                            data-url="http://127.0.0.1:8000/i_authorized/{{encode($auth_history->booking_id)}}/{{encode($auth_history->card_id)}}/{{encode($auth_history->card_billing_id)}}/{{$refund_status}}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>

                                <td>{{ $auth_history->user?->name ?? 'N/A' }}</td>
                                <td>{{ $auth_history->sent_to ?? 'N/A' }}</td>
                                <td>{{ $auth_history->details ?? 'N/A' }}</td>
                                <td>{{ '****' . substr($card_details->cc_number ?? '', -4) }}</td>
                                <td>{{ $auth_history->created_at->format('d-m-Y H:i:s') }}</td>
                                
                                <td data-auth-id="{{ $auth_history->id }}">
                                    @if($auth_history->auth_status)
                                        <span class="badge bg-info">{{ ucfirst($auth_history->auth_status) }}</span>
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                              
                                <td>
                                    <a target="_blank" href="{{route('download-auth-pdf',['id'=>$auth_history->booking_id])}}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                  <td>

                                  @if($auth_history->auth_status == 'completed')

                                    <a target="_blank"
                                        href="{{ route('zoho-certificate.download', ['requestId' => $auth_history->zoho_document_id]) }}"
                                        class="btn btn-danger btn-sm"
                                        title="Download Zoho Certificate">
                                            <i class="bi bi-download ms-1"></i>
                                        </a>
                                  @endif      


                                  </td>
                                <td>date</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($auth_histories as $auth_history)
        @if($auth_history->zoho_document_id)
            @if($auth_history->auth_status !='completed')
                updateAuthStatus({{ $auth_history->id }});
            @endif    
        @endif
    @endforeach
});

function updateAuthStatus(authHistoryId) {
    console.log('Updating status for auth history ID:', authHistoryId);
    
    fetch('{{ route("update-auth-status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            auth_history_id: authHistoryId
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success response:', data);
        const statusCell = document.querySelector(`td[data-auth-id="${authHistoryId}"]`);
        statusCell.innerHTML = `<span class="badge bg-info">${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</span>`;
    })
    .catch(error => {
        console.log('Error:', error);
        const statusCell = document.querySelector(`td[data-auth-id="${authHistoryId}"]`);
        statusCell.innerHTML = '<span class="badge bg-secondary">Sent</span>';
    });
}
</script>





<div class="modal fade" id="signatureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalContent" style="overflow: scroll">
                Loading...
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('signatureModal');
    const modalContent = modal.querySelector('#modalContent');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        modalContent.innerHTML = 'Loading...';

        fetch(url)
            .then(response => response.text())
            .then(html => {
                modalContent.innerHTML = html;
            })
            .catch(error => {
                modalContent.innerHTML = 'Error loading content';
                console.error(error);
            });
    });

    modal.addEventListener('hidden.bs.modal', function () {
        modalContent.innerHTML = '';
    });
});
</script>



@endsection