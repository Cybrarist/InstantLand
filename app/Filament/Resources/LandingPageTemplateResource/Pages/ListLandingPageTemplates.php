<?php

namespace App\Filament\Resources\LandingPageTemplateResource\Pages;

use App\Filament\Resources\LandingPageTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandingPageTemplates extends ListRecords
{
    protected static string $resource = LandingPageTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
