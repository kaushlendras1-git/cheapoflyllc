        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status</label>
            <select class="form-control" name="booking_status_id">
                @if(isset($booking->booking_status_id))
                    <option value="{{ $booking->booking_status_id }}" selected>
                        {{ ucwords(optional($booking->bookingStatus)->name . ' - ' . $booking->booking_status_id) }}
                    </option>
                @endif

                @php
                    // Get allowed next statuses based on current status, department, and role
                    $nextStatuses = DB::table('booking_status_dependencies')
                        ->where('booking_status_id', $booking->booking_status_id ?? $currentStatusId)
                        ->where('department', 'Sales')
                        ->where('role', 'User')
                        ->pluck('dependent_status_id')
                        ->toArray();
                @endphp

                @foreach($booking_status as $status)
                    @if(in_array($status->id, $nextStatuses))
                        <option value="{{ $status->id }}">
                            {{ ucwords($status->name . ' - ' . $status->id) }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>


        @php
            $validPaymentStatusIds = DB::table('booking_payment_statuses')
                ->where('booking_status_id', $booking->booking_status_id)
                ->where('department', 'Sales')
                ->where('role','Managers')
                ->pluck('payment_status_id')
                ->toArray();

            $currentPaymentStatus = $booking->payment_status_id
                ? DB::table('payment_statuses')
                    ->where('id', $booking->payment_status_id)
                    ->value('name')
                : null;    
        @endphp

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status 
            </label>
            <select class="form-control" name="payment_status_id">       
            @if($currentPaymentStatus)
                <option value="{{ $booking->payment_status_id }}" selected>
                    {{ ucwords($currentPaymentStatus . ' - ' . $booking->payment_status_id) }}
                </option>
            @endif

            @foreach($payment_status as $payment)
                @if(in_array($payment->id, $validPaymentStatusIds) && $payment->id != $booking->payment_status_id)
                    <option value="{{ $payment->id }}">
                        {{ ucwords($payment->name . ' - ' . $payment->id) }}
                    </option>
                @endif
            @endforeach
            </select>
        </div>