@php
    $user = auth()->user();
    $userDeptId = $user->department_id;
    $userRole = $user->role_id;
    
    if ($userDeptId == 5) {
        $bookingStatuses = \App\Models\BookingStatus::where('status', 1)->get()->filter(function($status) use ($userDeptId) {
            return $status->departments && in_array($userDeptId, $status->departments);
        });
        $paymentStatuses = \App\Models\PaymentStatus::where('status', 1)->get()->filter(function($status) use ($userDeptId) {
            return $status->departments && in_array($userDeptId, $status->departments);
        });
    } else {
        $bookingStatuses = \App\Models\BookingStatus::where('status', 1)->get()->filter(function($status) use ($userDeptId, $userRole) {
            $deptMatch = $status->departments && in_array($userDeptId, $status->departments);
            $roleMatch = $status->roles && in_array($userRole, $status->roles);
            return $deptMatch && $roleMatch;
        });
        $paymentStatuses = \App\Models\PaymentStatus::where('status', 1)->get()->filter(function($status) use ($userDeptId, $userRole) {
            $deptMatch = $status->departments && in_array($userDeptId, $status->departments);
            $roleMatch = $status->roles && in_array($userRole, $status->roles);
            return $deptMatch && $roleMatch;
        });
    }
@endphp



        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect" {{ (auth()->user()->role_id == 1 && auth()->user()->department_id != 5 && $booking->payment_status_id >= 7) ? 'disabled' : '' }} >
                @foreach($bookingStatuses as $status)
                    <option value="{{ $status->id }}" {{ ($booking->booking_status_id == $status->id) || (!$booking->booking_status_id && $status->id == 16) ? 'selected' : '' }}>
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
           
            @if(auth()->user()->role_id == 1 && auth()->user()->department_id != 5 && $booking->payment_status_id >= 7)
                <input type="hidden" name="booking_status_id" value="{{ $booking->booking_status_id }}">
            @endif

        </div>


@php
    $makeReadonly = auth()->user()->role_id == 1
                    && auth()->user()->department_id != 5
                    && $booking->payment_status_id >= 7;
@endphp

<div class="col-md-2 position-relative mb-5">
    <label class="form-label">Payment Status {{ auth()->user()->department_id }}</label>

    <select class="form-control"
            name="payment_status_id"
            id="paymentStatusSelect"
            @disabled($makeReadonly) {{-- Blade will output: disabled="disabled" when true --}}
    >
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

    {{-- Disabled inputs are not submitted, so keep a hidden input to preserve the value --}}
    @if($makeReadonly)
        <input type="hidden" name="payment_status_id" value="{{ $booking->payment_status_id }}">
    @endif
</div>
