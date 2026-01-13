<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateSource extends Model
{
    protected $fillable = [
        'network_id',
        'code',
        'name',
        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
    ];
}
