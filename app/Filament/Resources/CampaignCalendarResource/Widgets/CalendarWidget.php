<?php

namespace App\Filament\Resources\CampaignCalendarResource\Widgets;

use App\Enums\StatusEnum;
use app\Filament\Resources\CampaignResource;
use App\Models\Campaign;
use Filament\Support\Colors\Color;
use Filament\Widgets\Widget;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{



    protected function headerActions(): array
    {
        return [];
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetch_info): array
    {

         return Campaign::query()
            ->where('start_at', '>=', $fetch_info['start'])
            ->where(function ($query) use ($fetch_info) {
                $query->where('end_at', '<=', $fetch_info['end'])
                    ->orWhereNull('end_at');
            })
            ->get()
            ->map(function (Campaign $campaign) {

                $main_color=match ($campaign->status) {
                    StatusEnum::Scheduled=>"#f59e0b",
                    StatusEnum::Finished=> "#ef4444",
                    default=> 'primary',
                };

                return [
                        'title' => $campaign->name,
                        'start' => $campaign->start_at->toDateString(),
                        'end' => $campaign->end_at ?? $campaign->start_at->toDateString(),
                        'url' => CampaignResource::getUrl(name: 'edit', parameters: ['record' => $campaign]),
                        "backgroundColor"=>$main_color,
                        "borderColor"=>$main_color,
                        'shouldOpenUrlInNewTab' => true,
                    ];
                }
            )

            ->toArray();
    }

}
