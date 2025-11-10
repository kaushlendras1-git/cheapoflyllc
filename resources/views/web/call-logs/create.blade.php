@extends('web.layouts.main')
@section('content')


<!-- Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:phone-plus-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Create Call Logs
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('call-logs.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:phone-log-outline"></span>
                        Call Logs
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:plus-circle-outline"></span>
                    Create
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">

            <!--  Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <strong>Whoops!</strong> Please fix the following:
                <ul class="mt-2 mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!--  Create Call Logs Form -->
            <div class="lob-card p-5">
                <form id="callLogsForm" method="POST" action="{{ route('call-logs.store') }}"
                    class="filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf

                    <!-- Top Checkbox Row -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 checkbox-servis">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="form-check form-check-inline position-relative">
                                <input name="chkflight" class="form-check-input" type="checkbox" id="booking-flight"
                                    value="1" {{ old('chkflight') ? 'checked' : '' }}>
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
                        </div>

                        <div class="d-flex gap-2 mt-3 mt-md-0">
                            <button type="submit"
                                class="btn btn-primary d-flex align-items-center gap-2 button-style px-4 py-3">
                                <span class="iconify fs-5" data-icon="mdi:content-save-outline"></span> Submit
                            </button>
                        </div>
                    </div>

                    <!-- Booking Form Fields -->
                    <div class="row g-4 booking-form">

                        <!-- Country -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <select name="country_code" id="country_code" class="form-control input-style"
                                    placeholder=" ">
                                    <option value="" {{ old('country_code') == '' ? 'selected' : '' }}>Select Country
                                    </option>
                                    <option value="US" {{ old('country_code') == 'US' ? 'selected' : '' }}>🇺🇸 United
                                        States</option>
                                    <option value="CA" {{ old('country_code') == 'CA' ? 'selected' : '' }}>🇨🇦 Canada
                                    </option>
                                    <option value="GB" {{ old('country_code') == 'GB' ? 'selected' : '' }}>🇬🇧 United
                                        Kingdom</option>
                                    <option value="AU" {{ old('country_code') == 'AU' ? 'selected' : '' }}>🇦🇺
                                        Australia</option>
                                    <option value="IN" {{ old('country_code') == 'IN' ? 'selected' : '' }}>🇮🇳 India
                                    </option>
                                    <option value="DE" {{ old('country_code') == 'DE' ? 'selected' : '' }}>🇩🇪 Germany
                                    </option>
                                    <option value="FR" {{ old('country_code') == 'FR' ? 'selected' : '' }}>🇫🇷 France
                                    </option>
                                    <option value="MX" {{ old('country_code') == 'MX' ? 'selected' : '' }}>🇲🇽 Mexico
                                    </option>
                                    <option value="JP" {{ old('country_code') == 'JP' ? 'selected' : '' }}>🇯🇵 Japan
                                    </option>
                                    <option value="KR" {{ old('country_code') == 'KR' ? 'selected' : '' }}>🇰🇷 South
                                        Korea</option>
                                    <option value="CN" {{ old('country_code') == 'CN' ? 'selected' : '' }}>🇨🇳 China
                                    </option>
                                    <option value="BR" {{ old('country_code') == 'BR' ? 'selected' : '' }}>🇧🇷 Brazil
                                    </option>
                                    <option value="RU" {{ old('country_code') == 'RU' ? 'selected' : '' }}>🇷🇺 Russia
                                    </option>
                                    <option value="IT" {{ old('country_code') == 'IT' ? 'selected' : '' }}>🇮🇹 Italy
                                    </option>
                                    <option value="ES" {{ old('country_code') == 'ES' ? 'selected' : '' }}>🇪🇸 Spain
                                    </option>
                                    <option value="NL" {{ old('country_code') == 'NL' ? 'selected' : '' }}>🇳🇱
                                        Netherlands</option>
                                    <option value="SE" {{ old('country_code') == 'SE' ? 'selected' : '' }}>🇸🇪 Sweden
                                    </option>
                                    <option value="NO" {{ old('country_code') == 'NO' ? 'selected' : '' }}>🇳🇴 Norway
                                    </option>
                                    <option value="DK" {{ old('country_code') == 'DK' ? 'selected' : '' }}>🇩🇰 Denmark
                                    </option>
                                    <option value="FI" {{ old('country_code') == 'FI' ? 'selected' : '' }}>🇫🇮 Finland
                                    </option>
                                    <option value="CH" {{ old('country_code') == 'CH' ? 'selected' : '' }}>🇨🇭
                                        Switzerland</option>
                                    <option value="AT" {{ old('country_code') == 'AT' ? 'selected' : '' }}>🇦🇹 Austria
                                    </option>
                                    <option value="BE" {{ old('country_code') == 'BE' ? 'selected' : '' }}>🇧🇪 Belgium
                                    </option>
                                    <option value="PL" {{ old('country_code') == 'PL' ? 'selected' : '' }}>🇵🇱 Poland
                                    </option>
                                    <option value="TR" {{ old('country_code') == 'TR' ? 'selected' : '' }}>🇹🇷 Turkey
                                    </option>
                                    <option value="SA" {{ old('country_code') == 'SA' ? 'selected' : '' }}>🇸🇦 Saudi
                                        Arabia</option>
                                    <option value="AE" {{ old('country_code') == 'AE' ? 'selected' : '' }}>🇦🇪 UAE
                                    </option>
                                    <option value="SG" {{ old('country_code') == 'SG' ? 'selected' : '' }}>🇸🇬
                                        Singapore</option>
                                    <option value="MY" {{ old('country_code') == 'MY' ? 'selected' : '' }}>🇲🇾 Malaysia
                                    </option>
                                    <option value="TH" {{ old('country_code') == 'TH' ? 'selected' : '' }}>🇹🇭 Thailand
                                    </option>
                                    <option value="PH" {{ old('country_code') == 'PH' ? 'selected' : '' }}>🇵🇭
                                        Philippines</option>
                                    <option value="ID" {{ old('country_code') == 'ID' ? 'selected' : '' }}>🇮🇩
                                        Indonesia</option>
                                    <option value="VN" {{ old('country_code') == 'VN' ? 'selected' : '' }}>🇻🇳 Vietnam
                                    </option>
                                    <option value="BD" {{ old('country_code') == 'BD' ? 'selected' : '' }}>🇧🇩
                                        Bangladesh</option>
                                    <option value="PK" {{ old('country_code') == 'PK' ? 'selected' : '' }}>🇵🇰 Pakistan
                                    </option>
                                    <option value="LK" {{ old('country_code') == 'LK' ? 'selected' : '' }}>🇱🇰 Sri
                                        Lanka</option>
                                    <option value="NZ" {{ old('country_code') == 'NZ' ? 'selected' : '' }}>🇳🇿 New
                                        Zealand</option>
                                    <option value="ZA" {{ old('country_code') == 'ZA' ? 'selected' : '' }}>🇿🇦 South
                                        Africa</option>
                                    <option value="EG" {{ old('country_code') == 'EG' ? 'selected' : '' }}>🇪🇬 Egypt
                                    </option>
                                    <option value="NG" {{ old('country_code') == 'NG' ? 'selected' : '' }}>🇳🇬 Nigeria
                                    </option>
                                    <option value="KE" {{ old('country_code') == 'KE' ? 'selected' : '' }}>🇰🇪 Kenya
                                    </option>
                                    <option value="AR" {{ old('country_code') == 'AR' ? 'selected' : '' }}>🇦🇷
                                        Argentina</option>
                                    <option value="CL" {{ old('country_code') == 'CL' ? 'selected' : '' }}>🇨🇱 Chile
                                    </option>
                                    <option value="CO" {{ old('country_code') == 'CO' ? 'selected' : '' }}>🇨🇴 Colombia
                                    </option>
                                    <option value="PE" {{ old('country_code') == 'PE' ? 'selected' : '' }}>🇵🇪 Peru
                                    </option>
                                </select>
                                <label for="country_code" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:flag-outline"></span>
                                    Country
                                </label>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" id="phone" name="phone" class="form-control input-style"
                                    placeholder=" " value="{{ old('phone') }}" maxlength="12"
                                    oninput="formatPhone(this)">
                                <label for="phone" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:phone-outline"></span>
                                    Calling Phone No. <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Caller Name -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" class="form-control input-style" placeholder=" "
                                    value="{{ old('name') }}">
                                <label class="form-label" for="name">
                                    <span class="iconify me-1" data-icon="mdi:account-outline"></span>
                                    Name of the Caller <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campaign -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <select id="campaign" name="campaign_id" class="form-control input-style"
                                    placeholder=" ">
                                    <option value="">Select</option>
                                    @foreach($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}"
                                        {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                        {{ $campaign->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="campaign" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:bullhorn-outline"></span>
                                    Campaign <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('campaign_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Call Type -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <select name="call_type" id="call_type" class="form-control input-style"
                                    placeholder=" ">
                                    <option value="">Select</option>
                                    @foreach($call_types as $call_type)
                                    <option value="{{ $call_type->id }}"
                                        {{ old('call_type') == $call_type->id ? 'selected' : '' }}>
                                        {{ $call_type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="call_type" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:phone-calling-outline"></span>
                                    Call Type <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('call_type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Follow Up -->
                        <div class="col-md-2 position-relative" id="assignDiv" style="display: none;">
                            <div class="floating-group lob-card">
                                <select name="assign" id="assign" class="form-control input-style" placeholder=" ">
                                    <option value="">Select</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assign') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="assign" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:account-check-outline"></span>
                                    Follow Up
                                </label>
                            </div>
                            @error('assign')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Followup Date -->
                        <div class="col-md-2 position-relative" id="followup_date" style="display: none;">
                            <div class="floating-group lob-card">
                                <input type="datetime-local" id="followup_date_input" name="followup_date"
                                    class="form-control input-style" placeholder=" ">
                                <label for="followup_date_input" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:calendar-clock-outline"></span>
                                    Followup Date <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Call Converted -->
                        <div class="col-md-2 position-relative" style="margin-top: 0px!important;">
                            <div class="floating-group lob-card py-3 no-hover-card"
                                style="background: transparent!important; border: none!important; box-shadow: none!important;">
                                <label class="form-label none-upper d-block" style="margin-bottom: 0px!important;">
                                    Call Converted <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input type="radio" id="call_converted_yes" name="call_converted" value="1"
                                            {{ old('call_converted', '1') == '1' ? 'checked' : '' }}
                                            class="form-check-input">
                                        <label for="call_converted_yes" class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="call_converted_no" name="call_converted" value="0"
                                            {{ old('call_converted') == '0' ? 'checked' : '' }}
                                            class="form-check-input">
                                        <label for="call_converted_no" class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Notes -->
                        <div class="col-md-6 position-relative notes" id="notesDiv" style="display: none;">
                            <div class="floating-group lob-card">
                                <textarea name="notes" class="form-control input-style" rows="3"
                                    placeholder=" ">{{ old('notes') }}</textarea>
                                <label class="form-label" for="notes">
                                    <span class="iconify me-1" data-icon="mdi:note-text-outline"></span>
                                    Notes
                                </label>
                            </div>
                            @error('notes')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </form>
            </div>
            <!--  End lob-card -->
        </div>
    </div>
</div>
<!--  End Content Wrapper -->

<!-- Scripts -->
<script>
function formatPhone(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length >= 6) {
        value = value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' + value.substring(6, 10);
    } else if (value.length >= 3) {
        value = value.substring(0, 3) + ' ' + value.substring(3);
    }
    input.value = value;
}

document.getElementById('call_type').addEventListener('change', function() {
    const followupDateDiv = document.getElementById('followup_date');
    const assignDiv = document.getElementById('assignDiv');
    if (this.value == 4) {
        followupDateDiv.style.display = 'block';
        assignDiv.style.display = 'block';
    } else {
        followupDateDiv.style.display = 'none';
        assignDiv.style.display = 'none';
    }
});

document.querySelectorAll('input[name="call_converted"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        const notesDiv = document.getElementById('notesDiv');
        notesDiv.style.display = this.value === '0' ? 'block' : 'none';
    });
});

window.addEventListener("pageshow", function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        window.location.reload();
    }
});
</script>

@endsection