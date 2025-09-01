@extends('web.layouts.main')
@section('content')
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        <!-- Display success message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card p-4">
            <!-- Table -->
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
                            <th>Received Status</th>
                            <th>IP</th>
                            <th>Action</th>
                            <th>Type</th>
                            <th>PDF</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auth_histories as $key=>$auth_history)
                            @php

                                $signature = \App\Models\Signature::where('booking_id', $auth_history->booking_id)
                                    ->where('card_id', $auth_history->card_id)
                                    ->where('card_billing_id', $auth_history->card_billing_id)
                                    ->where('refund_status', $auth_history->refund_status)
                                    ->first();

                                $card_deatils =  \App\Models\TravelBillingDetail::
                                      where('booking_id', 3)
                                     ->where('state', 30)
                                     ->where('id', 2)
                                     ->first();




                            @endphp

                            <tr>
                                <td><a title="{{ $auth_history->booking_id }}" href="{{ route('booking.show', ['id' => encode($auth_history->booking_id)]) }}">
                                    {{ $auth_history->id }}</a>
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
{{--                                <td>{{ '****' . substr($card_deatils->cc_number ?? '',  -4) }}</td>--}}
                                <td>{{ !empty($auth_history->travel_billing_details)?'****'.substr($auth_history->travel_billing_details->cc_number,-4):'****' }}</td>

                                <td>{{ $auth_history->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    @if($signature)
                                        <span class="badge bg-success">Auth Received</span>
                                    @else
                                        <span class="badge bg-danger">No Auth Received</span>
                                    @endif
                                </td>
                                <td>{{ $signature?->ip_address ?? 'N/A' }}</td>
                                <td>
                                    @if($signature?->signature)
                                        {{ ucfirst($signature->signature_type) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($signature?->signature_data)
                                     <button class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#signatureModal{{ $auth_history->id }}"
                                                aria-label="View Signature">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled><i class="bi bi-x-circle"></i></button>
                                    @endif
                                </td>
                                <td>
                                    <a target="_blank" href="{{route('download-auth-pdf',['id'=>$auth_history->booking_id])}}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $signature?->created_at?->format('d-m-Y H:i:s') ?? 'N/A' }}</td>
                            </tr>

                            @if($signature)
                                <div class="modal fade" id="signatureModal{{ $auth_history->id }}" tabindex="-1" aria-labelledby="signatureModalLabel{{ $auth_history->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="signatureModalLabel{{ $auth_history->id }}">Signature Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if(str_starts_with($signature->signature_data, 'data:image'))
                                                    <img src="{{ $signature->signature_data }}" alt="Signature" class="img-fluid rounded border">
                                                @else
                                                    {!! $signature->signature_data !!}
                                                @endif
                                                <p class="mt-3">
                                                    <strong>Signature Type:</strong> {{ ucfirst($signature->signature_type) }} <br>
                                                    <strong>IP Address:</strong> {{ $signature->ip_address ?? 'N/A' }} <br>
                                                    <strong>Created On:</strong> {{ $signature->created_at?->format('d-m-Y H:i:s') ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!--/ Content -->


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




<!-- Custom Styles -->
<style>

.dark-header {
    background-color: #312d4b;
    color: #fff;
    border-radius: 0.5rem;
}

.dark-header .form-control,
.dark-header .form-select {
    background-color: #fff;
    color: #000;
    border: 1px solid #ced4da;
}

.dark-header .form-label {
    color: #fff;
}

.dark-header .form-control::placeholder {
    color: #666;
}

.dark-header .btn-warning {
    color: #000;
}

.table td,
.table th {
    font-size: 0.75rem;
}
</style>
@endsection
