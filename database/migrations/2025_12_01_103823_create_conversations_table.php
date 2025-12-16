<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('status')->default('active'); // active, closed, archived
            $table->string('lang')->nullable();          // en, ar...
            $table->string('dialect')->nullable();       // egyptian, gulf...
            $table->string('topic')->nullable();         // general topic
            $table->json('summary')->nullable();         // AI summary
            $table->json('meta')->nullable();            // extra metadata

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
