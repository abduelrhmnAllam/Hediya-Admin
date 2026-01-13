<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateStatDailyMetric extends Model
{
    protected $fillable = [
        'network_id','campaign_id','date',
        'metric_key','metric_value','currency','raw_payload',
    ];

    protected $casts = [
        'date' => 'date',
        'raw_payload' => 'array',
    ];
}
