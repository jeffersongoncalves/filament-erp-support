<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;

class PrioritiesRelationManager extends RelationManager
{
    protected static string $relationship = 'priorities';

    protected static ?string $title = 'Priorities';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('priority')
                    ->label('Priority')
                    ->options(self::priorityOptions())
                    ->default(IssuePriority::Medium->value)
                    ->required(),
                TextInput::make('response_time')
                    ->label('Response Time')
                    ->helperText('Seconds')
                    ->numeric()
                    ->default(0)
                    ->required(),
                TextInput::make('resolution_time')
                    ->label('Resolution Time')
                    ->helperText('Seconds')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('priority')
            ->columns([
                TextColumn::make('priority')
                    ->label('Priority')
                    ->badge(),
                TextColumn::make('response_time')
                    ->label('Response Time')
                    ->numeric(),
                TextColumn::make('resolution_time')
                    ->label('Resolution Time')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
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
    protected static function priorityOptions(): array
    {
        $options = [];

        foreach (IssuePriority::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
