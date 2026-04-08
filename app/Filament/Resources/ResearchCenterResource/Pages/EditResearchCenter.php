<?php

namespace App\Filament\Resources\ResearchCenterResource\Pages;

use App\Filament\Resources\ResearchCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearchCenter extends EditRecord
{
    protected static string $resource = ResearchCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
