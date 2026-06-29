<?php

use JeffersonGoncalves\Erp\Support\Enums\IssuePriority;
use JeffersonGoncalves\Erp\Support\Enums\IssueStatus;
use JeffersonGoncalves\Erp\Support\Models\Issue;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\CreateIssue;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\EditIssue;
use JeffersonGoncalves\FilamentErp\Support\Resources\Issues\Pages\ListIssues;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the issue list page', function () {
    Livewire::test(ListIssues::class)->assertSuccessful();
});

it('can render the issue create page', function () {
    Livewire::test(CreateIssue::class)->assertSuccessful();
});

it('can render the issue edit page', function () {
    $issue = Issue::factory()->create();

    Livewire::test(EditIssue::class, ['record' => $issue->getRouteKey()])
        ->assertSuccessful();
});

it('can create an issue through the form', function () {
    Livewire::test(CreateIssue::class)
        ->fillForm([
            'subject' => 'Printer not working',
            'customer_name' => 'Acme Corp',
            'status' => IssueStatus::Open->value,
            'priority' => IssuePriority::High->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Issue::query()->where('subject', 'Printer not working')->exists())->toBeTrue();
});
