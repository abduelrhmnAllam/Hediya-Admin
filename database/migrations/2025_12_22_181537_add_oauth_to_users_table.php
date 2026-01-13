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
        Schema::table('users', function (Blueprint $table) {
            $table->string('oauth_id')->nullable()->after('email');
            $table->string('oauth_type')->nullable()->after('oauth_id');
            $table->unique(['oauth_id', 'oauth_type'], 'users_oauth_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_oauth_unique');
            $table->dropColumn(['oauth_id', 'oauth_type']);
        });
    }
};
