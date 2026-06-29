<?php

use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\IssueResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\IssueTypes\IssueTypeResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\ServiceLevelAgreementResource;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\WarrantyClaimResource;
use JeffersonGoncalves\FilamentErp\Support\Widgets\SupportStatsWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP Support resources are listed in
    | the Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Support',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'issue_type' => IssueTypeResource::class,
        'service_level_agreement' => ServiceLevelAgreementResource::class,
        'issue' => IssueResource::class,
        'warranty_claim' => WarrantyClaimResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'support_stats' => SupportStatsWidget::class,
    ],

];
