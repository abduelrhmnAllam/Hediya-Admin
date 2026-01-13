<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Details')
                    ->tabs([
                        Tabs\Tab::make('General Information')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('name_en')
                                            ->required()
                                            ->label('Name (English)'),
                                        TextInput::make('name_ar')
                                            ->required()
                                            ->label('Name (Arabic)'),
                                    ]),
                                Textarea::make('description_en')
                                    ->label('Description (English)')
                                    ->columnSpanFull(),
                                Textarea::make('description_ar')
                                    ->label('Description (Arabic)')
                                    ->columnSpanFull(),
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('price')
                                            ->numeric()
                                            ->prefix('$'),
                                        TextInput::make('old_price')
                                            ->numeric()
                                            ->prefix('$'),
                                        TextInput::make('qty')
                                            ->numeric()
                                            ->label('Quantity'),
                                    ]),
                            ]),
                        Tabs\Tab::make('Relationships & Meta')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Select::make('category_id')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('vendor_id')
                                            ->relationship('vendor', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('brand_id')
                                            ->relationship('brand', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('country_id')
                                            ->relationship('country', 'name')
                                            ->searchable()
                                            ->preload(),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('external_id'),
                                        TextInput::make('fingerprint')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                        TextInput::make('version')
                                            ->numeric()
                                            ->default(1),
                                    ]),
                            ]),
                        Tabs\Tab::make('Images')
                            ->schema([
                                Repeater::make('images')
                                    ->relationship('images')
                                    ->schema([
                                        TextInput::make('url')
                                            ->required()
                                            ->label('Image URL'),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columns(2)
                                    ->orderColumn('sort_order')
                                    ->grid(2)
                                    ->createItemButtonLabel('Add Image'),
                            ]),
                        Tabs\Tab::make('Sizes')
                            ->schema([
                                Repeater::make('sizes')
                                    ->relationship('sizes')
                                    ->schema([
                                        TextInput::make('size')
                                            ->required(),
                                    ])
                                    ->grid(4)
                                    ->createItemButtonLabel('Add Size'),
                            ]),
                        Tabs\Tab::make('Attributes')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('material'),
                                        TextInput::make('gender_en'),
                                        TextInput::make('gender_ar'),
                                        TextInput::make('currency'),
                                        TextInput::make('colors_en'),
                                        TextInput::make('colors_ar'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
