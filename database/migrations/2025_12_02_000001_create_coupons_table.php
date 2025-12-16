<?php

// database/migrations/2025_12_02_000001_create_coupons_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('coupons', function (Blueprint $t) {
            $t->id();
            $t->foreignId('vendor_id')->constrained('vendors')->cascadeOnDelete();
            $t->string('coupon');
            $t->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('coupons');
    }
};

