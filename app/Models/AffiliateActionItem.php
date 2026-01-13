<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateActionItem extends Model
{
    protected $fillable = [
        'action_id',
        'product_id',
        'product_name',
        'product_url',
        'product_image',
        'amount',
        'payment',
        'percentage',
        'rate',
        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
        'percentage' => 'boolean',
    ];
}
