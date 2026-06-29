<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportPlugin;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\CreateServiceLevelAgreement;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\EditServiceLevelAgreement;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\ListServiceLevelAgreements;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\RelationManagers\PrioritiesRelationManager;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Schemas\ServiceLevelAgreementForm;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Tables\ServiceLevelAgreementsTable;

class ServiceLevelAgreementResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::serviceLevelAgreement();
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
        return ServiceLevelAgreementForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ServiceLevelAgreementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PrioritiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceLevelAgreements::route('/'),
            'create' => CreateServiceLevelAgreement::route('/create'),
            'edit' => EditServiceLevelAgreement::route('/{record}/edit'),
        ];
    }
}
