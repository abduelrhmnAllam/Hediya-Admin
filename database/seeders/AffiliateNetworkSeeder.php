<?php

namespace Database\Seeders;

use App\Models\AffiliateNetwork;
use Illuminate\Database\Seeder;

class AffiliateNetworkSeeder extends Seeder
{
    public function run(): void
    {
        AffiliateNetwork::firstOrCreate(
            ['key' => 'admitad'],
            [
                'name' => 'Admitad',
            ]
        );

        AffiliateNetwork::firstOrCreate(
            ['key' => 'boostiny'],
            [
                'name' => 'Boostiny',
            ]
        );
    }
}
