<?php

namespace App\Filament\Resources\AffiliateCampaigns\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AffiliateCampaignsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Campaign Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('network.name')
                    ->label('Network')
                    ->badge()
                    ->sortable(),

                TextColumn::make('vendor.name')
                    ->label('Linked Vendor')
                    ->placeholder('Not linked')
                    ->searchable(),

                TextColumn::make('external_id')
                    ->label('External ID')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('network_id')
                    ->relationship('network', 'name'),
            ]);
    }
}
