<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // === Parent Categories ===
        $parents = [
            ['guid' => 'ELEC', 'name' => 'Electronics'],
            ['guid' => 'FASH', 'name' => 'Fashion'],
            ['guid' => 'BEAUTY', 'name' => 'Beauty & Personal Care'],
            ['guid' => 'HOME', 'name' => 'Home & Kitchen'],
            ['guid' => 'SPORT', 'name' => 'Sports & Outdoors'],
        ];

        $parentCategories = [];

        foreach ($parents as $p) {
            $parentCategories[$p['guid']] = Category::create([
                'supplier_guid' => $p['guid'],
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'parent_id' => null,
                'extra' => null,
            ]);
        }

        // === Subcategories ===
        $subcategories = [
            // Electronics
            ['guid' => 'ELEC_SMART', 'name' => 'Smartphones',      'parent' => 'ELEC'],
            ['guid' => 'ELEC_LAP',   'name' => 'Laptops',          'parent' => 'ELEC'],

            // Fashion
            ['guid' => 'FASH_MEN',   'name' => 'Men Clothing',     'parent' => 'FASH'],
            ['guid' => 'FASH_WOMEN', 'name' => 'Women Clothing',   'parent' => 'FASH'],

            // Beauty
            ['guid' => 'BEAUTY_SK',  'name' => 'Skincare',         'parent' => 'BEAUTY'],
            ['guid' => 'BEAUTY_MK',  'name' => 'Makeup',           'parent' => 'BEAUTY'],

            // Home & Kitchen
            ['guid' => 'HOME_DECOR', 'name' => 'Home Decor',       'parent' => 'HOME'],
            ['guid' => 'HOME_KITCH', 'name' => 'Kitchen Tools',    'parent' => 'HOME'],

            // Sports
            ['guid' => 'SPORT_FIT',  'name' => 'Fitness Equipment','parent' => 'SPORT'],
            ['guid' => 'SPORT_WEAR', 'name' => 'Sportswear',       'parent' => 'SPORT'],
        ];

        foreach ($subcategories as $sub) {
            Category::create([
                'supplier_guid' => $sub['guid'],
                'name' => $sub['name'],
                'slug' => Str::slug($sub['name']),
                'parent_id' => $parentCategories[$sub['parent']]->id,
                'extra' => null,
            ]);
        }
    }
}
