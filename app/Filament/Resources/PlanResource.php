<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use LucaLongo\Subscriptions\Filament\Forms\PlanForm;
use LucaLongo\Subscriptions\Filament\Tables\PlanTable;
use LucaLongo\Subscriptions\Models\Plan;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Plans');
    }

    public static function form(Form $form): Form
    {
        return PlanForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return PlanTable::make($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
