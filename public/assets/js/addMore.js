document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('hotel-booking-button').addEventListener('click', addHotelRow)
    const hotelFormsContainer = document.getElementById('hotelForms');
    let hotelIndex = document.querySelectorAll('.hotel-row').length ?? 0;

    // Add initial row on page load
    addHotelRow();
    // Function to add a new hotel row
    function addHotelRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'hotel-row';
        newRow.dataset.index = hotelIndex;
        newRow.innerHTML = `
                <td><span class="hotel-title">${hotelIndex + 1}</span></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="hotel[${hotelIndex}][hotel_name]" placeholder="Hotel Name"></td>
                <td><input type="text" class="form-control" style="width:8rem" name="hotel[${hotelIndex}][room_category]" placeholder="Room Category"></td>
                <td><input type="date" class="form-control" style="width:114px" name="hotel[${hotelIndex}][checkin_date]"></td>
                <td><input type="date" class="form-control" style="width:114px" name="hotel[${hotelIndex}][checkout_date]"></td>
                <td><input type="number" class="form-control" style="width:8rem" name="hotel[${hotelIndex}][no_of_rooms]" placeholder="No. Of Rooms" min="1"></td>
                <td><input type="text" class="form-control" style="width:10rem" name="hotel[${hotelIndex}][confirmation_number]" placeholder="Confirmation Number"></td>
                <td><input type="text" class="form-control" style="width:8rem" name="hotel[${hotelIndex}][hotel_address]" placeholder="Hotel Address"></td>
                <td><input type="text" class="form-control" style="width:8rem" name="hotel[${hotelIndex}][special_notes]" placeholder="Refundable"></td>

                <td>
                    <button type="button" class="btn btn-outline-danger delete-hotel-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
        hotelFormsContainer.appendChild(newRow);
        hotelIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Update hotel titles and indices after deletion
    function updateHotelTitles() {
        const rows = hotelFormsContainer.querySelectorAll('.hotel-row');
        rows.forEach((row, index) => {
            const title = row.querySelector('.hotel-title');
            title.textContent = `${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/hotel\[\d+\]/, `hotel[${index}]`);
                input.name = name;
            });
        });
        hotelIndex = rows.length;
    }

    // Event listener for input changes to auto-add rows
    hotelFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.hotel-row');
        if (!row) return;

        const rows = hotelFormsContainer.querySelectorAll('.hotel-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addHotelRow();
        }
    });

    // Delete hotel row
    hotelFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-hotel-btn')) {
            const row = e.target.closest('.hotel-row');
            if (hotelFormsContainer.children.length > 1) {
                row.remove();
                updateHotelTitles();
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cruise-booking-button').addEventListener('click', addCruiseRow)
    const cruiseFormsContainer = document.getElementById('cruiseForms');
    let cruiseIndex = document.querySelectorAll('.cruise-row').length ?? 0;

    addCruiseRow();

    // Function to add a new cruise row
    function addCruiseRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'cruise-row';
        newRow.dataset.index = cruiseIndex;
        newRow.innerHTML = `
                <td><span class="cruise-title">${cruiseIndex + 1}</span></td>
                <td><input type="date" class="form-control" style="width: 125px;" name="cruise[${cruiseIndex}][departure_date]"></td>             
                <td><input type="text" class="form-control" style="width:39.5rem" name="cruise[${cruiseIndex}][departure_port]" placeholder="Departure Port"></td>
          
                <td><input type="text" class="form-control time_24_hrs" style="width:50px;" name="cruise[${cruiseIndex}][departure_hrs]" placeholder="Hrs" min="0" max="23"></td>
                <td><input type="text" class="form-control time_24_hrs" style="width:50px;" name="cruise[${cruiseIndex}][arrival_hrs]" placeholder="Hrs" min="0" max="23"></td>

                <td>
                    <button type="button" class="btn btn-outline-danger delete-cruise-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
        cruiseFormsContainer.appendChild(newRow);
        const departureInput = newRow.querySelector('input[name="cruise[' + cruiseIndex + '][departure_hrs]"]');
        const arrivalInput = newRow.querySelector('input[name="cruise[' + cruiseIndex + '][arrival_hrs]"]');

        cruiseIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Update cruise titles and indices after deletion
    function updateCruiseTitles() {
        const rows = cruiseFormsContainer.querySelectorAll('.cruise-row');
        rows.forEach((row, index) => {
            const title = row.querySelector('.cruise-title');
            title.textContent = `${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/cruise\[\d+\]/, `cruise[${index}]`);
                input.name = name;
            });
        });
        cruiseIndex = rows.length;
    }

    // Event listener for input changes to auto-add rows
    cruiseFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.cruise-row');
        if (!row) return;

        const rows = cruiseFormsContainer.querySelectorAll('.cruise-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addCruiseRow();
        }
    });

    // Delete cruise row
    cruiseFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-cruise-btn')) {
            const row = e.target.closest('.cruise-row');
            row.remove();
            updateCruiseTitles();
            // if (cruiseFormsContainer.children.length > 1) {
            //     row.remove();
            //     updateCruiseTitles();
            // }
        }
    });
});

