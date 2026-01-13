<?php

namespace App\Filament\Resources\AffiliateDashboardDailies;

use App\Filament\Resources\AffiliateDashboardDailies\Pages\CreateAffiliateDashboardDaily;
use App\Filament\Resources\AffiliateDashboardDailies\Pages\EditAffiliateDashboardDaily;
use App\Filament\Resources\AffiliateDashboardDailies\Pages\ListAffiliateDashboardDailies;
use App\Filament\Resources\AffiliateDashboardDailies\Schemas\AffiliateDashboardDailyForm;
use App\Filament\Resources\AffiliateDashboardDailies\Tables\AffiliateDashboardDailiesTable;
use App\Models\AffiliateDashboardDaily;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliateDashboardDailyResource extends Resource
{
    protected static ?string $model = AffiliateDashboardDaily::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowTrendingUp;
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Schema $schema): Schema
    {
        return AffiliateDashboardDailyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AffiliateDashboardDailiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAffiliateDashboardDailies::route('/'),

        ];
    }

public static function canViewAny(): bool
{
    return auth()->user()->hasAnyRole([
        'affiliate-admin',
        'hybrid-admin',
    ]);
}

public static function canCreate(): bool
{
    return false;
}


}
