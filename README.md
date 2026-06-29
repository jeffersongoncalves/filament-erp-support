<div class="filament-hidden">

![Filament ERP Support](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-support/3.x/art/jeffersongoncalves-filament-erp-support.png)

</div>

# Filament ERP Support

Filament v5 panel resources for the [Laravel ERP support module](https://github.com/jeffersongoncalves/laravel-erp-support) — issues, SLAs and warranty claims.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-support` domain package (namespace `JeffersonGoncalves\Erp\Support\`). It wires the support models into ready-to-use Filament resources and a helpdesk dashboard widget.

## Features

- **Helpdesk resources** — Issues, issue types and warranty claims
- **Service levels** — Service level agreements with a priorities relation manager
- **Dashboard widget** — `SupportStatsWidget` with open/resolved issue counts
- **Configurable** — Swap resource classes, change the navigation group or assign a cluster via config

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-support
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportPlugin;

$panel->plugin(
    FilamentErpSupportPlugin::make()
        ->navigationGroup('ERP — Support'),
);
```

## Resources

| Resource | Purpose |
|----------|---------|
| `IssueTypeResource` | Issue types |
| `ServiceLevelAgreementResource` | Service level agreements (+ Priorities relation manager) |
| `IssueResource` | Issues |
| `WarrantyClaimResource` | Warranty claims |

## Widgets

| Widget | Purpose |
|--------|---------|
| `SupportStatsWidget` | Open and resolved issue counts |

## Configuration

Publish the config to swap resource classes, change the navigation group, or adjust widgets:

```bash
php artisan vendor:publish --tag="filament-erp-support-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