function attach24HourTimeListener(input) {
    input.addEventListener('input', () => {
        let value = input.value;

        // Allow only digits and colon
        value = value.replace(/[^\d:]/g, '');

        // Auto-insert colon after 2 digits for hours if missing
        if (value.length === 2 && !value.includes(':')) {
            value += ':';
        }
        // Limit to 5 chars like HH:mm
        if (value.length > 5) {
            value = value.slice(0, 5);
        }

        input.value = value;

        // Regex validation for 24hr HH:mm
        const regex = /^([01]\d|2[0-3]):([0-5]\d)$/;
        if (!regex.test(value)) {
            input.setCustomValidity('Please enter a valid time in 24-hour format HH:mm');
        } else {
            input.setCustomValidity('');
        }
    });
}
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('car-booking-button').addEventListener('click', addCarRow)
    const carFormsContainer = document.getElementById('carForms');
    let carIndex = document.querySelectorAll('.car-row').length ?? 0;

    // Add initial row on page load
    addCarRow();

    // Function to add a new car rental row
    function addCarRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'car-row';
        newRow.dataset.index = carIndex;
        newRow.innerHTML = `
                <td><span class="car-title">${carIndex + 1}</span></td>
                <td><input type="text" class="form-control" style="width:10rem" name="car[${carIndex}][car_rental_provider]" placeholder="Car Rental Provider"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="car[${carIndex}][car_type]" placeholder="Car Type"></td>
                <td><input type="text" class="form-control" style="width:9rem" name="car[${carIndex}][pickup_location]" placeholder="Pick-up Location"></td>
                <td><input type="text" class="form-control" style="width:10rem" name="car[${carIndex}][dropoff_location]" placeholder="Drop-off Location"></td>
                <td><input type="date" class="form-control" style="width:105px"; name="car[${carIndex}][pickup_date]"></td>
                <td><input type="text" pattern="^([01]\\d|2[0-3]):([0-5]\\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" placeholder="Hrs" style="width:105px"; name="car[${carIndex}][pickup_time]"></td>
                <td><input type="date" class="form-control" style="width:105px"; name="car[${carIndex}][dropoff_date]"></td>
                <td><input type="text" pattern="^([01]\\d|2[0-3]):([0-5]\\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" placeholder="Hrs" style="width:105px"; name="car[${carIndex}][dropoff_time]"></td>
                <td><input type="text" class="form-control" style="width:12rem" name="car[${carIndex}][confirmation_number]" placeholder="Confirmation Number"></td>
                 <td>
                    <button type="button" class="btn btn-outline-danger delete-car-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
        carFormsContainer.appendChild(newRow);
        const pickupTimeInput = newRow.querySelector(`input[name="car[${carIndex}][pickup_time]"]`);
        const dropoffTimeInput = newRow.querySelector(`input[name="car[${carIndex}][dropoff_time]"]`);
        if (pickupTimeInput) attach24HourTimeListener(pickupTimeInput);
        if (dropoffTimeInput) attach24HourTimeListener(dropoffTimeInput);
        carIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Update car titles and indices after deletion
    function updateCarTitles() {
        const rows = carFormsContainer.querySelectorAll('.car-row');
        rows.forEach((row, index) => {
            const title = row.querySelector('.car-title');
            title.textContent = `${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/car\[\d+\]/, `car[${index}]`);
                input.name = name;
            });
        });
        carIndex = rows.length;
    }

    // Event listener for input changes to auto-add rows
    carFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.car-row');
        if (!row) return;

        const rows = carFormsContainer.querySelectorAll('.car-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addCarRow();
        }
    });

    // Delete car row
    carFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-car-btn')) {
            const row = e.target.closest('.car-row');
            row.remove();
            updateCarTitles();
            // if (carFormsContainer.children.length > 1) {
            //     row.remove();
            //     updateCarTitles();
            // }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('flight-booking-button').addEventListener('click', addFlightRow)
    const flightFormsContainer = document.getElementById('flightForms');
    const flightRowsCount = flightFormsContainer.getElementsByClassName('flight-row').length ?? 0;
    let flightIndex = flightRowsCount;

    // Add initial row on page load
    addFlightRow();

    // Function to add a new flight row
    function addFlightRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'flight-row';
        newRow.dataset.index = flightIndex;
        newRow.innerHTML = `
                <td><span class="flight-title">${flightIndex + 1}</span></td>

                <td><select class="form-control" style="width: 80px;" name="flight[${flightIndex}][direction]">
                        <option value="">Select</option>
                        <option value="Inbound">Inbound</option>
                        <option value="Outbound">Outbound</option>
                    </select>
                </td>

                <td><input type="date" class="form-control" style="width: 6.7rem" name="flight[${flightIndex}][departure_date]"></td>
                <td><input type="text" class="form-control" style="width: 40px;" name="flight[${flightIndex}][airline_code]" placeholder="Airlines (Code)"></td>
                <td><input type="text" class="form-control" style="width: 3.5rem;" name="flight[${flightIndex}][flight_number]" placeholder="Flight No"></td>

                <td><select class="form-control" style="width: 60px;" name="flight[${flightIndex}][cabin]">
                    <option value="">Select</option>
                    <option value="B.Eco">B.Eco</option>
                    <option value="Eco">Eco</option>
                    <option value="Pre.Eco">Pre.Eco</option>
                    <option value="Buss.">Buss.</option>
                    <option value="First Class">First Class</option>
                </select></td>

                <td><input type="text" class="form-control" style="width: 37px;" name="flight[${flightIndex}][class_of_service]" placeholder="Class of Service"></td>
                <td><input type="text" class="form-control departure-airport" style="width: 10rem;" name="flight[${flightIndex}][departure_airport]" placeholder="Departure Airport">
                    <div class="suggestions-list" style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;"></div>
                </td>
                <td><input type="text" pattern="^([01]\\d|2[0-3]):([0-5]\\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" style="width: 86px" name="flight[${flightIndex}][departure_hours]" placeholder="Hrs" />
                </td>

                <td><input type="text" class="form-control arrival-airport" style="width: 90px;" name="flight[${flightIndex}][arrival_airport]" placeholder="Arrival Airport">
                    <div class="suggestions-list" style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;"></div>
                </td>

                <td><input type="text" pattern="^([01]\\d|2[0-3]):([0-5]\\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" style="width: 86px;" name="flight[${flightIndex}][arrival_hours]" placeholder="Hrs"

                                                        ></td>

                <td><input type="text" class="form-control" style="width: 4.5rem;" name="flight[${flightIndex}][duration]" placeholder="Duration"></td>
                <td><input type="text" class="form-control" style="width: 4.5rem;" name="flight[${flightIndex}][transit]" placeholder="Transit"></td>
                <td><input type="date" class="form-control" style="width: 105px;" name="flight[${flightIndex}][arrival_date]"></td>
                <td>
                    <button type="button" class="btn btn-outline-danger delete-flight-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
        flightFormsContainer.appendChild(newRow);
        const pickupTimeInput = newRow.querySelector(`input[name="flight[${flightIndex}][arrival_hours]"]`);
        const dropoffTimeInput = newRow.querySelector(`input[name="flight[${flightIndex}][departure_hours]"]`);
        if (pickupTimeInput) attach24HourTimeListener(pickupTimeInput);
        if (dropoffTimeInput) attach24HourTimeListener(dropoffTimeInput);

        flightIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Update flight titles and indices after deletion
    function updateFlightTitles() {
        const rows = flightFormsContainer.querySelectorAll('.flight-row');
        rows.forEach((row, index) => {
            const title = row.querySelector('.flight-title');
            title.textContent = `${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/flight\[\d+\]/, `flight[${index}]`);
                input.name = name;
            });
        });
        flightIndex = rows.length;
    }

    // Event listener for input changes to auto-add rows
    flightFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.flight-row');
        if (!row) return;

        const rows = flightFormsContainer.querySelectorAll('.flight-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addFlightRow();
        }
    });

    // Delete flight row
    flightFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-flight-btn')) {
            const row = e.target.closest('.flight-row');
            if (flightFormsContainer.children.length > 1) {
                row.remove();
                updateFlightTitles();
            }
        }
    });
});


