<?php

namespace App\Filament\Resources\Avatars\Pages;

use App\Filament\Resources\Avatars\AvatarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
class EditAvatar extends EditRecord
{
    protected static string $resource = AvatarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
             Action::make('changeImage')
            ->label('Change Avatar')
            ->form([
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->image()
                    ->required(),
            ])
            ->action(fn (array $data) =>
                $this->record->update(['image' => $data['image']])
            ),

        ];
    }
}
