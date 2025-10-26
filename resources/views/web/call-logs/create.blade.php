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
                            <label class="form-label">Country</label>
                            <select name="country_code" id="country_code" class="form-control">
                                @php
                                    $phoneParam = request('canonicalformat') ?: request('phone');
                                    // Handle URL encoding - %2B becomes +
                                    if ($phoneParam) {
                                        $phoneParam = '+'.str_replace('%2B', '+', $phoneParam);
                                    }

                                    

                                    $detectedCountry = '';
                                    if ($phoneParam) {
                                        echo "Phone: '$phoneParam'<br>";
                                        $countryCodes = ['+44' => 'GB', '+1' => 'US', '+91' => 'IN', '+49' => 'DE', '+33' => 'FR'];
                                        foreach ($countryCodes as $code => $country) {
                                            echo "Checking '$code' in '$phoneParam': " . (strpos($phoneParam, $code) === 0 ? 'YES' : 'NO') . "<br>";
                                            if (strpos($phoneParam, $code) === 0) {
                                                $detectedCountry = $country;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    
                                    $selectedCountry = $detectedCountry ?: old('country_code');

                                   

                                @endphp
                                <option value="" {{ !$selectedCountry ? 'selected' : '' }}>Select Country</option>
                                <option value="US" data-code="+1" data-flag="🇺🇸" {{ $selectedCountry == 'US' ? 'selected' : '' }}>United States</option>
                                <option value="CA" data-code="+1" data-flag="🇨🇦" {{ $selectedCountry == 'CA' ? 'selected' : '' }}>Canada</option>
                                <option value="GB" data-code="+44" data-flag="🇬🇧" {{ $selectedCountry == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="AU" data-code="+61" data-flag="🇦🇺" {{ $selectedCountry == 'AU' ? 'selected' : '' }}>🇦🇺 Australia</option>
                                <option value="IN" data-code="+91" data-flag="🇮🇳" {{ $selectedCountry == 'IN' ? 'selected' : '' }}>🇮🇳 India</option>
                                <option value="DE" data-code="+49" data-flag="🇩🇪" {{ $selectedCountry == 'DE' ? 'selected' : '' }}>🇩🇪 Germany</option>
                                <option value="FR" data-code="+33" data-flag="🇫🇷" {{ $selectedCountry == 'FR' ? 'selected' : '' }}>🇫🇷 France</option>
                                <option value="MX" data-code="+52" data-flag="🇲🇽" {{ old('country_code') == 'MX' ? 'selected' : '' }}>🇲🇽 Mexico</option>
                                <option value="JP" data-code="+81" data-flag="🇯🇵" {{ old('country_code') == 'JP' ? 'selected' : '' }}>🇯🇵 Japan</option>
                                <option value="KR" data-code="+82" data-flag="🇰🇷" {{ old('country_code') == 'KR' ? 'selected' : '' }}>🇰🇷 South Korea</option>
                                <option value="CN" data-code="+86" data-flag="🇨🇳" {{ old('country_code') == 'CN' ? 'selected' : '' }}>🇨🇳 China</option>
                                <option value="BR" data-code="+55" data-flag="🇧🇷" {{ old('country_code') == 'BR' ? 'selected' : '' }}>🇧🇷 Brazil</option>
                                <option value="RU" data-code="+7" data-flag="🇷🇺" {{ old('country_code') == 'RU' ? 'selected' : '' }}>🇷🇺 Russia</option>
                                <option value="IT" data-code="+39" data-flag="🇮🇹" {{ old('country_code') == 'IT' ? 'selected' : '' }}>🇮🇹 Italy</option>
                                <option value="ES" data-code="+34" data-flag="🇪🇸" {{ old('country_code') == 'ES' ? 'selected' : '' }}>🇪🇸 Spain</option>
                                <option value="NL" data-code="+31" data-flag="🇳🇱" {{ old('country_code') == 'NL' ? 'selected' : '' }}>🇳🇱 Netherlands</option>
                                <option value="SE" data-code="+46" data-flag="🇸🇪" {{ old('country_code') == 'SE' ? 'selected' : '' }}>🇸🇪 Sweden</option>
                                <option value="NO" data-code="+47" data-flag="🇳🇴" {{ old('country_code') == 'NO' ? 'selected' : '' }}>🇳🇴 Norway</option>
                                <option value="DK" data-code="+45" data-flag="🇩🇰" {{ old('country_code') == 'DK' ? 'selected' : '' }}>🇩🇰 Denmark</option>
                                <option value="FI" data-code="+358" data-flag="🇫🇮" {{ old('country_code') == 'FI' ? 'selected' : '' }}>🇫🇮 Finland</option>
                                <option value="CH" data-code="+41" data-flag="🇨🇭" {{ old('country_code') == 'CH' ? 'selected' : '' }}>🇨🇭 Switzerland</option>
                                <option value="AT" data-code="+43" data-flag="🇦🇹" {{ old('country_code') == 'AT' ? 'selected' : '' }}>🇦🇹 Austria</option>
                                <option value="BE" data-code="+32" data-flag="🇧🇪" {{ old('country_code') == 'BE' ? 'selected' : '' }}>🇧🇪 Belgium</option>
                                <option value="PL" data-code="+48" data-flag="🇵🇱" {{ old('country_code') == 'PL' ? 'selected' : '' }}>🇵🇱 Poland</option>
                                <option value="TR" data-code="+90" data-flag="🇹🇷" {{ old('country_code') == 'TR' ? 'selected' : '' }}>🇹🇷 Turkey</option>
                                <option value="SA" data-code="+966" data-flag="🇸🇦" {{ old('country_code') == 'SA' ? 'selected' : '' }}>🇸🇦 Saudi Arabia</option>
                                <option value="AE" data-code="+971" data-flag="🇦🇪" {{ old('country_code') == 'AE' ? 'selected' : '' }}>🇦🇪 UAE</option>
                                <option value="SG" data-code="+65" data-flag="🇸🇬" {{ old('country_code') == 'SG' ? 'selected' : '' }}>🇸🇬 Singapore</option>
                                <option value="MY" data-code="+60" data-flag="🇲🇾" {{ old('country_code') == 'MY' ? 'selected' : '' }}>🇲🇾 Malaysia</option>
                                <option value="TH" data-code="+66" data-flag="🇹🇭" {{ old('country_code') == 'TH' ? 'selected' : '' }}>🇹🇭 Thailand</option>
                                <option value="PH" data-code="+63" data-flag="🇵🇭" {{ old('country_code') == 'PH' ? 'selected' : '' }}>🇵🇭 Philippines</option>
                                <option value="ID" data-code="+62" data-flag="🇮🇩" {{ old('country_code') == 'ID' ? 'selected' : '' }}>🇮🇩 Indonesia</option>
                                <option value="VN" data-code="+84" data-flag="🇻🇳" {{ old('country_code') == 'VN' ? 'selected' : '' }}>🇻🇳 Vietnam</option>
                                <option value="BD" data-code="+880" data-flag="🇧🇩" {{ old('country_code') == 'BD' ? 'selected' : '' }}>🇧🇩 Bangladesh</option>
                                <option value="PK" data-code="+92" data-flag="🇵🇰" {{ old('country_code') == 'PK' ? 'selected' : '' }}>🇵🇰 Pakistan</option>
                                <option value="LK" data-code="+94" data-flag="🇱🇰" {{ old('country_code') == 'LK' ? 'selected' : '' }}>🇱🇰 Sri Lanka</option>
                                <option value="NZ" data-code="+64" data-flag="🇳🇿" {{ old('country_code') == 'NZ' ? 'selected' : '' }}>🇳🇿 New Zealand</option>
                                <option value="ZA" data-code="+27" data-flag="🇿🇦" {{ old('country_code') == 'ZA' ? 'selected' : '' }}>🇿🇦 South Africa</option>
                                <option value="EG" data-code="+20" data-flag="🇪🇬" {{ old('country_code') == 'EG' ? 'selected' : '' }}>🇪🇬 Egypt</option>
                                <option value="NG" data-code="+234" data-flag="🇳🇬" {{ old('country_code') == 'NG' ? 'selected' : '' }}>🇳🇬 Nigeria</option>
                                <option value="KE" data-code="+254" data-flag="🇰🇪" {{ old('country_code') == 'KE' ? 'selected' : '' }}>🇰🇪 Kenya</option>
                                <option value="AR" data-code="+54" data-flag="🇦🇷" {{ old('country_code') == 'AR' ? 'selected' : '' }}>🇦🇷 Argentina</option>
                                <option value="CL" data-code="+56" data-flag="🇨🇱" {{ old('country_code') == 'CL' ? 'selected' : '' }}>🇨🇱 Chile</option>
                                <option value="CO" data-code="+57" data-flag="🇨🇴" {{ old('country_code') == 'CO' ? 'selected' : '' }}>🇨🇴 Colombia</option>
                                <option value="PE" data-code="+51" data-flag="🇵🇪" {{ old('country_code') == 'PE' ? 'selected' : '' }}>🇵🇪 Peru</option>
                            </select>
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                @php
                                    $phoneValue = request('phone') ?: old('phone');
                                    if ($phoneValue) {
                                        // Extract only digits
                                        $digits = preg_replace('/\D/', '', $phoneValue);
                                        // Get last 10 digits
                                        $last10 = substr($digits, -10);
                                        // Format as XXX XXX XXXX
                                        if (strlen($last10) == 10) {
                                            $phoneValue = substr($last10, 0, 3) . ' ' . substr($last10, 3, 3) . ' ' . substr($last10, 6, 4);
                                        }
                                    }
                                @endphp
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $phoneValue }}" maxlength="12" oninput="formatPhone(this)">
                                <!-- <span id="country_flag" class="ms-2" style="font-size: 20px;">🇺🇸</span> -->
                            </div>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                           
                            <label class="form-label">Name of the Caller <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ request('name') ?: old('name') }}">
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
                                    data-type="{{ $call_type->type }}"
                                    data-id="{{ $call_type->id }}"

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
                       
                        <div class="col-md-6 position-relative notes" id="notesDiv" style="display: none;">
                           <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                            @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                  
            </form>
        </div>

    </div>
    <!--/ Content -->

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

        if (this.value == 4) { // Assuming '4' is the ID for 'Follow Up'
            followupDateDiv.style.display = 'block';
            assignDiv.style.display = 'block';
        } else {
            followupDateDiv.style.display = 'none';
            assignDiv.style.display = 'none';
        }
    });

    // Show/hide notes based on call_converted selection
    document.querySelectorAll('input[name="call_converted"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const notesDiv = document.getElementById('notesDiv');
            if (this.value === '0') { // call_converted_no
                notesDiv.style.display = 'block';
            } else {
                notesDiv.style.display = 'none';
            }
        });
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
