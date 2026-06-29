<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\WarrantyClaimResource;

class ListWarrantyClaims extends ListRecords
{
    protected static string $resource = WarrantyClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
