<?php

namespace App\Filament\Resources\OccasionNames\Pages;

use App\Filament\Resources\OccasionNames\OccasionNameResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;

class EditOccasionName extends EditRecord
{
    protected static string $resource = OccasionNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
              Action::make('changeImage')
            ->label('Change Image')
            ->form([
                FileUpload::make('image_background')
                    ->disk('public')
                    ->directory('occasions')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->required(),
            ])
            ->action(function (array $data) {
                $this->record->update([
                    'image_background' => $data['image_background'],
                ]);
            }),
    
        ];
    }
}
