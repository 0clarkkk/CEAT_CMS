<?php

namespace App\Filament\Resources\ResearchCenterResource\Pages;

use App\Filament\Resources\ResearchCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearchCenters extends ListRecords
{
    protected static string $resource = ResearchCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
