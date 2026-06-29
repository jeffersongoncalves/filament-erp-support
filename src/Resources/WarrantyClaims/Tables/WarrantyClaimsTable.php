<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Enums\WarrantyClaimStatus;

class WarrantyClaimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('serial_no')
                    ->label('Serial No')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof WarrantyClaimStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        WarrantyClaimStatus::Open => 'info',
                        WarrantyClaimStatus::InProgress => 'warning',
                        WarrantyClaimStatus::Resolved => 'success',
                        WarrantyClaimStatus::Closed => 'gray',
                        WarrantyClaimStatus::Cancelled => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('complaint_date')
                    ->label('Complaint Date')
                    ->date()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
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

        foreach (WarrantyClaimStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
