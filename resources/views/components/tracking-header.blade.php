<header class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="grid grid-cols-3 items-center">

            {{-- ✅ LEFT (English) --}}
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

            {{-- ✅ CENTER (Logo + Name) --}}
            <div class="text-center">
                <img src="{{ asset('images/uc3-logo.png') }}"
     alt="University Logo"
     class="mx-auto h-20 mb-2">
                <div class="font-bold text-lg">
                   University of Constantine 3
                </div>
                <div class="text-sm text-gray-600">
                    Salah Boubnider
                </div>
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
</header>
