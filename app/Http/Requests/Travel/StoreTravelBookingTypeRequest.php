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
            'booking_id' => 'required|exists:travel_bookings,id',
            'type' => 'required|in:Flight,Hotel,Cruise,Car',
        ];
    }
}