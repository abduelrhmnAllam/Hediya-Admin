<?php
namespace App\Filament\Widgets;

use App\Models\AffiliateDashboardDaily;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;


class AffiliateRevenueTrend extends ChartWidget
{
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole([
            'hybrid-admin',
            'affiliate-admin',
        ]) ?? false;
    }

    public function getHeading(): ?string
    {
        return 'Revenue & Orders (Last 30 Days)';
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $fromDate = now()->subDays(2000)->startOfDay();

        $stats = AffiliateDashboardDaily::query()
            ->whereDate('date', '>=', $fromDate)
            ->orderBy('date')
            ->get();

        return [
            'labels' => $stats->pluck('date')->map(
                fn ($date) => Carbon::parse($date)->format('M d')
            )->toArray(),

            'datasets' => [
                [
                    'label' => 'Net Revenue',
                    'data'  => $stats->pluck('net_revenue')->toArray(),
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Orders',
                    'data'  => $stats->pluck('net_orders')->toArray(),
                    'tension' => 0.4,
                    'yAxisID' => 'y1',
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Revenue',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'position' => 'right',
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Orders',
                    ],
                ],
            ],
        ];
    }
}
