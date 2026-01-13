<?php

namespace App\Services\Admitad;

use App\Models\AffiliateAction;
use App\Models\AffiliateSource;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdmitadActionMapper
{
    /**
     * Map Admitad row to AffiliateAction schema
     */
    public static function map(
        array $row,
        int $networkId,
        int $campaignId
    ): array {

        // Resolve source_id from affiliate_sources
        // For Admitad, we might have different sources or a default one
        $sourceId = AffiliateSource::where('network_id', $networkId)
            ->where('code', 'standard') // Assuming 'standard' as default for now, or we can refine
            ->value('id');

        // External unique identifier
        $externalId = $row['id'] ?? (string) Str::uuid();

        // Safe date parsing
        $actionTime = Carbon::parse($row['action_date']);
        $clickTime = isset($row['click_date']) ? Carbon::parse($row['click_date']) : null;

        return [
            'network_id'   => $networkId,
            'campaign_id'  => $campaignId,
            'website_id'   => null, // Can be mapped if needed from $row['advcampaign_id'] or similar
            'source_id'    => $sourceId,

            'external_id'  => (string) $externalId,

            'action_type'  => $row['action_type'] ?? 'sale',
            'status'       => $row['status'] ?? 'pending',
            'currency'     => $row['currency'] ?? 'USD',

            'payment'     => (float) ($row['payment'] ?? 0),
            'net_payment' => (float) ($row['payment'] ?? 0), // Admitad doesn't always have "net" vs "gross" in this endpoint explicitly like Boostiny

            'cart_amount'     => (float) ($row['cart'] ?? 0),
            'net_cart_amount' => (float) ($row['cart'] ?? 0),

            'cancellation_rate' => 0,

            'conversion_time'   => $actionTime,
            'action_date'       => $actionTime->toDateString(),
            'click_date'        => $clickTime ? $clickTime->toDateTimeString() : null,
            'closing_date'      => isset($row['closing_date']) ? Carbon::parse($row['closing_date'])->toDateTimeString() : null,
            'status_updated_at' => now(),

            'order_id'   => $row['order_id'] ?? null,
            'promocode'  => $row['promocode'] ?? null,

            'subid'  => $row['subid'] ?? null,
            'subid1' => $row['subid1'] ?? null,
            'subid2' => $row['subid2'] ?? null,
            'subid3' => $row['subid3'] ?? null,
            'subid4' => $row['subid4'] ?? null,

            'processed'  => false,
            'paid'       => false,

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
