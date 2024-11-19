<?php

namespace App\Filament\Resources\CampaignResource\RelationManagers;

use app\Filament\Resources\LandingPageResource;
use App\Models\LandingPage;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscribersRelationManager extends RelationManager
{
    protected static string $relationship = 'subscribers';

    public function form(Form $form): Form
    {

        return $form->schema([

            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            KeyValue::make('data')->columnSpanFull()
        ]);
    }

    public function table(Table $table ): Table
    {

        $current_subscribers=Subscriber::withWhereHas('landing_pages', function ($query){
            $query->whereIn('landing_pages.id', LandingPage::where('campaign_id', $this->ownerRecord->id)
                ->pluck('id')->toArray());
        })
            ->pluck('data')->toArray();
//            ->get();

        $dynamic_columns=[];
        foreach ($current_subscribers as $subscriber)
            foreach ($subscriber as $key=> $fields_available){
                $dynamic_columns[$key]=Tables\Columns\TextColumn::make("data." . $key)->label($key);
                $filters_options[$key]=$key;
            }

        $filter_values=Filter::make('custom fields')

            ->form([

                Grid::make()
                    ->schema([
                        Select::make('type')
                            ->options($filters_options ?? [])
                            ->searchable()
                            ->preload(),

                        TextInput::make('value')
                            ->columnSpan(1),
                    ])


            ])->columnSpan(2)
            ->query(function (Builder $query, array $data): Builder {
                if ($data['type'] && $data['value'])
                    $query->whereLike("data->" . $data['type'] , "%{$data['value']}%");

                return $query;

            })->indicator('Search');

        return $table
            ->query(function (){
                return Subscriber::whereHas('landing_pages', function ($query){
                    $query->whereIn('landing_pages.id', LandingPage::where('campaign_id', $this->ownerRecord->id)->pluck('id')->toArray());
                });
            })
            ->recordTitleAttribute('email')
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()->searchable(),
                ...$dynamic_columns,

                Tables\Columns\TextColumn::make('landing_pages')
                    ->html()
                    ->color('danger')
                    ->formatStateUsing(function ($record){
                        $to_return="";
                        foreach ($record->landing_pages as $landing_page){
                            $to_return="<a target='_blank' href='" . LandingPageResource::getUrl('edit', ['record'=>$landing_page->id]) . "'>" . $landing_page->name. "</a>" ;
                        }

                        return $to_return;
                    })
            ])
            ->filters([
                $filter_values
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

}
