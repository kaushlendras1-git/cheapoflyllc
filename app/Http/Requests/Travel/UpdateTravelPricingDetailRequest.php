<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelPricingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'hotel_cost' => 'sometimes|numeric|min:0|nullable',
            'cruise_cost' => 'sometimes|numeric|min:0|nullable',
            'total_amount' => 'sometimes|numeric|min:0|nullable',
            'advisor_mco' => 'sometimes|numeric|min:0|nullable',
            'conversion_charge' => 'sometimes|numeric|min:0|nullable',
            'airline_commission' => 'sometimes|numeric|min:0|nullable',
            'final_amount' => 'sometimes|numeric|min:0|nullable',
            'merchant' => 'sometimes|string|max:255|nullable',
            'net_mco' => 'sometimes|numeric|min:0|nullable',
        ];
    }
}