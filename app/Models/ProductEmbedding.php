<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductEmbedding extends Model
{
    protected $fillable = ['product_id', 'embedding'];

    protected $casts = [
        'embedding' => 'array',
    ];

    /**
     * Get the embedding attribute - convert from PostgreSQL pgvector to array
     * PostgreSQL pgvector type returns as string format '[0.1,0.2,0.3]'
     */
    public function getEmbeddingAttribute($value)
    {
        if (is_string($value)) {
            // PostgreSQL pgvector returns as string format '[0.1,0.2,0.3]'
            $value = trim($value, '[]');
            if (!empty($value)) {
                return array_map('floatval', explode(',', $value));
            }
            return [];
        }
        
        // If already an array or null, return as is
        return $value ?? [];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope to filter by embedding similarity
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $embedding The embedding vector array
     * @param string $operator The distance operator ('<->' for cosine distance, '<#>' for negative inner product, '<->>' for L2 distance)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereEmbedding($query, array $embedding, string $operator = '<->')
    {
        // Convert embedding array to PostgreSQL vector format: [0.1,0.2,0.3]
        $vectorString = '[' . implode(',', $embedding) . ']';
        
        return $query->whereRaw('embedding ' . $operator . ' ?::vector', [$vectorString]);
    }

    /**
     * Scope to order by embedding similarity (ascending = most similar first)
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $embedding The embedding vector array to compare against
     * @param string $operator The distance operator ('<->' for cosine distance, '<#>' for negative inner product, '<->>' for L2 distance)
     * @param string $direction 'asc' for most similar first, 'desc' for least similar first
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByEmbedding($query, array $embedding, string $operator = '<->', string $direction = 'asc')
    {
        // Convert embedding array to PostgreSQL vector format: [0.1,0.2,0.3]
        $vectorString = '[' . implode(',', $embedding) . ']';
        
        return $query->orderByRaw('embedding ' . $operator . ' ?::vector ' . $direction, [$vectorString]);
    }
}