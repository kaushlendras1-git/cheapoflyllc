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
const ponds = {};

const bookingTypes = [
    { key: 'flight', inputName: 'flightbookingimage[]' },
    { key: 'hotel', inputName: 'hotelbookingimage[]' },
    { key: 'cruise', inputName: 'cruisebookingimage[]' },
    { key: 'car', inputName: 'carbookingimage[]' },
    { key: 'train', inputName: 'trainbookingimage[]' },
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

bookingTypes.forEach(({ key, inputName }) => {
    const span = document.getElementById(`${key}_uploaded_files`);
    const baseUrl = span.dataset.baseurl;
    const normalizedBaseUrl = baseUrl.endsWith('/') ? baseUrl : baseUrl + '/';
    const uploadedImages = JSON.parse(span.dataset.images || '[]');
    const pondInstance = ponds[inputName];
    console.log(inputName);
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

    const hotelInputs = document.querySelectorAll('[name^="hotel["]');
    hotelInputs.forEach(input => {
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
    try{
        const response = await axios.post(action, formdata, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        showToast(response.data.message);
    }
    catch (e) {

    }
});

document.getElementById('saveRemark').addEventListener('click',async function (e){

    const remark = document.querySelector('textarea[name="particulars"]');
    console.log(remark);
    try{
        const response = await axios.post(route('booking.update-remark',{id:route().params.id}),{
            remark:remark.value
        });
        let html = '';
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

document.getElementById('save-billing-detail').addEventListener('click',async function (e) {
    e.preventDefault();
    const element = document.getElementById('billing-detail-add');
    const formdata = new FormData(element);
    const action = element.action;
    try{
        const response = await axios.post(action,formdata);
        console.log(response);
        showToast(response.data.message);
        document.getElementById('billing-close-modal').click();
        element.reset();
    }
    catch(e){
        console.log(e);
        showToast(e.response.data.message,'error');
    }
})

Array.from(document.querySelectorAll('.deleteBillData')).forEach((el) => {
    el.addEventListener('click', async e => {
        e.preventDefault();
        const action = e.target.getAttribute('data-href');
        try {
            const response = await axios.delete(action);
            showToast(response.data.message);
        }
        catch(e){
            showToast(e.response.data.message);
        }
    })
})
