import { route } from 'ziggy-js';
import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';

$('#sendAuthEmail').submit(async function(e){
    e.preventDefault();
      const formdata = new FormData(this); 
    try {
        const response = await axios.post(this.action, formdata);

        console.log(response.data);

        if (response.status === 200 || response.status === 201) {
            showToast(response.data.message || "Auth has been sent", "success");
        } else {
            showToast("Something went wrong", "error");
        }
    } catch (e) {
        console.error(e);

        if (e.response?.status === 422) {
            showToast(e.response.data?.error || "Validation Error", "error");
        } else if (e.response?.status === 500) {
            showToast("Server Error", "error");
        } else {
            showToast("Something went wrong", "error");
        }
    }
});

$('#sendSMS').submit(async function(e) {
    e.preventDefault();
    const formdata = new FormData(this); 

    try {
        const response = await axios.post(this.action, formdata);

        if (response.status === 200 || response.status === 201) {

            const modalEl = document.getElementById('smsModal');
            const smsModal = bootstrap.Modal.getInstance(modalEl);
            if (smsModal) {
                smsModal.hide();
            }

            showToast(response.data.message || "SMS has been sent", "success");

        } else {
            showToast("Something went wrong", "error");
        }
    } catch (e) {
        console.error(e);

        if (e.response?.status === 422) {
            showToast(e.response.data?.error || "Validation Error", "error");
        } else if (e.response?.status === 500) {
            showToast("Server Error", "error");
        } else {
            showToast("Something went wrong", "error");
        }
    }
});




$('#sendSurvey').submit(async function(e){
    e.preventDefault();
      const formdata = new FormData(this); 
    try {
        const response = await axios.post(this.action, formdata);

        console.log(response.data);

        if (response.status === 200 || response.status === 201) {
            showToast(response.data.message || "Auth has been sent", "success");
        } else {
            showToast("Something went wrong", "error");
        }
    } catch (e) {
        console.error(e);

        if (e.response?.status === 422) {
            showToast(e.response.data?.error || "Validation Error", "error");
        } else if (e.response?.status === 500) {
            showToast("Server Error", "error");
        } else {
            showToast("Something went wrong", "error");
        }
    }
});

$('#sendWhatsApp').submit(async function(e){
    e.preventDefault();
      const formdata = new FormData(this); 
    try {
        const response = await axios.post(this.action, formdata);

        console.log(response.data);

        if (response.status === 200 || response.status === 201) {
            showToast(response.data.message || "Auth has been sent", "success");
        } else {
            showToast("Something went wrong", "error");
        }
    } catch (e) {
        console.error(e);

        if (e.response?.status === 422) {
            showToast(e.response.data?.error || "Validation Error", "error");
        } else if (e.response?.status === 500) {
            showToast("Server Error", "error");
        } else {
            showToast("Something went wrong", "error");
        }
    }
});



