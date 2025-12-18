<?php

namespace App\Filament\Resources\OccasionNames\Pages;

use App\Filament\Resources\OccasionNames\OccasionNameResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\HtmlString;

class EditOccasionName extends EditRecord
{
    protected static string $resource = OccasionNameResource::class;

   
    public function getTitle(): string|HtmlString
    {
        if (! $this->record?->image_background_url) {
            return parent::getTitle();
        }

        return new HtmlString(
            '<div style="display:flex;align-items:center;gap:12px;">
                <img
                    src="' . $this->record->image_background_url . '"
                    style="
                        width:80px;
                        height:80px;
                        object-fit:cover;
                        border-radius:50%;
                    "
                />
                <span>' .'Update'. ' '. e($this->record->name) . '</span>
            </div>'
        );
    }

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
                        ->image()
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
