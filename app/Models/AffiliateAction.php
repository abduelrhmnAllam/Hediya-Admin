<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateAction extends Model
{
    protected $fillable = [
        'network_id',
        'campaign_id',
        'website_id',
        'source_id',

        'external_id',
        'action_type',
        'status',
        'currency',

        'orders',
        'net_orders',
        'payment',
        'net_payment',
        'cart_amount',
        'net_cart_amount',
        'cancellation_rate',
        'revenue_cancellation_rate',
        'sales_amount_cancellation_rate',
        'sales_usd_cancellation_rate',
        'aov_usd_cancellation_rate',
        'sales_amount_usd',
        'net_sales_amount_usd',
        'aov_usd',
        'net_aov_usd',
        'conversion_time',

        'action_date',
        'click_date',
        'closing_date',
        'status_updated_at',

        'order_id',
        'promocode',

        'subid',
        'subid1',
        'subid2',
        'subid3',
        'subid4',

        'processed',
        'paid',

        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
        'processed' => 'boolean',
        'paid' => 'boolean',
    ];

    public function network()
    {
        return $this->belongsTo(AffiliateNetwork::class);
    }

    public function campaign()
    {
        return $this->belongsTo(AffiliateCampaign::class);
    }
}
