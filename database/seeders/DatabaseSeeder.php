<?php

namespace Database\Seeders;

use Artisan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call your individual seeders
        $this->call([
             RelativesTableSeeder::class,
             InterestsTableSeeder::class,
             AvatarSeeder::class,
             OccasionNamesTableSeeder::class,
             VendorSeeder::class,
             CouponSeeder::class,
             CountrySeeder::class,
        ]);

        // generate a personal access client
        Artisan::call('passport:client', [
            '--personal' => true,
            '--name' => 'Personal Access Client'
        ]);
    }
}
