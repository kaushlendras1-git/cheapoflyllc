import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

import { route } from "ziggy-js";
import CurrencyAPI from '@everapi/currencyapi-js';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';
import './timeFormatter.js';

// Store Quill instances globally
window.quillInstances = {};

document.addEventListener('DOMContentLoaded', () => {
    const textareas = document.querySelectorAll('textarea[name$="_description"], textarea[name*="[service_name]"]');

    textareas.forEach(textarea => {
        // Create div container for Quill
        const editorDiv = document.createElement('div');
        editorDiv.style.minHeight = '150px';
        textarea.style.display = 'none';
        textarea.parentNode.insertBefore(editorDiv, textarea.nextSibling);

        // Initialize Quill
        const quill = new Quill(editorDiv, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Set initial content
        quill.root.innerHTML = textarea.value;

        // Store instance
        window.quillInstances[textarea.name] = quill;

        // Update textarea on content change
        quill.on('text-change', () => {
            textarea.value = quill.root.innerHTML;
        });
    });
});


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
        if (finalAmountField) finalAmountField.value = roundedAmount;
        if (textAmountField) textAmountField.innerText = `${roundedAmount}`;
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
        if (finalAmountField) finalAmountField.value = roundedAmount;
        if (textAmountField) textAmountField.innerText = ` ${roundedAmount}`;
    }
}

const container = document.getElementById('billingForms');

if (container) {
    container.addEventListener('input', async function (e) {
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

    container.addEventListener('change', async function (e) {
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
}

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
        allowPaste: false, // Disable global paste
    });
});

// Enable paste only for the active tab's filepond
document.addEventListener('paste', function (e) {
    const activeTab = document.querySelector('.tab-pane.active');
    if (!activeTab) return;

    const activeFilePond = activeTab.querySelector('.filepond--root');
    if (!activeFilePond) return;

    // Find the corresponding pond instance
    const fileInput = activeTab.querySelector('input[type="file"]');
    if (fileInput && ponds[fileInput.name]) {
        // Temporarily enable paste for active pond
        ponds[fileInput.name].allowPaste = true;

        // Disable paste for all other ponds
        Object.keys(ponds).forEach(key => {
            if (key !== fileInput.name) {
                ponds[key].allowPaste = false;
            }
        });
    }
});

