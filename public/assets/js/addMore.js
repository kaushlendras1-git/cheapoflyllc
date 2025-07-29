
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('hotel-booking-button').addEventListener('click',addHotelRow)
        const hotelFormsContainer = document.getElementById('hotelForms');
        let hotelIndex = 0;

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
                <td><input type="number" class="form-control" style="width:10rem" name="hotel[${hotelIndex}][no_of_rooms]" placeholder="No. Of Rooms" min="1"></td>
                <td><input type="text" class="form-control" style="width:12rem" name="hotel[${hotelIndex}][confirmation_number]" placeholder="Confirmation Number"></td>
                <td><input type="text" class="form-control" style="width:8rem" name="hotel[${hotelIndex}][hotel_address]" placeholder="Hotel Address"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="hotel[${hotelIndex}][remarks]" placeholder="Remarks"></td>
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
                const inputs = row.querySelectorAll('input');
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
        document.getElementById('cruise-booking-button').addEventListener('click',addCruiseRow )
        const cruiseFormsContainer = document.getElementById('cruiseForms');
        let cruiseIndex = 0;

        addCruiseRow();

        // Function to add a new cruise row
        function addCruiseRow() {
            const newRow = document.createElement('tr');
            newRow.className = 'cruise-row';
            newRow.dataset.index = cruiseIndex;
            newRow.innerHTML = `
                <td><span class="cruise-title">${cruiseIndex + 1}</span></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][cruise_line]" placeholder="Cruise Line"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][ship_name]" placeholder="Name of the Ship"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][category]" placeholder="Category"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][stateroom]" placeholder="Stateroom"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][departure_port]" placeholder="Departure Port"></td>
                <td><input type="date" class="form-control" style="width: 105px;" name="cruise[${cruiseIndex}][departure_date]"></td>
                <td><input type="time" class="form-control" style="width:50px;" name="cruise[${cruiseIndex}][departure_hrs]" placeholder="Hrs" min="0" max="23"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="cruise[${cruiseIndex}][arrival_port]" placeholder="Arrival Port"></td>
                <td><input type="date" class="form-control" style="width:105px; name="cruise[${cruiseIndex}][arrival_date]"></td>
                <td><input type="time" class="form-control" style="width:50px; name="cruise[${cruiseIndex}][arrival_hrs]" placeholder="Hrs" min="0" max="23"></td>

                <td>
                    <button type="button" class="btn btn-outline-danger delete-cruise-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
            cruiseFormsContainer.appendChild(newRow);
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
                const inputs = row.querySelectorAll('input');
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
                if (cruiseFormsContainer.children.length > 1) {
                    row.remove();
                    updateCruiseTitles();
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('car-booking-button').addEventListener('click', addCarRow)
        const carFormsContainer = document.getElementById('carForms');
        let carIndex = 0;

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
                <td><input type="time" class="form-control" style="width:105px"; name="car[${carIndex}][pickup_time]"></td>
                <td><input type="date" class="form-control" style="width:105px"; name="car[${carIndex}][dropoff_date]"></td>
                <td><input type="time" class="form-control" style="width:105px"; name="car[${carIndex}][dropoff_time]"></td>
                <td><input type="text" class="form-control" style="width:12rem" name="car[${carIndex}][confirmation_number]" placeholder="Confirmation Number"></td>
                <td><input type="text" class="form-control" style="width:7.5rem" name="car[${carIndex}][remarks]" placeholder="Remarks"></td>
                <td><input type="text" class="form-control" style="width:13rem" name="car[${carIndex}][rental_provider_address]" placeholder="Rental Provider's Address"></td>
                <td>
                    <button type="button" class="btn btn-outline-danger delete-car-btn">
                        <i class="ri ri-delete-bin-line"></i>
                    </button>
                </td>
            `;
            carFormsContainer.appendChild(newRow);
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
                const inputs = row.querySelectorAll('input');
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
                if (carFormsContainer.children.length > 1) {
                    row.remove();
                    updateCarTitles();
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('flight-booking-button').addEventListener('click',addFlightRow)
        const flightFormsContainer = document.getElementById('flightForms');
        let flightIndex = 0;

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
                </select></td>

                <td><input type="text" class="form-control" style="width: 37px;" name="flight[${flightIndex}][class_of_service]" placeholder="Class of Service"></td>
                <td><input type="text" class="form-control" style="width: 10rem;" name="flight[${flightIndex}][departure_airport]" placeholder="Departure Airport"></td>
                <td><input type="time" class="form-control" style="style="width: 86px" name="flight[${flightIndex}][departure_hours]" placeholder="Hrs" min="0" max="23"></td>
                <td><input type="text" class="form-control" style="width: 90px;" name="flight[${flightIndex}][arrival_airport]" placeholder="Arrival Airport"></td>
                <td><input type="time" class="form-control" style="width: 86px;" name="flight[${flightIndex}][arrival_hours]" placeholder="Hrs" min="0" max="23"></td>

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
                const inputs = row.querySelectorAll('input');
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
        document.getElementById('train-booking-button').addEventListener('click',addTrainRow)
    const trainFormsContainer = document.getElementById('trainForms');
    let trainIndex = 0;

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
            <td><input type="date" class="form-control" style="width: 115px;" name="train[${trainIndex}][departure_date]"></td>
            <td><input type="text" class="form-control" style="width: 110px;" name="train[${trainIndex}][train_number]" placeholder="Train No"></td>
            <td><input type="text" class="form-control" style="width: 7.5rem;" name="train[${trainIndex}][cabin]" placeholder="Cabin"></td>
            <td><input type="text" class="form-control" style="width: 10rem;" name="train[${trainIndex}][departure_station]" placeholder="Departure Station"></td>
            <td><input type="number" class="form-control" style="width: 50px;" name="train[${trainIndex}][departure_hours]" placeholder="Hrs" min="0" max="23"></td>
            <td><input type="number" class="form-control" style="width: 50px;" name="train[${trainIndex}][departure_minutes]" placeholder="mm" min="0" max="59"></td>
            <td><input type="text" class="form-control" style="width: 10rem;" name="train[${trainIndex}][arrival_station]" placeholder="Arrival Station"></td>
            <td><input type="number" class="form-control" style="width: 50px;" name="train[${trainIndex}][arrival_hours]" placeholder="Hrs" min="0" max="23"></td>
            <td><input type="number" class="form-control" style="width: 50px;" name="train[${trainIndex}][arrival_minutes]" placeholder="mm" min="0" max="59"></td>
            <td><input type="text" class="form-control" style="width: 100px;" name="train[${trainIndex}][duration]" placeholder="Duration"></td>
            <td><input type="text" class="form-control" style="width: 7.5rem;" name="train[${trainIndex}][transit]" placeholder="Transit"></td>
            <td><input type="date" class="form-control" style="width: 110px;" name="train[${trainIndex}][arrival_date]"></td>
            <td>
                <button type="button" class="btn btn-outline-danger delete-train-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>
        `;
        trainFormsContainer.appendChild(newRow);
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
            const inputs = row.querySelectorAll('input');
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
            if (trainFormsContainer.children.length > 1) {
                row.remove();
                updateTrainTitles();
            }
        }
    });
});

    /**************************** ************** End Train*********************** */




    // Passenger Section
document.addEventListener('DOMContentLoaded', () => {
    const passengerFormsContainer = document.getElementById('passengerForms');
    let passengerIndex = passengerFormsContainer.querySelectorAll('.passenger-form').length || 0;

    // Add initial row on page load if no rows exist
    if (passengerIndex === 0) {
        addPassengerRow();
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
                    <option value="Adult" selected>Adult</option>
                    <option value="Child">Child</option>
                    <option value="Infant">Infant</option>
                    <option value="Seat Infant">Seat Infant</option>
                    <option value="Lap Infant">Lap Infant</option>
                </select>
            </td>
            <td>
                <select class="form-control" style="width:70px;" name="passenger[${passengerIndex}][gender]">
                    <option value="">Select</option>
                    <option value="Male" selected>Male</option>
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
            <td><input type="text" class="form-control" style="width: 7.5rem" name="passenger[${passengerIndex}][first_name]" placeholder="First Name"></td>
            <td><input type="text" class="form-control" style="width: 7.5rem" name="passenger[${passengerIndex}][middle_name]" placeholder="Middle Name"></td>
            <td><input type="text" class="form-control" style="width: 7.5rem" name="passenger[${passengerIndex}][last_name]" placeholder="Last Name"></td>
            <td><input type="date" class="form-control" style="width: 135px;" name="passenger[${passengerIndex}][dob]"></td>
            <td><input type="text" class="form-control" style="width:80px; name="passenger[${passengerIndex}][seat_number]" placeholder="Seat"></td>
            <td><input type="number" class="form-control" style="width:80px; name="passenger[${passengerIndex}][credit_note]" placeholder="0" step="0.01"></td>
            <td><input type="text" class="form-control" style="width:80px; name="passenger[${passengerIndex}][e_ticket_number]" placeholder="E Ticket"></td>
            <td>
                <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                    <i class="icon-base ri ri-delete-bin-2-line"></i>
                </button>
            </td>
        `;
        passengerFormsContainer.appendChild(newRow);
        passengerIndex++;
    }

    // Function to check if a row is filled
    function isRowFilled(row) {
        const inputs = row.querySelectorAll('input:not([name$="[middle_name]"]):not([name$="[seat_number]"]):not([name$="[e_ticket_number]"])');
        const selects = row.querySelectorAll('select');
        return Array.from(inputs).every(input => input.value.trim() !== '') &&
               Array.from(selects).every(select => select.value.trim() !== '');
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
    }

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
    document.getElementById('billing-booking-button').addEventListener('click',addBillingRow);
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
    function addBillingRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'billing-card';
        newRow.dataset.index = billingIndex;
        newRow.innerHTML = `
            <td><h6 class="billing-card-title mb-0"> ${billingIndex + 1}</h6></td>
            <td>
                <select class="form-control" name="billing[${billingIndex}][card_type]">
                    <option value="">Select</option>
                    <option value="VISA">VISA</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="AMEX">AMEX</option>
                    <option value="DISCOVER">DISCOVER</option>
                </select>
            </td>
            <td><input type="text" class="form-control" placeholder="CC Number" name="billing[${billingIndex}][cc_number]" value=""></td>
            <td><input type="text" class="form-control" placeholder="CC Holder Name" name="billing[${billingIndex}][cc_holder_name]" value=""></td>
            <td>
                <select class="form-control" name="billing[${billingIndex}][exp_month]">
                    <option value="">MM</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </td>
            <td>
                <select class="form-control" name="billing[${billingIndex}][exp_year]">
                    <option value="">YYYY</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
                    <option value="2034">2034</option>
                </select>
            </td>
            <td><input type="text" style="width: 57px;" class="form-control" placeholder="CVV" name="billing[${billingIndex}][cvv]" value=""></td>

            <td>
                <select id="" style="width:7.5rem"
                    class="form-control state-select"
                    name="billing[${billingIndex}][state]">
                    <option value="India">Select Billing</option>
                    <option value="India">Address</option>
                </select>
            </td>

            <td><input type="text" style="width: 65px;" class="form-control" placeholder="Amount" name="billing[${billingIndex}][amount]" value=""></td>

            <td>
                <select class="form-control" name="billing[${billingIndex}][currency]">
                    <option value="">Select </option>
                    <option value="USD">USD</option>
                    <option value="CAD">CAD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="AUD">AUD</option>
                    <option value="INR">INR</option>
                    <option value="MXN">MXN</option>
                </select>
            </td>
            <td> AUD<span>90909</span></td>

            <td>
                <button type="button" class="btn btn-outline-danger delete-billing-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>
        `;
        billingFormsContainer.appendChild(newRow);
        billingIndex++;
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
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('pricing-booking-button').addEventListener('click',addPricingRow)
    const pricingFormsContainer = document.getElementById('pricingForms');
    let pricingIndex = pricingFormsContainer.querySelectorAll('.pricing-row').length;

    // Function to add a blank row
    function addPricingRow() {
        const newRow = document.createElement('tr');
        newRow.className = 'pricing-row';
        newRow.dataset.index = pricingIndex;
        newRow.innerHTML = `
            <td>
                <select class="form-control" name="pricing[${pricingIndex}][passenger_type]" id="passenger_type_${pricingIndex}">
                    <option value="">Select</option>
                    <option value="adult">Adult</option>
                    <option value="child">Child</option>
                    <option value="infant_on_lap">Infant on Lap</option>
                    <option value="infant_on_seat">Infant on Seat</option>
                </select>
            </td>
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][num_passengers]" placeholder="No. of Passengers" min="0"></td>
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][gross_price]" placeholder="Gross Price" min="0" step="0.01"></td>
            <td><span class="gross-total">0.00</span></td>
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][net_price]" placeholder="Net Price" min="0" step="0.01"></td>
            <td><span class="net-total">0.00</span></td>
            <td>
                <select class="form-control" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                    <option value="">Select</option>
                    <option>Ticket Cost</option>
                    <option>Flight Ticket Cost</option>
                    <option>Cruise Ticket Cost</option>
                    <option>Car Rental Cost</option>
                    <option>Train Cost</option>
                    <option>Hotel Cost</option>
                    <option>Company Card</option>
                    <option>Issuance Fees</option>
                    <option>FXL Issuance Fees</option>
                    <option value="merchant_fee">Merchant Fee</option>
                    <option value="company_card_used"> Company Card Used</option>
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>
        `;
        pricingFormsContainer.appendChild(newRow);
        pricingIndex++;
    }

    // Check if all inputs/selects in a row are filled
    function isRowFilled(row) {
        const requiredInputs = row.querySelectorAll('input, select');
        return Array.from(requiredInputs).every(el => el.value.trim() !== '');
    }

    // Calculate row totals
    function calculateRowTotals(row) {
        const numPassengers = parseFloat(row.querySelector('input[name$="[num_passengers]"]').value) || 0;
        const grossPrice = parseFloat(row.querySelector('input[name$="[gross_price]"]').value) || 0;
        const netPrice = parseFloat(row.querySelector('input[name$="[net_price]"]').value) || 0;

        const grossTotal = (numPassengers * grossPrice).toFixed(2);
        const netTotal = (numPassengers * netPrice).toFixed(2);

        row.querySelector('.gross-total').textContent = grossTotal;
        row.querySelector('.net-total').textContent = netTotal;

        updateFooterTotals();
    }

    // Update total in footer
    function updateFooterTotals() {
        const rows = pricingFormsContainer.querySelectorAll('.pricing-row');
        let grossTotal = 0;
        let netTotal = 0;

        rows.forEach(row => {
            grossTotal += parseFloat(row.querySelector('.gross-total')?.textContent || 0);
            netTotal += parseFloat(row.querySelector('.net-total')?.textContent || 0);
        });

        document.getElementById('total_gross_profit').textContent = grossTotal.toFixed(2);
        document.getElementById('total_net_profit').textContent = netTotal.toFixed(2);
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
});


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
    url:'/countrylist',
    method:'GET',
    success:function (res){
        let cntrylst = res.data;
        var _cntrystr = '<option value="">Select Country</option>';
        $.each(cntrylst, function () {
            _cntrystr += `<option value="${this.id}">${this.name}</option>`;
        });

        $(".country-select").each(function () {
            $(this).html(_cntrystr);
        });
    },
    error:function (res){
        console.log(res)
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
FilePond.registerPlugin(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview,
  FilePondPluginFilePoster
);

const inputElement = document.querySelector('#filepondFile');

FilePond.create(inputElement, {
  name: 'sector_details[]', // MUST match the input name exactly
  allowMultiple: true,
  maxFiles: 5,
  acceptedFileTypes: ['image/*'],
  maxFileSize: '2MB'
});
