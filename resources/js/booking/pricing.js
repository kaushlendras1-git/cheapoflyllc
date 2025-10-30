document.addEventListener('DOMContentLoaded', () => {




    document.getElementById('pricing-booking-button').addEventListener('click',addPricingRow)
    const pricingFormsContainer = document.getElementById('pricingForms');
    let pricingIndex = pricingFormsContainer.querySelectorAll('.pricing-row').length;

    // Function to add a blank row
    function addPricingRow() {
        const checkMerchantRow = document.getElementById('merchant-row');

        const newRow = document.createElement('tr');
        newRow.className = 'pricing-row';
        newRow.dataset.index = pricingIndex;
        newRow.innerHTML = `
            <td>
                <select class="form-control passenger_type" name="pricing[${pricingIndex}][passenger_type]" id="passenger_type_${pricingIndex}">
                    <option value="">Select</option>
                    <option value="adult">Adult</option>
                    <option value="child">Child</option>
                    <option value="infant">Infant</option>
                    <option value="infant_on_lap">Infant on Lap</option>
                    <option value="infant_on_seat">Infant on Seat</option>
                    <option value="Pet-in Cabin">Pet-in Cabin</option>
                    <option value="Pet-in Cargo">Pet-in Cargo</option>
                </select>
            </td>
            <td><input type="number" style="width: 120px" class="form-control num_passengers" name="pricing[${pricingIndex}][num_passengers]" value="1" min="0"></td>
            <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][gross_price]" value="0.00" min="0" step="0.01"></td>
            <td><span class="gross-total">0.00</span></td>
            <td>
            <select style="width: 160px;" name="pricing[${pricingIndex}][price_description]" class="form-select form-control">
                <option value="">Select</option>
                <option data-type="Flight" value="Flight Price Offered">Flight Price Offered</option>
                <option data-type="Hotel" value="Hotel Price Offered">Hotel Price Offered</option>
                <option data-type="Car" value="Car Price Offered">Car Price Offered</option>
                <option data-type="Train" value="Train Price Offered">Train Price Offered</option>
                <option data-type="Cruise" value="Cruise Price Offered">Cruise Price Offered</option>
                <option data-type="Cruise" value="Excursions">Excursions</option>
                <option data-type="Cruise" value="Spa Services">Spa Services</option>
                <option data-type="Cruise" value="WiFi Packages">WiFi Packages</option>
                <option data-type="Cruise" value="Crew Appreciation Fees/Gratuities">Crew Appreciation Fees/Gratuities</option>
                <option data-type="Cruise" value="Shuttle Services">Shuttle Services</option>
                <option data-type="Cruise" value="Speciality Dining">Speciality Dining</option>
                <option data-type="Cruise" value="Drink Packages">Drink Packages</option>
                <option data-type="Cruise" value="Trip Insurance">Trip Insurance</option>
                <option data-type="Cruise" value="Check-in Proces Luggage Tags &amp; Sailing Pass">Check-in Proces Luggage Tags &amp; Sailing Pass</option>
                <option data-type="Cruise" value="Special Occasion Package">Special Occasion Package</option>
                <option data-type="Cruise" value="Water Bottle or Distilled Water Package">Water Bottle or Distilled Water Package</option>
                <option data-type="Cruise" value="Pet-in Cabin">Pet-in Cabin</option>
                <option data-type="Cruise" value="Vacation Packages">Vacation Packages</option>
                <option data-type="Cruise" value="Seat Assignment">Seat Assignment</option>
            </select>
            </td>
            <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][net_price]" placeholder="Net Price" min="0" step="0.01"></td>
            <td><span class="net-total">0.00</span></td>
          
            <td>
                <select style="width: 145px;" class="form-control detailDropdown" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                    <option value="">Select</option>
                    <option data-grossmco="1" value="Flight Cost">Flight Cost</option>
                    <option data-grossmco="1" value="Hotel Cost">Hotel Cost</option>
                    <option data-grossmco="1" value="Car Rental Cost">Car Rental Cost</option>
                    <option data-grossmco="1" value="Cruise Cost">Cruise Cost</option>
                    <option data-grossmco="1" value="Train Cost">Train Cost</option>
                    <option data-grossmco="1" value="Company card">Company card</option>
                    <option data-grossmco="0" value="Partial Refund">Partial Refund</option>
                    <option data-grossmco="0" value="Full Refund">Full Refund</option>
                    <option data-grossmco="0" value="Chargeback Fee">Chargeback Fee</option>
                    <option data-grossmco="0" value="Partial Chargeback Amt.">Partial Chargeback Amt.</option>
                    <option data-grossmco="0" value="Chargeback Amt.">Chargeback Amt.</option>
                    <option data-grossmco="1" value=" Pet-in Cabin"> Pet-in Cabin</option>
                    <option data-grossmco="1" value="Pet-in Cargo">Pet-in Cargo</option>

                    <option data-grossmco="1" data-cruise="1" value="Excursions">Excursions</option>
                    <option data-grossmco="1" data-cruise="1" value="Spa Services">Spa Services</option>
                    <option data-grossmco="1" data-cruise="1" value="WiFi Packages">WiFi Packages</option>
                    <option data-grossmco="1" data-cruise="1" value="Gratuities">Crew Appreciation Fees/Gratuities</option>
                    <option data-grossmco="1" data-cruise="1" value="Shuttle Services">Shuttle Services</option>
                    <option data-grossmco="1" data-cruise="1" value="Speciality Dining">Speciality Dining</option>
                    <option data-grossmco="1" data-cruise="1" value="Drink Packages">Drink Packages</option>
                    <option data-grossmco="1" data-cruise="1" value="Trip Insurance">Trip Insurance</option>
                    <option data-grossmco="1" data-cruise="1" value="Check-in Proces Luggage Tags & Sailing Pass">Check-in Proces Luggage Tags & Sailing Pass</option>
                    <option data-grossmco="1" data-cruise="1" value="Special Occasion Package">Special Occasion Package</option>
                    <option data-grossmco="1" data-cruise="1" value="Water Bottle or Distilled Water Package">Water Bottle or Distilled Water Package</option>

                    <option data-grossmco="1" data-change="1" value="Change Fee">Change Fee</option>
                    <option data-grossmco="1" data-change="1" value="Fare Difference">Fare Difference</option>


                </select>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>
        `;
        
        // Apply cruise visibility to new row
        toggleCruiseOptionsForRow(newRow);
        if(checkMerchantRow){
            checkMerchantRow.before(newRow);
        }
        else{
            pricingFormsContainer.appendChild(newRow);
        }
        
        // Apply price description filtering to new row
        filterPriceDescriptionOptions();
        
        pricingIndex++;
    }

    // Check if all inputs/selects in a row are filled
    function isRowFilled(row) {
        const requiredInputs = row.querySelectorAll('input, select');
        return Array.from(requiredInputs).every(el => el.value.trim() !== '');
    }

    // Calculate row totals
    function calculateRowTotals(row) {
        const inputElement = row.querySelector('input[name$="[num_passengers]"]');
        let numPassengers = 0;

        if (inputElement && inputElement.value) {
            numPassengers = parseFloat(inputElement.value) || 0;
        }
        const inputElement2 = row.querySelector('input[name$="[gross_price]"]');
        let grossPrice = 0;

        if (inputElement2 && inputElement2.value) {
            grossPrice = parseFloat(inputElement2.value) || 0;
        }
        const netPrice = parseFloat(row.querySelector('input[name$="[net_price]"]').value) || 0;

        const grossTotal = (numPassengers * grossPrice).toFixed(2);
        const netTotal = (numPassengers * netPrice).toFixed(2);

        if(row.querySelector('.gross-total')){
            row.querySelector('.gross-total').textContent = grossTotal;
        }
        row.querySelector('.net-total').textContent = netTotal;

        updateFooterTotals();
    }


    

    // Recalculate row and add new row if needed
    function handleRowChange(row) {
        calculateRowTotals(row);

        const rows = pricingFormsContainer.querySelectorAll('.pricing-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addPricingRow();
        }
    }

    // Function to show/hide cruise options based on cruise checkbox
    function toggleCruiseOptions() {
        const cruiseCheckbox = document.getElementById('booking-cruise');
        const cruiseOptions = document.querySelectorAll('option[data-cruise="1"]');
        
        if (cruiseCheckbox && cruiseCheckbox.checked) {
            cruiseOptions.forEach(option => option.style.display = 'block');
        } else {
            cruiseOptions.forEach(option => option.style.display = 'none');
        }
    }

    // Function to filter price description options based on selected booking types
    function filterPriceDescriptionOptions() {
        const selectedTypes = [];
        
        // Get all checked booking type checkboxes
        document.querySelectorAll('input[name="booking-type[]"]').forEach(checkbox => {
            if (checkbox.checked) {
                selectedTypes.push(checkbox.value);
            }
        });
        
        // Filter options in all price description selects
        document.querySelectorAll('select[name*="[price_description]"]').forEach(select => {
            const options = select.querySelectorAll('option');
            
            options.forEach(option => {
                if (option.value === '') {
                    // Always show the default "Select" option
                    option.style.display = 'block';
                } else {
                    const optionType = option.getAttribute('data-type');
                    if (selectedTypes.length === 0 || selectedTypes.includes(optionType)) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                }
            });
        });
    }

    // Function to apply cruise visibility to a specific row
    function toggleCruiseOptionsForRow(row) {
        const cruiseCheckbox = document.getElementById('booking-cruise');
        const cruiseOptions = row.querySelectorAll('option[data-cruise="1"]');
        
        if (cruiseCheckbox && cruiseCheckbox.checked) {
            cruiseOptions.forEach(option => option.style.display = 'block');
        } else {
            cruiseOptions.forEach(option => option.style.display = 'none');
        }
    }

    // Listen for booking type checkbox changes
    document.addEventListener('change', (e) => {
        if (e.target.id === 'booking-cruise') {
            toggleCruiseOptions();
        }
        
        // Filter price description options when booking type changes
        if (e.target.name === 'booking-type[]') {
            filterPriceDescriptionOptions();
        }
    });

    // Initial check on page load
    document.addEventListener('DOMContentLoaded', () => {
        toggleCruiseOptions();
        filterPriceDescriptionOptions();
    });
    
    // Also run filtering when this script loads (for existing elements)
    setTimeout(() => {
        filterPriceDescriptionOptions();
    }, 100);

    // Input change handler
    pricingFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.pricing-row');
        if (row) {
            handleRowChange(row);
        }
    });

    // Select change handler
    pricingFormsContainer.addEventListener('change', (e) => {
        const row = e.target.closest('.pricing-row');
        if (row) {
            handleRowChange(row);
        }
    });

    // Delete row handler
    pricingFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-pricing-btn')) {
            const row = e.target.closest('.pricing-row');
            if (row) {
                row.remove();
                updateFooterTotals();
            }
        }
    });

    // Init: recalculate all existing rows on page load
    pricingFormsContainer.querySelectorAll('.pricing-row').forEach(row => {
        calculateRowTotals(row);
    });
    
    // Ensure totals are calculated on page load
    updateFooterTotals();
});

