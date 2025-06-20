  // Function to update S.No for a table
        function updateSerialNumbers(tableId) {
            const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
            for (let i = 0; i < table.rows.length; i++) {
                table.rows[i].cells[0].textContent = i + 1;
            }
        }

        // Function to add a row to the Cruise table
        function addCruiseRow() {
            const table = document.getElementById('cruiseTable').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length + 1;
            const row = table.insertRow();
            const cells = [
                rowCount,
                '', // Date
                '', // Cruise Line
                '', // Name of the Ship
                '', // Category
                '', // Stateroom
                '', // Departure Port
                '', // Departure Date
                '', // Hrs
                '', // mm
                '', // Arrival Port
                '', // Arrival Date
                '', // Hrs
                '', // mm
                '', // Remarks
                ''  // Action
            ];
            const names = [
                `cruise[date][]`,
                `cruise[line][]`,
                `cruise[ship][]`,
                `cruise[category][]`,
                `cruise[stateroom][]`,
                `cruise[departure_port][]`,
                `cruise[departure_date][]`,
                `cruise[departure_hrs][]`,
                `cruise[departure_mm][]`,
                `cruise[arrival_port][]`,
                `cruise[arrival_date][]`,
                `cruise[arrival_hrs][]`,
                `cruise[arrival_mm][]`,
                `cruise[remarks][]`
            ];
            cells.forEach((cellData, index) => {
                const cell = row.insertCell(index);
                if (index === 0) {
                    cell.textContent = cellData;
                } else if (index === cells.length - 1) {
                    const button = document.createElement('button');
                    button.className = 'delete-row';
                    button.textContent = 'Delete';
                    button.onclick = () => {
                        row.remove();
                        updateSerialNumbers('cruiseTable');
                    };
                    cell.appendChild(button);
                } else {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = names[index - 1];
                    input.value = cellData;
                    cell.appendChild(input);
                }
            });
        }

        // Function to add a row to the Car table
        function addCarRow() {
            const table = document.getElementById('carTable').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length + 1;
            const row = table.insertRow();
            const cells = [
                rowCount,
                '', // Car Rental Provider
                '', // Car Type
                '', // Pick-up Location
                '', // Drop-off Location
                '', // Pick-up Date
                '', // Pick-up Time
                '', // Drop-off Date
                '', // Drop-off Time
                '', // Confirmation Number
                '', // Remarks
                '', // Rental Provider's Address
                ''  // Action
            ];
            const names = [
                `car[provider][]`,
                `car[type][]`,
                `car[pickup_location][]`,
                `car[dropoff_location][]`,
                `car[pickup_date][]`,
                `car[pickup_time][]`,
                `car[dropoff_date][]`,
                `car[dropoff_time][]`,
                `car[confirmation][]`,
                `car[remarks][]`,
                `car[provider_address][]`
            ];
            cells.forEach((cellData, index) => {
                const cell = row.insertCell(index);
                if (index === 0) {
                    cell.textContent = cellData;
                } else if (index === cells.length - 1) {
                    const button = document.createElement('button');
                    button.className = 'delete-row';
                    button.textContent = 'Delete';
                    button.onclick = () => {
                        row.remove();
                        updateSerialNumbers('carTable');
                    };
                    cell.appendChild(button);
                } else {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = names[index - 1];
                    input.value = cellData;
                    cell.appendChild(input);
                }
            });
        }

        // Function to add a row to the Hotel table
        function addHotelRow() {
            const table = document.getElementById('hotelTable').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length + 1;
            const row = table.insertRow();
            const cells = [
                rowCount,
                '', // Hotel Name
                '', // Room Category
                '', // Check-in Date
                '', // Check-out Date
                '', // No. Of Rooms
                '', // Confirmation Number
                '', // Hotel Address
                '', // Remarks
                ''  // Action
            ];
            const names = [
                `hotel[name][]`,
                `hotel[room_category][]`,
                `hotel[checkin_date][]`,
                `hotel[checkout_date][]`,
                `hotel[rooms][]`,
                `hotel[confirmation][]`,
                `hotel[address][]`,
                `hotel[remarks][]`
            ];
            cells.forEach((cellData, index) => {
                const cell = row.insertCell(index);
                if (index === 0) {
                    cell.textContent = cellData;
                } else if (index === cells.length - 1) {
                    const button = document.createElement('button');
                    button.className = 'delete-row';
                    button.textContent = 'Delete';
                    button.onclick = () => {
                        row.remove();
                        updateSerialNumbers('hotelTable');
                    };
                    cell.appendChild(button);
                } else {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = names[index - 1];
                    input.value = cellData;
                    cell.appendChild(input);
                }
            });
        }

        // Function to add a row to the Flight table
        function addFlightRow() {
            const table = document.getElementById('flightTable').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length + 1;
            const row = table.insertRow();
            const cells = [
                rowCount,
                '', // Direction
                '', // Date
                '', // Airlines (Code)
                '', // Flight No
                '', // Cabin
                '', // Class of Service
                '', // Departure Airport
                '', // Hrs
                '', // mm
                '', // Arrival Airport
                '', // Hrs
                '', // mm
                '', // Duration
                '', // Transit
                '', // Arrival Date
                ''  // Action
            ];
            const names = [
                `flight[direction][]`,
                `flight[date][]`,
                `flight[airlines][]`,
                `flight[number][]`,
                `flight[cabin][]`,
                `flight[class][]`,
                `flight[departure_airport][]`,
                `flight[departure_hrs][]`,
                `flight[departure_mm][]`,
                `flight[arrival_airport][]`,
                `flight[arrival_hrs][]`,
                `flight[arrival_mm][]`,
                `flight[duration][]`,
                `flight[transit][]`,
                `flight[arrival_date][]`
            ];
            cells.forEach((cellData, index) => {
                const cell = row.insertCell(index);
                if (index === 0) {
                    cell.textContent = cellData;
                } else if (index === cells.length - 1) {
                    const button = document.createElement('button');
                    button.className = 'delete-row';
                    button.textContent = 'Delete';
                    button.onclick = () => {
                        row.remove();
                        updateSerialNumbers('flightTable');
                    };
                    cell.appendChild(button);
                } else {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = names[index - 1];
                    input.value = cellData;
                    cell.appendChild(input);
                }
            });
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