<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelScreenshotRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'type' => 'sometimes|in:Flight,Hotel,Car|nullable',
            'notes' => 'sometimes|string|nullable',
            'file_path' => 'sometimes|string|max:255|nullable',
        ];
    }
}