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
            if (!Schema::hasColumn('affiliate_actions', 'orders')) {
                $table->integer('orders')->default(0)->after('status');
            }
            if (!Schema::hasColumn('affiliate_actions', 'net_orders')) {
                $table->integer('net_orders')->default(0)->after('orders');
            }
            if (!Schema::hasColumn('affiliate_actions', 'aov_usd')) {
                $table->decimal('aov_usd', 12, 2)->nullable()->after('net_sales_amount_usd');
            }
            if (!Schema::hasColumn('affiliate_actions', 'net_aov_usd')) {
                $table->decimal('net_aov_usd', 12, 2)->nullable()->after('aov_usd');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dropColumn(['orders', 'net_orders', 'aov_usd', 'net_aov_usd']);
        });
    }
};
