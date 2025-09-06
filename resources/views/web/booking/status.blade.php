

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Booking Status {{ auth()->user()->departments }} - {{ auth()->user()->role }}</label>
            <select class="form-control" name="booking_status_id" id="bookingStatusSelect">
                @if(isset($booking->booking_status_id))
                    <option value="{{ $booking->booking_status_id }}" selected>
                        {{ ucwords(optional($booking->bookingStatus)->name . ' - ' . $booking->booking_status_id) }}
                    </option>
                @endif

            @if(auth()->user()->departments != 'Admin')    
                @php
                    // Get allowed next statuses based on current status, department, and role
                    $nextStatuses = DB::table('booking_status_dependencies')
                        ->where('booking_status_id', $booking->booking_status_id ?? $currentStatusId)
                        ->where('department', auth()->user()->departments)
                        ->where('role', auth()->user()->role)
                        ->pluck('dependent_status_id')
                        ->toArray();
                @endphp

                //Managers

                @foreach($booking_status as $status)
                    @php
                        $statusDepartments = is_array($status->departments) ? $status->departments : json_decode($status->departments ?? '[]', true);
                        $statusRoles = is_array($status->roles) ? $status->roles : json_decode($status->roles ?? '[]', true);
                        $hasAccess = (empty($statusDepartments) || in_array(auth()->user()->departments, $statusDepartments)) && 
                                    (empty($statusRoles) || in_array(auth()->user()->role, $statusRoles));
                    @endphp
                    @if(in_array($status->id, $nextStatuses) && $hasAccess)
                        <option value="{{ $status->id }}">
                            {{ ucwords($status->name . ' - ' . $status->id) }}
                        </option>
                    @endif
                @endforeach
            @else
                 @foreach($booking_status as $status)
                    @php
                        $statusDepartments = is_array($status->departments) ? $status->departments : json_decode($status->departments ?? '[]', true);
                        $statusRoles = is_array($status->roles) ? $status->roles : json_decode($status->roles ?? '[]', true);
                        $hasAccess = (empty($statusDepartments) || in_array(auth()->user()->departments, $statusDepartments)) && 
                                    (empty($statusRoles) || in_array(auth()->user()->role, $statusRoles));
                    @endphp
                    @if($hasAccess)
                        <option value="{{ $status->id }}">
                            {{ ucwords($status->name . ' - ' . $status->id) }}
                        </option>
                    @endif
                @endforeach
            @endif

            </select>
        </div>


        @php
            $currentPaymentStatus = $booking->payment_status_id
                ? DB::table('payment_statuses')
                    ->where('id', $booking->payment_status_id)
                    ->value('name')
                : null;    
        @endphp

        <div class="col-md-2 position-relative mb-5">
            <label class="form-label">Payment Status 
            </label>
            <select class="form-control" name="payment_status_id" id="paymentStatusSelect">       
            @if($currentPaymentStatus)
                <option value="{{ $booking->payment_status_id }}" selected>
                    {{ ucwords($currentPaymentStatus . ' - ' . $booking->payment_status_id) }}
                </option>
            @endif
            </select>
        </div>

@vite('resources/js/booking/status-manager.js')

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-department" content="{{ auth()->user()->departments }}">
<meta name="user-role" content="{{ auth()->user()->role }}">