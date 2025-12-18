<?php

namespace App\Filament\Widgets;

use App\Models\Avatar;
use App\Models\Interest;
use App\Models\OccasionName;
use App\Models\Relative;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Avatars', Avatar::count())
                ->description('Total avatars')
                ->icon('heroicon-o-user-circle'),

            Stat::make('Default Avatars', Avatar::where('is_default', true)->count())
                ->description('Marked as default')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Interests', Interest::count())
                ->description('Total interests')
                ->icon('heroicon-o-sparkles'),

            Stat::make('Occasion Names', OccasionName::count())
                ->description('Total occasions')
                ->icon('heroicon-o-calendar'),

            Stat::make('Recommended Occasions', OccasionName::where('is_recommend', true)->count())
                ->description('Recommended')
                ->icon('heroicon-o-star')
                ->color('warning'),

            Stat::make('Relatives', Relative::count())
                ->description('Total relatives')
                ->icon('heroicon-o-users'),

            Stat::make('Default Relatives', Relative::where('is_default', true)->count())
                ->description('Marked as default')
                ->icon('heroicon-o-check-badge')
                ->color('success'),
        ];
    }
}
