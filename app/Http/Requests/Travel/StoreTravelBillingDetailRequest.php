<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelBillingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:travel_bookings,id',
            'card_type' => 'nullable|string|max:50',
            'cc_number' => 'nullable|string|max:50',
            'cc_holder_name' => 'nullable|string|max:255',
            'exp_month' => 'nullable|string|size:2|regex:/^[0-1][0-9]$/',
            'exp_year' => 'nullable|string|size:4|regex:/^[0-9]{4}$/',
            'cvv' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'contact_no' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'currency' => 'nullable|string|max:10|in:USD,EUR,GBP,INR',
            'amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }
}