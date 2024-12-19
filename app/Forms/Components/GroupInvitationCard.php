<?php

namespace App\Forms\Components;

use App\Constants\InvitationConstants;
use App\Mail\SurveyInvitationMail;
use App\Models\Group;
use App\Models\Invitation;
use App\Models\Survey;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class GroupInvitationCard extends Field
{
    protected string $view = 'forms.components.group-invitation-card';

    protected ?Invitation $invitation = null;
    protected ?Group $group = null;
    protected ?Survey $survey = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerActions([
            Action::make('resend')
                ->label(__('translations.components.evaluation_invitations.resend_invitation'))
                ->color('warning')
                ->icon('heroicon-o-arrow-uturn-right')
                ->action(function ($data) {
                    try {
                        $email = $this->invitation->email;
                        Mail::to($email)->send(new SurveyInvitationMail($email, $this->survey, $this->invitation));

                        $this->invitation->update([
                            'num_of_sends' => $this->invitation->num_of_sends + 1,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title(__('translations.notifications.resend_success_title'))
                            ->body(__('translations.notifications.resend_success_body'))
                            ->send();
                    } catch (\Throwable $th) {
                        \Filament\Notifications\Notification::make()
                            ->warning()
                            ->title(__('translations.notifications.resend_error_title'))
                            ->body(__('translations.notifications.resend_error_body'))
                            ->send();
                    }
                }),

            Action::make('move')
                ->modalHeading(__('translations.components.evaluation_invitations.move_invitation'))
                ->label(__('translations.components.evaluation_invitations.move_invitation_button'))
                ->color('info')
                ->icon('heroicon-o-arrows-pointing-out')
                ->requiresConfirmation()
                ->form([
                    Select::make('group_id')
                        ->label(__('translations.components.evaluation_invitations.group'))
                        ->options(function () {
                            $invitation = $this->getInvitation();
                            $locale = app()->getLocale();

                            $groups = Group::whereDoesntHave('invitations', function ($query) use ($invitation) {
                                return $query->where('id', $invitation->id);
                            })->get();

                            return $groups->pluck('name_' . $locale, 'id');
                        }),
                ])
                ->action(function ($data) {
                    try {
                        $groupId = $data['group_id'];
                        $this->invitation->update([
                            'group_id' => $groupId,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title(__('translations.notifications.move_success_title'))
                            ->body(__('translations.notifications.move_success_body'))
                            ->send();
                    } catch (\Throwable $th) {
                        Log::info($th->getMessage());
                        \Filament\Notifications\Notification::make()
                            ->warning()
                            ->title(__('translations.notifications.move_error_title'))
                            ->body(__('translations.notifications.move_error_body'))
                            ->send();
                    }
                }),

            Action::make('delete')
                ->label(__('translations.components.evaluation_invitations.delete'))
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function ($data) {
                    try {
                        $this->getInvitation()->delete();

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title(__('translations.notifications.delete_success_title'))
                            ->body(__('translations.notifications.delete_success_body'))
                            ->send();
                    } catch (\Throwable $th) {
                        Log::info($th->getMessage());
                        \Filament\Notifications\Notification::make()
                            ->warning()
                            ->title(__('translations.notifications.delete_error_title'))
                            ->body(__('translations.notifications.delete_error_body'))
                            ->send();
                    }
                }),

            Action::make('sendInvitation')
                ->label(__('translations.components.evaluation_invitations.send_invitation'))
                ->color('gray')
                ->modalActions(fn ($action) => [
                    $action->getModalSubmitAction()->color('success')
                        ->extraAttributes([
                            'style' => 'margin: 0 auto;'
                        ]),
                ])
                ->modalSubmitActionLabel(__('translations.components.evaluation_invitations.send_invitation'))
                ->disabled(function () {
                    return $this->getInvitation() == null ? false : true;
                })
                ->icon('heroicon-o-paper-airplane')
                ->modalDescription(function(){
                    $locale = app()->getLocale();
                    if($locale == 'ar'){
                        return new HtmlString('<p>يمكنك إرسال دعوة من خلال القالب التالي</p>
                            <br>
                            <ul style="list-style-type: disc; padding-left: 1.5rem;">
                                <li>يقوم النظام بإرسال تفاصيل الاستبيان عبر البريد الإلكتروني للتقييم.</li>
                                <li>يقوم النظام بإعلامك عندما يفتح المستخدم رابط الاستبيان.</li>
                                <li>تظهر حالة الدعوة بجانبها.</li>
                                <li>إذا لم يستجب المستخدم للدعوة، سيقوم النظام بتذكيره 3 مرات على مدار 6 أيام.</li>
                            </ul>
                            ');
                    }else{
                        return new HtmlString('
                        <p>you can send an invitation through the following template </p>
                        <br>
                        <ul style="list-style-type: disc; padding-left: 1.5rem;">
                            <li>The system sends the details of the survey to email for evaluation.</li>
                            <li>The system notifies you when the user opens the link to the survey.</li>
                            <li>The status of the invitation appears next to it.</li>
                            <li>If the user does not respond to the invitation, the system will remind them 3 times for 6 days.</li>
                        </ul>
                        ');
                    }

                })
                ->form([
                    TextInput::make('email')
                        ->label(__('translations.components.evaluation_invitations.email'))
                        ->email()
                        ->required()
                ])
                ->icon('heroicon-o-paper-airplane')
                ->action(function ($data) {
                    try {
                        $invitation = Invitation::create([
                            'survey_id' => $this->survey->id,
                            'group_id' => $this->group->id,
                            'email' => $data['email'],
                            'status' => InvitationConstants::STATUS_INACTIVE,
                        ]);

                        Mail::to($data['email'])->send(new SurveyInvitationMail($data['email'], $this->survey, $invitation));

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title(__('translations.notifications.send_success_title'))
                            ->body(__('translations.notifications.send_success_body'))
                            ->send();
                    } catch (\Throwable $th) {
                        Log::info($th->getMessage());
                        \Filament\Notifications\Notification::make()
                            ->warning()
                            ->title(__('translations.notifications.send_error_title'))
                            ->body(__('translations.notifications.send_error_body'))
                            ->send();
                    }
                }),
        ]);

    }

    public function survey(Survey $survey): self
    {
        $this->survey = $survey;
        return $this;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function invitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation(): ?invitation
    {
        return $this->invitation;
    }

    public function group(Group $group): self
    {
        $this->group = $group;
        $invitation = $group->invitations()->where('status', InvitationConstants::STATUS_INACTIVE)->first();
        if ($invitation) {
            $this->invitation($invitation);
        }
        return $this;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function getGroupName()
    {
        return $this->group->name_by_locale;
    }

    public function getInvitationStatus()
    {
        return $this->invitation->status_label;
    }

    public function getInvitationDate()
    {
        $date = Carbon::parse('2024-12-18 16:06:19');
        $formattedDate = $date->format('d-m-Y');
        return $formattedDate;
    }

}
