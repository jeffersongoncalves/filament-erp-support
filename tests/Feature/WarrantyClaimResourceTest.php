<?php

use JeffersonGoncalves\Erp\Support\Enums\WarrantyClaimStatus;
use JeffersonGoncalves\Erp\Support\Models\WarrantyClaim;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\CreateWarrantyClaim;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\EditWarrantyClaim;
use JeffersonGoncalves\FilamentErp\Support\Resources\WarrantyClaims\Pages\ListWarrantyClaims;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the warranty claim list page', function () {
    Livewire::test(ListWarrantyClaims::class)->assertSuccessful();
});

it('can render the warranty claim create page', function () {
    Livewire::test(CreateWarrantyClaim::class)->assertSuccessful();
});

it('can render the warranty claim edit page', function () {
    $claim = WarrantyClaim::factory()->create();

    Livewire::test(EditWarrantyClaim::class, ['record' => $claim->getRouteKey()])
        ->assertSuccessful();
});

it('can create a warranty claim through the form', function () {
    Livewire::test(CreateWarrantyClaim::class)
        ->fillForm([
            'customer_name' => 'Globex',
            'serial_no' => 'SN-1234-ABCD',
            'item_code' => 'ITEM-9001',
            'status' => WarrantyClaimStatus::Open->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(WarrantyClaim::query()->where('serial_no', 'SN-1234-ABCD')->exists())->toBeTrue();
});

it('can filter warranty claims by status', function () {
    WarrantyClaim::factory()->create(['status' => WarrantyClaimStatus::Open]);
    WarrantyClaim::factory()->create(['status' => WarrantyClaimStatus::Closed]);

    Livewire::test(ListWarrantyClaims::class)
        ->filterTable('status', WarrantyClaimStatus::Open->value)
        ->assertSuccessful();
});