document.querySelectorAll('input[name="pnrtype"]').forEach(radio => {
    radio.addEventListener('change', function (e) {
        const pricingFormsContainer = document.getElementById('pricingForms');
        let pricingIndex = pricingFormsContainer.querySelectorAll('.pricing-row').length;

        // Remove previous rows and totals
        document.querySelectorAll('.hkRow, .fxlRow').forEach(row => row.remove());
        const totalsDiv = document.getElementById('fxlTotals');
        if (totalsDiv) totalsDiv.style.display = 'none';

        if (e.target.value === 'HK') {

            const totalPassengers = countPassengers();
            const grossTotal = totalPassengers * 10;
            const netTotal = grossTotal;

            const newRow = document.createElement('tr');
            newRow.className = 'pricing-row hkRow';
            newRow.dataset.index = pricingIndex;
            newRow.innerHTML = `
               <td style="background-color: #f2f2f3;">
                    <select class="form-control" name="pricing[${pricingIndex}][passenger_type]" id="passenger_type_${pricingIndex}" disabled >
                        <option value="">Select</option>
                    </select>
                </td>
                <td><input type="number" style="width: 120px" class="form-control" name="pricing[${pricingIndex}][num_passengers]" value="${totalPassengers}" readonly></td>
                <td><input type="number" style="width: 100px" class="form-control" name="pricing[${pricingIndex}][gross_price]" value="0.00" readonly></td>
                <td><span class="gross-total">0.00</span></td>
                <td></td>
                <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][net_price]" value="10.00" readonly></td>
                <td><span class="net-total">${netTotal}</span></td>
                <td>
                    <select class="form-control detailDropdown" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}" style=" appearance: none; -webkit-appearance: none;-moz-appearance: none;">
                        <option data-grossmco="1" selected>Issuance Fees - Voyzant</option>
                    </select>
                </td>
                <td></td>
            `;
            pricingFormsContainer.appendChild(newRow);
            updateFooterTotals();
        }

        else if (e.target.value === 'FXL') {
            const totalPassengers = countPassengers();
            const grossTotal = totalPassengers * 100;
            const netTotal = grossTotal;

            const newRow = document.createElement('tr');
            newRow.className = 'pricing-row fxlRow';
            newRow.dataset.index = pricingIndex;
            newRow.innerHTML = `
                 <td style="background-color: #f2f2f3;">
                    <select class="form-control" name="pricing[${pricingIndex}][passenger_type]" id="passenger_type_${pricingIndex}" disabled>
                        <option value="">Select</option>
                    </select>
                </td>
                <td><input type="number" style="width: 120px" class="form-control" name="pricing[${pricingIndex}][num_passengers]" value="${totalPassengers}" readonly></td>
                <td><input type="number" style="width: 100px" class="form-control" name="pricing[${pricingIndex}][gross_price]" value="0.00" readonly></td>
                <td><span class="gross-total">0.00</span></td>
                <td></td>
                <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][net_price]" value="100.00" readonly></td>
                <td><span class="net-total">${netTotal}</span></td>
                <td>
                    <select class="form-control detailDropdown" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                        <option data-grossmco="1" selected>FXL Issuance Fees</option>
                    </select>
                </td>
                <td></td>
            `;
            pricingFormsContainer.appendChild(newRow);
            updateFooterTotals();
        }
    });
});

