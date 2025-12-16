<?php

namespace App\Filament\Resources\OccasionNames\Pages;

use App\Filament\Resources\OccasionNames\OccasionNameResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOccasionNames extends ListRecords
{
    protected static string $resource = OccasionNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
