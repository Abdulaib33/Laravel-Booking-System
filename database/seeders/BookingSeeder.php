<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $editor = User::where('email', 'editor@example.com')->first();
        $guest = User::where('email', 'guest@example.com')->first();

        $haircut = Service::where('name', 'Haircut')->first();
        $beardTrim = Service::where('name', 'Beard Trim')->first();
        $consultation = Service::where('name', 'Consultation')->first();
        $premium = Service::where('name', 'Premium Package')->first();

        $bookings = [
            [
                'user_id' => $guest->id,
                'service_id' => $haircut->id,
                'booking_date' => Carbon::today()->addDays(1)->toDateString(),
                'booking_time' => '09:00:00',
                'status' => 'pending',
                'notes' => 'First appointment request.',
            ],
            [
                'user_id' => $guest->id,
                'service_id' => $beardTrim->id,
                'booking_date' => Carbon::today()->addDays(2)->toDateString(),
                'booking_time' => '10:30:00',
                'status' => 'approved',
                'notes' => 'Customer requested morning slot.',
            ],
            [
                'user_id' => $editor->id,
                'service_id' => $consultation->id,
                'booking_date' => Carbon::today()->addDays(3)->toDateString(),
                'booking_time' => '11:00:00',
                'status' => 'rejected',
                'notes' => 'Requested slot unavailable.',
            ],
            [
                'user_id' => $admin->id,
                'service_id' => $premium->id,
                'booking_date' => Carbon::today()->addDays(4)->toDateString(),
                'booking_time' => '14:00:00',
                'status' => 'completed',
                'notes' => 'Premium customer session completed successfully.',
            ],
            [
                'user_id' => $guest->id,
                'service_id' => $haircut->id,
                'booking_date' => Carbon::today()->addDays(5)->toDateString(),
                'booking_time' => '15:30:00',
                'status' => 'pending',
                'notes' => 'Afternoon appointment preferred.',
            ],
            [
                'user_id' => $editor->id,
                'service_id' => $consultation->id,
                'booking_date' => Carbon::today()->addDays(6)->toDateString(),
                'booking_time' => '16:00:00',
                'status' => 'approved',
                'notes' => 'Consultation confirmed by admin.',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::updateOrCreate(
                [
                    'service_id' => $booking['service_id'],
                    'booking_date' => $booking['booking_date'],
                    'booking_time' => $booking['booking_time'],
                ],
                $booking
            );
        }
    }
}