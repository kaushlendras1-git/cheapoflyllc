@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
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
      <div class="card p-3 mt-2 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="d-flex align-items-center gap-3 flex-wrap">
            <div class="form-check form-check-inline">
              <input name="chkflight" class="form-check-input" type="checkbox" id="booking-flight" value="1" {{ $callLog->chkflight ? 'checked' : '' }}>
              <label class="form-check-label" for="booking-flight">Flight</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="chkhotel" class="form-check-input" type="checkbox" id="booking-hotel" value="1" {{ $callLog->chkhotel ? 'checked' : '' }}>
              <label class="form-check-label" for="booking-hotel">Hotel</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="chkcruise" class="form-check-input" type="checkbox" id="booking-cruise" value="1" {{ $callLog->chkcruise ? 'checked' : '' }}>
              <label class="form-check-label" for="booking-cruise">Cruise</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="chkcar" class="form-check-input" type="checkbox" id="booking-car" value="1" {{ $callLog->chkcar ? 'checked' : '' }}>
              <label class="form-check-label" for="booking-car">Car</label>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Booking Form Card -->
      <div class="card p-4 mb-4">
        <div class="row mb-3">
          <div class="col-md-3">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $callLog->phone) }}">
            @error('phone')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $callLog->name) }}">
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label">Team <span class="text-danger">*</span></label>
            <select id="team" name="team" class="form-control">
              <option value="" {{ old('selcompany', $callLog->selcompany) == '' ? 'selected' : '' }}>Select</option>
              @foreach($teams as $team)
                <option value="{{ $team->name }}" {{ old('selcompany', $callLog->team) == $team->name ? 'selected' : '' }}>
                  {{ $team->name }}
                </option>
              @endforeach
            </select>
            @error('selcompany')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label">Campaign <span class="text-danger">*</span></label>
            <select id="selcampaign" name="campaign" class="form-control">
              <option value="" {{ old('selcampaign', $callLog->campaign) == '' ? 'selected' : '' }}>Select</option>
              @foreach($campaigns as $campaign)
                <option value="{{ $campaign->name }}" {{ old('selcampaign', $callLog->campaign) == $campaign->name ? 'selected' : '' }}>
                  {{ $campaign->name }}
                </option>
              @endforeach
            </select>
            @error('selcampaign')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="row mb-3">
          <div class="col-md-3">
            <label class="form-label">Reservation Source <span class="text-danger">*</span></label>
            <input type="text" name="reservation_source" class="form-control" value="{{ old('reservation_source', $callLog->reservation_source) }}">
            @error('reservation_source')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label">Call Type <span class="text-danger">*</span></label>
            <select name="call_type" id="call_type" class="form-control">
              <option value="" {{ old('call_type', $callLog->call_type) == '' ? 'selected' : '' }}>Select</option>
              @foreach($call_types as $call_type)
                <option value="{{ $call_type->value }}" {{ old('call_type', $callLog->call_type) == $call_type->value ? 'selected' : '' }}>
                  {{ $call_type->name }}
                </option>
              @endforeach
            </select>
            @error('calltype')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>


          <div class="col-md-3" id="assign" style="{{ !$callLog->assign? 'display: none;' : '' }}">
                  <label for="assign" class="form-label">CallBack Assign For <span class="text-danger">*</span></label>
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

            <div class="col-md-3" id="followup_date" style="display: none;">
                  <label for="followup_date_input" class="form-label">Followup Date <span class="text-danger">*</span></label>
                  <input type="datetime-local" id="followup_date_input" name="followup_date" class="form-control" placeholder="YYYY-MM-DD HH:MM">
            </div>


          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label d-block">Call Converted <span class="text-danger">*</span></label>
              <div>
                <input type="radio" name="call_converted" value="1" {{ old('call_converted', $callLog->call_converted) == '1' ? 'checked' : '' }}>
                <label class="me-2">Yes</label>
                <input type="radio" name="call_converted" value="0" {{ old('call_converted', $callLog->call_converted) == '0' ? 'checked' : '' }}>
                <label>No</label>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $callLog->notes) }}</textarea>
            @error('notes')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!---------------- Start History ---- ------------- --------- ----->

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        
        <div class="col-md-12 p-0 h-100">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h5 class="card-action-title mb-0 d-flex align-items-center">
                                <i class="icon-base ri ri-bar-chart-2-line icon-24px text-body me-3"></i><!--Call Log History-->Conversations
                            </h5>
                            <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                                <span class="icon-base ri ri-information-2-fill icon-22px"></span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-body pt-3">
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="timelineTabs" role="tablist">
        @php
            // Group logs by date (YYYY-MM-DD)
            $groupedLogs = $logs->groupBy(function($log) {
                return $log->updated_at->format('Y-m-d');
            });
            $first = true;
        @endphp
        @foreach($groupedLogs as $date => $logs)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $first ? 'active' : '' }}" id="tab-{{ $date }}" data-bs-toggle="tab" data-bs-target="#content-{{ $date }}" type="button" role="tab" aria-controls="content-{{ $date }}" aria-selected="{{ $first ? 'true' : 'false' }}">
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
            <div class="tab-pane fade {{ $first ? 'show active' : '' }}" id="content-{{ $date }}" role="tabpanel" aria-labelledby="tab-{{ $date }}">
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
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">{{ $log->operation }}</h6>
                                    <small class="text-body-secondary">{{ $log->updated_at }}</small>
                                </div>
                                <p class="mb-2">{{ $log->comment }} @ {{ $log->updated_at->diffForHumans() }}</p>
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div>
                                            <p class="mb-0 small fw-medium">{{ $log->user->name }}</p>
                                            <!-- <small>CEO of ThemeSelection</small> -->
                                        </div>
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
</div>

<!---------------- End History --------------- ----------------- -->

<script>
    // JavaScript to toggle visibility of Follow-Up Date and Call Back Assign fields
    document.getElementById('call_type').addEventListener('change', function () {
        const followupDateDiv = document.getElementById('followup_date');
        const assignDiv = document.getElementById('assign');
       
        if (this.value === 'FollowUp') {
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
                headers: { 'Content-Type': 'application/json; charset=utf-8' }
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
            messages.forEach(({ message }) => appendToast(message, 'success'));
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
