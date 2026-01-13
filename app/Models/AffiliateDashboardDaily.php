<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateDashboardDaily extends Model
{
    protected $table = 'affiliate_dashboard_daily';

    protected $fillable = [
        'network_id',
        'date',
        'orders',
        'net_orders',
        'revenue',
        'net_revenue',
        'aov',
        'cancellation_rate',
    ];

    protected $casts = [
        'date' => 'date',
    ];


      public function network(): BelongsTo
    {
        return $this->belongsTo(AffiliateNetwork::class , 'network_id');
    }

}
