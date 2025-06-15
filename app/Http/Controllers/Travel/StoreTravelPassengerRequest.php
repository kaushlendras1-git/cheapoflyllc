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
            'passenger' => 'required|array|min:1',
            'passenger.*.passenger_type' => 'nullable|string|max:50',
            'passenger.*.gender' => 'nullable|string|max:20|in:Male,Female,Other',
            'passenger.*.dob' => 'nullable|date',
            'passenger.*.seat_number' => 'nullable|string|max:20',
            'passenger.*.title' => 'nullable|string|max:20|in:Mr,Ms,Mrs,Dr',
            'passenger.*.credit_note' => 'nullable|numeric|min:0',
            'passenger.*.first_name' => 'nullable|string|max:255',
            'passenger.*.middle_name' => 'nullable|string|max:255',
            'passenger.*.last_name' => 'nullable|string|max:255',
            'passenger.*.e_ticket_number' => 'nullable|string|max:50',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        // Map 'credit_note' to 'credit_note_amount'
        foreach ($data['passenger'] as &$passenger) {
            if (isset($passenger['credit_note'])) {
                $passenger['credit_note_amount'] = $passenger['credit_note'];
                unset($passenger['credit_note']);
            }
        }
        return $data['passenger'];
    }
}