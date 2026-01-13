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
            if (!Schema::hasColumn('affiliate_actions', 'net_payment')) {
                $table->decimal('net_payment', 12, 2)->nullable()->after('payment');
            }
            if (!Schema::hasColumn('affiliate_actions', 'net_cart_amount')) {
                $table->decimal('net_cart_amount', 12, 2)->nullable()->after('cart_amount');
            }
            if (!Schema::hasColumn('affiliate_actions', 'cancellation_rate')) {
                $table->decimal('cancellation_rate', 8, 4)->nullable()->after('net_cart_amount');
            }
            if (!Schema::hasColumn('affiliate_actions', 'sales_amount_usd')) {
                $table->decimal('sales_amount_usd', 12, 2)->nullable()->after('cancellation_rate');
            }
            if (!Schema::hasColumn('affiliate_actions', 'net_sales_amount_usd')) {
                $table->decimal('net_sales_amount_usd', 12, 2)->nullable()->after('sales_amount_usd');
            }
        });

        Schema::table('affiliate_campaigns', function (Blueprint $table) {
            if (!Schema::hasColumn('affiliate_campaigns', 'vendor_id')) {
                $table->foreignId('vendor_id')->nullable()->after('network_id')->constrained('vendors')->nullOnDelete();
            }
            if (!Schema::hasColumn('affiliate_campaigns', 'logo')) {
                $table->string('logo', 500)->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dropColumn([
                'net_payment',
                'net_cart_amount',
                'cancellation_rate',
                'sales_amount_usd',
                'net_sales_amount_usd',
            ]);
        });

        Schema::table('affiliate_campaigns', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['vendor_id', 'logo']);
        });
    }
};
