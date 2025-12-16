<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('occasion_names', function (Blueprint $table) {
    $table->id();

    $table->string('name');

    $table->boolean('is_recommend')
          ->default(false);
    $table->boolean('is_default')
          ->default(true);
    $table->foreignId('user_id')
          ->nullable()
          ->constrained('users')
          ->onDelete('cascade');

    $table->text('description')->nullable();
    $table->date('date')->nullable();
    $table->string('background_color')->nullable();
    $table->string('title_color')->nullable();
    $table->string('image_background')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('occasion_names');
    }
};
