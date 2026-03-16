<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        //return false;

        return $this->user() !== null; // logged-in only
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }


    public function withvalidator($validator) {
        $validator->after(function ($validator) {
            $serviceId = $this->input('service_id');
            $date = $this->input('booking_date');
            $time = $this->input('booking_time');

            if (!$serviceId || !$date || !$time) {
                return;
            }

            $exists = Booking::query()
                ->where('service_id', $serviceId)
                ->where('booking_date', $date)
                ->where('booking_time', $time)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($exists)  {
                $validator->errors()->add(
                    'booking_time',
                    'This time is already booked. Please choose another time.'
                );
            }
        });
    }
}
