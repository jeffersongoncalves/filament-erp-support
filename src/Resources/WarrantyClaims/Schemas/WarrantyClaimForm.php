<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Support\Enums\WarrantyClaimStatus;

class WarrantyClaimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric()
                            ->nullable(),
                        TextInput::make('serial_no')
                            ->label('Serial No')
                            ->maxLength(255),
                        TextInput::make('item_code')
                            ->label('Item Code')
                            ->maxLength(255),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::statusOptions())
                            ->default(WarrantyClaimStatus::Open->value)
                            ->required(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DatePicker::make('complaint_date')
                            ->label('Complaint Date'),
                        DatePicker::make('resolution_date')
                            ->label('Resolution Date'),
                    ])->columns(2),
                Section::make('Complaint')
                    ->schema([
                        Textarea::make('complaint')
                            ->label('Complaint')
                            ->columnSpanFull(),
                        Textarea::make('resolution_details')
                            ->label('Resolution Details')
                            ->columnSpanFull(),
                    ])->columns(2),
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
