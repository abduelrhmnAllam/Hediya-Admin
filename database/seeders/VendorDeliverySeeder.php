<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\VendorDelivery;

class VendorDeliverySeeder extends Seeder
{
    public function run(): void
    {
        // Get all vendors
        $vendors = Vendor::all();
        
        if ($vendors->isEmpty()) {
            $this->command->warn('No vendors found. Please run VendorSeeder first.');
            return;
        }

        // Create vendor_delivery record for each vendor
        foreach ($vendors as $vendor) {
            VendorDelivery::firstOrCreate(
                [
                    'vendor_id' => $vendor->id,
                ],
                [
                    'vendor_id' => $vendor->id,
                    'free_delivery_min_price' => rand(100, 300), // Random price between 100 and 300
                    'delivery_estimated_days' => rand(1, 3), // Random days between 1 and 3
                ]
            );
        }

        $this->command->info('Vendor delivery records seeded successfully! Each vendor has a delivery record.');
    }
}

