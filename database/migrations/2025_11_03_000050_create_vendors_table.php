<?php

// database/migrations/2025_11_03_000050_create_vendors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vendors', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('vendors');
    }
};

