<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateWebsite extends Model
{
    protected $fillable = [
        'network_id',
        'external_id',
        'name',
        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
    ];
}
