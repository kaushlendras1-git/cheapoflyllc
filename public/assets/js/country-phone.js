document.addEventListener('DOMContentLoaded', function() {
    const countrySelect = document.getElementById('country_code');
    const phoneInput = document.getElementById('phone');
    const flagDisplay = document.getElementById('country_flag');
    
    if (countrySelect && phoneInput && flagDisplay) {
        function formatPhoneDisplay(phoneValue, countryCode) {
            // Remove all non-digits
            let digits = phoneValue.replace(/\D/g, '');
            
            // Remove country code digits from the beginning if present
            const codeDigits = countryCode.replace(/\D/g, '');
            if (digits.startsWith(codeDigits)) {
                digits = digits.substring(codeDigits.length);
            }
            
            // Format as XXX XXX XXXX
            if (digits.length > 6) {
                digits = `${digits.slice(0, 3)} ${digits.slice(3, 6)} ${digits.slice(6)}`;
            } else if (digits.length > 3) {
                digits = `${digits.slice(0, 3)} ${digits.slice(3)}`;
            }
            
            return countryCode + ' ' + digits;
        }
        
        countrySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const countryCode = selectedOption.getAttribute('data-code');
            const flag = selectedOption.getAttribute('data-flag');
            
            if (countryCode) {
                let currentValue = phoneInput.value;
                phoneInput.value = formatPhoneDisplay(currentValue, countryCode);
                phoneInput.focus();
            }
            
            if (flag) {
                flagDisplay.textContent = flag;
            }
        });
        
        phoneInput.addEventListener('input', function() {
            const selectedOption = countrySelect.options[countrySelect.selectedIndex];
            const countryCode = selectedOption.getAttribute('data-code');
            
            if (countryCode) {
                this.value = formatPhoneDisplay(this.value, countryCode);
            }
        });
        
        phoneInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                const countryCode = selectedOption.getAttribute('data-code');
                
                if (countryCode) {
                    this.value = formatPhoneDisplay(this.value, countryCode);
                }
            }, 0);
        });
        
        // Set initial values on page load
        const initialOption = countrySelect.options[countrySelect.selectedIndex];
        const initialCode = initialOption.getAttribute('data-code');
        const initialFlag = initialOption.getAttribute('data-flag');
        
        // Format existing phone value on page load
        if (phoneInput.value && initialCode) {
            phoneInput.value = formatPhoneDisplay(phoneInput.value, initialCode);
        }
        
        if (initialFlag) {
            flagDisplay.textContent = initialFlag;
        }
        
        // Before form submission, convert to digits only
        const form = phoneInput.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                const phoneValue = phoneInput.value.replace(/\D/g, '');
                phoneInput.value = phoneValue;
            });
        }
    }
});