<?php

namespace App\Services\Boostiny;

use App\Models\AffiliateCampaign;
use Illuminate\Support\Facades\Log;

class SyncBoostinyCouponActionsJob
{
    public function __construct(
        protected string $from,
        protected string $to,
        protected int $networkId
    ) {}

    public function handle(BoostinyClient $client): void
    {
        Log::info('SyncBoostinyCouponActionsJob started', [
            'from' => $this->from,
            'to'   => $this->to,
        ]);

        $rows = $client->fetchCouponPerformance($this->from, $this->to);

        foreach ($rows as $row) {

            // ✅ 1) Campaign داخلي (Upsert)
            $campaign = AffiliateCampaign::updateOrCreate(
                [
                    'network_id'  => $this->networkId,
                    'external_id' => (string) $row['campaign_id'],
                ],
                [
                    'name' => $row['campaign_name'] ?? 'Unknown',
                    'logo' => $row['campaign_logo'] ?? null,
                ]
            );

            // ✅ 2) Map Action باستخدام campaign_id الداخلي
            $mapped = BoostinyActionMapper::map(
                $row,
                $this->networkId,
                'coupon',
                $campaign->id
            );

            BoostinyActionMapper::persist($mapped);
        }

        Log::info('SyncBoostinyCouponActionsJob finished', [
            'rows' => count($rows),
        ]);
    }
}
