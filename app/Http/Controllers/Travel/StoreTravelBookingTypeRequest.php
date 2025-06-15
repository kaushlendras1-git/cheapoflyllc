<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelBookingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking-type' => 'required|array|min:1',
            'booking-type.*' => 'in:Flight,Hotel,Cruise,Car',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        // Transform 'booking-type' to 'types' for processing
        return ['types' => $data['booking-type']];
    }
}