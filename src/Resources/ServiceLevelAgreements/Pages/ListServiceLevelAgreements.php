<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\ServiceLevelAgreementResource;

class ListServiceLevelAgreements extends ListRecords
{
    protected static string $resource = ServiceLevelAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
