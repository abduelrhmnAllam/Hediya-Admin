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
        Schema::table('products', function (Blueprint $table) {
            // Vector column only for PostgreSQL
            if (DB::getDriverName() === 'pgsql') {
                $table->vector('embedding', 1536)
                    ->nullable()
                    ->after('country_id')
                    ->comment('text-embedding-3-small has 1536 dimensions');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (DB::getDriverName() === 'pgsql') {
                $table->dropColumn('embedding');
            }
        });
    }
};
