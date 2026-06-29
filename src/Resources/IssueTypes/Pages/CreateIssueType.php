<?php

namespace JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\IssueTypeResource;

class CreateIssueType extends CreateRecord
{
    protected static string $resource = IssueTypeResource::class;
}
