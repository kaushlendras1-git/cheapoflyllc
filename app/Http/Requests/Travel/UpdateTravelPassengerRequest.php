<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelPassengerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'passenger_type' => 'sometimes|string|max:50|nullable',
            'gender' => 'sometimes|string|max:20|in:Male,Female,Other|nullable',
            'dob' => 'sometimes|date|nullable',
            'seat_number' => 'sometimes|string|max:20|nullable',
            'title' => 'sometimes|string|max:20|in:Mr,Ms,Mrs,Dr|nullable',
            'credit_note_amount' => 'sometimes|numeric|min:0|nullable',
            'first_name' => 'sometimes|string|max:255|nullable',
            'middle_name' => 'sometimes|string|max:255|nullable',
            'last_name' => 'sometimes|string|max:255|nullable',
            'e_ticket_number' => 'sometimes|string|max:50|nullable',
        ];
    }
}