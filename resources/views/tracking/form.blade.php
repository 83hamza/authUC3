<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تتبع ملف الطالب</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 flex flex-col min-h-screen">

    {{-- ✅ Header --}}
    <x-tracking-header />

    {{-- ✅ Main --}}
    <main class="flex-grow flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <h2 class="text-2xl font-extrabold text-center mb-8">
                📂 تتبع ملف الطالب
            </h2>

            <form method="POST" action="{{ route('track.check') }}">
                @csrf

                <div class="mb-6 text-right">
                    <label class="block mb-2 font-semibold">
                        رقم التتبع
                    </label>

                    <input
                        type="text"
                        name="tracking_id"
                        required
                        placeholder="مثال: NPLR7PY4RY"
                        class="w-full px-4 py-3 border rounded-xl
                               focus:ring-2 focus:ring-blue-500
                               focus:outline-none text-left"
                    >
                </div>

                <button
    type="submit"
    onclick="this.disabled=true; this.innerText='⏳ جارٍ البحث...'; this.form.submit();"
    class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg"
>
    🔍 تتبع الملف
</button>

            </form>

        </div>

    </main>

    {{-- ✅ Footer --}}
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} University of Constantine 3 – Salah Boubnider  
        <br>
        Vice-Rectorate for Higher Education Certificates and Equivalency Office
    </footer>

</body>
</html>
