<?php

namespace App\Services\Boostiny;

use App\Models\AffiliateAction;
use App\Models\AffiliateSource;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BoostinyActionMapper
{
    /**
     * Map Boostiny row to AffiliateAction schema
     */
    public static function map(
        array $row,
        int $networkId,
        string $source,     // coupon | link
        int $campaignId     // INTERNAL campaign_id (affiliate_campaigns.id)
    ): array {

        // ✅ Resolve source_id from affiliate_sources (NO hardcode)
        $sourceId = AffiliateSource::where('network_id', $networkId)
            ->where('code', $source)
            ->value('id');

        if (! $sourceId) {
            throw new \RuntimeException(
                "AffiliateSource not found for network_id={$networkId}, code={$source}"
            );
        }

        // ✅ External unique identifier
        $externalId = $row['order_id']
            ?? $row['click_id']
            ?? (string) Str::uuid();

        // ✅ Safe date parsing
        $date = Carbon::parse($row['date'])->startOfDay();

        return [
            'network_id'   => $networkId,
            'campaign_id'  => $campaignId,
            'website_id'   => null,
            'source_id'    => $sourceId,

            'external_id'  => (string) $externalId,

            'action_type'  => 'sale',
            'status'       => 'approved',
            'currency'     => 'USD',

            'orders'     => (int) ($row['orders'] ?? 0),
            'net_orders' => (int) ($row['net_orders'] ?? 0),

            'payment'     => (float) ($row['revenue'] ?? 0),
            'net_payment' => (float) ($row['net_revenue'] ?? 0),

            'cart_amount'     => (float) ($row['sales_amount'] ?? 0),
            'net_cart_amount' => (float) ($row['net_sales_amount'] ?? 0),

            'cancellation_rate' => (float) ($row['orders_cancellation_rate'] ?? 0),
            'revenue_cancellation_rate' => (float) ($row['revenue_cancellation_rate'] ?? 0),
            'sales_amount_cancellation_rate' => (float) ($row['sales_amount_cancellation_rate'] ?? 0),
            'sales_usd_cancellation_rate' => (float) ($row['sales_amount_usd_cancellation_rate'] ?? 0),
            'aov_usd_cancellation_rate' => (float) ($row['aov_usd_cancellation_rate'] ?? 0),

            'sales_amount_usd'     => (float) ($row['sales_amount_usd'] ?? 0),
            'net_sales_amount_usd' => (float) ($row['net_sales_amount_usd'] ?? 0),

            'aov_usd'     => (float) ($row['aov_usd'] ?? 0),
            'net_aov_usd' => (float) ($row['net_aov_usd'] ?? 0),

            // ✅ DATETIME-safe
            'conversion_time'   => $date,
            'action_date'       => $date->toDateString(),
            'click_date'        => null,
            'closing_date'      => null,
            'status_updated_at' => now(),

            'order_id'   => $row['order_id'] ?? null,
            'promocode'  => $row['code'] ?? null,

            // Boostiny subs (if exist)
            'subid'  => $row['sub1'] ?? null,
            'subid1' => $row['sub2'] ?? null,
            'subid2' => $row['sub3'] ?? null,
            'subid3' => $row['sub4'] ?? null,
            'subid4' => $row['sub5'] ?? null,

            'processed'  => false,
            'paid'       => false,

            // ✅ Keep full raw payload
            'raw_payload' => $row,
        ];
    }

    /**
     * Persist action safely (idempotent)
     */
    public static function persist(array $data): AffiliateAction
    {
        return AffiliateAction::updateOrCreate(
            [
                'network_id'  => $data['network_id'],
                'external_id' => $data['external_id'],
            ],
            $data
        );
    }
}
