<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportPlugin;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages\CreateIssueType;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages\EditIssueType;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages\ListIssueTypes;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Schemas\IssueTypeForm;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Tables\IssueTypesTable;

class IssueTypeResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::issueType();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpSupportPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-support.navigation_group', 'ERP — Support');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return IssueTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IssueTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIssueTypes::route('/'),
            'create' => CreateIssueType::route('/create'),
            'edit' => EditIssueType::route('/{record}/edit'),
        ];
    }
}
