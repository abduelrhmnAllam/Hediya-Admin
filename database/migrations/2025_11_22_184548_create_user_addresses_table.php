<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();


            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();


            $table->enum('building_type', [
                'home',
                'office',
                'hotel',
                'apartment',
                'other'
            ])->nullable();


            $table->string('image')->nullable();


            $table->string('address')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('building_name')->nullable();
            $table->string('building_number')->nullable();
            $table->string('area')->nullable();


            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

     
            $table->boolean('is_default')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
