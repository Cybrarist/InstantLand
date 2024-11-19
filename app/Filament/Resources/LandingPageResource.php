<?php

namespace app\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Admin\Resources\LandingPageResource\Pages;
use App\Filament\Admin\Resources\LandingPageResource\RelationManagers;
use App\Filament\Resources\LandingPageResource\RelationManagers\SubscribersRelationManager;
use App\Models\Campaign;
use App\Models\LandingPage;
use App\Models\LandingPageTemplate;
use Dotswan\FilamentCodeEditor\Fields\CodeEditor;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Icetalker\FilamentPicker\Forms\Components\Picker;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Self_;
use Riodwanto\FilamentAceEditor\AceEditor;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;

    protected static ?string $navigationGroup="Campaigns";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute ='name';

    public static function form(Form $form): Form
    {
        return $form->schema(self::get_form());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query){
                $query->with(['campaign:id,name','user:id,name']);
            })
            ->columns([

                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("user.name"),
                Tables\Columns\TextColumn::make("campaign.name"),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => StatusEnum::get_badge($state)),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make("company_id")
                    ->label("Company")
                    ->relationship("company" , "name")
                    ->searchable()
                    ->native(false),

                Tables\Filters\SelectFilter::make("user_id")
                    ->label("User")
                    ->relationship("user" , "name")
                    ->searchable()
                    ->native(false),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            SubscribersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \app\Filament\Resources\LandingPageResource\Pages\ListLandingPages::route('/'),
            'create' => \app\Filament\Resources\LandingPageResource\Pages\CreateLandingPage::route('/create'),
            'edit' => \app\Filament\Resources\LandingPageResource\Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }


    public static function get_form(Campaign $campaign=null)
    {

        return [

            TextInput::make("name")
                ->required()
                ->maxLength(255)
                ->autofocus()
                ->live()
                ->debounce(1000)
                ->afterStateUpdated(function (Forms\Set $set , Forms\Get $get , string $state){
                    $set("link" ,Str::slug($state));
                }),

            Forms\Components\TextInput::make("link")
                ->unique(ignoreRecord: true)
                ->hint('URL accessible to users')
                ->helperText(function ($state){
                    return "landing page link:" . env('APP_URL') . "/$state";
                })
                ->string()
                ->required(),

            Select::make("status")
                ->required()
                ->options(StatusEnum::class)
                ->default(StatusEnum::Active)
                ->native(false),

            Forms\Components\Select::make("landing_page_template_id")
                ->label("Copy Layout From Template")
                ->visible(fn($operation)=> $operation=="create")
                ->options(fn()=>LandingPageTemplate::all()->pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->native(false),


            'campaign'=> Forms\Components\Select::make('campaign_id')
                ->relationship('campaign', 'name')
                ->native(false)
                ->searchable()
                ->preload()
                ->nullable(),

            TextInput::make('AB_testing')
                ->label('A/B Testing')
                ->minValue(0)
                ->integer()
                ->numeric()
                ->maxValue(100),



            Forms\Components\MarkdownEditor::make("description")
                ->columnSpanFull()
                ->string(),

            Forms\Components\Section::make('Header And Footer')
                ->columns(1)
                ->collapsible()
                ->collapsed()
                ->schema([
                    AceEditor::make('header')
                        ->mode('html')
                        ->theme('github')
                        ->darkTheme('dracula')
                        ->formatStateUsing(function ($record){
                            if (!$record?->header)
                                return "<head></head>";
                            return $record->header;
                        })->nullable(),

                    AceEditor::make('footer')
                        ->mode('html')
                        ->theme('github')
                        ->darkTheme('dracula')
                        ->formatStateUsing(function ($record){
                            if (!$record?->footer)
                                return "<footer> </footer>";
                            return $record->header;
                        })->nullable(),




                ]),


            Forms\Components\FileUpload::make('css_files')
                ->helperText("Extra CSS files that can't be added as link to header")
                ->disk('landing_pages_files')
                ->directory('css')
                ->panelLayout('grid')
                ->acceptedFileTypes(['text/css'])
                ->multiple()
                ->reorderable()
                ->downloadable()
                ->openable(),


            Forms\Components\FileUpload::make('js_files')
                ->helperText("Extra Js files that can't be added as link to header")
                ->disk('landing_pages_files')
                ->directory('js')
                ->panelLayout('grid')
                ->multiple()
                ->reorderable()
                ->downloadable()
                ->openable(),

        ];
    }
}
