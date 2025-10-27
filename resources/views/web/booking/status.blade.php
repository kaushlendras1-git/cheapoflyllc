@php
    $user = auth()->user();
    $userDeptId = $user->department_id;
    $userRole = $user->role_id;
    
    $filterStatuses = function($statuses) use ($userDeptId, $userRole) {
        return $statuses->filter(function($status) use ($userDeptId, $userRole) {
            $deptMatch = $status->departments && in_array((string)$userDeptId, $status->departments);
            $roleMatch = $status->roles && in_array($userRole, $status->roles);
            return $deptMatch && $roleMatch;
        });
    };
    
    $bookingStatuses = $filterStatuses(\App\Models\BookingStatus::where('status', 1)->get());
    $paymentStatuses = $filterStatuses(\App\Models\PaymentStatus::where('status', 1)->get());
@endphp

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect" {{ (auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) ? 'disabled' : '' }}>
                @foreach($bookingStatuses as $status)
                    <option value="{{ $status->id }}" {{ ($booking->booking_status_id == $status->id) || (!$booking->booking_status_id && $status->id == 16) ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @if(auth()->user()->role_id == 1 && $booking->payment_status_id >= 7)
                <input type="hidden" name="booking_status_id" value="{{ $booking->booking_status_id }}">
            @endif
        </div>


        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status</label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect" {{ (auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) ? 'disabled' : '' }}>
                @foreach($paymentStatuses as $status)
                    <option value="{{ $status->id }}" {{ $booking->payment_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @if(auth()->user()->role_id == 1 && $booking->payment_status_id >= 7)
                <input type="hidden" name="payment_status_id" value="{{ $booking->payment_status_id }}">
            @endif
        </div>
