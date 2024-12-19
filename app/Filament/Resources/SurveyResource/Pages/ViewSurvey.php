<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Constants\InvitationConstants;
use App\Filament\Resources\SurveyResource;
use App\Forms\Components\EvaluationInvitations;
use App\Forms\Components\GroupInvitationCard;
use App\Livewire\SurveyStatsOverview;
use App\Models\Group;
use App\Models\Invitation;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ViewSurvey extends Page implements HasForms
{
    use InteractsWithRecord, InteractsWithForms;

    protected static string $resource = SurveyResource::class;

    protected static string $view = 'filament.resources.survey-resource.pages.view-survey';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getBreadcrumb(): ?string
    {
        return static::$breadcrumb . trans('translations.resources.labels.surveys.view');
    }

    public function getTitle(): string | Htmlable
    {
        return trans('translations.resources.labels.surveys.view'). ' '. $this->record->name;
    }

    // #[On('refreshGroupCards')]
    // public function refreshGroupCards(): void
    // {
    //     $this->form->fill();
    // }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('survey_evaluation')
                    // ->heading($this->record->name.' '.__('translations.survey_evaluation'))
                    ->heading(trans('translations.survey_evaluation', [ 'survey' => $this->record->name]))
                    ->collapsed()
                    ->schema([
                        TextInput::make('bca360_comments')
                            ->label('BCA360 Comments')
                            ->placeholder('Enter your BCA360 evaluation comments'),
                    ]),

                Section::make('self_valuation')
                    ->heading(__('translations.self_valuation'))
                    ->collapsed()
                    ->schema([
                        TextInput::make('self_feedback')
                            ->label('Self Feedback')
                            ->placeholder('Enter your self-evaluation feedback'),
                    ]),
                Section::make('evaluation_invitations')
                    ->heading(__('translations.components.evaluation_invitations.title'))
                    ->collapsed()
                    ->columns(2)
                    // ->description(__('translations.components.evaluation_invitations.text'))
                    ->schema(function(){
                        $groups = Group::with('invitations')->get();
                        $fields = [];

                        $fields[] = Placeholder::make('place_holder')
                            ->columnSpanFull()
                            ->label(__('translations.components.evaluation_invitations.text'));
                        foreach ($groups as $group) {
                            $fields[] = GroupInvitationCard::make('group_' . $group->id)
                                ->survey($this->record)
                                ->group($group);
                        }
                        return $fields;
                    }),

                Section::make('final_report')
                    ->heading(__('translations.final_report'))
                    ->collapsed()
                    ->schema([
                        Textarea::make('final_report')
                            ->label('Final Report Details')
                            ->placeholder('Enter the final report details'),
                    ]),
            ]);
    }


    protected function getHeaderWidgets(): array
    {
        return [
            SurveyStatsOverview::class
        ];
    }


}
