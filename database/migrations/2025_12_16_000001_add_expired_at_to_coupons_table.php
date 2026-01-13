<?php

// database/migrations/2025_12_16_000001_add_expired_at_to_coupons_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('coupons', function (Blueprint $table) {
            $table->timestamp('expired_at')->nullable()->after('coupon');
        });
    }
    
    public function down(): void {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });
    }
};

