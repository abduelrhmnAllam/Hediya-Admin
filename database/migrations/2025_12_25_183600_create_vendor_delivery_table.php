<?php

// database/migrations/2025_12_25_183600_create_vendor_delivery_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vendor_delivery', function (Blueprint $t) {
            $t->id();
            $t->foreignId('vendor_id')->constrained('vendors')->cascadeOnDelete();
            $t->decimal('free_delivery_min_price', 10, 2)->nullable();
            $t->integer('delivery_estimated_days')->nullable();
            $t->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('vendor_delivery');
    }
};

