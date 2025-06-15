<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pnr' => 'required|string|max:50|unique:travel_bookings,pnr',
            'hotel_ref' => 'nullable|string|max:50',
            'cruise_ref' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'query_type' => 'nullable|string|max:100',
            'company_organisation' => 'nullable|string|max:255',
            'booking_status' => 'nullable|string|max:50|in:under process,confirmed,cancelled',
            'payment_status' => 'nullable|string|max:50|in:pending,paid,failed',
            'reservation_source' => 'nullable|string|max:255',
            'descriptor' => 'nullable|string|max:255',
            'amadeus_sabre_pnr' => 'nullable|string|max:50',
            'created_by' => 'nullable|string|max:255',
        ];
    }
}