<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use LucaLongo\Subscriptions\Filament\Forms\FeatureForm;
use LucaLongo\Subscriptions\Filament\Tables\FeatureTable;
use LucaLongo\Subscriptions\Models\Feature;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function getNavigationGroup(): ?string
    {
        return __('Plans');
    }

    public static function form(Form $form): Form
    {
        return FeatureForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return FeatureTable::make($table);
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
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
