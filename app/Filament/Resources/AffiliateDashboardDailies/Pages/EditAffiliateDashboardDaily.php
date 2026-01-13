<?php

namespace App\Filament\Resources\AffiliateDashboardDailies\Pages;

use App\Filament\Resources\AffiliateDashboardDailies\AffiliateDashboardDailyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAffiliateDashboardDaily extends EditRecord
{
    protected static string $resource = AffiliateDashboardDailyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
