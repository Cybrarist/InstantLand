<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Models\Component;
use Dotswan\FilamentCodeEditor\Fields\CodeEditor;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Riodwanto\FilamentAceEditor\AceEditor;

class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup= 'Templates';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->afterStateUpdated(function ( $get,  $set, ?string $state) {
                        if (filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->required()
                    ->live()
                    ->debounce(1000),

                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\Section::make('Code')
                    ->columns(3)
                    ->collapsible()
                    ->collapsed()
                    ->live()
                    ->schema([
                        AceEditor::make('css')
                            ->mode('css')
                            ->theme('github')
                            ->darkTheme('dracula')
                            ->autosize()
                        ,

                        AceEditor::make('js')
                            ->columnSpan(2)
                            ->mode('js')
                            ->theme('github')
                            ->darkTheme('dracula')
                            ->autosize()
                        ,

                        AceEditor::make('html')
                            ->columnSpanFull()
                            ->mode('html')
                            ->theme('github')
                            ->darkTheme('dracula')
                            ->autosize()
                        ,
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug')->searchable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'view' => Pages\ViewComponent::route('/{record}'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