// ✅ Count passengers
function countPassengers() {
    const rows = document.querySelectorAll('#passengerForms .passenger-form');
    let total = 0;
    rows.forEach(row => {
        const typeSelect = row.querySelector('select[name*="[passenger_type]"]');
        if (typeSelect && typeSelect.value.trim() !== '') {
            total++;
        }
    });
    return total;
}

function updateFooterTotals() {
    const pricingFormsContainer = document.getElementById('pricingForms');
    const rows = pricingFormsContainer.querySelectorAll('.pricing-row');
    let grossTotal = 0;
    let netTotal = 0;
    let companyCard = 0;
    let totalPassengers = 0;

    $('.num_passengers').each(function() {
        let val = parseInt($(this).val(), 10);
        if (!isNaN(val)) {
            totalPassengers += val;
        }
    });
    let grossMco = 0;
    rows.forEach(row => {
        const selectElement = row.querySelector('.detailDropdown');
        let grossmcoBool = 0;
        if (selectElement && selectElement.options && selectElement.selectedIndex >= 0) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];

            if (selectedOption && selectedOption.getAttribute('data-grossmco')) {
                grossmcoBool = selectedOption.getAttribute('data-grossmco');
            }
        }

        if (grossmcoBool === '1') {
            const netTotalText = row.querySelector('.net-total')?.textContent || '0';
            grossMco += parseFloat(netTotalText);
        }
        grossTotal += parseFloat(row.querySelector('.gross-total')?.textContent || 0);
        netTotal += parseFloat(row.querySelector('.net-total')?.textContent || 0);
    });


    document.getElementById('total_gross_profit').textContent = grossTotal.toFixed(2);
    document.getElementById('gross_value').value = grossTotal.toFixed(2);

    document.getElementById('total_net_profit').textContent = netTotal.toFixed(2);
    document.getElementById('net_value').value = netTotal.toFixed(2);
    
    // Debug logging
   // console.log('Setting gross_value:', grossTotal.toFixed(2));
   // console.log('Setting net_value:', netTotal.toFixed(2));

    const diff = grossTotal - netTotal;
    const mcqElement = document.getElementById('total_gross_value');


    if (mcqElement) {
        //let merchantFeefinal = grossMco * 0.15;
        let merchantFeefinal = diff * 0.15;
        // document.getElementById('merchant_fee_text').textContent = merchantFeefinal;
        document.getElementById('merchant_fee_text1').textContent = merchantFeefinal.toFixed(2);
        document.getElementById('merchant_fee_text2').textContent = merchantFeefinal.toFixed(2);
        document.getElementById('merchant_fee').value = merchantFeefinal;
        let fetchNetAmount = document.getElementById('total_net_profit').textContent;
        let finalNetAmount = parseFloat(fetchNetAmount) + merchantFeefinal;
        document.getElementById('total_net_profit').textContent = finalNetAmount;
        document.getElementById('net_value').value = finalNetAmount;
        
        mcqElement.textContent = grossMco - merchantFeefinal;
        mcqElement.textContent = grossTotal - grossMco;

        document.getElementById('gross_mco').value= grossMco - merchantFeefinal;
    }

    const netProfitAfterFee = grossTotal - netTotal;
    const netProfitElement = document.getElementById('total_netprofit_value');
    const netMCOInput = document.getElementById('net_mco');
    if (netProfitElement) {
        netProfitElement.textContent = netProfitAfterFee.toFixed(2);
        netMCOInput.value = netProfitAfterFee.toFixed(2);
    }

    const element3 = document.getElementById('net-total-merchant');



    if(document.getElementById('net-total-company-card')){
        document.getElementById('net-total-company-card').textContent = totalPassengers * 10;
    }
    const fetchgrossAmount = document.getElementById('total_gross_profit').textContent;
    const fetchnetAmount = document.getElementById('total_net_profit').textContent;
    const finalnetMCOs = fetchgrossAmount - fetchnetAmount;
    document.getElementById('total_netprofit_value').textContent = parseFloat(finalnetMCOs).toFixed(2);
    document.getElementById('net_mco').value = finalnetMCOs;
}

