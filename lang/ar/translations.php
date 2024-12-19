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

    'survey_evaluation' => 'تقييم',
    'self_valuation' => 'تقييم ذاتي',
    'final_report' => 'تقرير نهائي',

    'resources' => [
        'labels' => [
            'users' => [
                'plural_label' => 'المستخدمون',
                'model_label' => 'المستخدم',
            ],
            'groups' => [
                'plural_label' => 'المجموعات',
                'model_label' => 'المجموعة',
            ],
            'surveys' => [
                'view' => 'عرض',
                'plural_label' => 'الاستبيانات',
                'model_label' => 'الاستبيان',
            ],
            'invitations' => [
                'status' => [
                    'inactive' => 'غير مفعلة',
                    'opened' => 'مقروءة',
                    'completed' => 'مكتملة',
                ]
            ],
        ],
    ],
    'components' => [
        'evaluation_invitations' => [
            'group' => 'مجموعة',
            'title' => 'دعوات التقييم',
            'text' => 'يمكنك دعوة مجموعة من المستخدمين لتقييمك. استخدم الزر لإكمال الدعوات. كل واحدة تعتمد على المجموعة المناسبة لها.',
            'empty_invitation' => 'لا توجد دعوات بعد',
            'send_invitation' => 'إرسال دعوة',
            'resend_invitation' => 'إعادة الإرسال ',
            'move_invitation' => 'نقل إلى مجموعة أخرى',
            'move_invitation_button' => 'نقل',
            'delete' => 'حذف',
            'status' => 'الحالة',
            'num_of_sends' => 'عدد مرات الإرسال',
            'sending_date' => 'تاريخ الإرسال',
            'email' => 'الإيميل',
        ],
    ],
    'widgets' => [
        'labels' => [
            'total_invitations' => 'مجموع الدعوات',
            'completed_invitations' => 'الدعوات المكتملة',
            'opened_invitations' => 'الدعوات المقروءة',
            'waiting_invitations' => 'الدعوات المنتظرة',
        ],
    ],
    'notifications' => [
        'resend_success_title' => 'تمت إعادة إرسال الدعوة',
        'resend_success_body' => 'تمت إعادة إرسال الدعوة بنجاح.',
        'resend_error_title' => 'فشل إعادة الإرسال',
        'resend_error_body' => 'حدث خطأ. لم يتم إعادة إرسال الدعوة.',

        'move_success_title' => 'تم نقل الدعوة',
        'move_success_body' => 'تم نقل الدعوة إلى المجموعة المحددة بنجاح.',
        'move_error_title' => 'فشل النقل',
        'move_error_body' => 'حدث خطأ. لم يتم نقل الدعوة.',

        'delete_success_title' => 'تم حذف الدعوة',
        'delete_success_body' => 'تم حذف الدعوة بنجاح.',
        'delete_error_title' => 'فشل الحذف',
        'delete_error_body' => 'حدث خطأ. لم يتم حذف الدعوة.',

        'send_success_title' => 'تم إرسال الدعوة',
        'send_success_body' => 'تم إرسال الدعوة بنجاح.',
        'send_error_title' => 'فشل الإرسال',
        'send_error_body' => 'حدث خطأ. لم يتم إرسال الدعوة.',
    ],

];
