<?php

namespace App\Filament\Resources\AffiliateDashboardDailies\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AffiliateDashboardDailiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('network.name')
                    ->label('Network')
                    ->sortable()
                    ->badge(),



                TextColumn::make('net_orders')
                    ->label('Net Orders')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('net_revenue')
                    ->label('Net Revenue')
                    ->money('USD')
                    ->sortable(),



                TextColumn::make('aov')
                    ->label('AOV')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('cancellation_rate')
                    ->label('Cancellation %')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . '%')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('network_id')
                    ->label('Network')
                    ->relationship('network', 'name'),

                Tables\Filters\Filter::make('date')
                    ->form([
                        DatePicker::make('from')
                            ->label('From date'),

                        DatePicker::make('to')
                            ->label('To date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn ($q, $date) => $q->whereDate('date', '>=', $date)
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn ($q, $date) => $q->whereDate('date', '<=', $date)
                            );
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }
}
