<?php

namespace App\Livewire;

use App\Models\AffiliateAction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class AffiliateStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Get the totals from the database
        $stats = AffiliateAction::query()
            ->select([
                DB::raw('SUM(orders) as total_orders'),
                DB::raw('SUM(net_orders) as total_net_orders'),
                DB::raw('SUM(payment) as total_revenue'),
                DB::raw('SUM(net_payment) as total_net_revenue'),
                DB::raw('SUM(cart_amount) as total_sales'),
                DB::raw('SUM(net_cart_amount) as total_net_sales'),
                DB::raw('SUM(sales_amount_usd) as total_sales_usd'),
                DB::raw('SUM(net_sales_amount_usd) as total_net_sales_usd'),
                DB::raw('AVG(cancellation_rate) as avg_orders_cancel'),
                DB::raw('AVG(revenue_cancellation_rate) as avg_rev_cancel'),
            ])
            ->first();

        return [
            Stat::make('Orders (Net/Gross)', number_format($stats->total_net_orders ?? 0) . ' / ' . number_format($stats->total_orders ?? 0))
                ->description('Cancellation: ' . number_format($stats->avg_orders_cancel ?? 0, 2) . '%')
                ->color('success'),

            Stat::make('Revenue (Net/Gross)', '$' . number_format($stats->total_net_revenue ?? 0, 2) . ' / $' . number_format($stats->total_revenue ?? 0, 2))
                ->description('Cancellation: ' . number_format($stats->avg_rev_cancel ?? 0, 2) . '%')
                ->color('primary'),

            Stat::make('Sales USD (Net/Gross)', '$' . number_format($stats->total_net_sales_usd ?? 0, 2) . ' / $' . number_format($stats->total_sales_usd ?? 0, 2))
                ->description('Net Sales Local: ' . number_format($stats->total_net_sales ?? 0, 2))
                ->color('warning'),
        ];
    }
}
