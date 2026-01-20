<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <div class="d-flex justify-content-center gap-3 mb-4">
    <a href="{{ url('/') }}" class="btn btn-secondary px-4">
        ⬅ الرئيسية
    </a>

    <a href="{{ route('tracking.form') }}" class="btn btn-outline-primary px-4">
        🔄 بحث جديد
    </a>
</div>


    <title>تتبع ملف الطالب</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    {{-- ✅ العنوان --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">📌 تتبع ملف الطالب</h2>
        <p class="text-muted">أدخل رقم التتبع لمعرفة حالة الملف</p>
    </div>

    {{-- ✅ بطاقة التتبع --}}
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body">

            {{-- ✅ الفورم --}}
            <form method="POST" action="{{ route('tracking.check') }}">
                @csrf

                <div class="mb-3">
                    <input type="text"
                           name="tracking_code"
                           class="form-control"
                           placeholder="أدخل رقم التتبع"
                           value="{{ old('tracking_code') }}"
                           required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    🔍 بحث
                </button>
            </form>

        </div>
    </div>

    {{-- ✅ عرض الأخطاء --}}
    @if($errors->any())
        <div class="alert alert-danger mt-4 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- ✅ عرض النتيجة --}}
    @if(isset($file))

        @if($file)
            <div class="card shadow mt-4 mx-auto" style="max-width: 700px;">
                <div class="card-body">

                    <h4 class="fw-bold mb-3 text-success">✅ تم العثور على الملف</h4>

                    <ul class="list-group">

                        <li class="list-group-item">
                            👤 الاسم: <b>{{ $file->first_name }}</b>
                        </li>

                        <li class="list-group-item">
                            👤 اللقب: <b>{{ $file->last_name }}</b>
                        </li>

                        <li class="list-group-item">
                            🎓 نوع الشهادة: <b>{{ $file->diploma_type }}</b>
                        </li>

                        <li class="list-group-item">
                            📅 تاريخ الإيداع: <b>{{ $file->submitted_at }}</b>
                        </li>

                        <li class="list-group-item">
                            🔎 رقم التتبع: <b>{{ $file->tracking_id }}</b>
                        </li>

                        <li class="list-group-item">
                            📌 الحالة:
                            <b>
                                @if($file->status == 'pending')
                                    ⏳ انتظار
                                @elseif($file->status == 'processed')
                                    ✅ تم توثيقه
                                @elseif($file->status == 'rejected')
                                    ❌ مرفوض - يرجى التقرب إلى الجامعة
                                @endif
                            </b>
                        </li>

                    </ul>

                </div>
            </div>
        @else
            <div class="alert alert-warning mt-4 text-center">
                ❌ رقم التتبع غير موجود
            </div>
        @endif

    @endif

</div>

</body>
</html>
