<?php

namespace App\Filament\Resources\OccasionNames\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;

class OccasionNamesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_background')
                    ->disk('public')
                    ->label('Image')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_default')
                    ->boolean()
                    ->label('Default'),

                IconColumn::make('is_recommend')
                    ->boolean()
                    ->label('Recommended'),

                TextColumn::make('date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_default')
                    ->label('Default'),

                TernaryFilter::make('is_recommend')
                    ->label('Recommended'),
            ])
            ->recordUrl(
                fn ($record) => route(
                    'filament.admin.resources.occasion-names.edit',
                    $record
                )
            );
    }
}
