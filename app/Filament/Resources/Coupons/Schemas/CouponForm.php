<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('vendor_id')
                ->label('Vendor')
                ->relationship('vendor', 'name')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('category_id', null)),

            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship(
                    name: 'category',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn ($query, callable $get) =>
                        $query->where('vendor_id', $get('vendor_id'))
                )
                ->disabled(fn (callable $get) => ! $get('vendor_id'))
                ->nullable(),

            Forms\Components\TextInput::make('coupon')
                ->label('Coupon Code')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),

            Forms\Components\DatePicker::make('expired_at')
                ->label('Expiration Date')
                ->nullable(),
        ]);
    }
}
