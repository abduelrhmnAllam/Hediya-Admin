<?php

namespace App\Filament\Resources\AffiliateActions;

use App\Filament\Resources\AffiliateActions\Pages\ListAffiliateActions;
use App\Filament\Resources\AffiliateActions\Tables\AffiliateActionsTable;
use App\Models\AffiliateAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliateActionResource extends Resource
{
    protected static ?string $model = AffiliateAction::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $recordTitleAttribute = 'order_id';

    public static function table(Table $table): Table
    {
        return AffiliateActionsTable::configure($table);
    }

    public static function getHeaderWidgets(): array
    {
        return [
            \App\Livewire\AffiliateStatsOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAffiliateActions::route('/'),
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
