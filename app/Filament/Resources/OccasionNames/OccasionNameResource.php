<?php

namespace App\Filament\Resources\OccasionNames;

use App\Filament\Resources\OccasionNames\Pages\CreateOccasionName;
use App\Filament\Resources\OccasionNames\Pages\EditOccasionName;
use App\Filament\Resources\OccasionNames\Pages\ListOccasionNames;
use App\Filament\Resources\OccasionNames\Schemas\OccasionNameForm;
use App\Filament\Resources\OccasionNames\Tables\OccasionNamesTable;
use App\Models\OccasionName;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OccasionNameResource extends Resource
{
    protected static ?string $model = OccasionName::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return OccasionNameForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OccasionNamesTable::configure($table);
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
            'index' => ListOccasionNames::route('/'),
            'create' => CreateOccasionName::route('/create'),
            'edit' => EditOccasionName::route('/{record}/edit'),
        ];
    }
}
