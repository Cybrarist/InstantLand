<?php

namespace App\Filament\Resources\CampaignResource\RelationManagers;

use app\Filament\Resources\LandingPageResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LandingPagesRelationManager extends RelationManager
{
    protected static string $relationship = 'landing_pages';

    public function form(Form $form): Form
    {
      return $form->schema(Arr::except(LandingPageResource::get_form($this->ownerRecord) , ['campaign']));
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->recordUrl(
                fn (Model $record): string => route('filament.admin.resources.landing-pages.edit', ['record' => $record]),
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data) {
                    $data['user_id']= Auth::id();
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
