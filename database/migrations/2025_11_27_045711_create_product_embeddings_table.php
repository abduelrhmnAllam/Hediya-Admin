<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Enable pgvector extension only if PostgreSQL is used
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('CREATE EXTENSION IF NOT EXISTS vector');
        }

        Schema::create('product_embeddings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->timestamps();

            // Vector column only for PostgreSQL
            if (DB::getDriverName() === 'pgsql') {
                $table->vector('embedding', 1536)
                      ->nullable()
                      ->comment('text-embedding-3-small has 1536 dimensions');
            }
        });

        // Create HNSW index only for PostgreSQL
        if (DB::getDriverName() === 'pgsql') {
            DB::statement(
                'CREATE INDEX product_embeddings_embedding_hnsw
                 ON product_embeddings
                 USING hnsw (embedding vector_cosine_ops)'
            );
        }
    }

    public function down()
    {
        Schema::dropIfExists('product_embeddings');
    }
};