/**************************** ************** Start Train*********************** */

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('train-booking-button').addEventListener('click', addTrainRow)
    const trainFormsContainer = document.getElementById('trainForms');
    let trainIndex = document.querySelectorAll('.train-row').length ?? 0;

    // Add initial row on page load
    addTrainRow();

    // Function to add a new train row
    function addTrainRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'train-row';
        newRow.dataset.index = trainIndex;
        newRow.innerHTML = `
            <td><span class="train-title">${trainIndex + 1}</span></td>
            <td><input type="text" class="form-control" style="width: 7.5rem;" name="train[${trainIndex}][direction]" placeholder="Direction"></td>
            <td><input type="date" class="form-control" style="width: 105px;" name="train[${trainIndex}][departure_date]"></td>
            <td><input type="text" class="form-control" style="width: 108px;" name="train[${trainIndex}][train_number]" placeholder="Train No"></td>
            <td><input type="text" class="form-control" style="width: 7.5rem;" name="train[${trainIndex}][cabin]" placeholder="Cabin"></td>
            <td>
                <input type="text" class="form-control train_departure_station" style="width: 9rem;" name="train[${trainIndex}][departure_station]" placeholder="Departure Station">
                <div class="train-suggestions-box" style="position:absolute;width:100%; background:#fff; z-index: 19999; border:1px solid #ccc; display:none;">
                </div>
            </td>
            <td><input type="text" class="form-control time_24_hrs" style="width: 80px;" name="train[${trainIndex}][departure_hours]" placeholder="Hrs" min="0" max="23"></td>
            <td><input type="text" class="form-control" style="width: 9rem;" name="train[${trainIndex}][arrival_station]" placeholder="Arrival Station"></td>
            <td><input type="text" class="form-control time_24_hrs" style="width: 80px;" name="train[${trainIndex}][arrival_hours]" placeholder="Hrs" min="0" max="23"></td>
            <td><input type="text" class="form-control" style="width: 5.5rem;" name="train[${trainIndex}][duration]" placeholder="Duration"></td>
            <td><input type="text" class="form-control" style="width: 5.5rem;" name="train[${trainIndex}][transit]" placeholder="Transit"></td>
            <td><input type="date" class="form-control" style="width: 110px;" name="train[${trainIndex}][arrival_date]"></td>
            <td>
                <button type="button" class="btn btn-outline-danger delete-train-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>
        `;
        trainFormsContainer.appendChild(newRow);
        const pickupTimeInput = newRow.querySelector(`input[name="train[${trainIndex}][departure_hours]"]`);
        const dropoffTimeInput = newRow.querySelector(`input[name="train[${trainIndex}][arrival_hours]"]`);
        if (pickupTimeInput) attach24HourTimeListener(pickupTimeInput);
        if (dropoffTimeInput) attach24HourTimeListener(dropoffTimeInput);

        trainIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Update train titles and indices after deletion
    function updateTrainTitles() {
        const rows = trainFormsContainer.querySelectorAll('.train-row');
        rows.forEach((row, index) => {
            const title = row.querySelector('.train-title');
            title.textContent = `${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/train\[\d+\]/, `train[${index}]`);
                input.name = name;
            });
        });
        trainIndex = rows.length;
    }

    // Event listener for input changes to auto-add rows
    trainFormsContainer.addEventListener('input', (e) => {
        const row = e.target.closest('.train-row');
        if (!row) return;

        const rows = trainFormsContainer.querySelectorAll('.train-row');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addTrainRow();
        }
    });

    // Delete train row
    trainFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-train-btn')) {
            const row = e.target.closest('.train-row');
            row.remove();
            updateTrainTitles();
            // if (trainFormsContainer.children.length > 1) {
            //     row.remove();
            //     updateTrainTitles();
            // }
        }
    });
});

/**************************** ************** End Train*********************** */




// Passenger Section
document.addEventListener('DOMContentLoaded', () => {
    const passengerFormsContainer = document.getElementById('passengerForms');
    let passengerIndex = passengerFormsContainer.querySelectorAll('.passenger-form').length || 0;

    // Function to toggle credit column visibility
    function toggleCreditColumn() {
        const queryType = document.getElementById('query_type');
        if (!queryType) return; // Exit if element doesn't exist

        const selectedOption = queryType.options[queryType.selectedIndex];
        let dataType = null;

        if (selectedOption) {
            dataType = selectedOption.getAttribute('data-id');
        }
        const allowedDataIds = ['13', '14', '18', '19', '32', '33', '39', '41', '43', '44', '50', '51'];

        // Get all 10th column elements (th and td)
        const creditHeaders = document.querySelectorAll('.passenger-table th:nth-child(9)');
        const creditCells = document.querySelectorAll('.passenger-table td:nth-child(10)');

        if (allowedDataIds.includes(dataType)) {
            // Show credit column
            creditHeaders.forEach(el => el.style.display = '');
            creditCells.forEach(el => el.style.display = '');
        } else {
            // Hide credit column
            creditHeaders.forEach(el => el.style.display = 'none');
            creditCells.forEach(el => el.style.display = 'none');
        }

        const booking_hotel = document.getElementById('booking-hotel');


    }

    // Add initial row on page load if no rows exist
    if (passengerIndex === 0) {
        addPassengerRow();
    }

    // Run toggleCreditColumn on page load
    toggleCreditColumn();

    // Run when query_type changes
    const queryTypeElement = document.getElementById('query_type');
    if (queryTypeElement) {
        queryTypeElement.addEventListener('change', toggleCreditColumn);
    }

    // Function to add a new passenger row
    function addPassengerRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'passenger-form';
        newRow.dataset.index = passengerIndex;
        newRow.innerHTML = `
            <td><span class="billing-card-title"> ${passengerIndex + 1}</span></td>
            <td>
                <select class="form-control" style="width: 5.5rem" name="passenger[${passengerIndex}][passenger_type]">
                    <option value="">Select</option>
                    <option value="Adult">Adult</option>
                    <option value="Child">Child</option>
                    <option value="Infant">Infant</option>
                    <option value="Seat Infant">Seat Infant</option>
                    <option value="Lap Infant">Lap Infant</option>
                </select>
            </td>
            <td>
                <select class="form-control" style="width:70px;" name="passenger[${passengerIndex}][gender]">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </td>
            <td>
                <select class="form-control" style="width:70px;" name="passenger[${passengerIndex}][title]">
                    <option value="">Select</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                    <option value="Master">Master</option>
                    <option value="Miss">Miss</option>
                </select>
            </td>
            <td><input type="text" class="form-control" name="passenger[${passengerIndex}][first_name]" placeholder="First Name"></td>
           
            <td><input type="text" class="form-control" style="width: 7.5rem" name="passenger[${passengerIndex}][last_name]" placeholder="Last Name"></td>
            <td><input type="date" class="form-control" style="width: 105px;" name="passenger[${passengerIndex}][dob]"></td>
            <td><input type="text" class="form-control" style="width:80px;" name="passenger[${passengerIndex}][seat_number]" placeholder="Seat"></td>
            <td><input type="number" class="form-control" style="width:80px;" name="passenger[${passengerIndex}][credit_note]" placeholder="0" step="0.01"></td>
            <td><input type="text" class="form-control w-100" name="passenger[${passengerIndex}][e_ticket_number]" placeholder="E Ticket"></td>
            <td><input type="text" class="form-control w-100" name="passenger[${passengerIndex}][room_category]" placeholder="Room Category"></td>
            <td>
                <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                    <i class="icon-base ri ri-delete-bin-2-line"></i>
                </button>
            </td>
        `;
        passengerFormsContainer.appendChild(newRow);
        passengerIndex++;

        // Apply credit column visibility to new row immediately
        setTimeout(() => {
            toggleCreditColumn();
        }, 10);
    }

    // Function to check if a row is filled
    // function isRowFilled(row) {
    //     const inputs = row.querySelectorAll('input:not([name$="[middle_name]"]):not([name$="[seat_number]"]):not([name$="[e_ticket_number]"])');
    //     const selects = row.querySelectorAll('select');
    //     return Array.from(inputs).every(input => input.value.trim() !== '') &&
    //            Array.from(selects).every(select => select.value.trim() !== '');
    // }
    function isRowFilled(row) {
        // Select inputs excluding certain names
        const inputs = Array.from(row.querySelectorAll('input:not([name$="[middle_name]"]):not([name$="[seat_number]"]):not([name$="[e_ticket_number]"])'));

        // Filter out inputs with name matching passenger[x][credit_note] whose parent td is hidden
        const filteredInputs = inputs.filter(input => {
            const name = input.getAttribute('name') || '';
            const isCreditNote = /\bpassenger\[\d+\]\[credit_note\]$/.test(name);

            if (isCreditNote) {
                const parentTd = input.closest('td');
                if (parentTd && window.getComputedStyle(parentTd).display === 'none') {
                    return false; // exclude this input
                }
            }
            return true; // include
        });

        // Select all selects
        const selects = Array.from(row.querySelectorAll('select'));

        // Check all filtered inputs and selects have non-empty trimmed values
        return filteredInputs.every(input => input.value.trim() !== '') &&
            selects.every(select => select.value.trim() !== '');
    }

    // Update passenger titles and indices after deletion
    function updatePassengerTitles() {
        const rows = passengerFormsContainer.querySelectorAll('.passenger-form');
        rows.forEach((row, index) => {
            const title = row.querySelector('.billing-card-title');
            title.textContent = ` ${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select');
            inputs.forEach(input => {
                const name = input.name.replace(/passenger\[\d+\]/, `passenger[${index}]`);
                input.name = name;
            });
        });
        passengerIndex = rows.length;

        // Apply credit column visibility after updating rows
        toggleCreditColumn();
    }

    // const addButton = document.getElementById('passenger-detail-button');
    // if (addButton) {
    //     addButton.addEventListener('click', addPassengerRow);
    // }
    document.getElementById('passenger-detail-button').addEventListener('click', addPassengerRow);


    // Event listener for input and change events to auto-add rows
    function handlePassengerInput(e) {
        const row = e.target.closest('.passenger-form');
        if (!row) return;

        const rows = passengerFormsContainer.querySelectorAll('.passenger-form');
        const lastRow = rows[rows.length - 1];
        if (row === lastRow && isRowFilled(lastRow)) {
            addPassengerRow();
        }
    }

    passengerFormsContainer.addEventListener('input', handlePassengerInput);
    passengerFormsContainer.addEventListener('change', handlePassengerInput);

    // Delete passenger row
    passengerFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-passenger')) {
            const row = e.target.closest('.passenger-form');
            if (passengerFormsContainer.children.length > 1) {
                row.remove();
                updatePassengerTitles();
            }
        }
    });
});


