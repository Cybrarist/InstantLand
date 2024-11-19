<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriberResource\Pages;
use App\Filament\Resources\SubscriberResource\RelationManagers;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup='Campaigns';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                KeyValue::make('data')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {

        $current_subscribers= Subscriber::latest('updated_at')->limit(1000)->pluck('data')->toArray();

        $dynamic_columns=[];
        foreach ($current_subscribers as $subscriber)
            foreach ($subscriber as $key=> $fields_available){
                $dynamic_columns[$key]=Tables\Columns\TextColumn::make("data." . $key)->label($key)->toggleable();
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


            ])
            ->columnSpan(2)
            ->query(function (Builder $query, array $data): Builder {
                if ($data['type'] && $data['value'])
                    $query->whereLike("data->" . $data['type'] , "%{$data['value']}%");
                return $query;
            })
            ->indicator('Search');
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                ...$dynamic_columns,
            ])
            ->filters([
                $filter_values
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}
