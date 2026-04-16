<?php

namespace App\Filament\Resources\ResearchCenterResource\Pages;

use App\Filament\Resources\ResearchCenterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResearchCenter extends CreateRecord
{
    protected static string $resource = ResearchCenterResource::class;

    public function mount(): void
    {
        parent::mount();
        
        // Initialize form data with is_featured as false AFTER form is created
        $this->form->fill([
            'is_featured' => false,
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure is_featured is false when creating
        $data['is_featured'] = false;
        return $data;
    }
}
