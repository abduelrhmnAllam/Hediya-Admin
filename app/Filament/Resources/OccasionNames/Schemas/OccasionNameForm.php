<?php

namespace App\Filament\Resources\OccasionNames\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;

class OccasionNameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /*
            |--------------------------------------------------------------
            | Default Toggle
            |--------------------------------------------------------------
            */
            Toggle::make('is_default')
                ->label('Default')
                ->helperText('Toggle to mark this occasion as default'),

            /*
            |--------------------------------------------------------------
            | Name
            |--------------------------------------------------------------
            */
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            /*
            |--------------------------------------------------------------
            | Description
            |--------------------------------------------------------------
            */
            Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            /*
            |--------------------------------------------------------------
            | Image Upload (Create only)
            |--------------------------------------------------------------
            */
            FileUpload::make('image_background')
                ->label('Background Image')
                ->disk('public')
                ->directory('occasions')
                ->visibility('public')
                ->image()
                ->imagePreviewHeight('200')
                ->preserveFilenames()
                ->maxSize(2048)
                ->columnSpanFull()
                ->visible(fn ($record) => $record === null),

            /*
            |--------------------------------------------------------------
            | Colors
            |--------------------------------------------------------------
            */
            Grid::make(2)->schema([
                ColorPicker::make('background_color')
                    ->label('Background Color'),

                ColorPicker::make('title_color')
                    ->label('Text Color'),
            ]),

            /*
            |--------------------------------------------------------------
            | Recommendation
            |--------------------------------------------------------------
            */
            Toggle::make('is_recommend')
                ->label('Recommended')
                ->helperText('Toggle to mark this occasion as recommended')
                ->reactive(),

            DatePicker::make('date')
                ->label('Recommendation Date')
                ->visible(fn ($get) => $get('is_recommend') === true)
                ->required(fn ($get) => $get('is_recommend') === true),

        ]);
    }
}
