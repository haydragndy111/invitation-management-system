<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invitation;
use App\Constants\InvitationConstants;
use App\Mail\SurveyInvitationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendInvitationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitations:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to invited users where the invitations are opened or inactive, up to 4 times over 6 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch invitations that are 'opened' or 'inactive'
        $invitations = Invitation::whereIn('status', [
            InvitationConstants::STATUS_OPENED,
            InvitationConstants::STATUS_INACTIVE,
        ])->get();

        $this->info('Sending reminders to eligible invitations...');

        foreach ($invitations as $invitation) {
            try {
                Mail::to($invitation->email)->send(new SurveyInvitationMail($invitation->email, $invitation->survey, $invitation));

                $invitation->increment('num_of_sends');
                $invitation->touch();
            } catch (\Throwable $th) {
                Log::error("Failed to send reminder to: {$invitation->email}");
            }
        }

    }
}
