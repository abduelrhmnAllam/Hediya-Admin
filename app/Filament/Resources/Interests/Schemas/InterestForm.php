<?php

namespace App\Filament\Resources\Interests\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class InterestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /*
            |--------------------------------------------------------------
            | Title
            |--------------------------------------------------------------
            */
            TextInput::make('title')
                ->required()
                ->columnSpanFull(),

            /*
            |--------------------------------------------------------------
            | Icon (create only)
            |--------------------------------------------------------------
            */
            FileUpload::make('icon')
                ->label('Icon')
                ->disk('public')
                ->directory('interests')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->required()
                ->columnSpanFull()
                ->visible(fn ($record) => $record === null),

        ]);
    }
}
