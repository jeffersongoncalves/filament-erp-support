<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceLevelAgreementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('default_priority')
                    ->label('Default Priority')
                    ->badge()
                    ->toggleable(),
                IconColumn::make('default_sla')
                    ->label('Default SLA')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('enabled')
                    ->label('Enabled')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
