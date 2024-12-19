<!-- resources/views/emails/ar-survey-invitation.blade.php -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>دعوة للمشاركة في استطلاع</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            line-height: 1.6;
            color: #333;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 600px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>أهلاً عزيزي،</p>

        <p>
            هذه دعوة للمشاركة في استطلاع رأي حول الذكاء العاطفي {{ $survey_name }}.
        </p>

        <p>
            رابط الاستطلاع: <a href="{{ $survey_link }}" style="color: #007bff; text-decoration: underline;">{{ $survey_link }}</a>
        </p>

        <p>
            ملاحظة: إذا كنت بحاجة إلى أي مساعدة، يرجى الاتصال بنا عبر البريد الإلكتروني على <a href="mailto:support@email.com">support@email.com</a>.
        </p>

        <p>مع تحياتي،<br>فريق تكنولوجيا المعلومات</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} جميع الحقوق محفوظة.
    </div>
</body>
</html>
