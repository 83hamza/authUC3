<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تتبع الملف</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-lg text-right">

    <h1 class="text-2xl font-bold mb-6 text-center">
        حالة ملفك
    </h1>

    <div class="space-y-3 text-lg">
        <p><strong>الاسم:</strong> {{ $file->first_name }} {{ $file->last_name }}</p>
        <p><strong>نوع الشهادة:</strong> {{ $file->diploma_type }}</p>
        <p><strong>رقم التتبع:</strong> {{ $file->tracking_id }}</p>
        <p><strong>تاريخ الإيداع:</strong> {{ $file->submitted_at }}</p>

        <p>
            <strong>الحالة:</strong>
            <span class="px-3 py-1 rounded-lg
                @if($file->status === 'تم توقيفه') bg-red-100 text-red-700
                @elseif($file->status === 'قيد المعالجة') bg-yellow-100 text-yellow-700
                @else bg-green-100 text-green-700 @endif
            ">
                {{ $file->status }}
            </span>
        </p>
    </div>

</div>

</body>
</html>
