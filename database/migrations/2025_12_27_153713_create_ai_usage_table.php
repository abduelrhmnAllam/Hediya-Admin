<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ai_usage', function (Blueprint $table) {
            $table->id();

            // Optional: link usage to a user
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // What AI feature was used
            $table->string('feature');
            // examples: embedding, chat, completion

            // Model used
            $table->string('model')->nullable();
            // example: text-embedding-3-large

            // Token usage
            $table->unsignedInteger('tokens_used');

            // Where this usage came from
            $table->string('source')->nullable();
            // example: search, recommendation, profile_match

            // Extra flexible data
            $table->json('metadata')->nullable();

            // Optional cost tracking
            $table->decimal('cost', 15, 10)->nullable();

            $table->timestamps();

            // Helpful indexes
            $table->index(['feature', 'created_at']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_usage');
    }
};
