<?php

namespace App\Filament\Resources\TeamResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use LucaLongo\Subscriptions\Actions\CreateSubscription;
use LucaLongo\Subscriptions\Filament\Forms\SubscriptionForm;
use LucaLongo\Subscriptions\Filament\Tables\SubscriptionTable;
use LucaLongo\Subscriptions\Models\Plan;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    public function form(Form $form): Form
    {
        return SubscriptionForm::make($form, $this->ownerRecord);
    }

    public function table(Table $table): Table
    {
        return SubscriptionTable::make($table, $this->ownerRecord)
            ->headerActions([
                Action::make('add')
                    ->translateLabel()
                    ->fillForm(fn () => [
                        'subscriber_type' => $this->ownerRecord::class,
                        'subscriber_id' => $this->ownerRecord->getKey(),
                    ])
                    ->form([
                        Select::make('plan_id')
                            ->translateLabel()
                            ->relationship(name: 'plan', titleAttribute: 'name')
                            ->searchable(['name'])
                            ->preload()
                            ->required(),
                    ])
                    ->action(function ($data) {
                        (new CreateSubscription)->execute(
                            plan: Plan::find($data['plan_id']),
                            subscriber: $this->ownerRecord,
                        );

                        Notification::make()
                            ->title(__('Subscription created'))
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
