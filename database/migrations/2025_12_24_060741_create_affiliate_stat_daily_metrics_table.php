<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('affiliate_stat_daily_metrics', function (Blueprint $table) {
            $table->id();

            $table->foreignId('network_id')->constrained('affiliate_networks')->cascadeOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained('affiliate_campaigns')->nullOnDelete();

            $table->date('date');

            $table->string('metric_key');
            $table->decimal('metric_value', 18, 4)->nullable();
            $table->string('currency', 10)->nullable();

            $table->json('raw_payload')->nullable();
            $table->timestamps();

            $table->unique(['network_id','campaign_id','date','metric_key'], 'metrics_unique');
            $table->index(['date']);
            $table->index(['metric_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_stat_daily_metrics');
    }
};
