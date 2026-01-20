@php
    use Carbon\Carbon;

    // رابط التتبع الجديد
    $trackUrl = url('/track') . '?tracking_id=' . $file->tracking_id;
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: "Amiri", DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 15px;
            margin: 0;
            padding: 0;
        }

        .card {
            border: 3px solid #1d4ed8;
            border-radius: 18px;
            padding: 25px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 110px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
        }

        .subtitle {
            font-size: 14px;
            line-height: 1.8;
            margin-top: 8px;
        }

        hr {
            margin: 20px 0;
        }

        .row {
            margin: 8px 0;
            font-size: 17px;
        }

        .label {
            font-weight: bold;
        }

        .tracking-box {
            margin-top: 18px;
            padding: 14px;
            border: 2px dashed #1d4ed8;
            border-radius: 12px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .status {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .pending {
            background: #fef9c3;
            color: #92400e;
        }

        .processed {
            background: #dcfce7;
            color: #166534;
        }

        .rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .qr {
            text-align: center;
            margin-top: 22px;
        }

        .qr img {
            width: 120px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 22px;
            font-size: 13px;
            text-align: center;
            color: #555;
        }

        a {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: bold;
            font-size: 11px;
            word-break: break-all;
        }
    </style>
</head>

<body>

<div class="card">

    {{-- ===== Header ===== --}}
    <div class="header">
        <img src="{{ public_path('logo-nouv-uc3-2.png') }}" alt="University Logo">

        <div class="title">
            جامعة قسنطينة 3 – صالح بوبنيدر
        </div>

        <div class="subtitle">
            نيابة رئاسة الجامعة للتكوين العالي في الطورين الأول والثاني والتكوين المتواصل والشهادات<br>
            وكذا التكوين العالي في التدرج – مصلحة الشهادات والمعادلات
        </div>
    </div>

    <hr>

    {{-- ===== Title ===== --}}
    <div class="title" style="text-align:center;">
        وصل تتبع ملف الطالب
    </div>

    {{-- ===== Student Info ===== --}}
    <div class="row">
        <span class="label">الاسم:</span>
        {{ $file->first_name }}
    </div>

    <div class="row">
        <span class="label">اللقب:</span>
        {{ $file->last_name }}
    </div>

    <div class="row">
        <span class="label">نوع الشهادة:</span>
        {{ $file->diploma_type }}
    </div>

    <div class="row">
        <span class="label">تاريخ الإيداع:</span>
        {{ Carbon::parse($file->submitted_at)->format('Y-m-d') }}
    </div>

    {{-- ===== Status ===== --}}
    <div class="row">
        <span class="label">الحالة:</span>

        @if($file->status === 'pending')
            <span class="status pending">⏳ قيد المعالجة</span>
        @elseif($file->status === 'processed')
            <span class="status processed">✅ تمت المعالجة</span>
        @else
            <span class="status rejected">❌ مرفوض</span>
        @endif
    </div>

    {{-- ===== Tracking ID ===== --}}
    <div class="tracking-box">
        رقم التتبع: {{ $file->tracking_id }}
    </div>

    {{-- ===== QR Code ===== --}}
    <div class="qr">
        <div style="font-weight:bold;">
            امسح رمز QR لتتبع ملفك مباشرة
        </div>

        <img src="data:image/png;base64,{{ $qr }}" alt="QR Code">

        <div style="margin-top:10px;">
            أو عبر الرابط:
            <br>
            <a href="{{ $trackUrl }}">
                {{ $trackUrl }}
            </a>
        </div>
    </div>

    {{-- ===== Footer ===== --}}
    <div class="footer">
        هذا الوصل يسمح لصاحب الملف بتتبع طلبه عبر منصة جامعة قسنطينة 3 الرسمية.
    </div>

</div>

</body>
</html>
