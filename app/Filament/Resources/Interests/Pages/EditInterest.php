<?php

namespace App\Filament\Resources\Interests\Pages;

use App\Filament\Resources\Interests\InterestResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\HtmlString;

class EditInterest extends EditRecord
{
    protected static string $resource = InterestResource::class;

    /**
     * ✅ Title with icon (keeps header actions)
     */
    public function getTitle(): string|HtmlString
    {
        if (! $this->record?->icon) {
            return parent::getTitle();
        }

        return new HtmlString(
            '<div style="display:flex;align-items:center;gap:12px;">
                <img
                    src="' . $this->record->icon_url . '"
                    style="
                        width:64px;
                        height:64px;
                        object-fit:contain;
                        border-radius:12px;
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

            Action::make('changeIcon')
                ->label('Change Icon')
                ->form([
                    FileUpload::make('icon')
                        ->disk('public')
                        ->directory('interests')
                        ->visibility('public')
                        ->image()
                        ->required(),
                ])
                ->action(fn (array $data) =>
                    $this->record->update(['icon' => $data['icon']])
                ),
        ];
    }
}
