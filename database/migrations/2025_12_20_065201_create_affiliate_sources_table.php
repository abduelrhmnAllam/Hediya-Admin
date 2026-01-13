<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_sources', function (Blueprint $table) {
            $table->id();

            $table->foreignId('network_id')
                  ->constrained('affiliate_networks')
                  ->cascadeOnDelete();

            // source code inside the network (coupon, link, deeplink, cashback ...)
            $table->string('code');

            // human readable name
            $table->string('name');

            // optional raw data from network
            $table->json('raw_payload')->nullable();

            $table->timestamps();

            // prevent duplicate sources per network
            $table->unique(['network_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_sources');
    }
};
