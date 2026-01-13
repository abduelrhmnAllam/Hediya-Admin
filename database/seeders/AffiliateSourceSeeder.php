<?php

namespace Database\Seeders;

use App\Models\AffiliateNetwork;
use App\Models\AffiliateSource;
use Illuminate\Database\Seeder;

class AffiliateSourceSeeder extends Seeder
{
    public function run(): void
    {
        $admitad = AffiliateNetwork::where('key', 'admitad')->first();
        $boostiny = AffiliateNetwork::where('key', 'boostiny')->first();

        // Admitad sources
        AffiliateSource::firstOrCreate(
            ['network_id' => $admitad->id, 'code' => 'coupon'],
            ['name' => 'Coupon']
        );

        AffiliateSource::firstOrCreate(
            ['network_id' => $admitad->id, 'code' => 'link'],
            ['name' => 'Link']
        );

        // Boostiny sources
        AffiliateSource::firstOrCreate(
            ['network_id' => $boostiny->id, 'code' => 'coupon'],
            ['name' => 'Coupon']
        );

        AffiliateSource::firstOrCreate(
            ['network_id' => $boostiny->id, 'code' => 'link'],
            ['name' => 'Link']
        );
    }
}
