<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\WarrantyClaimResource;

class EditWarrantyClaim extends EditRecord
{
    protected static string $resource = WarrantyClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
