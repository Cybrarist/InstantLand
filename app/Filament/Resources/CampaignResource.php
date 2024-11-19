<?php

namespace app\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\CampaignResource\RelationManagers\LandingPagesRelationManager;
use App\Filament\Resources\CampaignResource\RelationManagers\SubscribersRelationManager;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationGroup="Campaigns";

    protected static ?string $recordTitleAttribute='name';
    protected static bool $isGloballySearchable=true;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                TextInput::make("name")
                    ->columnSpan(6)
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->live()
                    ->debounce(1000)
                    ->afterStateUpdated(function (Forms\Set $set , Forms\Get $get , string $state){
                        $set("link" ,Str::slug($state));
                    }),


                TextInput::make("link")
                    ->columnSpan(6)
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make("status")
                    ->columnspan(6)
                    ->required()
                    ->options(StatusEnum::class)
                    ->default(StatusEnum::Active)
                    ->native(false),

                DatePicker::make("start_at")
                    ->columnSpan(3)
                    ->default(today())
                    ->required()
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, $state){
                        if ($state > today())
                            $set('status', StatusEnum::Scheduled);
                    })
                ,

                DatePicker::make("end_at")
                    ->columnSpan(3)
                    ->nullable()
                    ->native(false),


                Textarea::make("description")
                    ->columnSpanFull()
                    ->rows(5)
                    ->autosize(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->with([
                    'user',
                    'landing_pages'
                ]);
            })
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("user.name"),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => StatusEnum::get_badge($state)),

                Tables\Columns\TextColumn::make("start_at")->date()->sortable(),
                Tables\Columns\TextColumn::make("end_at")->date()->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make("user_id")
                    ->label("Created By")
                    ->relationship("user", "name")
                    ->preload()
                    ->searchable()
                    ->multiple(),

                Tables\Filters\SelectFilter::make("status")
                    ->options(StatusEnum::class)
                    ->multiple(),


                Filter::make('active')

                    ->form([
                        DatePicker::make('start_at'),
                        DatePicker::make('end_at'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {

                        if ($data['start_at'] && $data['end_at'])
                            $query->whereDate('start_at', '>=', $data['start_at'])
                                ->whereDate('end_at', '<=', $data['end_at']);
                        elseif ($data['start_at'] && !$data['end_at'])
                            $query->whereDate('start_at',  $data['start_at']);
                        elseif ($data['end_at'] && !$data['start_at'])
                            $query->whereDate('end_at',  $data['end_at']);

                        return $query;

                    })

            ])
            ->actions([
                EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            LandingPagesRelationManager::class,
            SubscribersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \app\Filament\Resources\CampaignResource\Pages\ListCampaigns::route('/'),
            'create' => \app\Filament\Resources\CampaignResource\Pages\CreateCampaign::route('/create'),
            'edit' => \app\Filament\Resources\CampaignResource\Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
