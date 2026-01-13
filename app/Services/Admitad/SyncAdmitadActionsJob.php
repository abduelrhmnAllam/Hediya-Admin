<?php

namespace App\Services\Admitad;

use App\Models\AffiliateCampaign;
use Illuminate\Support\Facades\Log;

class SyncAdmitadActionsJob
{
    public function __construct(
        protected array $params,
        protected int $networkId
    ) {}

    public function handle(AdmitadClient $client): void
    {
        Log::info('SyncAdmitadActionsJob started', [
            'params' => $this->params,
        ]);

        $response = $client->fetchActions($this->params);
        $rows = $response['results'] ?? [];

        foreach ($rows as $row) {

            // 1) Campaign internal (Upsert)
            $campaign = AffiliateCampaign::firstOrCreate(
                [
                    'network_id'  => $this->networkId,
                    'external_id' => (string) $row['advcampaign_id'],
                ],
                [
                    'name' => $row['advcampaign_name'] ?? 'Unknown',
                ]
            );

            // 2) Map Action
            $mapped = AdmitadActionMapper::map(
                $row,
                $this->networkId,
                $campaign->id
            );

            AdmitadActionMapper::persist($mapped);
        }

        Log::info('SyncAdmitadActionsJob finished', [
            'rows' => count($rows),
        ]);
    }
}
