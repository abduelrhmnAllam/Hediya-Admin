<?php

// database/migrations/2025_11_03_000300_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('external_id')->nullable();
            $t->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name_en')->nullable();
            $t->string('name_ar')->nullable();
            $t->text(column: 'description_en')->nullable();
            $t->text(column: 'description_ar')->nullable();
            $t->string('fingerprint', 64)->unique();
            $t->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $t->string('material')->nullable();
            $t->string('gender_en')->nullable();
            $t->string('gender_ar')->nullable();
            $t->string('currency')->nullable();
            $t->integer('price')->nullable();
            $t->integer('old_price')->nullable();
            $t->integer('qty')->nullable();
            $t->text('url')->nullable();
            $t->string('colors_en')->nullable();
            $t->string('colors_ar')->nullable();
            $t->string('sizes_en')->nullable();
            $t->string('sizes_ar')->nullable();
            $t->unsignedInteger('version')->default(1);
            $t->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $t->foreignId('country_id')->nullable()->constrained('country')->nullOnDelete();
            $t->timestamps();
        });
    }
};
