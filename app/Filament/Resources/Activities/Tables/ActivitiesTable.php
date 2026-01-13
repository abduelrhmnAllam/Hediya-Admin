<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('event')
                    ->label('Action')
                    ->colors([
                        'success' => 'created',
                        'warning' => 'updated',
                        'danger'  => 'deleted',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->wrap()
                    ->searchable(),

                Tables\Columns\TextColumn::make('causer.email')
                    ->label('By Admin')
                    ->placeholder('System'),

                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject_id')
                    ->label('Record ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->since()
                    ->sortable(),
            ])

            ->filters([
                Tables\Filters\SelectFilter::make('event')
                    ->label('Action')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
            ])

            // ✅ Drawer Action (متوافق مع نسختك)
            ->actions([
                Action::make('details')
                    ->label('Details')
                    ->icon('heroicon-o-eye')
                    ->slideOver()
                    ->modalHeading('Activity Details')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->action(fn ($record) => null)
                    ->modalContent(fn ($record) => view(
                        'filament.activities.activity-drawer',
                        ['activity' => $record]
                    )),
            ])

            ->bulkActions([])

            ->defaultSort('created_at', 'desc');
    }
}
