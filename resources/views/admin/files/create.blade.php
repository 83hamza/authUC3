<x-app-layout>

    <div class="min-h-screen bg-sky-50 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ✅ Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800 flex items-center gap-2">
                        ➕ إضافة طالب جديد
                    </h2>
                    <p class="text-gray-600 mt-1 text-sm">
                        أدخل بيانات الطالب ثم اضغط حفظ
                    </p>
                </div>

                {{-- ✅ رجوع --}}
                <a href="{{ route('admin.files.index') }}"
                   class="px-4 py-2 rounded-lg bg-white shadow text-gray-800 font-bold text-sm hover:bg-gray-100 transition flex items-center gap-2">
                    🔙 رجوع
                </a>
            </div>

            {{-- ✅ Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-5 shadow text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ Card --}}
            <div class="bg-white rounded-xl shadow-lg border border-sky-200 p-6">

                <form method="POST" action="{{ route('admin.files.store') }}" dir="rtl">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- الاسم --}}
                        <div>
                            <label class="block text-gray-700 font-bold mb-1 text-sm">الاسم</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                        </div>

                        {{-- اللقب --}}
                        <div>
                            <label class="block text-gray-700 font-bold mb-1 text-sm">اللقب</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                        </div>

                        {{-- نوع الشهادة --}}
                        <div>
                            <label class="block text-gray-700 font-bold mb-1 text-sm">نوع الشهادة</label>
                            <input type="text" name="diploma_type" value="{{ old('diploma_type') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                        </div>

                        {{-- تاريخ الإيداع --}}
                        <div>
                            <label class="block text-gray-700 font-bold mb-1 text-sm">تاريخ الإيداع</label>
                            <input type="date" name="submitted_at" value="{{ old('submitted_at') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                        </div>


                    </div>

                    {{-- ✅ زر حفظ --}}
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                                class="px-8 py-2 rounded-lg bg-sky-500 text-black font-extrabold text-sm shadow hover:bg-sky-600 transition flex items-center gap-2">
                            ✅ حفظ الطالب
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
