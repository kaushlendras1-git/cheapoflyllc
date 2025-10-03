@php
    $user = auth()->user();
    $userDept = $user->departmentRelation->name ?? '';
    $userRole = $user->role_id;
    
    $filterStatuses = function($statuses) use ($userDept, $userRole) {
        return $statuses->filter(function($status) use ($userDept, $userRole) {
            return ($status->departments && in_array($userDept, $status->departments)) || 
                   ($status->roles && in_array($userRole, $status->roles));
        });
    };
    
    $bookingStatuses = $filterStatuses(\App\Models\BookingStatus::where('status', 1)->get());
    $paymentStatuses = $filterStatuses(\App\Models\PaymentStatus::where('status', 1)->get());
@endphp

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect">
                @foreach($bookingStatuses as $status)
                    <option value="{{ $status->id }}" {{ $booking->booking_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
                @if($booking->booking_status_id && !$bookingStatuses->contains('id', $booking->booking_status_id))
                    @php $currentStatus = \App\Models\BookingStatus::find($booking->booking_status_id); @endphp
                    @if($currentStatus)
                        <option value="{{ $currentStatus->id }}" selected>{{ $currentStatus->name }}</option>
                    @endif
                @endif
            </select>
        </div>

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status</label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect">
                @foreach($paymentStatuses as $status)
                    <option value="{{ $status->id }}" {{ $booking->payment_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
                @if($booking->payment_status_id && !$paymentStatuses->contains('id', $booking->payment_status_id))
                    @php $currentStatus = \App\Models\PaymentStatus::find($booking->payment_status_id); @endphp
                    @if($currentStatus)
                        <option value="{{ $currentStatus->id }}" selected>{{ $currentStatus->name }}</option>
                    @endif
                @endif
            </select>
        </div>