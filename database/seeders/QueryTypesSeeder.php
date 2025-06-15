<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class QueryTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $queryTypes = [
            ['name' => 'New Booking', 'value' => 'N'],
            ['name' => 'New Booking (Credit)', 'value' => 'NC'],
            ['name' => 'Air Miles', 'value' => 'M'],
            ['name' => 'Cancel (Credit)', 'value' => 'CC'],
            ['name' => 'Cancel (Refund)', 'value' => 'CR'],
            ['name' => 'Change', 'value' => 'CH'],
            ['name' => 'Upgrade', 'value' => 'U'],
            ['name' => 'Name Correction', 'value' => 'NMC'],
            ['name' => 'Seat Assignment', 'value' => 'S'],
            ['name' => 'Baggage Addition', 'value' => 'B'],
        ];

        foreach ($queryTypes as $type) {
            DB::table('query_types')->updateOrInsert(
                ['value' => $type['value']], // Unique identifier
                $type
            );
        }
    }
}
