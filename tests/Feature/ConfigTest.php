<?php

it('loads the filament-erp-support config file', function () {
    expect(config('filament-erp-support'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-support.navigation_group'))->toBe('ERP — Support');
});

it('registers all resources in config', function () {
    $resources = config('filament-erp-support.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'issue_type',
            'service_level_agreement',
            'issue',
            'warranty_claim',
        ]);
});

it('registers the dashboard widgets in config', function () {
    expect(config('filament-erp-support.widgets'))->toBeArray()
        ->toHaveKeys(['support_stats']);
});
