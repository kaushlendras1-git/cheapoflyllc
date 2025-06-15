<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTravelBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pnr' => ['sometimes', 'string', 'max:50', Rule::unique('travel_bookings', 'pnr')->ignore($this->route('id'))],
            'hotel_ref' => 'sometimes|string|max:50|nullable',
            'cruise_ref' => 'sometimes|string|max:50|nullable',
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'email' => 'sometimes|email|max:255',
            'query_type' => 'sometimes|string|max:100|nullable',
            'company_organisation' => 'sometimes|string|max:255|nullable',
            'booking_status' => 'sometimes|string|max:50|in:under process,confirmed,cancelled|nullable',
            'payment_status' => 'sometimes|string|max:50|in:pending,paid,failed|nullable',
            'reservation_source' => 'sometimes|string|max:255|nullable',
            'descriptor' => 'sometimes|string|max:255|nullable',
            'amadeus_sabre_pnr' => 'sometimes|string|max:50|nullable',
            'created_by' => 'sometimes|string|max:255|nullable',
        ];
    }
}