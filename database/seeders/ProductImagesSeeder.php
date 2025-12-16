<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Product::all() as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'url'        => $product->url ?? 'https://via.placeholder.com/500',
                'sort_order' => 0,
            ]);
        }
    }
}
