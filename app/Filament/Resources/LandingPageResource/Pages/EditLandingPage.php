<?php

namespace app\Filament\Resources\LandingPageResource\Pages;

use app\Filament\Resources\LandingPageResource;
use App\Models\LandingPage;
use App\Models\LandingPageTemplate;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditLandingPage extends EditRecord
{
    protected static string $resource = LandingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Open')
                ->url(function (LandingPage $record){
                    return route('landing-page.show', $record->link);
                })
                ->icon('heroicon-o-eye')
                ->openUrlInNewTab(),


            Actions\ActionGroup::make([
                Actions\Action::make('Build')
                    ->url(function (LandingPage $record){
                        return route('landing-page.editor', $record);
                    })->openUrlInNewTab(),

                Actions\Action::make('Preview')
                    ->url(function (LandingPage $record){
                        return route('landing-page.preview', $record->id);
                    })->openUrlInNewTab(),


                Actions\Action::make('Reset')
                    ->color('danger')
                    ->action(function (LandingPage $record){
                        $record->update([
                            'gjs_data' => []
                        ]);
                        Notification::make()
                            ->success()
                            ->title('Landing Page Rested Successfully')
                            ->send();

                    }),

                Actions\DeleteAction::make(),


            ]),

        ];
    }
}
