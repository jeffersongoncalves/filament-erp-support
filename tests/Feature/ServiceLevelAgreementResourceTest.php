<?php

use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;
use JeffersonGoncalves\Erp\Support\Models\ServiceLevelAgreement;
use JeffersonGoncalves\Erp\Support\Models\ServiceLevelPriority;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\CreateServiceLevelAgreement;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\EditServiceLevelAgreement;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\Pages\ListServiceLevelAgreements;
use JeffersonGoncalves\FilamentErp\Support\Resources\ServiceLevelAgreements\RelationManagers\PrioritiesRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the service level agreement list page', function () {
    Livewire::test(ListServiceLevelAgreements::class)->assertSuccessful();
});

it('can render the service level agreement create page', function () {
    Livewire::test(CreateServiceLevelAgreement::class)->assertSuccessful();
});

it('can render the service level agreement edit page', function () {
    $sla = ServiceLevelAgreement::factory()->create();

    Livewire::test(EditServiceLevelAgreement::class, ['record' => $sla->getRouteKey()])
        ->assertSuccessful();
});

it('can create a service level agreement through the form', function () {
    Livewire::test(CreateServiceLevelAgreement::class)
        ->fillForm([
            'name' => 'Gold Support',
            'default_priority' => IssuePriority::High->value,
            'enabled' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(ServiceLevelAgreement::query()->where('name', 'Gold Support')->exists())->toBeTrue();
});

it('can create a priority through the relation manager', function () {
    $sla = ServiceLevelAgreement::factory()->create();

    Livewire::test(PrioritiesRelationManager::class, [
        'ownerRecord' => $sla,
        'pageClass' => EditServiceLevelAgreement::class,
    ])
        ->callTableAction('create', data: [
            'priority' => IssuePriority::Urgent->value,
            'response_time' => 3600,
            'resolution_time' => 86400,
        ])
        ->assertHasNoTableActionErrors();

    expect(ServiceLevelPriority::query()
        ->where('service_level_agreement_id', $sla->id)
        ->where('priority', IssuePriority::Urgent->value)
        ->exists())->toBeTrue();
});
