<?php
namespace App\Jobs;

use App\Models\AffiliateAction;
use App\Models\AffiliateActionItem;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateNetwork;
use App\Models\AffiliateWebsite;
use App\Models\AffiliateSource;
use App\Services\AdmitadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class SyncAdmitadActionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $daysBack = 2000
    ) {}

    public function handle(AdmitadService $service): void
    {
        Log::info('SyncAdmitadActionsJob started', [
            'days_back' => $this->daysBack,
        ]);

        $network = AffiliateNetwork::where('key', 'admitad')->first();

        if (! $network) {
            Log::error('Admitad network not found');
            return;
        }

        $offset = 0;
        $limit  = 100;
        $totalInserted = 0;

        do {
            $response = $service->actions([
                'date_start' => now()->subDays($this->daysBack)->format('d.m.Y'),
                'limit'      => $limit,
                'offset'     => $offset,
            ]);

            $rows = $response['results'] ?? [];

            Log::info('Admitad actions page fetched', [
                'offset' => $offset,
                'count'  => count($rows),
            ]);

            DB::transaction(function () use ($rows, $network, &$totalInserted) {

                foreach ($rows as $row) {

                    if (empty($row['action_id'])) {
                        continue;
                    }

                    /** Campaign */
                    $campaign = AffiliateCampaign::firstOrCreate(
                        [
                            'network_id'  => $network->id,
                            'external_id' => (string) $row['advcampaign_id'],
                        ],
                        [
                            'name'        => $row['advcampaign_name'] ?? 'Unknown',
                            'currency'    => $row['currency'] ?? null,
                            'raw_payload' => $row,
                        ]
                    );

                    /** Website */
                    $website = null;
                    if (! empty($row['website_id'])) {
                        $website = AffiliateWebsite::firstOrCreate(
                            [
                                'network_id'  => $network->id,
                                'external_id' => (string) $row['website_id'],
                            ],
                            [
                                'name'        => $row['website_name'] ?? null,
                                'raw_payload' => $row,
                            ]
                        );
                    }

                    /** Source */
                    $source = null;
                    if (! empty($row['subid'])) {
                        $source = AffiliateSource::firstOrCreate(
                            [
                                'network_id' => $network->id,
                                'code'       => (string) $row['subid'],
                            ],
                            [
                                'name'        => $row['subid'],
                                'raw_payload' => $row,
                            ]
                        );
                    }

                    /** Action */
                    $action = AffiliateAction::updateOrCreate(
                        [
                            'network_id' => $network->id,
                            'external_id'=> (string) $row['action_id'],
                        ],
                        [
                            'campaign_id' => $campaign->id,
                            'website_id'  => $website?->id,
                            'source_id'   => $source?->id,

                            'action_type' => $row['action_type'] ?? null,
                            'status'      => $row['status'] ?? null,
                            'currency'    => $row['currency'] ?? null,

                            'payment'     => (float) ($row['payment'] ?? 0),
                            'cart_amount' => (float) ($row['cart'] ?? 0),
                          'conversion_time' => ! empty($row['conversion_time'])
    ? (
        is_numeric($row['conversion_time'])
            ? Carbon::createFromTimestamp((int) $row['conversion_time'])
            : Carbon::parse($row['conversion_time'])
      )
    : null,


                            'order_id'    => $row['order_id'] ?? null,
                            'promocode'   => $row['promocode'] ?? null,

                            'subid'  => $row['subid']  ?? null,
                            'subid1' => $row['subid1'] ?? null,
                            'subid2' => $row['subid2'] ?? null,
                            'subid3' => $row['subid3'] ?? null,
                            'subid4' => $row['subid4'] ?? null,

                            'action_date' => !empty($row['action_date'])
                                ? Carbon::parse($row['action_date'])
                                : null,

                            'click_date' => !empty($row['click_date'])
                                ? Carbon::parse($row['click_date'])
                                : null,

                            'closing_date' => !empty($row['closing_date'])
                                ? Carbon::parse($row['closing_date'])
                                : null,

                            'status_updated_at' => !empty($row['status_updated'])
                                ? Carbon::parse($row['status_updated'])
                                : null,

                            'processed' => (bool) ($row['processed'] ?? false),
                            'paid'      => (bool) ($row['paid'] ?? false),

                            'raw_payload'=> $row,
                        ]
                    );

                    /** Items */
                    AffiliateActionItem::where('action_id', $action->id)->delete();

                    foreach ($row['positions'] ?? [] as $item) {
                        AffiliateActionItem::create([
                            'action_id'    => $action->id,
                            'product_id'   => $item['product_id'] ?? null,
                            'product_name' => $item['product_name'] ?? null,
                            'product_url'  => $item['product_url'] ?? null,
                            'product_image'=> $item['product_image'] ?? null,
                            'amount'       => (float) ($item['amount'] ?? 0),
                            'payment'      => (float) ($item['payment'] ?? 0),
                            'percentage'   => (bool) ($item['percentage'] ?? false),
                            'rate'         => $item['rate'] ?? null,
                            'raw_payload'  => $item,
                        ]);
                    }

                    $totalInserted++;
                }
            });

            $offset += $limit;

        } while (count($rows) === $limit);

        Log::info('SyncAdmitadActionsJob finished', [
            'total_actions' => $totalInserted,
        ]);
    }
}
