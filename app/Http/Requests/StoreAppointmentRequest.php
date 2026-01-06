<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
                'before:+30 days', // Don't allow bookings more than 30 days in advance
            ],
            'appointment_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $hour = intval(explode(':', $value)[0]);
                    
                    // Validate time is within office hours (9 AM - 5 PM)
                    if ($hour < 9 || $hour >= 17) {
                        $fail('The appointment time must be between 09:00 AM and 05:00 PM.');
                    }
                },
            ],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'appointment_date.required' => 'The appointment date is required.',
            'appointment_date.date' => 'Please provide a valid date.',
            'appointment_date.after_or_equal' => 'The appointment date must be today or in the future.',
            'appointment_date.before' => 'Appointments cannot be booked more than 30 days in advance.',
            'appointment_time.required' => 'The appointment time is required.',
            'appointment_time.date_format' => 'Please provide a valid time in HH:MM format (e.g., 14:30).',
        ];
    }
}
