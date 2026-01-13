<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a unique index on title where user_id IS NULL (for default interests)
        // This allows the seeder to use upsert based on title for default interests
        DB::statement('CREATE UNIQUE INDEX interests_title_unique_default ON interests (title) WHERE user_id IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS interests_title_unique_default');
    }
};
