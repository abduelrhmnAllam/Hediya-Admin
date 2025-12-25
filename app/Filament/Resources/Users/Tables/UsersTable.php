<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('persons_count')
                    ->label('Persons')
                    ->counts('persons'),

                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            // 👇 افتح صفحة اليوزر بالضغط على الصف
            ->recordUrl(fn ($record) => route(
                'filament.admin.resources.users.edit',
                $record
            ));
    }
}
