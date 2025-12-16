<?php
// database/migrations/2025_11_03_000400_create_product_assets_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained()->cascadeOnDelete();
            $t->text('url');
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
            $t->index(['product_id', 'sort_order']);
        });



    }
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};

