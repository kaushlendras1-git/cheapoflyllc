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
            'feedback' => 'required|string',
            'param' => 'required|string|max:255',
            'status' => 'required|in:Pass,Fail,Pending',
            'qa' => 'nullable|string|max:255',
            'date_time' => 'nullable|date',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $data['parameters'] = $data['param'];
        unset($data['param']);
        return $data;
    }
}