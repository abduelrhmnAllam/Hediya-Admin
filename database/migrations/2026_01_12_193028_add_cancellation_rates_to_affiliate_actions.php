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
            $table->decimal('revenue_cancellation_rate', 8, 4)->nullable()->after('cancellation_rate');
            $table->decimal('sales_amount_cancellation_rate', 8, 4)->nullable()->after('revenue_cancellation_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dropColumn(['revenue_cancellation_rate', 'sales_amount_cancellation_rate']);
        });
    }
};