// Billing Section
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('billing-booking-button').addEventListener('click', addBillingRow);
    const billingFormsContainer = document.getElementById('billingForms');
    let billingIndex = billingFormsContainer.querySelectorAll('.billing-card').length || 0;
    let cntrystr2 = '';

    // Fetch countries
    $.ajax({
        url: '/countrylist',
        method: 'GET',
        success: function (res) {
            let cntrylst = res.data;
            cntrystr2 = '<option value="">Select Country</option>';
            $.each(cntrylst, function () {
                cntrystr2 += `<option value="${this.id}">${this.name}</option>`;
            });
            // Update existing country selects
            document.querySelectorAll('.country-select').forEach(select => {
                select.innerHTML = cntrystr2;
            });
        },
        error: function (res) {
            console.error('Failed to fetch countries:', res);
        }
    });

    // Add initial row on page load if no rows exist
    if (billingIndex === 0) {
        addBillingRow();
    }

    // Function to add a new billing row
    // function addBillingRow() {
    //     let billingOptions = '<option value="">Select Billing</option>';
    //     $.ajax({
    //         url:`/booking/billing-details/${booking_id}`,
    //         type:'GET',
    //         success: function (res) {
    //             res.data.forEach((booking) => {
    //                billingOptions += `<option value="${booking.id}">${booking.street_address}</option>`;
    //             });
    //         },
    //         error: function (res) {
    //             console.log(res);
    //         }
    //     });
    //     const newRow = document.createElement('tr');
    //     newRow.className = 'billing-card';
    //     newRow.dataset.index = billingIndex;
    //     newRow.innerHTML = `
    //         <td><h6 class="billing-card-title mb-0"> ${billingIndex + 1}</h6></td>
    //         <td>
    //             <select class="form-control" name="billing[${billingIndex}][card_type]">
    //                 <option value="">Select</option>
    //                 <option value="VISA">VISA</option>
    //                 <option value="Mastercard">Mastercard</option>
    //                 <option value="AMEX">AMEX</option>
    //                 <option value="DISCOVER">DISCOVER</option>
    //             </select>
    //         </td>
    //         <td><input type="text" style="width: 140px;" class="form-control" placeholder="CC Number" name="billing[${billingIndex}][cc_number]" value=""></td>
    //         <td><input type="text" class="form-control" placeholder="CC Holder Name" name="billing[${billingIndex}][cc_holder_name]" value=""></td>
    //         <td>
    //             <select style="width: 45px; margin: auto;" class="form-control" name="billing[${billingIndex}][exp_month]">
    //                 <option value="">MM</option>
    //                 <option value="01">01</option>
    //                 <option value="02">02</option>
    //                 <option value="03">03</option>
    //                 <option value="04">04</option>
    //                 <option value="05">05</option>
    //                 <option value="06">06</option>
    //                 <option value="07">07</option>
    //                 <option value="08">08</option>
    //                 <option value="09">09</option>
    //                 <option value="10">10</option>
    //                 <option value="11">11</option>
    //                 <option value="12">12</option>
    //             </select>
    //         </td>
    //         <td>
    //             <select class="form-control" name="billing[${billingIndex}][exp_year]">
    //                 <option value="">YYYY</option>
    //                 <option value="2024">2024</option>
    //                 <option value="2025">2025</option>
    //                 <option value="2026">2026</option>
    //                 <option value="2027">2027</option>
    //                 <option value="2028">2028</option>
    //                 <option value="2029">2029</option>
    //                 <option value="2030">2030</option>
    //                 <option value="2031">2031</option>
    //                 <option value="2032">2032</option>
    //                 <option value="2033">2033</option>
    //                 <option value="2034">2034</option>
    //             </select>
    //         </td>
    //         <td><input type="text" style="width: 57px;" class="form-control" placeholder="CVV" name="billing[${billingIndex}][cvv]" value=""></td>
    //
    //         <td>
    //             <select id="" style="width:7.5rem"
    //                 class="form-control state-select"
    //                 name="billing[${billingIndex}][state]">
    //                 ${billingOptions}
    //             </select>
    //         </td>
    //
    //         <td><input type="text" style="width: 65px;" class="form-control" placeholder="Amount" name="billing[${billingIndex}][amount]" value=""></td>
    //
    //         <td>
    //             <select class="form-control" name="billing[${billingIndex}][currency]">
    //                 <option value="">Select </option>
    //                 <option value="USD">USD</option>
    //                 <option value="CAD">CAD</option>
    //                 <option value="EUR">EUR</option>
    //                 <option value="GBP">GBP</option>
    //                 <option value="AUD">AUD</option>
    //                 <option value="INR">INR</option>
    //                 <option value="MXN">MXN</option>
    //             </select>
    //         </td>
    //         <td> AUD<span>90909</span></td>
    //
    //         <td>
    //             <button type="button" class="btn btn-outline-danger delete-billing-btn">
    //                 <i class="ri ri-delete-bin-line"></i>
    //             </button>
    //         </td>
    //     `;
    //     billingFormsContainer.appendChild(newRow);
    //     billingIndex++;
    // }

    function addBillingRow() {
        $.ajax({
            url: `/booking/billing-details/${booking_id}`,
            type: 'GET',
            success: function (res) {
                let billingOptions = '<option value="">Select Billing</option>';
                res.data.forEach((booking, index) => {
                    //billingOptions += `<option value="${booking.id}">Billing No. ${booking.street_address}</option>`;
                    billingOptions += `<option value="${booking.id}">Billing No. ${index + 1}</option>`;
                });

                const newRow = document.createElement('tr');
                newRow.className = 'billing-card';
                newRow.dataset.index = billingIndex;
                newRow.innerHTML = `
                <td><h6 class="billing-card-title mb-0">${billingIndex + 1}</h6></td>
                <td>
                    <select class="form-control" name="billing[${billingIndex}][card_type]">
                        <option value="">Select</option>
                        <option value="VISA">VISA</option>
                        <option value="Mastercard">Mastercard</option>
                        <option value="AMEX">AMEX</option>
                        <option value="DISCOVER">DISCOVER</option>
                    </select>
                </td>
                <td><input type="text" style="width: 140px;" class="form-control" placeholder="CC Number" name="billing[${billingIndex}][cc_number]"></td>
                <td><input type="text" class="form-control cc_holder_name" placeholder="CC Holder Name" name="billing[${billingIndex}][cc_holder_name]"></td>
                <td>
                    <select class="form-control" name="billing[${billingIndex}][exp_month]">
                        <option value="">MM</option>
                        ${Array.from({ length: 12 }, (_, i) => `<option value="${String(i + 1).padStart(2, '0')}">${String(i + 1).padStart(2, '0')}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <select class="form-control" name="billing[${billingIndex}][exp_year]">
                        <option value="">YYYY</option>
                        ${Array.from({ length: 11 }, (_, i) => `<option value="${2024 + i}">${2024 + i}</option>`).join('')}
                    </select>
                </td>
                <td><input type="text" style="width: 57px;" class="form-control" placeholder="CVV" name="billing[${billingIndex}][cvv]"></td>
                <td>
                    <select style="width:7.5rem" class="form-control state-select" name="billing[${billingIndex}][state]">
                        ${billingOptions}
                    </select>
                </td>
                <td><input type="text" style="width: 65px;" class="form-control usdAmount" placeholder="Amount" name="billing[${billingIndex}][authorized_amt]"></td>
                <td>
                    <select class="form-control currencyField" name="billing[${billingIndex}][currency]">
                        <option value="">Select</option>
                        <option value="USD">USD</option>
                        <option value="CAD">CAD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="AUD">AUD</option>
                        <option value="INR">INR</option>
                        <option value="MXN">MXN</option>
                    </select>
                </td>
                <td>
                    <span class="textAmount">0</span>
                    <input value="0" name="billing[${billingIndex}][amount]" class="finalAmount" type="hidden" />
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger delete-billing-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
                billingFormsContainer.appendChild(newRow);
                billingIndex++;
            },
            error: function (res) {
            }
        });
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input:not([type="radio"])');
        const selects = row.querySelectorAll('select');
        return Array.from(inputs).every(input => input.value.trim() !== '') &&
            Array.from(selects).every(select => select.value.trim() !== '');
    }

    // Update billing titles and indices after deletion
    function updateBillingTitles() {
        const rows = billingFormsContainer.querySelectorAll('.billing-card');
        rows.forEach((row, index) => {
            const title = row.querySelector('.billing-card-title');
            title.textContent = ` ${index + 1}`;
            row.dataset.index = index;
            const inputs = row.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.type === 'radio') {
                    input.value = index;
                } else {
                    const name = input.name.replace(/billing\[\d+\]/, `billing[${index}]`);
                    input.name = name;
                    if (input.classList.contains('country-select')) {
                        input.id = `country-${index}`;
                    } else if (input.classList.contains('state-select')) {
                        input.id = `state-${index}`;
                    }
                }
            });
        });
        billingIndex = rows.length;
    }

    // Event listener for input and change events to auto-add rows
    function handleBillingInput(e) {
        const row = e.target.closest('.billing-card');
        if (!row) return;

        const rows = billingFormsContainer.querySelectorAll('.billing-card');
        const lastRow = rows[rows.length - 1];

        if (row === lastRow && isRowFilled(lastRow)) {
            addBillingRow();
        }
    }

    billingFormsContainer.addEventListener('input', handleBillingInput);
    billingFormsContainer.addEventListener('change', handleBillingInput);

    // Handle country change to populate states
    billingFormsContainer.addEventListener('change', (e) => {
        if (e.target.classList.contains('country-select')) {
            const countryId = e.target.value;
            const index = e.target.closest('.billing-card').dataset.index;
            const stateSelect = document.getElementById(`state-${index}`);

            if (countryId) {
                $.ajax({
                    url: `/statelist/${countryId}`,
                    method: 'GET',
                    success: function (res) {
                        let stateOptions = '<option value="">Select State</option>';
                        $.each(res.data, function () {
                            stateOptions += `<option value="${this.id}">${this.name}</option>`;
                        });
                        stateSelect.innerHTML = stateOptions;
                    },
                    error: function (res) {
                        console.error('Failed to fetch states:', res);
                    }
                });
            } else {
                stateSelect.innerHTML = '<option value="">Select State</option>';
            }
        }
    });

    // Delete billing row
    billingFormsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.delete-billing-btn')) {
            const row = e.target.closest('.billing-card');
            if (billingFormsContainer.children.length > 1) {
                row.remove();
                updateBillingTitles();
            }
        }
    });
});






