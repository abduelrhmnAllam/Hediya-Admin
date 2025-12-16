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
    Schema::create('relatives', function (Blueprint $table) {
        $table->id();

          // Who created this relative name (null = system default)
          $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
          // Relative main fields
          $table->string('title');
          $table->enum('gender', ['male', 'female'])->nullable();
          $table->string('image')->nullable();
          // Default or user-created
          $table->boolean('is_default')->default(true);
          $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatives');
    }
};
