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
         Schema::create('affiliate_campaigns', function (Blueprint $table) {
             $table->id();

             $table->foreignId('network_id')
                   ->constrained('affiliate_networks')
                   ->cascadeOnDelete();

             $table->string('external_id');
             $table->string('name');
             $table->string('currency', 10)->nullable();
             $table->string('status')->nullable();

             $table->json('raw_payload')->nullable();

             $table->timestamps();

             $table->unique(['network_id', 'external_id']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_campaigns');
    }
};
