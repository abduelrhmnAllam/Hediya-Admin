<?php

namespace App\Jobs;

use App\Models\AffiliateAction;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateNetwork;
use App\Services\AdmitadService;
use App\Affiliates\Normalizers\AdmitadActionNormalizer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncAdmitadActionsDebugJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $daysBack = 180) {}

    public function handle(AdmitadService $service): void
    {
        Log::info('🔍 Admitad ACTIONS DEBUG job started', [
            'days_back' => $this->daysBack,
        ]);

        $network = AffiliateNetwork::where('key', 'admitad')->first();

        if (! $network) {
            Log::error('❌ Admitad network not found');
            return;
        }

        $offset = 0;
        $limit  = 50;
        $totalInserted = 0;

        do {
            Log::info('➡️ Fetching Admitad actions page', [
                'offset' => $offset,
            ]);

            $response = $service->actions([
                'date_start' => now()->subDays($this->daysBack)->format('d.m.Y'),
                'limit'      => $limit,
                'offset'     => $offset,
            ]);

            Log::info('📦 Raw API keys', array_keys($response));

            $results = $response['results'] ?? [];

            Log::info('📊 Actions received', [
                'count' => count($results),
            ]);

            foreach ($results as $item) {

                $normalized = AdmitadActionNormalizer::normalize($item);

                if (empty($normalized['external_id'])) {
                    Log::warning('⚠️ Skipping action without external_id', [
                        'raw' => $item,
                    ]);
                    continue;
                }

                $campaign = AffiliateCampaign::firstOrCreate(
                    [
                        'network_id' => $network->id,
                        'external_id'=> (string) ($item['advcampaign_id'] ?? 'unknown'),
                    ],
                    [
                        'name' => $item['advcampaign_name'] ?? 'Unknown',
                        'currency' => $item['currency'] ?? null,
                        'raw_payload' => $item,
                    ]
                );

                AffiliateAction::updateOrCreate(
                    [
                        'network_id' => $network->id,
                        'external_id'=> $normalized['external_id'],
                    ],
                    [
                        'campaign_id' => $campaign->id,
                        'action_type' => $normalized['action_type'],
                        'status'      => $normalized['status'],
                        'currency'    => $normalized['currency'],
                        'payment'     => $normalized['payment'],
                        'action_date' => $normalized['action_date'],
                        'raw_payload' => $normalized['raw_payload'],
                    ]
                );

                $totalInserted++;
            }

            $offset += $limit;

        } while (count($results) === $limit);

        Log::info('✅ Admitad ACTIONS DEBUG job finished', [
            'inserted' => $totalInserted,
        ]);
    }
}
