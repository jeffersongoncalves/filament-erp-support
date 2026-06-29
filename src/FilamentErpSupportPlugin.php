<?php

namespace JeffersonGoncalves\FilamentErp\Support;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Support\Concerns\HasErpSupportPluginConfig;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\IssueResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\IssueTypeResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\ServiceLevelAgreementResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\WarrantyClaimResource;

class FilamentErpSupportPlugin implements Plugin
{
    use HasErpSupportPluginConfig;

    public function getId(): string
    {
        return 'filament-erp-support';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
            'issue_type' => IssueTypeResource::class,
            'service_level_agreement' => ServiceLevelAgreementResource::class,
            'issue' => IssueResource::class,
            'warranty_claim' => WarrantyClaimResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
