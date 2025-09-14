@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Create Call Logs</h2>
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('call-logs.index') }}" class="active">Call Logs</a>
                <a href="javascript:void(0);">Create Call Logs</a>
            </div>
    </div>
    <div class="row">

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
        <div class="card p-4 create-booking-wrapper">
            <form id="callLogsForm" method="POST" action="{{ route('call-logs.store') }}">
                @csrf
                <!-- Top Bar -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap checkbox-servis">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="form-check form-check-inline position-relative">
                                <input name="chkflight" class="form-check-input" type="checkbox" id="booking-flight"
                                    value="1" {{ old('chkhotel') ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-flight">Flight</label>
                            </div>
                            <div class="form-check form-check-inline position-relative">
                                <input name="chkhotel" class="form-check-input" type="checkbox" id="booking-hotel"
                                    value="1" {{ old('chkhotel') ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-hotel">Hotel</label>
                            </div>
                            <div class="form-check form-check-inline position-relative">
                                <input name="chkcruise" class="form-check-input" type="checkbox" id="booking-cruise"
                                    value="1" {{ old('chkcruise') ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-cruise">Cruise</label>
                            </div>
                            <div class="form-check form-check-inline position-relative">
                                <input name="chkcar" class="form-check-input" type="checkbox" id="booking-car" value="1"
                                    {{ old('chkcar') ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-car">Car</label>
                            </div>

                            <div class="form-check form-check-inline position-relative">
                                <input name="chktrain" class="form-check-input" type="checkbox" id="booking-train"
                                    value="1" {{ old('chktrain') ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-train">Train</label>
                            </div>


                            @if ($errors->has('checkbox_group'))
                            <div class="alert alert-danger">
                                {{ $errors->first('checkbox_group') }}
                            </div>
                            @endif

                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" style="padding: 5px; font-size: 12px;" class="btn btn-primary">Submit</button>
                            <!-- <button class="btn btn-sm btn-primary text-center">
                                <i class="icon-base ri ri-save-2-fill"></i>
                                </button> -->
                                <!-- <button class="btn btn-sm btn-dark text-center">
                                <i class="icon-base ri ri-mail-send-fill"></i>
                            </button> -->
                        </div>
                    </div>
                </div>
                <!-- Booking Form Card -->
                <div class="pt-5 ps-0">
                    <div class="row booking-form">
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                           
                            <label class="form-label">Name of the Caller <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                       <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Campaign <span class="text-danger">*</span></label>
                            <select id="campaign" data-sh="Campaign" name="campaign_id" class="form-control">
                                <option value="" {{ old('campaign_id') == '' ? 'selected' : '' }}>Select</option>
                                @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}"
                                    {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                    {{ $campaign->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('campaign_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="col-md-2 position-relative mb-5">
                            <label for="call_type" class="form-label">Call Type <span
                                    class="text-danger">*</span></label>
                            <select name="call_type" id="call_type" class="form-control">
                                <option value="" {{ old('call_type') == '' ? 'selected' : '' }}>Select</option>
                                @foreach($call_types as $call_type)
                                <option value="{{ $call_type->id }}"
                                    {{ old('call_type') == $call_type->id ? 'selected' : '' }}>
                                    {{ $call_type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('call_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5" id="assignDiv" style="display: none;">
                            <label for="assign" class="form-label">Follow Up</label>
                            <select name="assign" id="assign" class="form-control">
                                <option value="" {{ old('assign') == '' ? 'selected' : '' }}>Select</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assign') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('assign')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 position-relative mb-5" id="followup_date" style="display: none;">
                            <label for="followup_date_input" class="form-label">Followup Date <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" id="followup_date_input" name="followup_date"
                                class="form-control" placeholder="YYYY-MM-DD HH:MM">
                        </div>



                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label none-upper">Call Converted <span class="text-danger">*</span></label>
                            <div>
                                <input type="radio" id="call_converted_yes" name="call_converted" value="1"
                                    {{ old('call_converted') == '1' ? 'checked' : '' }}>
                                <label for="call_converted_yes" class="me-2">Yes</label>
                                <input type="radio" id="call_converted_no" name="call_converted" value="0"
                                    {{ old('call_converted') == '0' ? 'checked' : '' }}>
                                <label for="call_converted_no">No</label>
                            </div>
                        </div>
                        <div class="col-md-6 position-relative">
                           <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                            @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> -->
            </form>
        </div>

    </div>
    <!--/ Content -->

    <script>

    document.getElementById('call_type').addEventListener('change', function() {
        const followupDateDiv = document.getElementById('followup_date');
        const assignDiv = document.getElementById('assignDiv');

        if (this.value == 4) { // Assuming '4' is the ID for 'Follow Up'
            followupDateDiv.style.display = 'block';
            assignDiv.style.display = 'block';
        } else {
            followupDateDiv.style.display = 'none';
            assignDiv.style.display = 'none';
        }
    });
    </script>


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

    <!-- @vite('resources/js/callLogs/create.js') -->

    <script>
    window.addEventListener("pageshow", function (event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            // Page was loaded from cache (Back button), force reload
            window.location.reload();
        }
    });
</script>


    @endsection
