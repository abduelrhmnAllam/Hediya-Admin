<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;

class LatestActivities extends TableWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Latest Admin Activities';

    /**
     * Show widget only for hybrid-admin
     */
    public static function canView(): bool
    {
        return auth()->user()?->hasRole('hybrid-admin') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Activity::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\BadgeColumn::make('event')
                    ->label('Action')
                    ->colors([
                        'success' => 'created',
                        'warning' => 'updated',
                        'danger'  => 'deleted',
                    ]),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->wrap(),

                Tables\Columns\TextColumn::make('causer.email')
                    ->label('By')
                    ->placeholder('System'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('When')
                    ->since(),
            ])
            // Dashboard widget = View only
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
