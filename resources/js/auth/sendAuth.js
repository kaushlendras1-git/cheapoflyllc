import { route } from 'ziggy-js';
import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('sendMailModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const booking_id = button.getAttribute('data-booking_id');
            const card_id = button.getAttribute('data-card_id');
            const card_billing_id = button.getAttribute('data-card_billing_id');
            const refund_status = button.getAttribute('data-refund_status');

            const loadContainer = document.getElementById('load_model');
            if (loadContainer && booking_id) {
                loadContainer.innerHTML = 'Loading...';
                fetch(`/i_authorized/${booking_id}/${card_id}/${card_billing_id}`)
                    .then(res => res.text())
                    .then(html => {
                        console.log('sendmail');
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

    const sendAuthMail = document.getElementsByClassName('sendAuthMail');
    Array.from(sendAuthMail).forEach((el)=>{
        el.addEventListener('click',(e)=>{
            console.log(e);
            const button = e.target;
            const booking_id = button.getAttribute('data-booking_id');
            const card_id = button.getAttribute('data-card_id');
            const card_billing_id = button.getAttribute('data-card_billing_id');
            const email = button.getAttribute('data-email');
            const refund_status = button.getAttribute('data-refund_status');
            const loadContainer = document.getElementById('load_model');
            const href=button.getAttribute('data-href');
            if (loadContainer && booking_id) {
                loadContainer.innerHTML = 'Loading...';
                fetch(href)
                    .then(res => res.text())
                    .then(html => {
                        $('#booking_id').val(booking_id);
                        $('#card_id').val(card_id);
                        $('#card_billing_id').val(card_billing_id);
                        $('#email').val(email);
                        loadContainer.innerHTML = html;
                    })
                    .catch(() => {
                        loadContainer.innerHTML = '<p class="text-danger">Failed to load content.</p>';
                    });
            }
        });
    });

    const form = document.getElementById('sendAuthMailModal');
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



$('#sendAuthEmail').submit(async function(e){
    e.preventDefault();
    const formdata = new FormData(this);
    const booking_id = document.getElementById('booking_id').value;
    const card_id = document.getElementById('card_id').value;
    const card_billing_id = document.getElementById('card_billing_id').value;
    const email = document.getElementById('email').value;
    formdata.append('booking_id',booking_id);
    formdata.append('card_id',card_id);
    formdata.append('card_billing_id',card_billing_id);
    formdata.append('email',email);
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