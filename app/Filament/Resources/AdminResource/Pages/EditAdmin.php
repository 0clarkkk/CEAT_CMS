<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    if ($this->record->id === auth()->id()) {
                        \Filament\Notifications\Notification::make()
                            ->title('Action blocked')
                            ->body('You cannot delete your own account.')
                            ->danger()
                            ->send();
                        $this->halt();
                    }
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * After saving, ensure the Spatie 'admin' role stays synced.
     */
    protected function afterSave(): void
    {
        if (Role::where('name', 'admin')->exists()) {
            $this->record->syncRoles('admin');
        }
    }
}
