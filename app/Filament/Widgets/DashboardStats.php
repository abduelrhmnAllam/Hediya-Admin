<?php

namespace App\Filament\Widgets;

use App\Models\Avatar;
use App\Models\Interest;
use App\Models\OccasionName;
use App\Models\Relative;
use App\Models\User;
use App\Models\AffiliateAction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole([
            'content-admin',
            'hybrid-admin',
        ]) ?? false;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered app users')
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Total Net Revenue', '$' . number_format(AffiliateAction::sum('net_payment'), 2))
                ->description('Net revenue from affiliate actions')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Total Net Orders', AffiliateAction::sum('net_orders'))
                ->description('Total orders')
                ->icon('heroicon-o-shopping-cart')
                ->color('primary'),

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
