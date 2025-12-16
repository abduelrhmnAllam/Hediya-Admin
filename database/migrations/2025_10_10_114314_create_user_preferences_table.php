<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->string('user_identifier')->default('guest')->index();
            $table->json('categories')->nullable();
            $table->json('keywords')->nullable();
            $table->json('price_ranges')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_preferences');
    }
};
