<?php

namespace App\Filament\Resources\FacultyMemberResource\Pages;

use App\Filament\Resources\FacultyMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacultyMember extends EditRecord
{
    protected static string $resource = FacultyMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // The model's boot method will handle file cleanup
        return $data;
    }
}
