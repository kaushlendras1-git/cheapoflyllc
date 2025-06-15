<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $campaigns = [
            ['name' => 'flydreamz'],
            ['name' => 'cruiseroyals'],
            ['name' => 'fareticketsllc'],
            ['name' => 'fareticketsus'],
        ];

        foreach ($campaigns as $campaign) {
            DB::table('campaigns')->updateOrInsert(
                ['name' => $campaign['name']], // Use 'name' as the unique identifier
                $campaign
            );
        }
    }
}
