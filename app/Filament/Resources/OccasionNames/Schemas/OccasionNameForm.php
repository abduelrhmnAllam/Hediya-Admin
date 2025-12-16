<?php

namespace App\Filament\Resources\OccasionNames\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class OccasionNameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Toggle::make('is_default')
              ->helperText('Toggle to mark this occasion as default')
                ->label('Default'),


            /*
            |--------------------------------------------------------------------------
            | Image + Name (same row)
            |--------------------------------------------------------------------------
            */
            Grid::make(12)->schema([

                Placeholder::make('image_preview')
                    ->content(fn ($record) =>
                        $record?->image_background_url
                            ? new HtmlString(
                                '<img
                                    src="'.$record->image_background_url.'"
                                    style="
                                        width:64px;
                                        height:64px;
                                        object-fit:cover;
                                        border-radius:50%;
                                    "
                                />'
                            )
                            : null
                    )
                    ->disableLabel()
                    ->columnSpan(2)
                    ->visible(fn () => request()->routeIs('*edit')),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(10),

            ]),

            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */
            Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            /*
            |--------------------------------------------------------------------------
            | Image upload (Create only)
            |--------------------------------------------------------------------------
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
            |--------------------------------------------------------------------------
            | Colors
            |--------------------------------------------------------------------------
            */
            Grid::make(2)->schema([
                ColorPicker::make('background_color')
                    ->label('Background Color'),

                ColorPicker::make('title_color')
                    ->label('Text Color'),
            ]),

            /*
            |--------------------------------------------------------------------------
            | Recommendation
            |--------------------------------------------------------------------------
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
