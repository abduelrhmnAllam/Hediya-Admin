<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->decimal('sales_usd_cancellation_rate', 8, 4)->nullable()->after('sales_amount_cancellation_rate');
            $table->decimal('aov_usd_cancellation_rate', 8, 4)->nullable()->after('sales_usd_cancellation_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dropColumn(['sales_usd_cancellation_rate', 'aov_usd_cancellation_rate']);
        });
    }
};
