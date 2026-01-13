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
        Schema::create('affiliate_actions', function (Blueprint $table) {
               $table->id();

               $table->foreignId('network_id')
                     ->constrained('affiliate_networks');

               $table->foreignId('campaign_id')
                     ->nullable()
                     ->constrained('affiliate_campaigns');

               $table->foreignId('website_id')
                     ->nullable()
                     ->constrained('affiliate_websites');

               $table->foreignId('source_id')
                     ->nullable()
                     ->constrained('affiliate_sources');

               $table->string('external_id'); // action_id
               $table->string('action_type')->nullable(); // sale / lead
               $table->string('status')->nullable();

               $table->string('currency', 10)->nullable();

               $table->decimal('payment', 12, 2)->default(0);
               $table->decimal('cart_amount', 12, 2)->nullable();

               $table->dateTime('action_date')->nullable();
               $table->dateTime('click_date')->nullable();
               $table->date('closing_date')->nullable();
               $table->dateTime('status_updated_at')->nullable();

               $table->string('order_id')->nullable();
               $table->string('promocode')->nullable();

               $table->string('subid')->nullable();
               $table->string('subid1')->nullable();
               $table->string('subid2')->nullable();
               $table->string('subid3')->nullable();
               $table->string('subid4')->nullable();

               $table->boolean('processed')->default(false);
               $table->boolean('paid')->default(false);

               $table->json('raw_payload')->nullable();

               $table->timestamps();

               $table->unique(['network_id', 'external_id']);
               $table->index(['action_date', 'status']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_actions');
    }
};
