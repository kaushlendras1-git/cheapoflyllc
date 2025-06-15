<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelSectorDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:travel_bookings,id',
            'sector_type' => 'required|string|max:100',
        ];
    }
}