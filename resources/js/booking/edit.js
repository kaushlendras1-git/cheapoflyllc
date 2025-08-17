import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import {route} from "ziggy-js";
import CurrencyAPI from '@everapi/currencyapi-js';


const currencyApi = new CurrencyAPI('cur_live_hNVrB7FwaBu1B2psLRKf7ALfqrSU5tXfIpFipPhY');
function convertAndDisplay(usdValue, toCurrency) {
    if (!usdValue || !toCurrency) return Promise.resolve(0); // Return a resolved Promise

    return currencyApi.latest({
        base_currency: 'USD',
        currencies: toCurrency
    }).then(response => {
        const rate = response.data[toCurrency].value;
        const converted = Number(usdValue) * rate;
        return converted;
    });
}

const container = document.getElementById('billingForms');

async function handleInputChange(e) {
    // .usdAmount
    if (e.target.classList.contains('usdAmount')) {
        const row = e.target.closest('tr'); // adjust as needed based on your markup
        const amt = e.target.value;
        const currencyField = row.querySelector('.currencyField');
        const finalAmountField = row.querySelector('.finalAmount');
        const textAmountField = row.querySelector('.textAmount');

        if (!currencyField) return;
        const selectedCurrency = currencyField.value;
        const finalAmount = await convertAndDisplay(amt, selectedCurrency);
        const roundedAmount = finalAmount.toFixed(2);
        if(finalAmountField) finalAmountField.value = roundedAmount;
        if(textAmountField) textAmountField.innerText = `${roundedAmount}`;
    }

    // .currencyField
    if (e.target.classList.contains('currencyField')) {
        const row = e.target.closest('tr'); // adjust as needed
        const amtField = row.querySelector('.usdAmount');
        const finalAmountField = row.querySelector('.finalAmount');
        const textAmountField = row.querySelector('.textAmount');

        if (!amtField) return;
        const amt = amtField.value;
        const selectedCurrency = e.target.value;
        const finalAmount = await convertAndDisplay(amt, selectedCurrency);
        const roundedAmount = finalAmount.toFixed(2);
        if(finalAmountField) finalAmountField.value = roundedAmount;
        if(textAmountField) textAmountField.innerText = ` ${roundedAmount}`;
    }
}

// Listen to input events bubbling up from child elements
container.addEventListener('input', handleInputChange);



if (sessionStorage.getItem("successMessage")) {
    showToast(sessionStorage.getItem("successMessage"));
    sessionStorage.removeItem("successMessage");
}
FilePond.registerPlugin(FilePondPluginImagePreview);
let ponds = {};

const bookingTypes = [
    { key: 'flight', inputName: 'flightbookingimage[]' },
    { key: 'hotel', inputName: 'hotelbookingimage[]' },
    { key: 'cruise', inputName: 'cruisebookingimage[]' },
    { key: 'car', inputName: 'carbookingimage[]' },
    { key: 'train', inputName: 'trainbookingimage[]' },
    { key: 'screenshots', inputName: 'screenshots[]' },
];

document.querySelectorAll('input[type="file"]').forEach(input => {
    ponds[input.name] = FilePond.create(input, {
        allowMultiple: true,
        maxFiles: 10,
        labelMaxFileSizeExceeded: 'File is too large',
        labelMaxFileSize: 'Max file size is {filesize}',
        labelMaxTotalFileSizeExceeded: 'Maximum total size exceeded',
        labelMaxTotalFileSize: 'Maximum total size is {filesize}',
        labelMaxFileCountExceeded: 'You can only upload up to 10 files',
    });
});

// const bookingTypes = [
//     { key: 'flight', inputName: 'flightbookingimage[]' },
//     { key: 'hotel', inputName: 'hotelbookingimage[]' },
//     { key: 'cruise', inputName: 'cruisebookingimage[]' },
//     { key: 'car', inputName: 'carbookingimage[]' },
//     { key: 'train', inputName: 'trainbookingimage[]' },
// ];

