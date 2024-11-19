<?php

namespace app\Filament\Resources\CampaignResource\Pages;

use App\Filament\Resources\CampaignCalendarResource\Widgets\CalendarWidget;
use app\Filament\Resources\CampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampaigns extends ListRecords
{
    protected static string $resource = CampaignResource::class;


    protected function getHeaderWidgets(): array
    {
        return [
            CalendarWidget::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
