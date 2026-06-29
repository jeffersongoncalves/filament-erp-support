<?php

namespace JeffersonGoncalves\FilamentErp\Support\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Support\Enums\IssueStatus;
use JeffersonGoncalves\Erp\Support\Enums\WarrantyClaimStatus;
use JeffersonGoncalves\Erp\Support\Support\ModelResolver;

/**
 * A snapshot of the support desk: how many issues are still open (not resolved
 * or closed) and how many warranty claims are still being worked.
 */
class SupportStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $issueModel = ModelResolver::issue();
        $warrantyClaimModel = ModelResolver::warrantyClaim();

        $openIssues = $issueModel::query()
            ->whereNotIn('status', [
                IssueStatus::Resolved->value,
                IssueStatus::Closed->value,
            ])
            ->count();

        $openWarrantyClaims = $warrantyClaimModel::query()
            ->whereNotIn('status', [
                WarrantyClaimStatus::Resolved->value,
                WarrantyClaimStatus::Closed->value,
                WarrantyClaimStatus::Cancelled->value,
            ])
            ->count();

        return [
            Stat::make('Open Issues', (string) $openIssues)
                ->description('awaiting resolution')
                ->color($openIssues > 0 ? 'primary' : 'gray'),
            Stat::make('Open Warranty Claims', (string) $openWarrantyClaims)
                ->description('in progress')
                ->color($openWarrantyClaims > 0 ? 'warning' : 'gray'),
        ];
    }
}
