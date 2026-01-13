<?php

namespace App\Filament\Resources\Relatives;

use App\Filament\Resources\Relatives\Pages\CreateRelative;
use App\Filament\Resources\Relatives\Pages\EditRelative;
use App\Filament\Resources\Relatives\Pages\ListRelatives;
use App\Filament\Resources\Relatives\Schemas\RelativeForm;
use App\Filament\Resources\Relatives\Tables\RelativesTable;
use App\Models\Relative;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RelativeResource extends Resource
{
    protected static ?string $model = Relative::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return RelativeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RelativesTable::configure($table);
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
            'index' => ListRelatives::route('/'),
            'create' => CreateRelative::route('/create'),
            'edit' => EditRelative::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
{
    return auth()->user()->hasAnyRole([
        'content-admin',
        'hybrid-admin',
    ]);
}

}