// bookingTypes.forEach(({ key, inputName }) => {
//     const span = document.getElementById(`${key}_uploaded_files`);
//     const baseUrl = span.dataset.baseurl;
//     const normalizedBaseUrl = baseUrl.endsWith('/') ? baseUrl : baseUrl + '/';
//     const uploadedImages = JSON.parse(span.dataset.images || '[]');
//
//     const pondInstance = ponds[inputName];
//
//     if (pondInstance && uploadedImages.length) {
//         uploadedImages.forEach((filePath) => {
//             if (filePath) {
//                 const fullUrl = normalizedBaseUrl + filePath;
//                 fetch(fullUrl)
//                     .then(response => response.blob())
//                     .then(blob => {
//                         const fileName = filePath.split('/').pop();
//                         const file = new File([blob], fileName, { type: blob.type });
//                         pondInstance.addFile(file);
//                     })
//                     .catch(error => console.error(`Error loading ${key} file:`, error));
//             }
//         });
//     }
// });

document.getElementById('bookingForm').addEventListener('submit',async function(e){
    e.preventDefault();
    const action = e.target.action;
    const formdata = new FormData(e.target);
    const keysToDelete = [];
    const flightpattern = /^flight\[\d+\]/;
    const hotelpattern = /^hotel\[\d+\]/;
    const cruisepattern = /^cruise\[\d+\]/;
    const carpattern = /^car\[\d+\]/;
    const trainpattern = /^train\[\d+\]/;
    for (let key of formdata.keys()) {
        if (flightpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if(hotelpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if(cruisepattern.test(key)) {
            keysToDelete.push(key);
        }
        else if(carpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if(trainpattern.test(key)) {
            keysToDelete.push(key);
        }
    }
    keysToDelete.forEach(key => formdata.delete(key));



    const isFlightChecked = document.querySelector('#booking-flight').checked;
    const isHotelChecked = document.querySelector('#booking-hotel').checked;
    const isCruiseChecked = document.querySelector('#booking-cruise').checked;
    const isCarChecked = document.querySelector('#booking-car').checked;
    const isTrainChecked = document.querySelector('#booking-train').checked;
    if (isFlightChecked) {
        const flightInputs = document.querySelectorAll('[name^="flight["]');
        const rows = {};
        flightInputs.forEach(input => {
            const match = input.name.match(/^flight\[(\d+)\]\[.*\]$/);
            const rowIndex = match[1];
            if (!rows[rowIndex]) rows[rowIndex] = [];
            rows[rowIndex].push(input);
        });

        Object.values(rows).forEach(inputs => {
            const allEmpty = inputs.every(input => input.value.trim() === '');
            if (!allEmpty) {
                inputs.forEach(input => {
                    formdata.append(input.name, input.value);
                });
            }
        });
    }
    if (isHotelChecked) {
        const hotelInputs = document.querySelectorAll('[name^="hotel["]');
        const rows = {};
        hotelInputs.forEach(input => {
            const match = input.name.match(/^hotel\[(\d+)\]\[.*\]$/);
            const rowIndex = match[1];
            if (!rows[rowIndex]) rows[rowIndex] = [];
            rows[rowIndex].push(input);
        });

        Object.values(rows).forEach(inputs => {
            const allEmpty = inputs.every(input => input.value.trim() === '');
            if (!allEmpty) {
                inputs.forEach(input => {
                    formdata.append(input.name, input.value);
                });
            }
        });
    }
    if (isCruiseChecked) {
        const cruiseInputs = document.querySelectorAll('[name^="cruise["]');
        const rows = {};
        cruiseInputs.forEach(input => {
            const match = input.name.match(/^cruise\[(\d+)\]\[.*\]$/);
            const rowIndex = match[1];
            if (!rows[rowIndex]) rows[rowIndex] = [];
            rows[rowIndex].push(input);
        });

        Object.values(rows).forEach(inputs => {
            const allEmpty = inputs.every(input => input.value.trim() === '');
            if (!allEmpty) {
                inputs.forEach(input => {
                    formdata.append(input.name, input.value);
                });
            }
        });
    }
    if (isCarChecked) {
        const carInputs = document.querySelectorAll('[name^="car["]');
        const rows = {};
        carInputs.forEach(input => {
            const match = input.name.match(/^car\[(\d+)\]\[.*\]$/);
            const rowIndex = match[1];
            if (!rows[rowIndex]) rows[rowIndex] = [];
            rows[rowIndex].push(input);
        });

        Object.values(rows).forEach(inputs => {
            const allEmpty = inputs.every(input => input.value.trim() === '');
            if (!allEmpty) {
                inputs.forEach(input => {
                    formdata.append(input.name, input.value);
                });
            }
        });
    }
    if (isTrainChecked) {
        const trainInputs = document.querySelectorAll('[name^="train["]');
        const rows = {};
        trainInputs.forEach(input => {
            const match = input.name.match(/^train\[(\d+)\]\[.*\]$/);
            const rowIndex = match[1];
            if (!rows[rowIndex]) rows[rowIndex] = [];
            rows[rowIndex].push(input);
        });

        Object.values(rows).forEach(inputs => {
            const allEmpty = inputs.every(input => input.value.trim() === '');
            if (!allEmpty) {
                inputs.forEach(input => {
                    formdata.append(input.name, input.value);
                });
            }
        });
    }


    //     if (isFlightChecked) {
    //     const skipFieldsForFlight = ['airline_code', 'flight_number', 'class_of_service'];
    //     const inputs = document.querySelectorAll('[name^="flight["]');
    //     const rows = {};
    //     let dynamicIndex = 0;

    //     inputs.forEach(input => {
    //         const match = input.name.match(/^flight\[\d+\]\[([^\]]+)\]$/); // ignore original index
    //         if (!match) return;

    //         const field = match[1];
    //         const value = (input.type === 'checkbox' || input.type === 'radio')
    //             ? (input.checked ? input.value : '')
    //             : input.value.trim();

    //         // Start a new row when direction is Outbound or Inbound
    //         if (field === 'direction') {
    //             dynamicIndex++;
    //             rows[dynamicIndex] = {};
    //         }

    //         if (!rows[dynamicIndex]) rows[dynamicIndex] = {};
    //         rows[dynamicIndex][field] = value;
    //     });

    //     Object.keys(rows).forEach(index => {
    //         const rowData = rows[index];
    //         const allBlank = skipFieldsForFlight.every(field => !((rowData[field] ?? '').trim()));

    //         if (!allBlank) {
    //             Object.entries(rowData).forEach(([fieldName, value]) => {
    //                 if (value) {
    //                     formdata.append(`flight[${index}][${fieldName}]`, value);
    //                 }
    //             });
    //         }
    //     });
    // }


    const hotelInputs = document.querySelectorAll('[name^="hotel["]');
    hotelInputs.forEach(input => {
        const name = input.name;
        const value = input.value;
        formdata.append(name, value);
    });

    const trainInputs = document.querySelectorAll('[name^="train["]');
    trainInputs.forEach(input => {
        const name = input.name;
        const value = input.value;
        formdata.append(name, value);
    });

    const cruiseInputs = document.querySelectorAll('[name^="cruise["]');
    cruiseInputs.forEach(input => {
        const name = input.name;
        const value = input.value;
        formdata.append(name, value);
    });
    const carInputs = document.querySelectorAll('[name^="car["]');
    carInputs.forEach(input => {
        const name = input.name;
        const value = input.value;
        formdata.append(name, value);
    });


    for (const inputName in ponds) {
        const pond = ponds[inputName];
        pond.getFiles().forEach(fileItem => {
            formdata.append(inputName, fileItem.file); // Automatically handles multiple
        });
    }


        const skipFieldsForPassenger = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'seat_number',
        'credit_note',
        'e_ticket_number'
        ];

        const skipFieldsForBilling = [
            'card_type',
            'cc_number',
            'cc_holder_name',
            'exp_month',
            'exp_year',
            'cvv',
        ];

        // Define the key fields for pricing rows
        const skipFieldsForPricing = [
            'net_price',
            'details'
        ];

        ['passenger', 'billing', 'pricing'].forEach(prefix => {
            const inputs = document.querySelectorAll(`[name^="${prefix}["]`);
            const rows = {};
            inputs.forEach(input => {
                const match = input.name.match(/\[(\d+)\]\[(\w+)\]/);
                if (!match) return;

                const index = match[1];
                const fieldName = match[2];

                if (!rows[index]) rows[index] = {};
                rows[index][fieldName] = input.value.trim();
            });

            let skipFields = [];
            if (prefix === 'passenger') {
                skipFields = skipFieldsForPassenger;
            } else if (prefix === 'billing') {
                skipFields = skipFieldsForBilling;
            } else if (prefix === 'pricing') {
                skipFields = skipFieldsForPricing;
            }

            Object.keys(rows).forEach(index => {
                const rowData = rows[index];
                const allBlank = skipFields.every(field => !rowData[field]);

                if (!allBlank) {
                    Object.keys(rowData).forEach(fieldName => {
                        formdata.append(`${prefix}[${index}][${fieldName}]`, rowData[fieldName]);
                    });
                }
            });
        });


    try{
        formdata.append('_method','patch');
        const response = await axios.post(action, formdata, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        showToast(response.data.message);
        setTimeout(() => {
            window.location.reload();
        }, 1000);

    }
    catch (e) {
        console.error(e);

        if (e.response?.status === 422 || e.response?.status === 500) {
           // showToast(e.response?.data?.errors ?? 'Validation/server error', "error");
            const errorMessage = e.response?.data?.error || e.response?.data?.errors  || 'Validation/server error';
            showToast(errorMessage, "error");
        } else if (e.response?.status === 555) {
            let activeTab = document.querySelector('.nav-tabs .nav-link.active');
            if (activeTab) {
                localStorage.setItem("activeTab", activeTab.getAttribute("href"));
            }
            showToast(e.response?.data?.errors ?? 'Validation/server error', "error");
            // setTimeout(() => {
            //     window.location.reload();
            // }, 1000);
        } else {
            showToast("Something went wrong2", "error");
        }
    }
});

document.getElementById('saveRemark').addEventListener('click', async function(e) {
    e.preventDefault();

    const remark = document.querySelector('textarea[name="particulars"]');
    const remarkValue = remark.value.trim();

    // Client-side validation
    if (!remarkValue) {
        showToast('Please Enter a remark', 'error');
        return;
    }

    try {
        const response = await axios.post(route('booking.update-remark', { id: route().params.id }), {
            remark: remarkValue,
        });

        let html = '';
        response.data.data.forEach(function(item, index) {
            html += `<tr id="remark-row-${item.id}">
                <td>${index + 1}</td>
                <td>${item.particulars}</td>
                <td>${item.agent}</td>
                <td>${item.created_at}</td>
                <td>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input toggle-remark" data-remarkid="${item.id}" checked>
                    </div>
                </td>
            </tr>`;
        });

        $('#bookingtableremarktable').html(html);
        remark.value = '';
        showToast(response.data.message, 'success');
    } catch (e) {
        console.error("AXIOS ERROR", e);
        let errorMessage = 'Failed to save remark';
        if (e.response && e.response.data && e.response.data.message) {
            errorMessage = e.response.data.message;
        }
        showToast(errorMessage, 'error');
    }
});


$('.country-select').on('change',async function(e){
    try{
        const response = await axios.get(route('statelist',e.target.value));

        let options = '<option value="">Select State</option>';
        response.data.data.forEach(function(item){
            options += `
                <option value="${item.id}">${item.name}</option>
            `;
        });
        e.target.parentElement.nextElementSibling.querySelector('select').innerHTML = options;
    }
    catch (e) {
    }
});


document.addEventListener('DOMContentLoaded', function() {
    // Get all checkboxes and the select element
    const checkboxes = document.querySelectorAll('.toggle-tab');
    const select = document.querySelector('#query_type');

    // Store all options for later use
    const allOptions = Array.from(select.options).map(option => ({
        text: option.text,
        value: option.value,
        dataType: option.getAttribute('data-type') || null,
        selected: option.selected
    }));

    // Function to update select options based on checkbox selection
    function updateSelectOptions() {
        // Get all selected checkboxes
        const selectedTypes = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        // Clear current options
        select.innerHTML = '';

        if (selectedTypes.length === 0) {
            // If no checkboxes are selected, show all options
            allOptions.forEach(opt => {
                const option = document.createElement('option');
                option.text = opt.text;
                option.value = opt.value;
                if (opt.dataType) option.setAttribute('data-type', opt.dataType);
                if (opt.selected) option.selected = true;
                select.appendChild(option);
            });
        } else if (selectedTypes.length === 1) {
            // If exactly one checkbox is selected, show options with matching data-type
            const selectedType = selectedTypes[0];
            allOptions.forEach(opt => {
                if (opt.dataType === selectedType || opt.text === 'Package Reservation') {
                    const option = document.createElement('option');
                    option.text = opt.text;
                    option.value = opt.value;
                    if (opt.dataType) option.setAttribute('data-type', opt.dataType);
                    if (opt.selected) option.selected = true;
                    select.appendChild(option);
                }
            });
        } else {
            // If multiple checkboxes are selected, show only "Package Reservation"
            const packageOption = allOptions.find(opt => opt.text === 'Package Reservation');
            if (packageOption) {
                const option = document.createElement('option');
                option.text = packageOption.text;
                option.value = packageOption.value;
                if (packageOption.selected) option.selected = true;
                select.appendChild(option);
            }
        }
    }

    // Add event listeners to checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectOptions);
    });

    // Initialize the select options on page load
    updateSelectOptions();
});

document.querySelector('select[name="pnrtype"]').addEventListener('change',function(e){
    if(e.target.value == 'HK'){
        const pricingFormsContainer = document.getElementById('pricingForms');
        let pricingIndex = pricingFormsContainer.querySelectorAll('.pricing-row').length;
        const newRow = document.createElement('tr');
        newRow.className = 'pricing-row hkRow';
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
            <td><input type="number" style="width: 120px" class="form-control" name="pricing[${pricingIndex}][num_passengers]" value="0" min="0"></td>
            <td><input type="number" style="width: 100px" class="form-control" name="pricing[${pricingIndex}][gross_price]" value="0.00" min="0" step="0.01"></td>
            <td><span class="gross-total">0.00</span></td>
            <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][net_price]" value="10.00" min="0" step="0.01"></td>
            <td><span class="net-total">$10</span></td>
            <td>
                <select class="form-control" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                    <option selected>Issuance Fees - Voyzant</option>
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
    else{
        Array.from(document.querySelectorAll('.hkRow')).forEach(e => {
            e.remove();
        });
    }
})

function toggleBillingTableVisibility() {
    const tableBody = document.querySelector('#billing-table tbody');
    const tableContainer = document.getElementById('billing-table-container');
    const rowCount = tableBody.querySelectorAll('tr').length;

    if (rowCount === 0) {
        tableContainer.style.display = 'none';
    } else {
        tableContainer.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    toggleBillingTableVisibility(); // Initial check

    document.getElementById('save-billing-detail').addEventListener('click', async function (e) {
        e.preventDefault();

        const element = document.getElementById('billing-detail-add');
        const formdata = new FormData(element);
        const action = element.action;

        try {
            const response = await axios.post(action, formdata);
            const billingElements = [...document.querySelectorAll('[name^="billing["]')].filter(el => {
                return el.name.endsWith('][state]');
            });

            showToast(response.data.message);
            document.getElementById('billing-close-modal').click();
            element.reset();

            const data = response.data.data;
            const tableBody = document.querySelector('#billing-table tbody');
            const rowCount = tableBody.querySelectorAll('tr').length;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>Card No. ${rowCount + 1}</td>
                <td>${data.email}</td>
                <td>${data.contact_number}</td>
                <td>${data.street_address}</td>
                <td>${data.city}</td>
                <td>${data.state}</td>
                <td>${data.zip_code}</td>
                <td>${data.country}</td>
                <td>
                    <button class="btn btn-outline-danger deleteBillData" data-href="/booking/billing-details/${data.id}"><i class="ri ri-delete-bin-line"></i></button>
                </td>
            `;
            billingElements.forEach(el => {
                if (el.tagName.toLowerCase() === 'select') {
                    const option = document.createElement('option');
                    option.value = response.data.data.id;
                    option.textContent = `Card No. ${rowCount + 1}`;

                    el.appendChild(option);
                } else {
                    console.warn('Element is not a select, cannot add option:', el);
                }
            });
            tableBody.appendChild(newRow);
            attachDeleteHandler(newRow.querySelector('.deleteBillData'));

            toggleBillingTableVisibility(); // 👈 After add
        } catch (e) {
            showToast(e?.response?.data?.message || 'Something went wrong', 'error');
        }
    });

    Array.from(document.querySelectorAll('.deleteBillData')).forEach(attachDeleteHandler);
});

function attachDeleteHandler(el) {
    el.addEventListener('click', async e => {
        e.preventDefault();
        const confirmed = confirm('Are you sure you want to delete this billing record?');
        if (!confirmed) return;

        const button = e.target.closest('.deleteBillData');
        const action = button.getAttribute('data-href');

        try {
            const response = await axios.delete(action);
            showToast(response.data.message);

            // Remove table row
            const row = button.closest('tr');
            row.remove();

            // Update row numbers
            const rows = document.querySelectorAll('#billing-table tbody tr');
            rows.forEach((tr, index) => {
                tr.querySelector('td').textContent = index + 1;
            });

            // Remove corresponding <option> from all select fields
            // Adjust 'deletedId' as per your API response structure
            const deletedId = response.data.deleted_id;

            const billingSelects = [...document.querySelectorAll('[name^="billing["]')].filter(el => {
                return el.name.endsWith('][state]');
            });

            billingSelects.forEach(select => {
                if (select.tagName.toLowerCase() === 'select') {
                    // Find the option with the deleted id
                    const optionToRemove = select.querySelector(`option[value="${deletedId}"]`);
                    if (optionToRemove) {
                        select.removeChild(optionToRemove);
                    }
                }
            });

            toggleBillingTableVisibility(); // 👈 After delete
        } catch (e) {
            showToast(e?.response?.data?.message || 'Failed to delete', 'error');
        }
    });
}



document.getElementById('saveFeedback').addEventListener('click', async function (e) {
    e.preventDefault();


    const parameters = Array.from(document.querySelectorAll('input[name="parameters[]"]:checked')).map(input => {
        const parentDiv = input.closest('.col-lg-3, .col-md-6, .col-12');

        const textarea = parentDiv.querySelector(`textarea[data-related="${input.id}"]`);

        let marks = textarea?.dataset.marksvalue || '';
        let quality = textarea?.dataset.qualitytype || '';

        if (!marks) {
            const marksInput = parentDiv.querySelector('input[name="marks_value"]');
            marks = marksInput ? marksInput.value : '';
        }
        if (!quality) {
            const qualityInput = parentDiv.querySelector('input[name="quality_type"]');
            quality = qualityInput ? qualityInput.value : '';
        }

        const note = textarea ? textarea.value : '';

        return {
            parameter: input.value,
            note,
            marks,
            quality
        };
    });

    try {
        const response = await axios.post(route('booking.update-feedback', { id: route().params.id }), {
            parameters: parameters
        });

        let html = '';
        response.data.data.forEach(function (item, index) {
            const date = new Date(item.created_at).toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).split('/').join('-');

                let labelClass = 'bg-secondary text-white'; // default
                if (item.quality === 'fatal') {
                    labelClass = 'bg-danger text-white';
                } else if (item.quality === 'non_fatal') {
                    labelClass = 'bg-success text-white';
                }
                html += `<tr>
                <td>
                    <div class="qis-label ${labelClass} p-1 rounded">
                        <span class="qis-icon">⏱️</span> ${item.parameter}
                    </div>
                </td>
                <td>${item.note}</td>
                <td>${item.user_id}</td>
                <td>${item.created_at}</td>
            </tr>`;
        });
        $('#booking_feed_back_table tbody').html(html);
        showToast(response.data.message);

    } catch (e) {
        console.error("AXIOS ERROR", e);
        if (e.response) {
            console.error("Server responded with:", e.response.data);
            showToast('Error saving feedback: ' + e.response.data.message, 'error');
        } else {
            showToast('Error saving feedback', 'error');
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.chkqlty').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const relatedId = this.id;
                const textarea = document.querySelector('textarea[data-related="' + relatedId + '"]');
                if (this.checked) {
                    textarea.classList.remove('d-none');
                } else {
                    textarea.classList.add('d-none');
                    textarea.value = '';
                }
            });
        });
    });


    // Optional: Handle delete button clicks
document.addEventListener('DOMContentLoaded', function () {
    const bookingId = route().params.id; // This works if you're on a route like /booking/{id}/...

    document.querySelectorAll('.chkqlty').forEach(function (checkbox) {
        checkbox.addEventListener('change', async function () {
            const paramName = this.value;
            const textarea = document.querySelector(`textarea[data-related="${paramName}"]`);

            if (!this.checked) {
                const confirmDelete = confirm(`Are you sure you want to delete feedback for "${paramName}"?`);
                if (confirmDelete) {
                    if (textarea) {
                        textarea.value = '';
                        textarea.classList.add('d-none');
                    }

                    try {
                        const response = await axios.post(route('booking.delete-feedback', { id: bookingId }), {
                            booking_id: bookingId,
                            parameter: paramName
                        });

                            showToast(response.data.message);
                    } catch (e) {
                        console.error("Delete error", e);
                        showToast('Error deleting feedback.', 'error');
                    }
                } else {
                    this.checked = true; // restore if canceled
                }
            } else {
                // Show textarea on check
                if (textarea) {
                    textarea.classList.remove('d-none');
                }
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-remark');
    toggles.forEach(function (checkbox) {
        checkbox.addEventListener('change', async function () {
            const id = this.dataset.remarkid;
                try {
                    const response = await axios.post(route('booking.status-remark', { id }));

                    if (response.data.success) {

                            const row = document.getElementById(`remark-row-${id}`);
                            if (row) {
                                setTimeout(() => {
                                    row.style.display = 'none';
                                }, 1000);
                            }

                    }
                } catch (error) {
                    console.error('Failed to toggle remark status:', error);
                }
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('sendMailModal');

    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const loadContainer = document.getElementById('load_model');
            if (loadContainer && id) {
                loadContainer.innerHTML = 'Loading...';
                fetch(`/i_authorized/${id}`)
                    .then(res => res.text())
                    .then(html => {
                        loadContainer.innerHTML = html;
                    })
                    .catch(() => {
                        loadContainer.innerHTML = '<p class="text-danger">Failed to load content.</p>';
                    });
            }
        });

        modal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('load_model').innerHTML = '';
        });
    }

    const form = document.getElementById('sendAuthEmail');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            document.querySelectorAll('input[name="auth_email[]"]:checked').forEach((checkbox, index) => {
                params.append(`cards[${index}]`, checkbox.dataset.cards);
                params.append(`billing_details_ids[${index}]`, checkbox.dataset.billing_details_id);
                params.append(`travel_billing_details_ids[${index}]`, checkbox.dataset.travel_billing_details_id);
            });

            fetch('/mail-sent?' + params.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message);
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) modalInstance.hide();
            })
            .catch(error => {
                showToast('Error sending email.', 'error');
                console.error(error);
            });
        });
    }
});

// document.getElementById('bookingtableremarktable').addEventListener('click', async function (e) {
//     if (e.target.classList.contains('deleteRemark')) {
//         const id = e.target.getAttribute('data-id');
//         try {
//             const response = await axios.post(route('booking.delete-remark', { id: id }), {
//                 booking_id: route().params.id
//             });

//             let html = '';
//             response.data.data.forEach(function(item, index) {
//                 html += `<tr>
//                     <td>${index + 1}</td>
//                     <td>${item.particulars}</td>
//                     <td>
//                         <button type="button" class="btn btn-danger deleteRemark" data-id="${item.id}">
//                             Delete
//                         </button>
//                     </td>
//                 </tr>`;
//             });

//             $('#bookingtableremarktable').html(html);
//             document.querySelector('textarea[name="particulars"]').value = "";
//             showToast(response.data.message);
//         } catch (err) {
//             console.log(err);
//         }
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    // Restore the active tab from localStorage
    let activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
        let tabEl = document.querySelector(`a[href="${activeTab}"]`);
        if (tabEl) {
            new bootstrap.Tab(tabEl).show();
        }
    }

    // Save the active tab whenever it changes
    document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function (tab) {
        tab.addEventListener("shown.bs.tab", function (e) {
            localStorage.setItem("activeTab", e.target.getAttribute("href"));
        });
    });
});
