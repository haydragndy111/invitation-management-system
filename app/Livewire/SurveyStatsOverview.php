<?php

namespace App\Livewire;

use App\Constants\InvitationConstants;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Survey;

class SurveyStatsOverview extends BaseWidget
{
    public ?Survey $record = null;

    protected function getStats(): array
    {
        $survey = $this->record;
        $totalInvitations = $survey->invitations()->count();
        $completedInvitations = $survey->invitations()->completed()->count();
        $openedInvitations = $survey->invitations()->opened()->count();
        $waitingInvitations = $survey->invitations()->active()->count();

        return [
            Stat::make(__('translations.widgets.labels.total_invitations'), $totalInvitations)
                ->icon('heroicon-o-queue-list'),
            Stat::make(__('translations.widgets.labels.completed_invitations'), $completedInvitations)
                ->icon('heroicon-o-check-circle'),
            Stat::make(__('translations.widgets.labels.opened_invitations'), $openedInvitations)
                ->icon('heroicon-o-arrow-path'),
            Stat::make(__('translations.widgets.labels.waiting_invitations'), $waitingInvitations)
                ->icon('heroicon-o-clock'),
        ];
    }
}