/************************Pricing********************* */




///////////////////////////Show And Hode Tabs////////////////////

document.addEventListener("DOMContentLoaded", function () {
    const toggleSections = {
        "Flight": "#flight-inputs",
        "Hotel": "#hotel-inputs",
        "Cruise": "#cruise-inputs",
        "Car": "#car-inputs",
        "Train": "#train-inputs"
    };

    const checkboxes = document.querySelectorAll(".toggle-tab");
    const navItems = document.querySelectorAll(".nav-item[data-tab]");

    // Function to toggle the visibility of input sections
    function toggleVisibility() {
        for (let type in toggleSections) {
            const section = document.querySelector(toggleSections[type]);
            const checkbox = document.querySelector(`#booking-${type.toLowerCase()}`);
            if (checkbox && checkbox.checked) {
                section.style.display = "block";
            } else if (section) {
                section.style.display = "none";
            }
        }
    }

    // Function to toggle the visibility of nav items
    function toggleTabs() {
        navItems.forEach(item => {
            const tab = item.getAttribute("data-tab");
            const isChecked = Array.from(checkboxes).some(
                checkbox => checkbox.value === tab && checkbox.checked
            );
            // Show tabs if checked; hide only the corresponding tab if unchecked
            item.style.display = isChecked ? "block" : "none";
        });

        // Always show tabs that are not part of the checkbox group
        document.querySelectorAll(".nav-item:not([data-tab])").forEach(item => {
            item.style.display = "block";
        });
    }

    // Function to toggle the visibility of table columns
    function toggleTableColumns() {
        // Get selected booking types
        const selectedTypes = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value.toLowerCase());

        // Show/hide table columns based on selection
        document.querySelectorAll("[data-column]").forEach(column => {
            const columnType = column.getAttribute("data-column");
            if (selectedTypes.includes(columnType)) {
                column.style.display = ""; // Show column
            } else {
                column.style.display = "none"; // Hide column
            }
        });
    }

    // Add event listeners to checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            toggleVisibility();
            toggleTabs();
            toggleTableColumns();
        });
    });

    // Initialize visibility on page load
    toggleVisibility();
    toggleTabs();
    toggleTableColumns();
});

