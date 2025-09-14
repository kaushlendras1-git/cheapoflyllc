document.addEventListener("DOMContentLoaded", function () {
    // PNR Type toggle for amadeus-inputs
    const amadeusInputs = document.getElementById('amadeus-inputs');
    
    function toggleAmadeusInputs() {
        const checkedRadio = document.querySelector('input[name="pnrtype"]:checked');
        const value = checkedRadio ? checkedRadio.value.toLowerCase() : '';
        
        if (amadeusInputs) {
            if (value === 'fxl' || value === 'fxr') {
                amadeusInputs.style.display = 'block';
            } else {
                amadeusInputs.style.display = 'none';
            }
        }
    }
    
    // Listen for changes on all pnrtype radio buttons
    document.addEventListener('change', function(e) {
        if (e.target.name === 'pnrtype') {
            toggleAmadeusInputs();
        }
    });
    
    // Initial check
    toggleAmadeusInputs();
});


  $(document).ready(function() {
    // Hide pricing section initially
    $('.checkbox-servis').hide();
    
    // Show/hide pricing section based on Flight checkbox
    $('#booking-flight').change(function() {
        if($(this).is(':checked')) {
            $('.checkbox-servis').show();
        } else {
            $('.checkbox-servis').hide();
        }
    });
    
    // Show pricing section on page load if Flight is checked
    if($('#booking-flight').is(':checked')) {
        $('.checkbox-servis').show();
    }
});