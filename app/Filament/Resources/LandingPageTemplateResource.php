<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageTemplateResource\Pages;
use App\Filament\Resources\LandingPageTemplateResource\RelationManagers;
use App\Models\LandingPageTemplate;
use Dotswan\FilamentCodeEditor\Fields\CodeEditor;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LandingPageTemplateResource extends Resource
{
    protected static ?string $model = LandingPageTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup= 'Templates';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make("name")
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->live()
                    ->debounce(1000)
                    ->afterStateUpdated(function (Forms\Set $set , Forms\Get $get , string $state){
                        $set("slug" ,Str::slug($state));
                    }),

                Forms\Components\TextInput::make("slug")
                    ->string()
                    ->required(),

                Forms\Components\Textarea::make("description")
                    ->string(),

                Forms\Components\Select::make("user_id")
                    ->label("Created By")
                    ->relationship("user" , "name")
                    ->disabled()
                    ->hiddenOn('create')
                    ->searchable()
                    ->preload()
                    ->native(false),

                Forms\Components\Section::make('Header And Footer')
                    ->columns(1)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        CodeEditor::make('header')
                            ->formatStateUsing(function ($record){
                                if (!$record?->header)
                                    return "<head></head>";
                                return $record->header;
                            })
                            ->nullable(),


                        CodeEditor::make('footer')
                            ->formatStateUsing(function ($record){
                                if (!$record?->footer)
                                    return "<footer> </footer>";
                            })
                            ->nullable(),


                    ]),

                Forms\Components\FileUpload::make('css_files')
                    ->disk('landing_pages_templates_files')
                    ->directory('css')
                    ->panelLayout('grid')
                    ->acceptedFileTypes(['text/css'])
                    ->multiple()
                    ->reorderable()
                    ->downloadable()
                    ->openable(),


                Forms\Components\FileUpload::make('js_files')
                    ->disk('landing_pages_templates_files')
                    ->directory('js')
                    ->panelLayout('grid')
                    ->multiple()
                    ->reorderable()
                    ->downloadable()
                    ->openable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("user.name"),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make("user_id")
                    ->label("User")
                    ->relationship("user" , "name")
                    ->searchable()
                    ->native(false),
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
            'index' => Pages\ListLandingPageTemplates::route('/'),
            'create' => Pages\CreateLandingPageTemplate::route('/create'),
            'edit' => Pages\EditLandingPageTemplate::route('/{record}/edit'),
        ];
    }
}