$.ajax({
    url: '/countrylist',
    method: 'GET',
    success: function (res) {
        let cntrylst = res.data;
        var _cntrystr = '<option value="">Select Country</option>';
        $.each(cntrylst, function () {
            _cntrystr += `<option value="${this.id}">${this.name}</option>`;
        });

        $(".country-select").each(function () {
            $(this).html(_cntrystr);
        });
    },
    error: function (res) {
        // console.log(res)
    }
});
/////////////////////////////////////////////////////////////////////////////////////////
// Generate country options


// Handle country change event
// $(".country-select").on("change", function () {
//     var selID = $(this).attr("id").replace('country', 'state');
//     var selectedCountry = $(this).val();
//     setState(selID, selectedCountry);
// });

// Function to populate state dropdown
function setState(stateID, countryName) {
    var states = stateList.find(item => item.country === countryName)?.states || [];
    var stateOptions = '<option value="">Select State</option>';
    states.forEach(state => {
        stateOptions += `<option value="${state}">${state}</option>`;
    });

    $(`#${stateID}`).html(stateOptions);
}

/////////////////////// Initialization script (cleaned) //////////////////////////////////

// Register plugins
// FilePond.registerPlugin(
//   FilePondPluginFileValidateType,
//   FilePondPluginImagePreview,
//   FilePondPluginFilePoster
// );
//
// const inputElement = document.querySelector('#filepondFile');
//
// FilePond.create(inputElement, {
//   name: 'sector_details[]', // MUST match the input name exactly
//   allowMultiple: true,
//   maxFiles: 5,
//   acceptedFileTypes: ['image/*'],
//   maxFileSize: '2MB'
// });
