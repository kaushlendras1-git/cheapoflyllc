import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import {route} from "ziggy-js";
import CurrencyAPI from '@everapi/currencyapi-js';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


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

const container = document.getElementById('billingForms');

container.addEventListener('input', async function(e) {
    if (e.target.classList.contains('usdAmount')) {
        const row = e.target.closest('tr');
        const amt = e.target.value;
        const currencyField = row.querySelector('.currencyField');
        if (!currencyField) return;
        const selectedCurrency = currencyField.value;
        if (!amt || !selectedCurrency) return;
        const finalAmount = await convertAndDisplay(amt, selectedCurrency);
        const roundedAmount = finalAmount.toFixed(2);
        const finalAmountField = row.querySelector('.finalAmount');
        const textAmountField = row.querySelector('.textAmount');
        if (finalAmountField) finalAmountField.value = roundedAmount;
        if (textAmountField) textAmountField.innerText = `${roundedAmount}`;
    }
});

container.addEventListener('change', async function(e) {
    if (e.target.classList.contains('currencyField')) {
        const row = e.target.closest('tr');
        const amtField = row.querySelector('.usdAmount');
        if (!amtField) return;
        const amt = amtField.value;
        if (!amt) return;
        const selectedCurrency = e.target.value;
        if (!selectedCurrency) return;
        const finalAmount = await convertAndDisplay(amt, selectedCurrency);
        const roundedAmount = finalAmount.toFixed(2);
        const finalAmountField = row.querySelector('.finalAmount');
        const textAmountField = row.querySelector('.textAmount');
        if (finalAmountField) finalAmountField.value = roundedAmount;
        if (textAmountField) textAmountField.innerText = `${roundedAmount}`;
    }
});




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