// Cruise port auto-suggestion functionality
document.addEventListener('DOMContentLoaded', function() {
    let cruisePorts = [];
    
    async function fetchCruisePorts() {
        try {
            const response = await fetch('/api/cruise-ports');
            if (response.ok) {
                cruisePorts = await response.json();
            }
        } catch (error) {
            console.error('Error fetching cruise ports:', error);
        }
    }
    
    fetchCruisePorts();
    
    function createSuggestionDropdown(input) {
        const dropdown = document.createElement('div');
        dropdown.className = 'cruise-port-suggestions';
        dropdown.style.cssText = 'position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ccc; max-height: 200px; overflow-y: auto; z-index: 99999; display: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(dropdown);
        return dropdown;
    }
    
    function showSuggestions(input, dropdown, query) {
        if (!query || query.length < 2) {
            dropdown.style.display = 'none';
            return;
        }
        
        const filtered = cruisePorts.filter(port => 
            port.name.toLowerCase().includes(query.toLowerCase()) ||
            port.country.toLowerCase().includes(query.toLowerCase())
        );
        
        if (filtered.length === 0) {
            dropdown.style.display = 'none';
            return;
        }
        
        dropdown.innerHTML = filtered.map(port => 
            `<div class="suggestion-item" style="padding: 8px; cursor: pointer; border-bottom: 1px solid #eee;" data-port="${port.name}">
                ${port.name}, ${port.country}
            </div>`
        ).join('');
        
        dropdown.style.display = 'block';
        
        dropdown.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', function() {
                input.value = this.dataset.port;
                dropdown.style.display = 'none';
            });
        });
    }
    
    function setupPortAutoSuggestion(input) {
        const tableCell = input.closest('td');
        if (tableCell) {
            tableCell.style.overflow = 'visible';
        }
        const table = input.closest('table');
        if (table) {
            table.style.overflow = 'visible';
        }
        const tableContainer = input.closest('.table-responsive');
        if (tableContainer) {
            tableContainer.style.overflow = 'visible';
        }
        
        const dropdown = createSuggestionDropdown(input);
        
        input.addEventListener('input', function() {
            showSuggestions(input, dropdown, this.value);
        });
        
        input.addEventListener('focus', function() {
            if (this.value.length >= 2) {
                showSuggestions(input, dropdown, this.value);
            }
        });
        
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    }
    
    document.querySelectorAll('input[name="departure_port"], input[name="arrival_port"]').forEach(input => {
        setupPortAutoSuggestion(input);
    });
    
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
                    const portInputs = node.querySelectorAll ? node.querySelectorAll('input[name*="departure_port"], input[name*="arrival_port"]') : [];
                    portInputs.forEach(input => {
                        setupPortAutoSuggestion(input);
                    });
                }
            });
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});



