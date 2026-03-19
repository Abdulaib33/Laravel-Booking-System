<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Haircut',
                'price_cents' => 2500,
                'duration_minutes' => 30,
                'active' => true,
            ],
            [
                'name' => 'Beard Trim',
                'price_cents' => 1500,
                'duration_minutes' => 20,
                'active' => true,
            ],
            [
                'name' => 'Consultation',
                'price_cents' => 1000,
                'duration_minutes' => 15,
                'active' => true,
            ],
            [
                'name' => 'Premium Package',
                'price_cents' => 5000,
                'duration_minutes' => 60,
                'active' => true,
            ],
            [
                'name' => 'VIP Session',
                'price_cents' => 8000,
                'duration_minutes' => 90,
                'active' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}