<?php

namespace App\Filament\Resources\LandingPageTemplateResource\Pages;

use App\Filament\Resources\LandingPageTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLandingPageTemplate extends CreateRecord
{
    protected static string $resource = LandingPageTemplateResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id']=Auth::id();

        return $data;
    }

}
