<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Role;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Force role = 'admin' and verify email before saving.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'admin';
        $data['email_verified_at'] = $data['email_verified_at'] ?? now();
        return $data;
    }

    /**
     * After creating the user, sync the Spatie 'admin' role.
     */
    protected function afterCreate(): void
    {
        if (Role::where('name', 'admin')->exists()) {
            $this->record->syncRoles('admin');
        }
    }
}
