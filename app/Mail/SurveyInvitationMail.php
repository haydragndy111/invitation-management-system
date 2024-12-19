<?php

namespace App\Mail;

use App\Models\Invitation;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveyInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;
    public Survey $survey;
    public Invitation $invitationId;


    /**
     * Create a new message instance.
     *
     * @param string $email
     */
    public function __construct(string $email, Survey $survey, Invitation $invitationId)
    {
        $this->email = $email;
        $this->survey = $survey;
        $this->invitationId = $invitationId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $surveyLink = route('surveys.show', [
            'survey' => $this->survey->id,
            'invitation' => $this->invitationId,
        ]);

        return $this->subject('Invitation to Participate in BCA360 Survey')
            ->view('emails.'.app()->getLocale().'-survey-invitation')
            ->with([
                'survey_link' => $surveyLink,
                'survey_name' => $this->survey->name,
            ]);
    }
}
