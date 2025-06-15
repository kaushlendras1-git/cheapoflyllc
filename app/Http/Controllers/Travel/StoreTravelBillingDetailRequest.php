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
            'card_type' => 'required|array|min:1',
            'card_type.*' => 'nullable|string|max:50',
            'cc_number' => 'required|array|min:1',
            'cc_number.*' => 'nullable|string|max:50',
            'cc_holder_name' => 'required|array|min:1',
            'cc_holder_name.*' => 'nullable|string|max:255',
            'exp_month' => 'required|array|min:1',
            'exp_month.*' => 'nullable|string|size:2|regex:/^[0-1][0-9]$/',
            'exp_year' => 'required|array|min:1',
            'exp_year.*' => 'nullable|string|size:4|regex:/^[0-9]{4}$/',
            'cvv' => 'required|array|min:1',
            'cvv.*' => 'nullable|string|max:10',
            'address' => 'required|array|min:1',
            'address.*' => 'nullable|string|max:255',
            'email' => 'required|array|min:1',
            'email.*' => 'nullable|email|max:255',
            'contact_no' => 'required|array|min:1',
            'contact_no.*' => 'nullable|string|max:20',
            'city' => 'required|array|min:1',
            'city.*' => 'nullable|string|max:100',
            'country' => 'required|array|min:1',
            'country.*' => 'nullable|string|max:100',
            'state' => 'required|array|min:1',
            'state.*' => 'nullable|string|max:100',
            'zip_code' => 'required|array|min:1',
            'zip_code.*' => 'nullable|string|max:20',
            'currency' => 'required|array|min:1',
            'currency.*' => 'nullable|string|max:10|in:USD,EUR,GBP,INR',
            'amount' => 'required|array|min:1',
            'amount.*' => 'nullable|numeric|min:0',
            'activeCard' => 'required|in:0,1',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $billingDetails = [];
        $count = count($data['card_type']);
        for ($i = 0; $i < $count; $i++) {
            $billingDetails[] = [
                'card_type' => $data['card_type'][$i] ?? null,
                'cc_number' => $data['cc_number'][$i] ?? null,
                'cc_holder_name' => $data['cc_holder_name'][$i] ?? null,
                'exp_month' => $data['exp_month'][$i] ?? null,
                'exp_year' => $data['exp_year'][$i] ?? null,
                'cvv' => $data['cvv'][$i] ?? null,
                'address' => $data['address'][$i] ?? null,
                'email' => $data['email'][$i] ?? null,
                'contact_no' => $data['contact_no'][$i] ?? null,
                'city' => $data['city'][$i] ?? null,
                'country' => $data['country'][$i] ?? null,
                'state' => $data['state'][$i] ?? null,
                'zip_code' => $data['zip_code'][$i] ?? null,
                'currency' => $data['currency'][$i] ?? 'USD',
                'amount' => $data['amount'][$i] ?? 0.00,
                'is_active' => $data['activeCard'] == $i ? 1 : 0,
            ];
        }
        return $billingDetails;
    }
}