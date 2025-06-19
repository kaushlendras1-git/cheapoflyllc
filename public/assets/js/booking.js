document.addEventListener('DOMContentLoaded', function () {
    const passengerFormsContainer = document.getElementById('passengerForms');
    const addPassengerBtn = document.getElementById('addPassengerBtn');
    const billingCardContainer = document.querySelector('#billing .card-body');
    const addBillingBtn = document.getElementById('addBillingBtn');

    // Update Passenger Indices
    function updatePassengerIndices() {
        const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
        forms.forEach((form, index) => {
            form.dataset.index = index;
            const header = form.querySelector('h6');
            header.textContent = `Passenger ${index + 1}`;
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.name.replace(/passenger\[\d+\]/, `passenger[${index}]`);
                input.name = name;
            });
        });
    }

    // Add Passenger
    addPassengerBtn.addEventListener('click', function () {
        const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
        const lastIndex = forms.length > 0 ? parseInt(forms[forms.length - 1].dataset.index) + 1 : 0;
        const newForm = forms[0].cloneNode(true);
        
        newForm.querySelectorAll('input').forEach(input => {
            input.value = input.placeholder || '';
        });
        
        newForm.dataset.index = lastIndex;
        newForm.querySelector('h6').textContent = `Passenger ${lastIndex + 1}`;
        
        newForm.querySelectorAll('input').forEach(input => {
            const name = input.name.replace(/passenger\[\d+\]/, `passenger[${lastIndex}]`);
            input.name = name;
        });
        
        newForm.querySelectorAll('.delete-passenger').forEach(btn => {
            btn.addEventListener('click', function () {
                if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                    newForm.remove();
                    updatePassengerIndices();
                } else {
                    alert('At least one passenger form is required.');
                }
            });
        });
        
        passengerFormsContainer.appendChild(newForm);
    });

    // Delete Passenger
    passengerFormsContainer.querySelectorAll('.delete-passenger').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = btn.closest('.passenger-form');
            if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                form.remove();
                updatePassengerIndices();
            } else {
                alert('At least one passenger form is required.');
            }
        });
    });

    // Update Billing Indices and Headers
    function updateBillingIndices() {
        const forms = billingCardContainer.querySelectorAll('.billing-card');
        forms.forEach((form, index) => {
            form.dataset.index = index;
            const header = form.querySelector('h6');
            header.textContent = `Card Details ${index + 1}`;
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                input.name = name;
            });
            const radio = form.querySelector('input[type="radio"]');
            radio.value = index;
        });
    }

    // Add Billing
    addBillingBtn.addEventListener('click', function () {
        const forms = billingCardContainer.querySelectorAll('.billing-card');
        const lastIndex = forms.length;
        const newForm = forms[0].cloneNode(true);
        
        newForm.querySelectorAll('input').forEach(input => {
            input.value = input.placeholder || '';
            input.name = input.name.replace(/\[\d+\]/, `[${lastIndex}]`);
        });
        
        newForm.querySelector('input[type="radio"]').value = lastIndex;
        newForm.querySelector('h6').textContent = `Card Details ${lastIndex + 1}`;
        
        billingCardContainer.appendChild(newForm);
        updateBillingIndices();
    });

    // Delete Billing (Event Delegation)
    billingCardContainer.addEventListener('click', function (event) {
        const deleteButton = event.target.closest('.delete-billing-btn');
        if (deleteButton) {
            const billingCard = deleteButton.closest('.billing-card');
            if (billingCard) {
                if (billingCardContainer.querySelectorAll('.billing-card').length > 1) {
                    billingCard.remove();
                    updateBillingIndices();
                    console.log('Billing card removed successfully');
                } else {
                    alert('At least one billing detail is required.');
                }
            } else {
                console.error('Billing card not found');
            }
        } else {
            console.log('Click was not on a delete button');
        }
    });
});