

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status {{ auth()->user()->departments }} - {{ auth()->user()->role }}</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect">
                @if(isset($booking->booking_status_id))
                    <option value="{{ $booking->booking_status_id }}" selected>
                        {{ ucwords(optional($booking->bookingStatus)->name) }}
                    </option>
                @endif

            </select>
        </div>

       

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status 
            </label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect">       
         
           
                @if(isset($booking->payment_status_id))
                    <option value="{{ $booking->payment_status_id }}" selected>
                        {{ ucwords(optional($booking->paymentStatus)->name) }}
                    </option>
                @endif
              
          
            </select>
        </div>

@vite('resources/js/booking/status-manager.js')

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-department" content="{{ auth()->user()->department_id }}">
<meta name="user-role" content="{{ auth()->user()->role_id }}">