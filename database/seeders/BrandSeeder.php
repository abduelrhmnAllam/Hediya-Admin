<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Nike', 'slug' => 'nike', 'website' => 'https://nike.com'],
            ['name' => 'Adidas', 'slug' => 'adidas', 'website' => 'https://adidas.com'],
            ['name' => 'Apple', 'slug' => 'apple', 'website' => 'https://apple.com'],
            ['name' => 'Zara', 'slug' => 'zara', 'website' => 'https://zara.com'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'website' => 'https://samsung.com'],
            ['name' => 'H&M', 'slug' => 'hm', 'website' => 'https://hm.com'],
            ['name' => 'Sony', 'slug' => 'sony', 'website' => 'https://sony.com'],
            ['name' => 'Puma', 'slug' => 'puma', 'website' => 'https://puma.com']
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['name' => $brand['name']], $brand);
        }
    }
}
