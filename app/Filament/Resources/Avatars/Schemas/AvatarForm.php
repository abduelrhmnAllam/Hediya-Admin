<?php
namespace App\Filament\Resources\Avatars\Schemas;


use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class AvatarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Toggle::make('is_default')
                ->label('Default Avatar'),

            Grid::make(12)->schema([

                Placeholder::make('image_preview')
                    ->content(fn ($record) =>
                        $record?->image_url
                            ? new HtmlString(
                                '<img src="'.$record->image_url.'"
                                   style="width:64px;height:64px;border-radius:50%;object-fit:cover;" />'
                            )
                            : null
                    )
                    ->disableLabel()
                    ->columnSpan(2)
                    ->visible(fn () => request()->routeIs('*edit')),

                TextInput::make('name')
                    ->required()
                    ->columnSpan(10),
            ]),

            Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    
                ]),

            FileUpload::make('image')
                ->label('Avatar Image')
                ->disk('public')
                ->directory('avatars')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->required()
                ->columnSpanFull()
                ->visible(fn ($record) => $record === null),
        ]);
    }
}
