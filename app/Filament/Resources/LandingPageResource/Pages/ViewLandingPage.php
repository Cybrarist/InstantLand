<?php

namespace app\Filament\Resources\LandingPageResource\Pages;

use app\Filament\Resources\LandingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLandingPage extends ViewRecord
{
    protected static string $resource = LandingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
