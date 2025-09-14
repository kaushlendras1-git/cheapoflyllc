@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Call Logs</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" href="{{ route('call-logs.index') }}">Call Logs</a>
            <a aria-current="page">Edit Call Logs</a>
        </div>
    </div>
    <div class="row gy-6">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('call-logs.update', $callLog->id) }}">
            @csrf
            @method('PUT')

            <!-- Top Bar -->
            <div class="card p-4">
                <div class="ps-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap checkbox-servis">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="form-check form-check-inline">
                                <input name="chkflight" class="form-check-input" type="checkbox" id="booking-flight"
                                    value="1" {{ $callLog->chkflight ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-flight">Flight</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="chkhotel" class="form-check-input" type="checkbox" id="booking-hotel"
                                    value="1" {{ $callLog->chkhotel ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-hotel">Hotel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="chkcruise" class="form-check-input" type="checkbox" id="booking-cruise"
                                    value="1" {{ $callLog->chkcruise ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-cruise">Cruise</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="chkcar" class="form-check-input" type="checkbox" id="booking-car" value="1"
                                    {{ $callLog->chkcar ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-car">Car</label>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" style="padding: 5px; font-size: 12px;"
                                class="btn btn-primary">Update</button>
                        </div>

                    </div>
                    @if ($errors->has('chkflight'))
                    <div class="text-danger mt-2">
                        At least one of Flight, Hotel, Cruise, or Car must be selected.
                    </div>
                    @endif
                </div>

                <!-- Booking Form Card -->
                <div class="pt-5 ps-0">
                    <div class="row booking-form">
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Calling Phone No.  <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $callLog->phone ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $callLog->phone) : '') }}"
                                >
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Name of the Caller <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $callLog->name) }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Campaign <span class="text-danger">*</span></label>
                            <select name="campaign" class="form-control">
                                @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}"
                                    {{ (old('campaign', $callLog->campaign ?? '') == $campaign->id) ? 'selected' : '' }}>
                                    {{ $campaign->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('campaign')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 booking-form">
                        

                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Call Type <span class="text-danger">*</span></label>
                            <select name="call_type" id="call_type" class="form-control">
                                <option value="" {{ old('call_type', $callLog->call_type) == '' ? 'selected' : '' }}>
                                    Select</option>
                                @foreach($call_types as $call_type)
                                <option value="{{ $call_type->id }}"
                                    {{ old('call_type', $callLog->call_type) == $call_type->id ? 'selected' : '' }}>
                                    {{ $call_type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('calltype')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-3 position-relative mb-5" id="assignDiv" 
                        @if($callLog->call_type != 4)
                            style="display: none;" 
                        @endif
                        >
                            <label for="assign" class="form-label">Follow Up<span class="text-danger">*</span></label>
                            <select name="assign" id="assign" class="form-control">
                                <option value="" {{ old('assign') == '' ? 'selected' : '' }}>Select</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $callLog->assign == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('assign')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-3 position-relative mb-5" id="followup_date"  @if($callLog->call_type != 4) style="display: none;"  @endif>
                            <label for="followup_date_input" class="form-label">Followup Date <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" id="followup_date_input" name="followup_date"
                                class="form-control" placeholder="YYYY-MM-DD HH:MM">
                        </div>


                        <div class="col-md-3 position-relative mb-5">
                            <div class="form-group">
                                <label class="form-label d-block none-upper">Call Converted <span
                                        class="text-danger">*</span></label>
                                <div>
                                    <input type="radio" name="call_converted" value="1"
                                        {{ old('call_converted', $callLog->call_converted) == '1' ? 'checked' : '' }}>
                                    <label class="me-2">Yes</label>
                                    <input type="radio" name="call_converted" value="0"
                                        {{ old('call_converted', $callLog->call_converted) == '0' ? 'checked' : '' }}>
                                    <label>No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row booking-form">
                        <div class="col-md-12 position-relative mb-5">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes', $callLog->notes) }}</textarea>
                            @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card card-action mt-4">
        <div class="card-header align-items-center pb-0">
            <div class="d-flex align-items-center justify-content-between w-100">
                <h5 class="card-action-title mb-0 d-flex align-items-center">
                    <i class="icon-base ri ri-bar-chart-2-line icon-24px text-body me-3"></i>
                    <!--Call Log History-->Conversations
                </h5>
                <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                    <span class="icon-base ri ri-information-2-fill icon-22px"></span>
                </button>
            </div>
        </div>
        <div class="card-body pt-3 viwer_seen">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="timelineTabs" role="tablist">
                @php
                // Group logs by date (YYYY-MM-DD)
                $groupedLogs = $logs->groupBy(function($log) {
                return $log->updated_at->format('Y-m-d');
                });
                $first = true;
                @endphp
                @foreach($groupedLogs as $date => $logs)
                <li class="nav-item" role="presentation">
                    <button class="nav-link save-feedback-btn {{ $first ? 'active' : '' }}" id="tab-{{ $date }}"
                        data-bs-toggle="tab" data-bs-target="#content-{{ $date }}" type="button" role="tab"
                        aria-controls="content-{{ $date }}" aria-selected="{{ $first ? 'true' : 'false' }}">
                        {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                    </button>
                </li>
                @php $first = false; @endphp
                @endforeach
            </ul>
            <!-- Tab Content -->
            <div class="tab-content" id="timelineTabContent">
                @php $first = true; @endphp
                @foreach($groupedLogs as $date => $logs)
                <div class="tab-pane fade {{ $first ? 'show active' : '' }}" id="content-{{ $date }}" role="tabpanel"
                    aria-labelledby="tab-{{ $date }}">
                    <ul class="timeline card-timeline mb-0">
                        @foreach($logs as $log)
                        <li class="timeline-item timeline-item-transparent">
                            @if($log->operation == 'created')
                            <span class="timeline-point timeline-point-primary"></span>
                            @elseif($log->operation == 'Viewed')
                            <span class="timeline-point timeline-point-success"></span>
                            @else
                            <span class="timeline-point timeline-point-info"></span>
                            @endif

                            <div class="timeline-event">
                                <div class="viewer-wrapper d-flex align-items-center justify-content-between">
                                    <div class="viewer-left-side">
                                        <div class="avatar avatar-sm me-2 d-flex align-items-center">
                                            <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                class="rounded-circle">
                                            <div class="about-viewer ms-3 pe-5">
                                                <div class="d-flex align-items-center mb-1">
                                                    <p class="mb-0 small user-viewer">{{ $log->user->name }}</p>
                                                    <div class="seprator-name"></div>
                                                    <small class="text-body-secondary"
                                                        style="white-space: nowrap;">{{ $log->updated_at }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0 comment-viewer ms-5"> {{ $log->comment }} @
                                                {{ $log->updated_at->diffForHumans() }} </p>
                                        </div>
                                    </div>
                                    <div class="viewer-right-side">
                                        <h6 class="mb-0">{{ $log->operation }}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @php $first = false; @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>


<!---------------- Start History ---- ------------- --------- ----->


<script>
const phoneInput = document.getElementById("phone");

phoneInput.addEventListener("input", () => {
    // Remove non-digit characters
    let inputValue = phoneInput.value.replace(/\D/g, "");

    // Format as 3-3-4
    if (inputValue.length > 3 && inputValue.length <= 6) {
        inputValue = `${inputValue.slice(0, 3)} ${inputValue.slice(3)}`;
    } else if (inputValue.length > 6) {
        inputValue = `${inputValue.slice(0, 3)} ${inputValue.slice(3, 6)} ${inputValue.slice(6, 10)}`;
    }

    // Limit max digits to 10
    inputValue = inputValue.slice(0, 12); // 3 + 1 space + 3 + 1 space + 4 = 12 chars max

    // Update the input value
    phoneInput.value = inputValue;
});
</script>

<script>
// JavaScript to toggle visibility of Follow-Up Date and Call Back Assign fields
document.getElementById('call_type').addEventListener('change', function() {
    const followupDateDiv = document.getElementById('followup_date');
    const assignDiv = document.getElementById('assignDiv');

    if (this.value == 4 ) {
        followupDateDiv.style.display = 'block'; // Show Follow-Up Date
        assignDiv.style.display = 'block'; // Show Follow-Up Date
    } else {
        followupDateDiv.style.display = 'none'; // Hide Follow-Up Date
        assignDiv.style.display = 'none'; // Hide Follow-Up Date
    }
});
</script>



<script>
document.addEventListener("DOMContentLoaded", () => {
    const toastContainer = document.querySelector('.toast-container');

    async function fetchNotifications(url) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                }
            });
            if (!response.ok) {
                throw new Error(`Error: ${response.statusText}`);
            }
            return await response.json();
        } catch (error) {
            console.error("Fetch error:", error);
            customAlert?.alert(error.message || "An error occurred.");
        }
    }

    function appendToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast show text-white bg-${type}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        toastContainer.appendChild(toast);

        // Remove toast after animation or close button click
        toast.querySelector('.btn-close').addEventListener('click', () => toast.remove());
        setTimeout(() => toast.remove(), 5000); // Auto-remove after 5 seconds
    }

    async function sndnotif() {
        const notifResponse = await fetchNotifications('booking.aspx/sndNotif');
        if (notifResponse?.d) {
            const messages = JSON.parse(notifResponse.d).Table || [];
            messages.forEach(({
                message
            }) => appendToast(message, 'success'));
        }

        const bookingResponse = await fetchNotifications('createbooking.aspx/chkbk');
        if (bookingResponse?.d) {
            const currentCount = parseInt(window.localStorage.getItem('onlinecnt'), 10) || 0;
            const newCount = parseInt(bookingResponse.d, 10);
            if (newCount > currentCount) {
                appendToast('New Online Booking', 'danger');
                window.localStorage.setItem('onlinecnt', newCount);
            } else {
                window.localStorage.setItem('onlinecnt', newCount);
            }
        }
    }

    setInterval(sndnotif, 60000);

    // Show/hide menu items based on conditions
    const pw = 'some_password'; // Replace with the actual logic for 'pw'
    document.querySelectorAll('[data-pw]').forEach(item => {
        if (item.getAttribute('data-pw').includes(pw) ||
            (item.id === 'onlbook' && 'Test Leader' === 'Peter') ||
            (item.id === 'limark' && 'Test Leader' === 'testuser')) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>

@endsection