<?php

namespace App\Filament\Resources\Relatives\Pages;

use App\Filament\Resources\Relatives\RelativeResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\HtmlString;

class EditRelative extends EditRecord
{
    protected static string $resource = RelativeResource::class;

    /**
     * ✅ Title with image (keeps header actions)
     */
    public function getTitle(): string|HtmlString
    {
        if (! $this->record?->image) {
            return parent::getTitle();
        }

        return new HtmlString(
            '<div style="display:flex;align-items:center;gap:12px;">
                <img
                    src="' . $this->record->image_url . '"
                    style="
                        width:80px;
                        height:80px;
                        object-fit:cover;
                        border-radius:50%;
                    "
                />
                <span>' . 'Update ' . e($this->record->title) . '</span>
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
                    FileUpload::make('image')
                        ->disk('public')
                        ->directory('relatives')
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
