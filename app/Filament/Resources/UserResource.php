<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\OwnedTeamsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\TeamsRelationManager;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                      TextInput::make('first_name')
                          ->required(),

                      TextInput::make('last_name')
                          ->required(),

                      TextInput::make('email')
                          ->required(),

                      DatePicker::make('email_verified_at')
                          ->label('Email Verified Date'),

                      TextInput::make('password')
                          ->nullable(),

                      TextInput::make('language')
                          ->required(),

                      Placeholder::make('created_at')
                          ->label('Created Date')
                          ->content(fn(?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                      Placeholder::make('updated_at')
                          ->label('Last Modified Date')
                          ->content(fn(?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                      Placeholder::make('two_factor_confirmed_at')
                          ->label('Two Factor Confirmed Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_label')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email_verified_at')
                    ->label('Email Verified Date')
                    ->date(),

                TextColumn::make('language'),

                TextColumn::make('two_factor_confirmed_at')
                    ->label('Two Factor Confirmed Date')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['first_name', 'last_name', 'email'];
    }

    public static function getRelations(): array
    {
        return [
            OwnedTeamsRelationManager::class,
            TeamsRelationManager::class,
        ];
    }
}
