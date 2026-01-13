<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    /**
     * Widgets displayed on the dashboard.
     */
    public function getWidgets(): array
    {
        return [
            // Existing system stats
            \App\Filament\Widgets\DashboardStats::class,

            // Affiliate analytics widgets
            \App\Filament\Widgets\RevenueToday::class,
            \App\Filament\Widgets\RevenueThisMonth::class,
            \App\Filament\Widgets\AffiliateRevenueTrend::class,
                \App\Filament\Widgets\LatestActivities::class,
        ];
    }
}
