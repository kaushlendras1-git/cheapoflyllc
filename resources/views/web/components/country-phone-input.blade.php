@props(['name' => 'phone', 'value' => '', 'countryName' => 'country_code', 'countryValue' => 'US', 'required' => false, 'label' => 'Phone Number'])

<div class="position-relative mb-3 country-phone-wrapper">
    <label class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    <div class="input-group">
        <select name="{{ $countryName }}" class="form-select country-code-select" style="max-width: 120px;" data-phone-input="{{ $name }}">
            <option value="US" data-code="+1" data-flag="🇺🇸" {{ $countryValue == 'US' ? 'selected' : '' }}>🇺🇸 +1</option>
            <option value="CA" data-code="+1" data-flag="🇨🇦" {{ $countryValue == 'CA' ? 'selected' : '' }}>🇨🇦 +1</option>
            <option value="GB" data-code="+44" data-flag="🇬🇧" {{ $countryValue == 'GB' ? 'selected' : '' }}>🇬🇧 +44</option>
            <option value="AU" data-code="+61" data-flag="🇦🇺" {{ $countryValue == 'AU' ? 'selected' : '' }}>🇦🇺 +61</option>
            <option value="IN" data-code="+91" data-flag="🇮🇳" {{ $countryValue == 'IN' ? 'selected' : '' }}>🇮🇳 +91</option>
            <option value="DE" data-code="+49" data-flag="🇩🇪" {{ $countryValue == 'DE' ? 'selected' : '' }}>🇩🇪 +49</option>
            <option value="FR" data-code="+33" data-flag="🇫🇷" {{ $countryValue == 'FR' ? 'selected' : '' }}>🇫🇷 +33</option>
            <option value="IT" data-code="+39" data-flag="🇮🇹" {{ $countryValue == 'IT' ? 'selected' : '' }}>🇮🇹 +39</option>
            <option value="ES" data-code="+34" data-flag="🇪🇸" {{ $countryValue == 'ES' ? 'selected' : '' }}>🇪🇸 +34</option>
            <option value="NL" data-code="+31" data-flag="🇳🇱" {{ $countryValue == 'NL' ? 'selected' : '' }}>🇳🇱 +31</option>
            <option value="MX" data-code="+52" data-flag="🇲🇽" {{ $countryValue == 'MX' ? 'selected' : '' }}>🇲🇽 +52</option>
            <option value="BR" data-code="+55" data-flag="🇧🇷" {{ $countryValue == 'BR' ? 'selected' : '' }}>🇧🇷 +55</option>
            <option value="JP" data-code="+81" data-flag="🇯🇵" {{ $countryValue == 'JP' ? 'selected' : '' }}>🇯🇵 +81</option>
            <option value="KR" data-code="+82" data-flag="🇰🇷" {{ $countryValue == 'KR' ? 'selected' : '' }}>🇰🇷 +82</option>
            <option value="CN" data-code="+86" data-flag="🇨🇳" {{ $countryValue == 'CN' ? 'selected' : '' }}>🇨🇳 +86</option>
            <option value="AE" data-code="+971" data-flag="🇦🇪" {{ $countryValue == 'AE' ? 'selected' : '' }}>🇦🇪 +971</option>
            <option value="SA" data-code="+966" data-flag="🇸🇦" {{ $countryValue == 'SA' ? 'selected' : '' }}>🇸🇦 +966</option>
        </select>
        <input type="tel" name="{{ $name }}" class="form-control phone-input" value="{{ $value }}" placeholder="Enter phone number" @if($required) required @endif>
    </div>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>