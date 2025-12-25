<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PersonsRelationManager extends RelationManager
{
    protected static string $relationship = 'persons';

    protected static ?string $title = 'Persons';


    public function table(Table $table): Table
    {
        return $table
                ->columns([

                Tables\Columns\ImageColumn::make('pic_url')
                 ->label('Photo')
                 ->circular()
                 ->size(40),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('relative.title')
                    ->label('Relation')
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->badge(),

                Tables\Columns\TextColumn::make('birthday_date')
                    ->label('Birthday')
                    ->date(),

                Tables\Columns\TextColumn::make('giftList_count')
                    ->label('Gifts')
                    ->counts('giftList'),

                Tables\Columns\TextColumn::make('occasions_count')
                    ->label('Occasions')
                    ->counts('occasions'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
