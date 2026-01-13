<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dateTime('conversion_time')
                  ->nullable()
                  ->after('cart_amount');
        });
    }

    public function down(): void
    {
        Schema::table('affiliate_actions', function (Blueprint $table) {
            $table->dropColumn('conversion_time');
        });
    }
};
