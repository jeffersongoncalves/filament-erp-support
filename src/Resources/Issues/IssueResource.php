<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\Issues;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportPlugin;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\CreateIssue;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\EditIssue;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\ListIssues;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Schemas\IssueForm;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Tables\IssuesTable;

class IssueResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'subject';

    public static function getModel(): string
    {
        return ModelResolver::issue();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpSupportPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-support.navigation_group', 'ERP — Support');
        }
    }

    public static function form(Form $form): Form
    {
        return IssueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return IssuesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIssues::route('/'),
            'create' => CreateIssue::route('/create'),
            'edit' => EditIssue::route('/{record}/edit'),
        ];
    }
}