document.addEventListener('change', function (e) {

    const pnrType = document.querySelector('input[name="pnrtype"]:checked')?.value;
    if (pnrType === 'FXL' && e.target.name.includes('[passenger_type]')) {
        const totalPassengers = countPassengers();
        const grossTotal = totalPassengers * 100;
        const netTotal = grossTotal;

        const fxlRow = document.querySelector('.fxlRow');
        if (fxlRow) {
            fxlRow.querySelector('input[name*="[num_passengers]"]').value = totalPassengers;
            fxlRow.querySelector('.gross-total').textContent = grossTotal.toFixed(2);
            fxlRow.querySelector('.net-total').textContent = netTotal.toFixed(2);
        }
    }
    else if (pnrType === 'HK' && e.target.name.includes('[passenger_type]')) {
        const totalPassengers = countPassengers();
        const grossTotal = totalPassengers * 10;
        const netTotal = grossTotal;

        const fxlRow = document.querySelector('.hkRow');
        if (fxlRow) {
            fxlRow.querySelector('input[name*="[num_passengers]"]').value = totalPassengers;
            fxlRow.querySelector('.gross-total').textContent = grossTotal.toFixed(2);
            fxlRow.querySelector('.net-total').textContent = netTotal.toFixed(2);
        }
    }
    updateFooterTotals();
});
