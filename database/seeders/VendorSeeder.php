<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            'AIGNER',
            'BANGGOOD',
            'BASHARACARE',
            'CLARKSSTORES',
            'MAGRBI',
            'DEALOUTLET',
            'LEVELSHOES',
            'FARFETCH',
            'LUXURYCLOSET',
        ];

        foreach ($vendors as $vendorName) {
            Vendor::firstOrCreate(['name' => $vendorName], ['name' => $vendorName]);
        }
    }
}

