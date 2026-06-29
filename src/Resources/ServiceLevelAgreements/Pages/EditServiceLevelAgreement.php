<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\ServiceLevelAgreementResource;

class EditServiceLevelAgreement extends EditRecord
{
    protected static string $resource = ServiceLevelAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
