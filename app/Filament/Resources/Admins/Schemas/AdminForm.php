<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            /*
            |--------------------------------------------------------------------------
            | Admin Information
            |--------------------------------------------------------------------------
            */
            Section::make('Admin Information')
                ->schema([
                    Group::make()
                        ->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->unique(
                                    table: 'admins',
                                    column: 'email',
                                    ignorable: fn ($record) => $record
                                ),
                        ])
                        ->columns(2),

                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->required(fn (string $operation) => $operation === 'create')
                        ->hidden(fn (string $operation) => $operation === 'edit')
                        ->minLength(8),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Roles & Access
            |--------------------------------------------------------------------------
            */
            Section::make('Roles & Access')
                ->schema([
                    Select::make('roles')
                        ->label('Roles')
                        ->relationship(
                            name: 'roles',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn ($query) =>
                                $query->where('guard_name', 'admin')
                        )
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->required()
                        ->helperText('Select one or more roles for this admin.')
                        ->disabled(fn ($record) =>
                            $record?->hasRole('hybrid-admin')
                        ),
                ]),
        ]);
    }
}
