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
        Schema::create('affiliate_action_items', function (Blueprint $table) {
            $table->id();
                
            $table->foreignId('action_id')
                  ->constrained('affiliate_actions')
                  ->cascadeOnDelete();

            $table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_url')->nullable();
            $table->string('product_image')->nullable();

            $table->decimal('amount', 12, 2)->nullable();
            $table->decimal('payment', 12, 2)->nullable();

            $table->boolean('percentage')->default(false);
            $table->string('rate')->nullable();

            $table->json('raw_payload')->nullable();

            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_action_items');
    }
};
