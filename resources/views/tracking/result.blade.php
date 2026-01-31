<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>وضعية الملف</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #f3f6fb;
            font-family: 'Segoe UI', Tahoma, Arial;
        }
    </style>
</head>
<body>


<!-- ===== HEADER ===== -->

<div class="h-1 bg-gradient-to-r from-blue-500 via-sky-400 to-blue-500"></div>

<div class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-3 items-center gap-4">


        <!-- 🔵 RIGHT (ARABIC) -->
        <div class="text-left text-sm leading-relaxed" dir="ltr">
            <p class="font-bold">People's Democratic Republic of Algeria</p>
            <p>Ministry of Higher Education and Scientific Research</p>
            <p>University of Constantine 3 – Salah Boubnider</p>
            <p class="text-xs text-gray-600">
                Vice-Rectorate for Higher Education  
                Certificates and Equivalency Office
            </p>
        </div>
        
        <!-- 🟨 CENTER (LOGO) -->
        <div class="text-center">
          <img src="{{ asset('images/uc3-logo.png') }}"
     alt="University Logo"
     class="mx-auto h-20 mb-2">


          

            <h2 class="font-bold text-lg">University of Constantine 3</h2>
            <p class="text-sm text-gray-600">Salah Boubnider</p>
        </div>
<!-- 🔴 LEFT (ENGLISH) -->
        <div class="text-right leading-relaxed text-sm" dir="rtl">
            <p class="font-bold">الجمهورية الجزائرية الديمقراطية الشعبية</p>
            <p>وزارة التعليم العالي والبحث العلمي</p>
            <p>جامعة قسنطينة 3 – صالح بوبنيدر</p>
            <p class="text-xs text-gray-600">
                نيابة مديرية الجامعة للتكوين العالي في الطورين الأول والثاني  
                والتكوين المتواصل والشهادات والتكوين العالي في التدرج
            </p>
        </div>
       

    </div>
</div>

<!-- ===== CONTENT ===== -->

{{-- ✅ رسالة حالة الملف --}}
@if($file->status === 'processed')
    <div class="max-w-2xl mx-auto mt-10 mb-6">
        <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-xl shadow text-center font-semibold">
            ✅ لقد تم توثيق الملف بنجاح  
            <br>
            يرجى التقرب إلى مصلحة الشهادات والمعادلات لاستكمال الإجراءات.
        </div>
    </div>

@elseif($file->status === 'rejected')
    <div class="max-w-2xl mx-auto mt-10 mb-6">
        <div class="bg-red-100 border border-red-300 text-red-800 px-6 py-4 rounded-xl shadow text-center font-semibold">
            ❌ تم رفض الملف  
            <br>
            يرجى التقرب إلى مصلحة الشهادات والمعادلات لمزيد من التفاصيل.
        </div>
    </div>

@else
    <div class="max-w-2xl mx-auto mt-10 mb-6">
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-6 py-4 rounded-xl shadow text-center font-semibold">
            ⏳ الملف قيد المعالجة  
            <br>
            يرجى الانتظار، سيتم إشعاركم فور الانتهاء من دراسة الملف.
        </div>
    </div>
@endif


<div class="max-w-4xl mx-auto mt-16 px-4">

    <div class="bg-white rounded-2xl shadow-xl p-8 text-right" dir="rtl">

        <h1 class="text-2xl font-bold text-center mb-6 flex justify-center items-center gap-2">
            📄 وضعية الملف
        </h1>

        <div class="space-y-4 text-[15px] leading-loose">

            <p><strong>الاسم واللقب:</strong> {{ $file->first_name }} {{ $file->last_name }}</p>

            <p><strong>نوع الشهادة:</strong> {{ $file->diploma_type }}</p>

            <p><strong>تاريخ الإيداع:</strong>
                {{ \Carbon\Carbon::parse($file->submitted_at)->format('d-m-Y') }}
            </p>

            <p><strong>رقم التتبع:</strong>
                <span class="font-bold text-blue-700">{{ $file->tracking_id }}</span>
            </p>

            <p class="mt-4"><strong>حالة الملف:</strong></p>

            <!-- STATUS BADGE -->
            <div class="inline-block px-5 py-2 rounded-full font-bold text-sm
                @if($file->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($file->status === 'processed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800
                @endif
            ">
                @if($file->status === 'pending')
                    ⏳ قيد المعالجة
                @elseif($file->status === 'processed')
                    ✅ تمت المعالجة
                @else
                    ❌ مرفوض
                @endif
            </div>

        </div>

    </div>

</div>
<p class="mt-10 text-center text-sm text-gray-500">
   {{-- ✅ Footer --}}
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} University of Constantine 3 – Salah Boubnider  
        <br>
        Vice-Rectorate for Higher Education Certificates and Equivalency Office
    </footer>
  
</body>
</html>

</p>
