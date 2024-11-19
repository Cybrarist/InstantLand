<?php

namespace app\Filament\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-c-users';

    protected static ?string $navigationGroup="Settings";

    protected static ?int $navigationSort=10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->autofocus(),

                Forms\Components\TextInput::make("email")
                    ->string()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\TextInput::make("password")
                    ->string()
                    ->nullable()
                    ->password(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => \app\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \app\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \app\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
