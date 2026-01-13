<?php

namespace App\Filament\Resources\AffiliateDashboardDailies\Pages;

use App\Filament\Resources\AffiliateDashboardDailies\AffiliateDashboardDailyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAffiliateDashboardDailies extends ListRecords
{
    protected static string $resource = AffiliateDashboardDailyResource::class;

    protected function getHeaderActions(): array
    {
        return [
          
        ];
    }
}
