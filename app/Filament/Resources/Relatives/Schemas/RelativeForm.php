<?php

namespace App\Filament\Resources\Relatives\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;

class RelativeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /*
            |--------------------------------------------------------------
            | Default toggle (single row)
            |--------------------------------------------------------------
            */
            Grid::make(12)->schema([
                Toggle::make('is_default')
                    ->label('Default Relative')
                    ->helperText('Toggle to mark this relative as default')
                    ->columnSpan(12),
            ]),

            /*
            |--------------------------------------------------------------
            | Title + Gender (same row)
            |--------------------------------------------------------------
            */
            Grid::make(12)->schema([

                TextInput::make('title')
                    ->required()
                    ->columnSpan(8),

                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required()
                    ->columnSpan(4),

            ]),

            /*
            |--------------------------------------------------------------
            | Image (create only)
            |--------------------------------------------------------------
            */
            FileUpload::make('image')
                ->label('Relative Image')
                ->disk('public')
                ->directory('relatives')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->required()
                ->columnSpanFull()
                ->visible(fn ($record) => $record === null),

        ]);
    }
}
