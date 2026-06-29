<?php

namespace JeffersonGoncalves\FilamentErp\Support\Tests;

use Composer\InstalledVersions;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Erp\Core\ErpCoreServiceProvider;
use JeffersonGoncalves\Erp\Support\ErpSupportServiceProvider;
use JeffersonGoncalves\FilamentErp\Core\Testing\InteractsWithErpFilament;
use JeffersonGoncalves\FilamentErp\Support\FilamentErpSupportServiceProvider;
use JeffersonGoncalves\FilamentErp\Support\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\FilamentErp\Support\Tests\Fixtures\TestUser;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithErpFilament;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rebindFilamentDataStore();

        // The domain factories ship in the vendored packages; resolve them by
        // basename across the Support and Core packages.
        Factory::guessFactoryNamesUsing($this->erpFactoryResolver([
            'JeffersonGoncalves\\Erp\\Support\\Database\\Factories',
            'JeffersonGoncalves\\Erp\\Core\\Database\\Factories',
        ]));

        Filament::setCurrentPanel(Filament::getDefaultPanel());

        $this->withoutVite();

        $this->actingAs(TestUser::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
    }

    protected function getPackageProviders($app): array
    {
        return array_merge($this->filamentTestProviders(), [
            ErpCoreServiceProvider::class,
            ErpSupportServiceProvider::class,
            FilamentErpSupportServiceProvider::class,
            TestPanelProvider::class,
        ]);
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('auth.providers.users.model', TestUser::class);

        $coreConfig = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-core').'/config/erp-core.php';

        if (file_exists($coreConfig)) {
            $app['config']->set('erp-core', require $coreConfig);
        }

        $supportConfig = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-support').'/config/erp-support.php';

        if (file_exists($supportConfig)) {
            $app['config']->set('erp-support', require $supportConfig);
        }
    }

    protected function defineDatabaseMigrations(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default('');
            $table->rememberToken();
        });

        $this->loadErpVendorMigrations([
            'core' => [
                'create_erp_companies_table',
                'create_erp_currencies_table',
                'create_erp_currency_exchanges_table',
                'create_erp_uoms_table',
                'create_erp_uom_conversions_table',
                'create_erp_fiscal_years_table',
                'create_erp_departments_table',
                'create_erp_designations_table',
                'create_erp_brands_table',
                'create_erp_terms_and_conditions_table',
                'create_erp_addresses_table',
                'create_erp_contacts_table',
                'create_erp_naming_series_table',
            ],
            'support' => [
                'create_erp_issue_types_table',
                'create_erp_service_level_agreements_table',
                'create_erp_service_level_priorities_table',
                'create_erp_issues_table',
                'create_erp_warranty_claims_table',
            ],
        ]);
    }
}
