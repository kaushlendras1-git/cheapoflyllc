import { route } from 'ziggy-js';
import axios from "axios";
import showToast from '../toast.js';
import '../../css/toast.css';

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
$('#bookingForm').submit(async function(e){
    e.preventDefault();
    const formdata =  new FormData(e.target);
    try{
        const response = await axios.post(e.target.action,formdata);
        console.log(response.data);
        if (response.status === 201) {

            this.removeAttribute("disabled");
            sessionStorage.setItem(
                "successMessage",
                response.data.message
            );
            window.location.href = route(response.data.data.route,{id:response.data.data.id});
        } else {
            showToast("Something went wrong", "error");
        }
    }
    catch(e){
        console.log(e);
        if(e.response.status === 422 || e.response.status === 500){
            showToast(e.response.data.error,"error");
        }else{
            showToast("Something went wrong", "error");
        }
    }
});
