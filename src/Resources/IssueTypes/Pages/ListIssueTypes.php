<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\IssueTypeResource;

class ListIssueTypes extends ListRecords
{
    protected static string $resource = IssueTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
