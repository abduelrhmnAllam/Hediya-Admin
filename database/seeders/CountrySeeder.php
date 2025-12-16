<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['code' => 'KW', 'name' => 'Kuwait'],
            ['code' => 'SA', 'name' => 'Saudi Arabia'],
            ['code' => 'UAE', 'name' => 'United Arab Emirates'],
        ];

        foreach ($countries as $country) {
            $exists = DB::table('country')->where('code', $country['code'])->exists();
            
            if (!$exists) {
                DB::table('country')->insert([
                    'code' => $country['code'],
                    'name' => $country['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

