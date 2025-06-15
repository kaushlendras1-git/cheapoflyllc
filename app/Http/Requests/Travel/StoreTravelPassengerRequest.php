<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelPassengerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:travel_bookings,id',
            'passenger_type' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20|in:Male,Female,Other',
            'dob' => 'nullable|date',
            'seat_number' => 'nullable|string|max:20',
            'title' => 'nullable|string|max:20|in:Mr,Ms,Mrs,Dr',
            'credit_note_amount' => 'nullable|numeric|min:0',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'e_ticket_number' => 'nullable|string|max:50',
        ];
    }
}