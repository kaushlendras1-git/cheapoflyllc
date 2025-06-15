<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelBillingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'card_type' => 'sometimes|string|max:50|nullable',
            'cc_number' => 'sometimes|string|max:50|nullable',
            'cc_holder_name' => 'sometimes|string|max:255|nullable',
            'exp_month' => 'sometimes|string|size:2|regex:/^[0-1][0-9]$/|nullable',
            'exp_year' => 'sometimes|string|size:4|regex:/^[0-9]{4}$/|nullable',
            'cvv' => 'sometimes|string|max:10|nullable',
            'address' => 'sometimes|string|max:255|nullable',
            'email' => 'sometimes|email|max:255|nullable',
            'contact_no' => 'sometimes|string|max:20|nullable',
            'city' => 'sometimes|string|max:100|nullable',
            'country' => 'sometimes|string|max:100|nullable',
            'state' => 'sometimes|string|max:100|nullable',
            'zip_code' => 'sometimes|string|max:20|nullable',
            'currency' => 'sometimes|string|max:10|in:USD,EUR,GBP,INR|nullable',
            'amount' => 'sometimes|numeric|min:0|nullable',
            'is_active' => 'sometimes|boolean|nullable',
        ];
    }
}