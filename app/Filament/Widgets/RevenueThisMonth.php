<?php
namespace App\Filament\Widgets;

use App\Models\AffiliateDashboardDaily;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueThisMonth extends StatsOverviewWidget
{


    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole([
            'hybrid-admin',
        ]) ?? false;
    }
    
    protected function getStats(): array
    {
        $monthRevenue = AffiliateDashboardDaily::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('net_revenue');

        return [
            Stat::make('Revenue This Month', number_format($monthRevenue, 2))
                ->description('Net revenue')
                ->color('primary'),
        ];
    }
}
