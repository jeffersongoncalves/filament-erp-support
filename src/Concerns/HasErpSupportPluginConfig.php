<?php

namespace JeffersonGoncalves\FilamentErp\Support\Concerns;

use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpPluginConfig;

trait HasErpSupportPluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-support';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Support';
    }
}
