

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect">
                @php
                    $allowedBookingStatuses = \App\Models\BookingPaymentStatus::where('department', auth()->user()->department_id)
                        ->where('role', auth()->user()->role_id)
                        ->pluck('booking_status_id')
                        ->toArray();
                    
                    $bookingDependencies = \App\Models\BookingStatusDependency::where('department', auth()->user()->department_id)
                        ->where('role', auth()->user()->role_id)
                        ->pluck('booking_status_id')
                        ->toArray();
                    
                    $availableBookingStatuses = array_unique(array_merge($allowedBookingStatuses, $bookingDependencies));
                    
                    // Always include current booking status
                    if ($booking->booking_status_id) {
                        $availableBookingStatuses[] = $booking->booking_status_id;
                        $availableBookingStatuses = array_unique($availableBookingStatuses);
                    }
                    
                    if (empty($availableBookingStatuses)) {
                        $availableBookingStatuses = \App\Models\BookingStatus::where('status', 1)->pluck('id')->toArray();
                    }
                @endphp
                @foreach(\App\Models\BookingStatus::where('status', 1)->whereIn('id', $availableBookingStatuses)->get() as $status)
                    <option value="{{ $status->id }}" {{ $booking->booking_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status</label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect">
                @php
                    $allowedPaymentStatuses = \App\Models\BookingPaymentStatus::where('department', auth()->user()->department_id)
                        ->where('role', auth()->user()->role_id)
                        ->pluck('payment_status_id')
                        ->toArray();
                    
                    // Always include current payment status
                    if ($booking->payment_status_id) {
                        $allowedPaymentStatuses[] = $booking->payment_status_id;
                        $allowedPaymentStatuses = array_unique($allowedPaymentStatuses);
                    }
                    
                    if (empty($allowedPaymentStatuses)) {
                        $allowedPaymentStatuses = \App\Models\PaymentStatus::where('status', 1)->pluck('id')->toArray();
                    }
                @endphp
                @foreach(\App\Models\PaymentStatus::where('status', 1)->whereIn('id', $allowedPaymentStatuses)->get() as $status)
                    <option value="{{ $status->id }}" {{ $booking->payment_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

