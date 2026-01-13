<?php

namespace App\Filament\Widgets;

use App\Models\AffiliateDashboardDaily;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueToday extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole([
            'hybrid-admin',
            'affiliate-admin',
        ]) ?? false;
    }

    protected function getStats(): array
    {
        $todayRevenue = AffiliateDashboardDaily::whereDate('date', today())
            ->sum('net_revenue');

        return [
            Stat::make('Revenue Today', number_format($todayRevenue, 2))
                ->description('Net revenue')
                ->color('success'),
        ];
    }
}
