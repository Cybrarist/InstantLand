<?php

namespace App\Filament\Resources\LandingPageTemplateResource\Pages;

use App\Filament\Resources\LandingPageTemplateResource;
use App\Models\LandingPageTemplate;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandingPageTemplate extends EditRecord
{

    protected static string $resource = LandingPageTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Build')
                ->url(function (LandingPageTemplate $record){
                    return route('landing-page-template.editor', $record);
                })->openUrlInNewTab(),

            Actions\Action::make('Preview')
                ->url(function (LandingPageTemplate $record){
                    return route('landing-page-template.show', $record);
                })->openUrlInNewTab(),

            Actions\DeleteAction::make(),
        ];
    }
}
