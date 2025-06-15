<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelScreenshotRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:Flight,Hotel,Car',
            'notes' => 'nullable|string',
            'file_path' => 'nullable|string|max:255',
        ];
    }
}