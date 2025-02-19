<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers\MembersRelationManager;
use App\Models\Team;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $slug = 'teams';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                      Select::make('owner_id')
                          ->relationship('owner', 'email')
                          ->searchable()
                          ->required(),

                      TextInput::make('name')
                          ->required(),

                      TextInput::make('vat_no'),

                      TextInput::make('tax_code'),

                      Placeholder::make('created_at')
                          ->label('Created Date')
                          ->content(fn(?Team $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                      Placeholder::make('updated_at')
                          ->label('Last Modified Date')
                          ->content(fn(?Team $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('vat_no'),

                TextColumn::make('tax_code'),
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

    public static function getRelations(): array
    {
        return [
            MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit'   => Pages\EditTeam::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['owner']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'owner.email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->owner) {
            $details['Owner'] = $record->owner->email;
        }

        return $details;
    }
}
