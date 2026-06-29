<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;
use JeffersonGoncalves\Erp\Support\Enums\IssueStatus;

class IssuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof IssueStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        IssueStatus::Open => 'info',
                        IssueStatus::Replied => 'info',
                        IssueStatus::OnHold => 'warning',
                        IssueStatus::Resolved => 'success',
                        IssueStatus::Closed => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('priority')
                    ->label('Priority')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof IssuePriority ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        IssuePriority::Low => 'gray',
                        IssuePriority::Medium => 'info',
                        IssuePriority::High => 'warning',
                        IssuePriority::Urgent => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('issueType.name')
                    ->label('Type')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('serviceLevelAgreement.name')
                    ->label('SLA')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('opening_date')
                    ->label('Opening Date')
                    ->date()
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
                SelectFilter::make('priority')
                    ->label('Priority')
                    ->options(self::priorityOptions()),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        $options = [];

        foreach (IssueStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }

    /** @return array<string, string> */
    protected static function priorityOptions(): array
    {
        $options = [];

        foreach (IssuePriority::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
