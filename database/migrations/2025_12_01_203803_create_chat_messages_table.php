<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
         if (!Schema::hasTable('chat_messages')) {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('conversation_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            $table->enum('role', ['user', 'assistant', 'system'])->default('user');

            $table->text('content')->nullable();

            $table->json('meta')->nullable();

            $table->float('sentiment_score')->nullable(); // -1 => negative, +1 => positive

            $table->timestamps();
        });
    }
}
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
