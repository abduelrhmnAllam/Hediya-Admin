<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use App\Models\Vendor;

class CouponSeeder extends Seeder
{
    public function run(): void
    {

        // delete all coupons
        Coupon::truncate();

        // Get all vendors
        $vendors = Vendor::all();
        
        if ($vendors->isEmpty()) {
            $this->command->warn('No vendors found. Please run VendorSeeder first.');
            return;
        }

        // Define one coupon code per vendor (general coupon - no category)
        $couponCodes = [
            'AIGNER' => 'AIGNER2024',
            'BANGGOOD' => 'BANGGOOD15',
            'BASHARACARE' => 'BEAUTY25',
            'CLARKSSTORES' => 'CLARKS30',
            'MAGRBI' => 'MAGRBI2024',
            'DEALOUTLET' => 'DEAL50',
            'LEVELSHOES' => 'LEVEL15',
            'FARFETCH' => 'FARFETCH20',
            'LUXURYCLOSET' => 'LUXURY10',
        ];

        // Create one general coupon (null category_id) for each vendor
        foreach ($vendors as $vendor) {
            // Use predefined coupon code if available, otherwise generate one
            $couponCode = $couponCodes[$vendor->name] ?? strtoupper($vendor->name) . '2024';
            
            Coupon::firstOrCreate(
                [
                    'vendor_id' => $vendor->id,
                    'category_id' => null, // General coupon for all categories
                ],
                [
                    'vendor_id' => $vendor->id,
                    'coupon' => $couponCode,
                    'category_id' => null,
                ]
            );
        }

        $this->command->info('Coupons seeded successfully! Each vendor has one general coupon.');
    }
}

