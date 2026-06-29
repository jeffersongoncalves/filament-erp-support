<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\IssueTypeResource;

class EditIssueType extends EditRecord
{
    protected static string $resource = IssueTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
