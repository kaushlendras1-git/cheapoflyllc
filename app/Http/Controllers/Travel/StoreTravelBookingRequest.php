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
            'selected_company' => 'nullable|string|max:255',
            'booking_status' => 'nullable|string|max:50|in:under process,confirmed,cancelled',
            'payment_status' => 'nullable|string|max:50|in:pending,paid,failed',
            'reservation_source' => 'nullable|string|max:255',
            'descriptor' => 'nullable|string|max:255', // First descriptor
            'amadeus_sabre_pnr' => 'nullable|string|max:50', // Second descriptor
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        // Map 'selected_company' to 'company_organisation'
        if (isset($data['selected_company'])) {
            $data['company_organisation'] = $data['selected_company'];
            unset($data['selected_company']);
        }
        // Map second 'descriptor' to 'amadeus_sabre_pnr'
        if ($this->has('descriptor') && $this->input('descriptor') !== null) {
            $data['amadeus_sabre_pnr'] = $data['descriptor'];
        }
        return $data;
    }
}