<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusInterdependency;

class StatusInterdependencySeeder extends Seeder
{
    public function run()
    {
        $interdependencies = [
            // Booking Status controls Payment Status
            ['booking_status_id' => 1, 'payment_status_id' => 1, 'department_id' => 1, 'role_id' => 1, 'direction' => 'booking_to_payment'],
            ['booking_status_id' => 2, 'payment_status_id' => 2, 'department_id' => 1, 'role_id' => 2, 'direction' => 'booking_to_payment'],
            ['booking_status_id' => 3, 'payment_status_id' => 3, 'department_id' => 2, 'role_id' => 1, 'direction' => 'booking_to_payment'],
            
            // Payment Status controls Booking Status
            ['booking_status_id' => 4, 'payment_status_id' => 4, 'department_id' => 1, 'role_id' => 1, 'direction' => 'payment_to_booking'],
            ['booking_status_id' => 5, 'payment_status_id' => 5, 'department_id' => 2, 'role_id' => 2, 'direction' => 'payment_to_booking'],
        ];

        foreach ($interdependencies as $interdependency) {
            StatusInterdependency::create($interdependency);
        }
    }
}