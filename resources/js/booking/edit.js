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

const bookingTypes = [
    { key: 'flight', inputName: 'flightbookingimage[]' },
    { key: 'hotel', inputName: 'hotelbookingimage[]' },
    { key: 'cruise', inputName: 'cruisebookingimage[]' },
    { key: 'car', inputName: 'carbookingimage[]' },
    { key: 'train', inputName: 'trainbookingimage[]' },
];

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

document.getElementById('bookingForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    console.log('Submitting booking form...');
    const form = e.target;
    const action = form.action;
    const formdata = new FormData(form);

      document.querySelectorAll('[name^="hotel["]').forEach(input => {
        formdata.append(input.name, input.value);
    });

    document.querySelectorAll('[name^="cruise["]').forEach(input => {
        formdata.append(input.name, input.value);
    });

    document.querySelectorAll('[name^="car["]').forEach(input => {
        formdata.append(input.name, input.value);
    });

    document.querySelectorAll('[name^="pricing["]').forEach(input => {
        formdata.append(input.name, input.value);
    });


    const passengerRows = document.querySelectorAll('#passengerForms .passenger-form');
    let passengerAdded = false;

    passengerRows.forEach((row, index) => {
        const fields = [
            'passenger_type', 'gender', 'title', 'first_name',
            'middle_name', 'last_name', 'dob', 'seat_number',
            'credit_note', 'e_ticket_number'
        ];

        fields.forEach((field) => {
            const input = row.querySelector(`[name^="passenger"][name$="[${field}]"]`);
            if (input) {
                const name = `passenger[${index}][${field}]`;
                const value = input.value?.trim() ?? '';
                formdata.append(name, value);
            }
        });

        const firstName = row.querySelector(`[name^="passenger"][name$="[first_name]"]`)?.value?.trim();
        const dob = row.querySelector(`[name^="passenger"][name$="[dob]"]`)?.value?.trim();
        const type = row.querySelector(`[name^="passenger"][name$="[passenger_type]"]`)?.value?.trim();

        if (firstName && dob && type) {
            passengerAdded = true;
        }
    });

    if (!passengerAdded) {
        showToast("Please provide at least one passenger", "error");
        return;
    }


    const billingRows = document.querySelectorAll('#billingForms .billing-card');
    let billingAdded = false;
    let billingIndex = 0;

    billingRows.forEach(row => {
        const fields = [
            'card_type', 'cc_number', 'cc_holder_name', 'exp_month', 'exp_year',
            'cvv', 'address', 'email', 'contact_no', 'city', 'country',
            'state', 'zip_code', 'currency', 'amount'
        ];

        let cardType = '', ccNumber = '', amount = '';

        fields.forEach(field => {
            const input = row.querySelector(`[name$="[${field}]"]`);
            if (input) {
                const name = `billing[${billingIndex}][${field}]`;
                formdata.append(name, input.value ?? '');
            }

            if (field === 'card_type') cardType = input?.value;
            if (field === 'cc_number') ccNumber = input?.value;
            if (field === 'amount') amount = input?.value;
        });

        // Check if this row counts as filled
        if (cardType && ccNumber && amount) {
            billingAdded = true;
        }

        billingIndex++;
    });

    // Add activeCard radio
    const activeCardInput = document.querySelector('input[name="activeCard"]:checked');
    if (activeCardInput) {
        formdata.append('activeCard', activeCardInput.value);
    }

    if (!billingAdded) {
        showToast("Please provide at least one billing row", "error");
        return;
    }


    // Append FilePond files (custom mapping)


    for (const inputName in ponds) {
        console.log(ponds);
        const pond = ponds[inputName];
        if (pond) {
            pond.getFiles().forEach(fileItem => {
                formdata.append(inputName, fileItem.file);
            });
        }
    }

    try {
        const response = await axios.post(action, formdata, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        console.log(response.data);

        if (response.status === 201) {
            this.removeAttribute("disabled");
            sessionStorage.setItem("successMessage", response.data.message);
            window.location.href = route(response.data.route, { id: response.data.id });
        } else {
            showToast("Something went wrong", "error");
        }

    }
    catch (e) {
        console.error(e);
        if (e.response?.status === 422 || e.response?.status === 500) {
            showToast(e.response?.data?.error ?? 'Validation/server error', "error");
        } else {
            showToast("Something went wrong", "error");
        }
    }
});

document.getElementById('saveRemark').addEventListener('click',async function (e){

    const remark = document.querySelector('textarea[name="particulars"]');
    const agent = document.querySelector('input[name="agent"]');
    console.log(agent);
    try{
        const response = await axios.post(route('booking.update-remark',{id:route().params.id}),{
            remark:remark.value,
            agent:agent.value,
        });
        let html = '';
        response.data.data.forEach(function(item,index){
            html += `<tr>
                    <td>${index+1}</td>
                    <td>${item.agent}</td>
                    <td>${item.created_at}</td>
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
