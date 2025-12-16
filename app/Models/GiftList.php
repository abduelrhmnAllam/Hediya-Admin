<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftList extends Model
{
    protected $table = 'gift_list';

    protected $fillable = [
        'person_id',
        'product_id',
        'user_id',
    ];

    /**
     * Get the person that owns the gift list entry.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    /**
     * Get the product in the gift list.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the user that owns the gift list entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