document.querySelectorAll('.destroy_filepond').forEach(input => {
    FilePond.destroy(input);
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
                    if (input.value.trim() !== '') {
                        formdata.append(input.name, input.value);
                    }
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
                    if (input.value.trim() !== '') {
                        formdata.append(input.name, input.value);
                    }
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
                    if (input.value.trim() !== '') {
                        formdata.append(input.name, input.value);
                    }
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
                    if (input.value.trim() !== '') {
                        formdata.append(input.name, input.value);
                    }
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
                    if (input.value.trim() !== '') {
                        formdata.append(input.name, input.value);
                    }
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

        const carMainImageInput = document.querySelector('input[name="car_main_image[]"]');
        if (carMainImageInput && carMainImageInput.files.length > 0) {
            for (const file of carMainImageInput.files) {
                formdata.append('car_main_image[]', file);
            }
        }
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

const saveFeedbackBtn = document.getElementById('saveFeedback');
if (saveFeedbackBtn) {
    saveFeedbackBtn.addEventListener('click', async function (e) {
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
}

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









document.addEventListener('DOMContentLoaded', function() {
    const queryTypeSelect = document.getElementById('query_type');
    if (!queryTypeSelect) return;

    // Store all original options
    const allOptions = [];
    Array.from(queryTypeSelect.options).forEach(option => {
        allOptions.push({
            value: option.value,
            text: option.text,
            dataType: option.getAttribute('data-type')
        });
    });

    function updateQueryType() {
        // Get all checked checkboxes that might be booking types
        const allChecked = document.querySelectorAll('input[type="checkbox"]:checked');
        const checkedTypes = [];

        // Extract booking types from checked boxes
        allChecked.forEach(checkbox => {
            const value = checkbox.value;
            const id = checkbox.id;
            const name = checkbox.name;

            // Check if this is a booking type checkbox
            if (value === 'Flight' || id.includes('flight') || name.includes('flight')) {
                checkedTypes.push('Flight');
            } else if (value === 'Cruise' || id.includes('cruise') || name.includes('cruise')) {
                checkedTypes.push('Cruise');
            } else if (value === 'Car' || id.includes('car') || name.includes('car')) {
                checkedTypes.push('Car');
            } else if (value === 'Hotel' || id.includes('hotel') || name.includes('hotel')) {
                checkedTypes.push('Hotel');
            } else if (value === 'Train' || id.includes('train') || name.includes('train')) {
                checkedTypes.push('Train');
            }
        });

        // Remove duplicates
        const uniqueTypes = [...new Set(checkedTypes)];

        // Clear and rebuild options
        queryTypeSelect.innerHTML = '';

        let optionsToShow = [];

        if (uniqueTypes.length === 0) {
            optionsToShow = allOptions; // Show all when none selected
        } else if (uniqueTypes.length === 1) {
            optionsToShow = allOptions.filter(opt => opt.dataType === uniqueTypes[0]);
        } else {
            optionsToShow = allOptions.filter(opt => opt.dataType === 'Package');
        }

        // Add options back
        optionsToShow.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.textContent = option.text;
            opt.setAttribute('data-type', option.dataType);
            opt.setAttribute('data-id', option.value);
            queryTypeSelect.appendChild(opt);
        });
    }

    // Listen to all checkbox changes
    document.addEventListener('change', function(e) {
        if (e.target.type === 'checkbox') {
            updateQueryType();
        }
    });

    updateQueryType(); // Initial call
});



document.addEventListener("DOMContentLoaded", () => {
    // Apply autocomplete for both departure and arrival inputs
    function initAutocomplete(input, searchAt) {
        const suggestionsBox = input.nextElementSibling;

        input.addEventListener("input", async (e) => {
            const keyword = e.target.value.trim();
            if (keyword.length < 2) {
                suggestionsBox.style.display = "none";
                return;
            }

            try {
                const response = await axios.get(route("airline.search", {}, Ziggy), {
                    params: {
                        keyword: keyword,
                        searchAt: searchAt // 'departure' or 'arrival'
                    }
                });

                const data = response.data;

                if (data.length > 0) {
                    suggestionsBox.innerHTML = data.map(item => `
                        <div class="suggestion-item" style="padding:5px; cursor:pointer;">
                           ${item.airport_name}, ${item.city}, ${item.country}
                        </div>
                    `).join("");
                    suggestionsBox.style.display = "block";
                } else {
                    suggestionsBox.style.display = "none";
                }
            } catch (error) {
                console.error("Error fetching data", error);
            }
        });

        suggestionsBox.addEventListener("click", (e) => {
            if (e.target.classList.contains("suggestion-item")) {
                input.value = e.target.textContent.trim();
                suggestionsBox.style.display = "none";
            }
        });

        input.addEventListener("blur", () => {
            setTimeout(() => {
                suggestionsBox.style.display = "none";
            }, 150);
        });
    }

    // Initialize for existing inputs
    document.querySelectorAll(".departure-airport").forEach(input => {
        initAutocomplete(input, 'departure');
    });
    document.querySelectorAll(".arrival-airport").forEach(input => {
        initAutocomplete(input, 'arrival');
    });

    // When adding a new row dynamically, reinitialize for new inputs
    const flightFormsContainer = document.getElementById('flightForms');
    const observer = new MutationObserver(() => {
        document.querySelectorAll(".departure-airport").forEach(input => {
            if (!input.dataset.autocomplete) {
                initAutocomplete(input, 'departure');
                input.dataset.autocomplete = true;
            }
        });
        document.querySelectorAll(".arrival-airport").forEach(input => {
            if (!input.dataset.autocomplete) {
                initAutocomplete(input, 'arrival');
                input.dataset.autocomplete = true;
            }
        });
    });
    observer.observe(flightFormsContainer, { childList: true, subtree: true });
});


const input = document.getElementById('fileInput');
const previewContainer = document.getElementById('imagePreviewContainer');

input.addEventListener('change', () => {
    previewContainer.innerHTML = ''; // Clear previous previews

    const files = input.files;
    if (files.length === 0) return;

    for (const file of files) {
        if (!file.type.startsWith('image/')) continue; // Ignore non-images

        const reader = new FileReader();
        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '80px';
            img.style.height = '80px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '6px';
            img.style.border = '1px solid #ccc';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});

const timeInputs = document.querySelectorAll('.time_24_hrs');
timeInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        let value = input.value;

        // Remove any non-digit and non-colon characters
        value = value.replace(/[^\d:]/g, '');

        // Auto-insert colon after two digits (hours) if not present
        if (value.length === 2 && !value.includes(':')) {
            value += ':';
        }

        // Limit length to 5 characters (HH:mm)
        if (value.length > 5) {
            value = value.slice(0,5);
        }

        input.value = value;

        // Validate 24-hour time format
        const regex = /^([01]\d|2[0-3]):([0-5]\d)$/;
        if (!regex.test(value)) {
            input.setCustomValidity('Please enter a valid time in 24-hour format HH:mm');
        } else {
            input.setCustomValidity('');
        }
    });
});

/***************Pricing***************** */

