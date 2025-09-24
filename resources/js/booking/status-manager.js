document.addEventListener('DOMContentLoaded', function() {
    const bookingSelect = document.getElementById('bookingStatusSelect');
    const paymentSelect = document.getElementById('paymentStatusSelect');
    
    if (bookingSelect) {
        fetch('/api/booking-statuses', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => populateSelect(bookingSelect, data))
        .catch(error => console.error('Booking statuses error:', error));
    }
    
    if (paymentSelect) {
        fetch('/api/payment-statuses', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => populateSelect(paymentSelect, data))
        .catch(error => console.error('Payment statuses error:', error));
    }
});

function populateSelect(selectElement, statuses) {
    const currentValue = selectElement.value;
    
    // Keep existing option if no data
    if (!statuses || statuses.length === 0) {
        return;
    }
    
    selectElement.innerHTML = '';
    
    statuses.forEach(status => {
        const option = document.createElement('option');
        option.value = status.id;
        option.text = status.name;
        if (status.id == currentValue) {
            option.selected = true;
        }
        selectElement.appendChild(option);
    });
}