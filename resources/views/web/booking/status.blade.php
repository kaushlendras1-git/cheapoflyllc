

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect">
                @foreach(\App\Models\BookingStatus::where('status', 1)->where(function($q) use ($booking) { $q->whereJsonContains('departments', auth()->user()->department_id)->orWhereJsonContains('roles', auth()->user()->role_id); if($booking->booking_status_id) $q->orWhere('id', $booking->booking_status_id); })->get() as $status)
                    <option value="{{ $status->id }}" {{ $booking->booking_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status</label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect">
                @foreach(\App\Models\PaymentStatus::where('status', 1)->where(function($q) use ($booking) { $q->whereJsonContains('departments', auth()->user()->department_id)->orWhereJsonContains('roles', auth()->user()->role_id); if($booking->payment_status_id) $q->orWhere('id', $booking->payment_status_id); })->get() as $status)
                    <option value="{{ $status->id }}" {{ $booking->payment_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

