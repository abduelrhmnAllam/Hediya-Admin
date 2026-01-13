<?php

namespace App\Jobs;

use App\Models\AffiliateAction;
use App\Models\AffiliateDashboardDaily;
use App\Models\AffiliateNetwork;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BuildAdmitadDashboardFromActionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * How many days back to rebuild dashboard
     */
    public function __construct(
        public int $daysBack = 300
    ) {}

    public function handle(): void
    {
        Log::info('BuildAffiliateDashboardFromActionsJob started', [
            'days_back' => $this->daysBack,
        ]);

        $fromDate = now()->subDays($this->daysBack)->startOfDay();

        Log::info('Aggregating actions from date', [
            'from_date' => $fromDate->toDateString(),
        ]);

        $rows = AffiliateAction::query()
            ->whereNotNull('action_date')
            ->whereDate('action_date', '>=', $fromDate)
            ->whereIn('status', ['approved', 'paid'])
            ->selectRaw('
                network_id,
                DATE(action_date) as date,
                COUNT(*) as orders,
                SUM(payment) as revenue
            ')
            ->groupByRaw('network_id, DATE(action_date)')
            ->orderBy('date')
            ->get();

        Log::info('Aggregated rows ready', [
            'rows_count' => $rows->count(),
        ]);

        foreach ($rows as $row) {

            $orders  = (int) $row->orders;
            $revenue = (float) $row->revenue;

            AffiliateDashboardDaily::updateOrCreate(
                [
                    'network_id' => $row->network_id,
                    'date'       => $row->date,
                ],
                [
                    'orders'      => $orders,
                    'net_orders'  => $orders,
                    'revenue'     => $revenue,
                    'net_revenue' => $revenue,
                    'aov'         => $orders > 0
                        ? round($revenue / $orders, 2)
                        : 0,
                    'cancellation_rate' => 0,
                ]
            );
        }

        Log::info('BuildAffiliateDashboardFromActionsJob finished');
    }
}
