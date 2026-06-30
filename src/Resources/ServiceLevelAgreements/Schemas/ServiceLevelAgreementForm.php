<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;

class ServiceLevelAgreementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('default_priority')
                            ->label('Default Priority')
                            ->options(self::priorityOptions())
                            ->default(IssuePriority::Medium->value)
                            ->required(),
                        Toggle::make('default_sla')
                            ->label('Default SLA'),
                        Toggle::make('enabled')
                            ->label('Enabled')
                            ->default(true),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
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