// Reset paste settings when tab changes
document.addEventListener('shown.bs.tab', function (e) {
    // Disable paste for all ponds first
    Object.keys(ponds).forEach(key => {
        ponds[key].allowPaste = false;
    });

    // Enable paste for the newly active tab
    const newActiveTab = document.querySelector(e.target.getAttribute('href'));
    if (newActiveTab) {
        const fileInput = newActiveTab.querySelector('input[type="file"]');
        if (fileInput && ponds[fileInput.name]) {
            ponds[fileInput.name].allowPaste = true;
        }
    }
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

document.getElementById('bookingForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    // Sync Quill data before form submission
    if (window.quillInstances) {
        for (const [name, quill] of Object.entries(window.quillInstances)) {
            const textarea = document.querySelector(`textarea[name="${name}"]`);
            if (textarea && quill) {
                textarea.value = quill.root.innerHTML;
            }
        }
    }
    
    const action = e.target.action;
    const formdata = new FormData(e.target);
    
    // Calculate and add gross_value and net_value to FormData
    const pricingRows = document.querySelectorAll('#pricingForms .pricing-row');
    let grossTotal = 0;
    let netTotal = 0;
    
    pricingRows.forEach(row => {
        const grossTotalSpan = row.querySelector('.gross-total');
        const netTotalSpan = row.querySelector('.net-total');
        if (grossTotalSpan) grossTotal += parseFloat(grossTotalSpan.textContent || 0);
        if (netTotalSpan) netTotal += parseFloat(netTotalSpan.textContent || 0);
    });
    
    formdata.set('gross_value', grossTotal.toFixed(2));
    formdata.set('net_value', netTotal.toFixed(2));
    const keysToDelete = [];
    const flightpattern = /^flight\[\d+\]/;
    const hotelpattern = /^hotel\[\d+\]/;
    const cruisepattern = /^cruise\[\d+\]/;
    const carpattern = /^car\[\d+\]/;
    const trainpattern = /^train\[\d+\]/;
    for (let key of formdata.keys()) {
        // Skip deletion of gross_value and net_value
        if (key === 'gross_value' || key === 'net_value') {
            continue;
        }
        if (flightpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if (hotelpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if (cruisepattern.test(key)) {
            keysToDelete.push(key);
        }
        else if (carpattern.test(key)) {
            keysToDelete.push(key);
        }
        else if (trainpattern.test(key)) {
            keysToDelete.push(key);
        }
    }
    keysToDelete.forEach(key => formdata.delete(key));



    const isFlightChecked = document.querySelector('#booking-flight')?.checked || false;
    const isHotelChecked = document.querySelector('#booking-hotel')?.checked || false;
    const isCruiseChecked = document.querySelector('#booking-cruise')?.checked || false;
    const isCarChecked = document.querySelector('#booking-car')?.checked || false;
    const isTrainChecked = document.querySelector('#booking-train')?.checked || false;
 
    console.log('Cruise checkbox checked:', isCruiseChecked);
 
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
        // Handle hotel description
        const hotelDesc = document.querySelector('[name="hotel_description"]');
        if (hotelDesc && hotelDesc.value.trim()) {
            formdata.append('hotel_description', hotelDesc.value.trim());
        }
        
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
        // Handle main cruise details (simple field names)
        const mainCruiseFields = ['cruise_line', 'ship_name', 'cruise_name', 'length', 'departure_port', 'arrival_port', 'category', 'stateroom', 'cruise_description'];
        const mainCruiseData = {};
        
        mainCruiseFields.forEach(fieldName => {
            const input = document.querySelector(`[name="${fieldName}"]`);
            if (input && input.value.trim()) {
                mainCruiseData[fieldName] = input.value.trim();
            }
        });
        
        // Add main cruise data if not empty
        if (Object.keys(mainCruiseData).length > 0) {
            Object.entries(mainCruiseData).forEach(([key, val]) => {
                formdata.append(key, val);
            });
        }

        // Handle cruise itinerary (indexed fields)
        const cruiseInputs = document.querySelectorAll('[name^="cruise["]');
        const cruiseRows = {};

        cruiseInputs.forEach(input => {
            const match = input.name.match(/^cruise\[(\d+)\]\[(.*?)\]$/);
            if (match) {
                const rowIndex = match[1];
                const fieldName = match[2];

                if (!cruiseRows[rowIndex]) cruiseRows[rowIndex] = {};
                cruiseRows[rowIndex][fieldName] = input.value.trim();
            }
        });

        Object.entries(cruiseRows).forEach(([index, row]) => {
            const allEmpty = Object.values(row).every(val => val === '');
            if (!allEmpty) {
                Object.entries(row).forEach(([key, val]) => {
                    if (val !== '') {
                        formdata.append(`cruise[${index}][${key}]`, val);
                    }
                });
            }
        });

        // ✅ Handle Cruise Add-ons (With File Uploads)
        const cruiseAddonInputs = document.querySelectorAll('[name^="cruiseaddon["]');
        const addonRows = {};

        cruiseAddonInputs.forEach(input => {
            const match = input.name.match(/^cruiseaddon\[(\d+)\]\[(.*?)\]/);
            if (match) {
                const rowIndex = match[1];
                const fieldName = match[2];

                if (!addonRows[rowIndex]) addonRows[rowIndex] = {};
                if (fieldName === 'image') {
                    // Handle multiple files for image
                    addonRows[rowIndex][fieldName] = input.files;
                } else {
                    addonRows[rowIndex][fieldName] = input.value.trim();
                }
            }
        });

        Object.entries(addonRows).forEach(([index, row]) => {
            const allEmpty = Object.entries(row).every(([key, val]) => {
                return key === 'image' ? val.length === 0 : val === '';
            });

            if (!allEmpty) {
                Object.entries(row).forEach(([key, val]) => {
                    if (key === 'image' && val.length > 0) {
                        for (let i = 0; i < val.length; i++) {
                            formdata.append(`cruiseaddon[${index}][image][]`, val[i]);
                        }
                    } else if (val !== '') {
                        formdata.append(`cruiseaddon[${index}][${key}]`, val);
                    }
                });
            }
        });
    }



    if (isCarChecked) {
        // Handle car description
        const carDesc = document.querySelector('[name="car_description"]');
        if (carDesc && carDesc.value.trim()) {
            formdata.append('car_description', carDesc.value.trim());
        }
        
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
        // Handle train description
        const trainDesc = document.querySelector('[name="train_description"]');
        if (trainDesc && trainDesc.value.trim()) {
            formdata.append('train_description', trainDesc.value.trim());
        }
        
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
    try {
        formdata.append('_method', 'patch');
        const response = await axios.post(action, formdata, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        if (response.data.reload) {
            location.reload();
            return;
        }
        showToast(response.data.message);
        setTimeout(() => {
            window.location.reload();
        }, 1000);

    }
    catch (e) {
        console.error(e);

        if (e.response?.data?.reload) {
            const errorMessage = e.response?.data?.error || e.response?.data?.errors || 'Page will reload';
            showToast(errorMessage, "error");
            const delay = e.response?.data?.delay_reload || 2000;
            setTimeout(() => {
                location.reload();
            }, delay);
            return;
        }

        if (e.response?.status === 422 || e.response?.status === 500) {
            // showToast(e.response?.data?.errors ?? 'Validation/server error', "error");
            const errorMessage = e.response?.data?.error || e.response?.data?.errors || 'Validation/server error';
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

document.getElementById('saveRemark').addEventListener('click', async function (e) {
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
        response.data.data.forEach(function (item, index) {
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

$('.country-select').on('change', async function (e) {
    try {
        const response = await axios.get(route('statelist', e.target.value));

        let options = '<option value="">Select State</option>';
        response.data.data.forEach(function (item) {
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
    if (!tableBody || !tableContainer) return;

    const rowCount = tableBody.querySelectorAll('tr').length;

    if (rowCount === 0) {
        tableContainer.style.display = 'none';
    } else {
        tableContainer.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Initial check (only if billing table exists)
    toggleBillingTableVisibility();

    const saveBillingBtn = document.getElementById('save-billing-detail');
    if (saveBillingBtn) {
        saveBillingBtn.addEventListener('click', async function (e) {
            e.preventDefault();

            const element = document.getElementById('billing-detail-add');
            const formdata = new FormData(element);
            const action = element.action;
            const isEditing = element.dataset.editingId;

            try {
                let response;
                if (isEditing) {
                    formdata.append('_method', 'PUT');
                    response = await axios.post(action, formdata);
                } else {
                    response = await axios.post(action, formdata);
                }

                showToast(response.data.message);
                document.getElementById('billing-close-modal').click();

                const data = response.data.data;
                const tableBody = document.querySelector('#billing-table tbody');

                if (isEditing) {
                    // Update existing row
                    const rowIndex = element.dataset.editingRow;
                    const row = tableBody.rows[rowIndex - 1]; // -1 because rowIndex is 1-based
                    if (row) {
                        row.cells[1].textContent = data.email;
                        row.cells[2].textContent = data.contact_number;
                        row.cells[3].textContent = data.street_address;
                        row.cells[4].textContent = data.city;
                        row.cells[5].textContent = data.state || '';
                        row.cells[6].textContent = data.zip_code;
                        row.cells[7].textContent = data.country || '';
                    }
                    // Clear editing state
                    delete element.dataset.editingId;
                    delete element.dataset.editingRow;
                } else {
                    // Add new row
                    const billingElements = [...document.querySelectorAll('[name^="billing["]')].filter(el => {
                        return el.name.endsWith('][state]');
                    });

                    if (tableBody) {
                        const rowCount = tableBody.querySelectorAll('tr').length;

                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                        <td>Billing No. ${rowCount + 1}</td>
                        <td>${data.email}</td>
                        <td>${data.contact_number}</td>
                        <td>${data.street_address}</td>
                        <td>${data.city}</td>
                        <td>${data.state}</td>
                        <td>${data.zip_code}</td>
                        <td>${data.country}</td>
                        <td class="text-center">
                            <button data-href="/booking/billing-details/edit/${data.id}" class="btn btn-outline-primary editBillData me-2">
                                <i class="ri ri-edit-line"></i>
                            </button>
                            <button class="btn btn-outline-danger deleteBillData" data-href="/booking/billing-details/${data.id}">
                                <i class="ri ri-delete-bin-line"></i>
                            </button>
                        </td>
                    `;
                        billingElements.forEach(el => {
                            if (el.tagName.toLowerCase() === 'select') {
                                const option = document.createElement('option');
                                option.value = response.data.data.id;
                                option.textContent = `Card No. ${rowCount + 1}`;
                                el.appendChild(option);
                            }
                        });
                        tableBody.appendChild(newRow);
                        attachDeleteHandler(newRow.querySelector('.deleteBillData'));
                        attachEditHandler(newRow.querySelector('.editBillData'));
                        toggleBillingTableVisibility();
                    }
                }

                element.reset();
                element.action = element.action.replace(/\/\d+$/, '/' + window.location.pathname.split('/').pop());
                element.method = 'POST';

            } catch (e) {
                showToast(e?.response?.data?.message || 'Something went wrong', 'error');
            }
        });
    }

    Array.from(document.querySelectorAll('.deleteBillData')).forEach(attachDeleteHandler);
    Array.from(document.querySelectorAll('.editBillData')).forEach(attachEditHandler);
});

function attachEditHandler(el) {
    el.addEventListener('click', async e => {
        e.preventDefault();
        const button = e.target.closest('.editBillData');
        const action = button.getAttribute('data-href');

        try {
            const response = await axios.get(action);
            const data = response.data.data;

            // Populate modal fields
            document.getElementById('billing-email').value = data.email;
            document.querySelector('input[name="contact_number"]').value = data.contact_number;
            document.querySelector('input[name="street_address"]').value = data.street_address;
            document.querySelector('input[name="city"]').value = data.city;
            document.querySelector('select[name="country"]').value = data.country;
            document.querySelector('input[name="zip_code"]').value = data.zip_code;

            // Load states for selected country
            if (data.country) {
                const stateResponse = await axios.get(`/statelist/${data.country}`);
                let stateOptions = '<option value="">Select State</option>';
                stateResponse.data.data.forEach(state => {
                    stateOptions += `<option value="${state.id}" ${state.id == data.state ? 'selected' : ''}>${state.name}</option>`;
                });
                document.getElementById('billingState').innerHTML = stateOptions;
            }

            // Change form action to update and store original row
            const form = document.getElementById('billing-detail-add');
            form.action = action.replace('/edit/', '/');
            form.method = 'PUT';
            form.dataset.editingId = data.id;
            form.dataset.editingRow = button.closest('tr').rowIndex;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();

        } catch (e) {
            showToast('Failed to load billing details', 'error');
        }
    });
}

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


document.addEventListener('DOMContentLoaded', function () {
    const queryTypeSelect = document.getElementById('query_type');
    if (!queryTypeSelect) return;

    // Store all original options
    const allOptions = [];
    Array.from(queryTypeSelect.options).forEach(option => {
        allOptions.push({
            value: option.value,
            text: option.text,
            dataType: option.getAttribute('data-type'),
            selected: option.selected // Store selected state
        });
    });

    function updateQueryType() {
        // Get all checked checkboxes that might be booking types
        const allChecked = document.querySelectorAll('input[type="checkbox"]:checked');
        const checkedTypes = [];

        // Store currently selected value before clearing
        const currentlySelected = queryTypeSelect.value;

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
            // Set selected if this was the previously selected value
            if (option.value === currentlySelected) {
                opt.selected = true;
            }
            queryTypeSelect.appendChild(opt);
        });

        // If previously selected value is not in new options, select first option
        if (!optionsToShow.some(opt => opt.value === currentlySelected) && optionsToShow.length > 0) {
            queryTypeSelect.value = optionsToShow[0].value;
        }
    }

    // Listen to all checkbox changes
    document.addEventListener('change', function (e) {
        if (e.target.type === 'checkbox') {
            updateQueryType();
        }
    });

    updateQueryType(); // Initial call
});






const input = document.getElementById('fileInput');
const previewContainer = document.getElementById('imagePreviewContainer');

if (previewContainer) {
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
}


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
            value = value.slice(0, 5);
        }

        input.value = value;

        // Validate 24-hour time format
        const regex = /^([01]\d|2[0-3]):([0-5]\d)$/;
        if (!regex.test(value)) {
          //  input.setCustomValidity('Please enter a valid time in 24-hour format HH:mm');
        } else {
            input.setCustomValidity('');
        }
    });
});

/***************Pricing***************** */


/***************Flight Search***************** */

document.addEventListener("DOMContentLoaded", () => {

    function initAutocomplete(input, searchAt) {
        const td = input.closest('td') || input.parentElement;
        const suggestionsBox = td.querySelector('.flight-suggestions-list');
        if (input) {
            input.addEventListener("input", async (e) => {
                const keyword = e.target.value.trim();
                if (keyword.length < 3) {
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
        }

        if (suggestionsBox) {
            suggestionsBox.addEventListener("click", (e) => {
                if (e.target.classList.contains("suggestion-item")) {
                    input.value = e.target.textContent.trim();
                    suggestionsBox.style.display = "none";
                }
            });
        }
        input.addEventListener("blur", () => {
            setTimeout(() => {
                suggestionsBox.style.display = "none";
            }, 150);
        });
    }

    function initAutocompleteAirplaneCode(input, searchAt) {
        const td = input.closest('td') || input.parentElement;
        const suggestionsBox = td.querySelector('.flight-code-suggestions-list');
        if (input) {
            input.addEventListener("input", async (e) => {
                const keyword = e.target.value.trim();
                if (keyword.length < 2) {
                    suggestionsBox.style.display = "none";
                    return;
                }

                try {
                    const response = await axios.get(route("airlines_code.search", {}, Ziggy), {
                        params: {
                            keyword: keyword,
                            searchAt: searchAt // 'departure' or 'arrival'
                        }
                    });

                    const data = response.data;
                    console.log(data);
                    if (data.length > 0) {
                        suggestionsBox.innerHTML = data.map(item => `
                        <div data-code="${item.airline_code}"  class="suggestion-item" style="padding:5px; cursor:pointer;">
                           ${item.airline_code},${item.airline_name}
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
        }

        if (suggestionsBox) {
            suggestionsBox.addEventListener("click", (e) => {
                if (e.target.classList.contains("suggestion-item")) {
                    //input.value = e.target.textContent.trim();
                    input.value = e.target.dataset.code;
                    suggestionsBox.style.display = "none";
                }
            });
        }
        input.addEventListener("blur", () => {
            setTimeout(() => {
                suggestionsBox.style.display = "none";
            }, 150);
        });
    }

    function initAutocompleteOperation(input, searchAt) {
        const td = input.closest('td') || input.parentElement;
        const suggestionsBox = td.querySelector('.operating-flight-suggestions-list');
        if (input) {
            input.addEventListener("input", async (e) => {
                const keyword = e.target.value.trim();
                if (keyword.length < 2) {
                    suggestionsBox.style.display = "none";
                    return;
                }

                try {
                    const response = await axios.get(route("airlines_code.search", {}, Ziggy), {
                        params: {
                            keyword: keyword,
                            searchAt: searchAt // 'departure' or 'arrival'
                        }
                    });

                    const data = response.data;
                    if (data.length > 0) {
                        suggestionsBox.innerHTML = data.map(item => `
                        <div data-code="${item.airline_code}"  class="suggestion-item" style="padding:5px; cursor:pointer;">
                           ${item.airline_code},${item.airline_name}
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
        }

        if (suggestionsBox) {
            suggestionsBox.addEventListener("click", (e) => {
                if (e.target.classList.contains("suggestion-item")) {
                    //input.value = e.target.textContent.trim();
                    input.value = e.target.dataset.code;
                    suggestionsBox.style.display = "none";
                }
            });
        }
        input.addEventListener("blur", () => {
            setTimeout(() => {
                suggestionsBox.style.display = "none";
            }, 150);
        });
    }



    document.querySelectorAll(".operating_service_search").forEach(input => {
        initAutocompleteOperation(input, 'departure');
    });

    document.querySelectorAll(".airline_code_input").forEach(input => {
        initAutocompleteAirplaneCode(input, 'departure');
    });

    document.querySelectorAll(".arrival-airport").forEach(input => {
        initAutocomplete(input, 'arrival');
    });

    const flightFormsContainer = document.getElementById('flightForms');
    if (flightFormsContainer) {
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
    }

});
/***************Train Search***************** */

document.addEventListener("DOMContentLoaded", () => {
    function initTrainAutocomplete(input, searchAt) {
        const td = input.closest('td') || input.parentElement;
        const suggestionsBox = td.querySelector('.train-suggestions-box');
        if (!suggestionsBox) {
            console.warn('train-suggestions-box not found for input:', input);
            return;
        }

        const positionBox = () => {
            suggestionsBox.style.width = input.offsetWidth + 'px';
        };
        positionBox();
        window.addEventListener('resize', positionBox);

        let inflight = 0;

        const render = (arr) => {
            if (!Array.isArray(arr) || arr.length === 0) {
                suggestionsBox.style.display = 'none';
                suggestionsBox.innerHTML = '';
                return;
            }
            suggestionsBox.innerHTML = arr.map(item => `
                <div class="suggestion-item">${item.name}</div>
            `).join('');
            suggestionsBox.style.display = 'block';
        };
        input.addEventListener("input", async (e) => {
            const keyword = e.target.value.trim();
            if (keyword.length < 2) {
                suggestionsBox.style.display = "none";
                suggestionsBox.innerHTML = '';
                return;
            }

            const seq = ++inflight;
            try {
                const resp = await axios.get(route("train.search", {}, Ziggy), {
                    params: { keyword, searchAt }
                });
                const data = Array.isArray(resp.data) ? resp.data : (resp.data?.data || []);
                if (seq !== inflight) return;
                render(data);
            } catch (err) {
                console.error("train.search error", err);
                suggestionsBox.style.display = "none";
            }
        });

        // use mousedown so click registers before blur hides it
        suggestionsBox.addEventListener("mousedown", (e) => {
            const item = e.target.closest('.suggestion-item');
            if (!item) return;
            e.preventDefault();
            input.value = item.textContent.trim();
            suggestionsBox.style.display = 'none';
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });

        input.addEventListener("blur", () => {
            setTimeout(() => { suggestionsBox.style.display = 'none'; }, 120);
        });
        input.addEventListener("focus", () => {
            if (suggestionsBox.innerHTML.trim()) suggestionsBox.style.display = 'block';
        });
    }

    document.querySelectorAll(".train_departure_station").forEach(input => {
        if (!input.dataset.autocompleteTrain) {
            initTrainAutocomplete(input, 'departure');
            input.dataset.autocompleteTrain = '1';
        }
    });
    document.querySelectorAll(".train_arrival_station").forEach(input => {
        if (!input.dataset.autocompleteTrain) {
            initTrainAutocomplete(input, 'arrival');
            input.dataset.autocompleteTrain = '1';
        }
    });

    // observe dynamic rows
    const trainFormsContainer = document.getElementById('trainForms');
    if (trainFormsContainer) {
        const observer = new MutationObserver(() => {
            document.querySelectorAll(".train_departure_station").forEach(input => {
                if (!input.dataset.autocompleteTrain) {
                    initTrainAutocomplete(input, 'departure');
                    input.dataset.autocompleteTrain = '1';
                }
            });
            document.querySelectorAll(".train_arrival_station").forEach(input => {
                if (!input.dataset.autocompleteTrain) {
                    initTrainAutocomplete(input, 'arrival');
                    input.dataset.autocompleteTrain = '1';
                }
            });
        });
        observer.observe(trainFormsContainer, { childList: true, subtree: true });
    }

    $('.airline_code_input').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '{{ route("airlines_code.search") }}',
                dataType: 'json',
                data: { q: request.term },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.airline_code + " - " + item.airline_code,
                            value: item.airline_code
                        };
                    }));
                }
            });
        },
        minLength: 2,
    });
});

document.getElementById('billingCountry').addEventListener('change',async function(e){
    const countryId = e.target.value;
    const selectElement = document.getElementById('billingState');
    selectElement.innerHTML = `<option value="">Loading...</option>`
    try{
        const response = await axios.get(route('statelist',{id:countryId}));
        let selectTag = '<option value="">Select State</option>'
        response.data.data.forEach((item)=>{
            selectTag+= `<option value="${item.id}">${item.name}</option>`
        });
        selectElement.innerHTML = selectTag;
        console.log(response.data.data);
    }
    catch(e){
        selectElement.innerHTML = `<option value="">Failed to load</option>`
        showToast('Something went wrong','error');
    }

});

Array.from(document.querySelectorAll('.cruiseType')).forEach(item => {
    item.addEventListener('click', function () {
        if (item.checked) {
            Array.from(document.querySelectorAll('.room_category')).forEach(ele => {
                ele.closest('td').style.display = 'block';
                const td = ele.closest('td');
                td.style.setProperty('border-bottom', '1px solid black', 'important');
            });
            const roomCategoryColumn = document.getElementById('room-category-column');
            roomCategoryColumn.style.display = 'block';
            roomCategoryColumn.style.setProperty('border', 'none', 'important');
            roomCategoryColumn.style.setProperty('border-bottom', '1px solid black', 'important');
        }
        else {
            Array.from(document.querySelectorAll('.room_category')).forEach(ele => {
                ele.closest('td').style.display = 'none';
            });
            document.getElementById('room-category-column').style.display = 'none';
        }
    });
});

Array.from(document.querySelectorAll('.toggle-tab')).forEach(item => {
    item.addEventListener('click', function () {
        Array.from(document.querySelectorAll('.toggle-tab')).forEach(toggler => {
            const type = toggler.value;
            const isChecked = toggler.checked;
            const rowId = type.toLowerCase() + "-deposit-billing";
            const row = document.getElementById(rowId);
            if (row) {
                if (isChecked) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            }
        });
    });
});


       const phoneInput = document.getElementById("phone");
       phoneInput.addEventListener("input", () => {
            let inputValue = phoneInput.value.replace(/\D/g, "");

            if (inputValue.length > 3 && inputValue.length <= 6) {
                inputValue = `${inputValue.slice(0, 3)} ${inputValue.slice(3)}`;
            } else if (inputValue.length > 6) {
                inputValue = `${inputValue.slice(0, 3)} ${inputValue.slice(3, 6)} ${inputValue.slice(6, 10)}`;
            }
            inputValue = inputValue.slice(0, 12);
            phoneInput.value = inputValue;
        });


        // Delete flight image handler
$(document).on('click', '.delete-flight-image', function() {
    if (!confirm('Are you sure you want to delete this image?')) return;

    const imageId = $(this).data('id');
    const row = $(this).closest('tr');

    $.ajax({
        url: `/booking/flight-image/${imageId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            row.remove();
        },
        error: function() {
            alert('Failed to delete image');
        }
    });
});

// Delete hotel image handler
$(document).on('click', '.delete-hotel-image-btn', function() {
    if (!confirm('Are you sure you want to delete this image?')) return;

    const imageId = $(this).data('id');
    const row = $(this).closest('tr');

    $.ajax({
        url: `/booking/hotel-image/${imageId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            row.remove();
        },
        error: function() {
            alert('Failed to delete image');
        }
    });
});

// Delete cruise image handler
$(document).on('click', '.delete-cruise-image-btn', function() {
    if (!confirm('Are you sure you want to delete this image?')) return;

    const imageId = $(this).data('id');
    const row = $(this).closest('tr');

    $.ajax({
        url: `/booking/cruise-image/${imageId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            row.remove();
        },
        error: function() {
            alert('Failed to delete image');
        }
    });
});

// Delete car image handler
$(document).on('click', '.delete-car-image-btn', function() {
    if (!confirm('Are you sure you want to delete this image?')) return;

    const imageId = $(this).data('id');
    const row = $(this).closest('tr');

    $.ajax({
        url: `/booking/car-image/${imageId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            row.remove();
        },
        error: function() {
            alert('Failed to delete image');
        }
    });
});

// Delete train image handler
$(document).on('click', '.delete-train-image-btn', function() {
    if (!confirm('Are you sure you want to delete this image?')) return;

    const imageId = $(this).data('id');
    const row = $(this).closest('tr');

    $.ajax({
        url: `/booking/train-image/${imageId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            row.remove();
        },
        error: function() {
            alert('Failed to delete image');
        }
    });
});

$('#billingFieldModal').on('show.bs.modal',function(e){
    const action = e.relatedTarget.getAttribute('data-href');
    const form = $(e.target).find('form');
    form.attr('action',action);
});

$('#save-billing-field-save').click(async function(e){
    e.preventDefault();
    const form = $('#billingFieldModal').find('form');
    const action = form.attr('action');
    const formData = new FormData(form[0]);
    try{
        const response = await axios.post(action, formData);
        showToast('Billing field saved successfully', 'success');
        $('#billingFieldModal').modal('hide');
    }
    catch (e) {
        if(e.response.status === 422){
            showToast('Please fill all the required fields', 'error');
        }
        else{
            showToast('Failed to save billing field', 'error');
        }
    }

})
