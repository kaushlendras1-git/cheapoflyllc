<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelQualityFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:travel_bookings,id',
            'qa' => 'nullable|string|max:255',
            'date_time' => 'nullable|date',
            'feedback' => 'nullable|string',
            'parameters' => 'nullable|string|max:255',
            'status' => 'nullable|in:Pass,Fail,Pending',
        ];
    }
}