<?php

namespace app\Filament\Resources\CampaignResource\Pages;

use app\Filament\Resources\CampaignResource;
use App\Jobs\ScreenShotCampaignsJob;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCampaign extends CreateRecord
{
    protected static string $resource = CampaignResource::class;



    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id']= Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', ['record'=>$this->record]);
    }
}
