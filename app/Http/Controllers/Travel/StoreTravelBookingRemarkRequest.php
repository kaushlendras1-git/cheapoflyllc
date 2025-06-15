<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelBookingRemarkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'particulars' => 'required|string',
            'agent' => 'nullable|string|max:255',
            'date_time' => 'nullable|date',
        ];
    }
}