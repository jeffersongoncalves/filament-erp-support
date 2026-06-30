<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Support\Enums\AgreementStatus;
use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;
use JeffersonGoncalves\Erp\Support\Enums\IssueStatus;

class IssueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->maxLength(255),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::enumOptions(IssueStatus::cases()))
                            ->default(IssueStatus::Open->value)
                            ->required(),
                        Select::make('priority')
                            ->label('Priority')
                            ->options(self::enumOptions(IssuePriority::cases()))
                            ->default(IssuePriority::Medium->value)
                            ->required(),
                        Select::make('agreement_status')
                            ->label('Agreement Status')
                            ->options(self::enumOptions(AgreementStatus::cases()))
                            ->nullable(),
                    ])->columns(2),
                Section::make('Party')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric()
                            ->nullable(),
                        TextInput::make('raised_by')
                            ->label('Raised By')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Classification')
                    ->schema([
                        Select::make('issue_type_id')
                            ->label('Issue Type')
                            ->relationship('issueType', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('service_level_agreement_id')
                            ->label('Service Level Agreement')
                            ->relationship('serviceLevelAgreement', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DatePicker::make('opening_date')
                            ->label('Opening Date'),
                        DateTimePicker::make('resolution_date')
                            ->label('Resolution Date'),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    /**
     * @param  array<int, \BackedEnum>  $cases
     * @return array<string, string>
     */
    protected static function enumOptions(array $cases): array
    {
        $options = [];

        foreach ($cases as $case) {
            /** @var string $value */
            $value = $case->value;
            $options[$value] = $value;
        }

        return $options;
    }
}
