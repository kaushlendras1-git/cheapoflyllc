<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelPricingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:travel_bookings,id',
            'hotel_cost' => 'nullable|numeric|min:0',
            'cruise_cost' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'advisor_mco' => 'nullable|numeric|min:0',
            'conversion_charge' => 'nullable|numeric|min:0',
            'airline_commission' => 'nullable|numeric|min:0',
            'final_amount' => 'nullable|numeric|min:0',
            'merchant' => 'nullable|string|max:255',
            'net_mco' => 'nullable|numeric|min:0',
        ];
    }
}