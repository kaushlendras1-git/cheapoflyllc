<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelBookingRemarkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'agent' => 'sometimes|string|max:255|nullable',
            'date_time' => 'sometimes|date|nullable',
            'particulars' => 'sometimes|string|nullable',
        ];
    }
}