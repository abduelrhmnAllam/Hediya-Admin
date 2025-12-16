<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnsignedGift extends Model
{
    protected $table = 'unsigned_gifts';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * Get the user that owns the unsigned gift.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the product in the unsigned gift.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
