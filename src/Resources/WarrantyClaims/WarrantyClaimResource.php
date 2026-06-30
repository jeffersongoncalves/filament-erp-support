<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Support\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportPlugin;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\CreateWarrantyClaim;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\EditWarrantyClaim;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\ListWarrantyClaims;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Schemas\WarrantyClaimForm;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Tables\WarrantyClaimsTable;

class WarrantyClaimResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'serial_no';

    public static function getModel(): string
    {
        return ModelResolver::warrantyClaim();
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
        return WarrantyClaimForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarrantyClaimsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWarrantyClaims::route('/'),
            'create' => CreateWarrantyClaim::route('/create'),
            'edit' => EditWarrantyClaim::route('/{record}/edit'),
        ];
    }
}
