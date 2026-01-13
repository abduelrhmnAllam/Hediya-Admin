<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('affiliate_dashboard_daily', function (Blueprint $table) {
            $table->id();

            $table->foreignId('network_id')->constrained('affiliate_networks')->cascadeOnDelete();
            $table->date('date');


            $table->decimal('revenue', 18, 2)->default(0);
            $table->decimal('net_revenue', 18, 2)->default(0);
            $table->integer('orders')->default(0);
            $table->integer('net_orders')->default(0);
            $table->decimal('aov', 18, 2)->default(0);
            $table->decimal('cancellation_rate', 5, 2)->default(0);

          
            $table->json('extra_metrics')->nullable();

            $table->timestamps();
            $table->unique(['network_id','date']);
            $table->index(['date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_dashboard_daily');
    }
};
