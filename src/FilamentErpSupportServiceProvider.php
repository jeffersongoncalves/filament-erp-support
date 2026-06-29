<?php

namespace JeffersonGoncalves\FilamentErp\Support;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpSupportServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-support';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
