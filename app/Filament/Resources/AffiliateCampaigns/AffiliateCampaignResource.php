<?php

namespace App\Filament\Resources\AffiliateCampaigns;

use App\Filament\Resources\AffiliateCampaigns\Pages\ListAffiliateCampaigns;
use App\Filament\Resources\AffiliateCampaigns\Tables\AffiliateCampaignsTable;
use App\Models\AffiliateCampaign;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliateCampaignResource extends Resource
{
    protected static ?string $model = AffiliateCampaign::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return AffiliateCampaignsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAffiliateCampaigns::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole([
            'affiliate-admin',
            'hybrid-admin',
        ]);
    }
}
