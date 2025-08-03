import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import {route} from "ziggy-js";

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

bookingTypes.forEach(({ key, inputName }) => {
    const span = document.getElementById(`${key}_uploaded_files`);
    const baseUrl = span.dataset.baseurl;
    const normalizedBaseUrl = baseUrl.endsWith('/') ? baseUrl : baseUrl + '/';
    const uploadedImages = JSON.parse(span.dataset.images || '[]');

    const pondInstance = ponds[inputName];

    if (pondInstance && uploadedImages.length) {
        uploadedImages.forEach((filePath) => {
            if (filePath) {
                const fullUrl = normalizedBaseUrl + filePath;
                fetch(fullUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        const fileName = filePath.split('/').pop();
                        const file = new File([blob], fileName, { type: blob.type });
                        pondInstance.addFile(file);
                    })
                    .catch(error => console.error(`Error loading ${key} file:`, error));
            }
        });
    }
});

document.getElementById('bookingForm').addEventListener('submit',async function(e){
    console.log('hello')
    e.preventDefault();
    const action = e.target.action;
    const formdata = new FormData(e.target);

    const isFlightChecked = document.querySelector('#booking-flight').checked;
    if (isFlightChecked) {
        const flightInputs = document.querySelectorAll('[name^="flight["]');
        flightInputs.forEach(input => {
            const name = input.name;
            const value = input.value;
            formdata.append(name, value);
        });
    }

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

    ['passenger', 'billing', 'pricing'].forEach(prefix => {
        const inputs = document.querySelectorAll(`[name^="${prefix}["], [name^="${prefix}["] *`);
        inputs.forEach(input => {
            if (input.name) {
                formdata.append(input.name, input.value);
            }
        });
    });


    try{
        const response = await axios.post(action, formdata, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        showToast(response.data.message);


    }
    catch (e) {
        console.error(e);
        if (e.response?.status === 422 || e.response?.status === 500) {
            showToast(e.response?.data?.error ?? 'Validation/server error', "error");
        } else {
            showToast("Something went wrong2", "error");
        }
    }
});

document.getElementById('saveRemark').addEventListener('click',async function (e){

    const remark = document.querySelector('textarea[name="particulars"]');
    try{
        const response = await axios.post(route('booking.update-remark',{id:route().params.id}),{
            remark:remark.value,
           // agent:agent.value,
        });
        let html = '';
        console.log(response);
        response.data.data.forEach(function(item,index){
            html += `<tr>
                    <td>${index+1}</td>
                    <td>${item.particulars}</td>
                    <td>
                        <button type="button" class="btn btn-danger deleteRemark" data-id="${item.id}">
                            Delete
                        </button>
                    </td>
                </tr>`;
        });
        $('#bookingtableremarktable').html(html);
        document.querySelector('textarea[name="particulars"]').value="";
        showToast(response.data.message);
    }
    catch (e){
        console.error("AXIOS ERROR", e);
        if (e.response) {
            console.error("Server responded with:", e.response.data);
        }
    }
});

document.getElementById('bookingtableremarktable').addEventListener('click', async function (e) {
    if (e.target.classList.contains('deleteRemark')) {
        const id = e.target.getAttribute('data-id');
        try {
            const response = await axios.post(route('booking.delete-remark', { id: id }), {
                booking_id: route().params.id
            });

            let html = '';
            response.data.data.forEach(function(item, index) {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${item.particulars}</td>
                    <td>
                        <button type="button" class="btn btn-danger deleteRemark" data-id="${item.id}">
                            Delete
                        </button>
                    </td>
                </tr>`;
            });

            $('#bookingtableremarktable').html(html);
            document.querySelector('textarea[name="particulars"]').value = "";
            showToast(response.data.message);
        } catch (err) {
            console.log(err);
        }
    }
});

$('.country-select').on('change',async function(e){
    try{
        const response = await axios.get(route('statelist',e.target.value));

        let options = '<option value="">Select State</option>';
        console.log(response.data.data);
        response.data.data.forEach(function(item){
            options += `
                <option value="${item.id}">${item.name}</option>
            `;
        });
        e.target.parentElement.nextElementSibling.querySelector('select').innerHTML = options;
    }
    catch (e) {
        console.log(e)
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
    console.log(e.target.value);
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
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][num_passengers]" placeholder="No. of Passengers" min="0"></td>
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][gross_price]" placeholder="Gross Price" min="0" step="0.01"></td>
            <td><span class="gross-total">$10</span></td>
            <td><input type="number" class="form-control" name="pricing[${pricingIndex}][net_price]" placeholder="Net Price" min="0" step="0.01"></td>
            <td><span class="net-total">$10</span></td>
            <td>
                <select class="form-control" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                    <option value="">Select</option>
                    <option value="ticket_cost">Ticket Cost</option>
                    <option value="merchant_fee">Merchant Fee</option>
                    <option value="company_card_used">Company Card Used</option>
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
            showToast(response.data.message);
            document.getElementById('billing-close-modal').click();
            element.reset();

            const data = response.data.data;
            const tableBody = document.querySelector('#billing-table tbody');
            const rowCount = tableBody.querySelectorAll('tr').length;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${rowCount + 1}</td>
                <td>${data.email}</td>
                <td>${data.contact_number}</td>
                <td>${data.street_address}</td>
                <td>${data.city}</td>
                <td>${data.state}</td>
                <td>${data.zip_code}</td>
                <td>${data.country}</td>
                <td>
                    <button class="btn btn-danger deleteBillData" data-href="/booking/billing-details/${data.id}">Delete</button>
                </td>
            `;
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

        const button = e.target;
        const action = button.getAttribute('data-href');

        try {
            const response = await axios.delete(action);
            showToast(response.data.message);
            const row = button.closest('tr');
            row.remove();
            const rows = document.querySelectorAll('#billing-table tbody tr');
            rows.forEach((tr, index) => {
                tr.querySelector('td').textContent = index + 1;
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
        console.log(html);
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
