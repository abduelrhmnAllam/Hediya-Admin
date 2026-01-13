<?php

namespace App\Jobs;

use App\Models\AffiliateDashboardDaily;
use App\Models\AffiliateNetwork;
use App\Services\AdmitadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncAdmitadDailyDashboardJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $daysBack = 300
    ) {}

    public function handle(AdmitadService $service): void
    {
        Log::info('SyncAdmitadDailyDashboardJob started', [
            'days_back' => $this->daysBack,
        ]);

        $network = AffiliateNetwork::where('key', 'admitad')->first();

        if (! $network) {
            Log::warning('Admitad network not found');
            return;
        }

        $response = $service->daily([
            'date_start' => now()->subDays($this->daysBack)->format('d.m.Y'),
            'date_end'   => now()->format('d.m.Y'),
            'limit'      => 100,
        ]);

        $rows = $response['results'] ?? [];

        Log::info('Admitad daily rows', [
            'count' => count($rows),
        ]);

        foreach ($rows as $row) {

            $date = $row['date'] ?? null;
            if (! $date) {
                continue;
            }

            AffiliateDashboardDaily::updateOrCreate(
                [
                    'network_id' => $network->id,
                    'date'       => $date,
                ],
                [
                    'orders'      => (int) ($row['sales_sum'] ?? 0),
                    'net_orders'  => (int) ($row['sales_sum'] ?? 0),

                    'revenue'     => (float) ($row['payment_sum_approved'] ?? 0),
                    'net_revenue' => (float) ($row['payment_sum_approved'] ?? 0),

                    'aov' => ($row['sales_sum'] ?? 0) > 0
                        ? ($row['payment_sum_approved'] ?? 0) / $row['sales_sum']
                        : 0,

                    'cancellation_rate' => 0,
                    'currency' => $row['currency'] ?? null,
                ]
            );
        }

        Log::info('SyncAdmitadDailyDashboardJob finished');
    }
}
