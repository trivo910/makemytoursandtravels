<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required_without:phone', 'nullable', 'email:rfc', 'max:255'],
            'phone' => ['required_without:email', 'nullable', 'string', 'max:30', 'regex:/^[0-9+().\-\s]{7,30}$/'],
            'pickup_location' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'travel_date' => ['required', 'date', 'after_or_equal:today'],
            'pickup_time' => ['nullable', 'date_format:H:i'],
            'passenger_count' => ['required', 'integer', 'min:1'],
            'vehicle_type' => ['nullable', 'string', Rule::in(['ac_bus', 'non_ac_bus', 'tempo_traveller', 'urbania'])],
            'vehicle_id' => [
                'nullable',
                'integer',
                Rule::exists('vehicles', 'id')->where('is_active', true),
            ],
            'message' => ['nullable', 'string', 'max:10000'],
            'website' => ['prohibited'],
        ];
    }
}
