<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelQualityFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'sometimes|exists:travel_bookings,id',
            'qa' => 'sometimes|string|max:255|nullable',
            'date_time' => 'sometimes|date|nullable',
            'feedback' => 'sometimes|string|nullable',
            'parameters' => 'sometimes|string|max:255|nullable',
            'status' => 'sometimes|in:Pass,Fail,Pending|nullable',
        ];
    }
}