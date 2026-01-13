<?php

namespace App\Filament\Resources\AffiliateActions\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;

class AffiliateActionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('action_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('network.name')
                    ->label('Network')
                    ->badge()
                    ->sortable(),

                TextColumn::make('campaign.name')
                    ->label('Campaign')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order_id')
                    ->label('Order ID')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('promocode')
                    ->label('Promocode')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'declined' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('orders')
                    ->label('Orders (G)')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('net_orders')
                    ->label('Orders (N)')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('payment')
                    ->label('Revenue (G)')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('net_payment')
                    ->label('Revenue (N)')
                    ->money('USD')
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('cart_amount')
                    ->label('Sales (G)')   
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('net_cart_amount')
                    ->label('Sales (N)')
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('sales_amount_usd')
                    ->label('Sales USD (G)')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('net_sales_amount_usd')
                    ->label('Sales USD (N)')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('aov_usd')
                    ->label('AOV (G)')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('net_aov_usd')
                    ->label('AOV (N)')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('cancellation_rate')
                    ->label('Cancel %')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . '%')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('network_id')
                    ->label('Network')
                    ->relationship('network', 'name'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'approved' => 'Approved',
                        'pending' => 'Pending',
                        'declined' => 'Declined',
                    ]),

                Tables\Filters\Filter::make('action_date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('to'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('action_date', '>=', $date))
                            ->when($data['to'], fn ($q, $date) => $q->whereDate('action_date', '<=', $date));
                    }),
            ])
            ->defaultSort('action_date', 'desc');
    }
}
