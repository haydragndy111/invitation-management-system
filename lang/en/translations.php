<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
     */

    'survey_evaluation' => 'Evaluation',
    'self_valuation' => 'Self Evaluation',
    'final_report' => 'Final Report',

    'resources' => [
        'labels' => [
            'users' => [
                'plural_label' => 'Users',
                'model_label' => 'User',
            ],
            'groups' => [
                'plural_label' => 'Groups',
                'model_label' => 'Group',
            ],
            'surveys' => [
                'view' => 'View',
                'plural_label' => 'Surveys',
                'model_label' => 'Survey',
            ],
            'invitations' => [
                'inactive' => 'Inactive',
                'opened' => 'Opened',
                'completed' => 'Completed',
            ]
        ],
    ],
    'components' => [
        'evaluation_invitations' => [
            'group' => 'Group',
            'title' => 'Evaluation Invitations',
            'text' => 'You can invite a group of users who will evaluate you. Use the button to complete invitations. Each one is based on its suitable group.',
            'empty_invitation' => 'There is no invitations yet',
            'send_invitation' => 'Send Invitation',
            'resend_invitation' => 'Resend',
            'move_invitation' => 'Move to another group',
            'move_invitation_button' => 'Move',
            'delete' => 'Delete',
            'status' => 'Status',
            'num_of_sends' => 'Numbers Of Sends',
            'sending_date' => 'Sending Date',
            'email' => 'Email',
        ],
    ],
    'widgets' => [
        'labels' => [
            'total_invitations' => 'Total Invitations',
            'completed_invitations' => 'Completed Invitations',
            'opened_invitations' => 'Opened Invitations',
            'waiting_invitations' => 'Waiting Invitations',
        ],
    ],
    'notifications' => [
        'resend_success_title' => 'Invitation Resent',
        'resend_success_body' => 'The invitation has been resent successfully.',
        'resend_error_title' => 'Invitation Not Resent',
        'resend_error_body' => 'An error occurred. The invitation could not be resent.',

        'move_success_title' => 'Invitation Moved',
        'move_success_body' => 'The invitation has been moved to the selected group successfully.',
        'move_error_title' => 'Move Failed',
        'move_error_body' => 'An error occurred. The invitation could not be moved.',

        'delete_success_title' => 'Invitation Deleted',
        'delete_success_body' => 'The invitation has been deleted successfully.',
        'delete_error_title' => 'Delete Failed',
        'delete_error_body' => 'An error occurred. The invitation could not be deleted.',

        'send_success_title' => 'Invitation Sent',
        'send_success_body' => 'The invitation has been sent successfully.',
        'send_error_title' => 'Send Failed',
        'send_error_body' => 'An error occurred. The invitation could not be sent.',
    ],

];
