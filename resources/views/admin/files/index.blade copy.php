<x-app-layout>

    <div class="py-10 bg-sky-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Header --}}
            <div class="flex items-center justify-between mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                        📁 قائمة الطلبة
                    </h1>
                    <p class="text-gray-600 mt-1">إدارة ملفات الطلبة وتتبع حالتهم بسهولة</p>

                    {{-- ✅ Search --}}
                    <form method="GET" action="{{ route('admin.files.index') }}" class="mt-4">
                        <div class="relative w-72">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="🔍 الاسم أو اللقب أو رقم التتبع"
                                   class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">

                            @if(request('search'))
                                <a href="{{ route('admin.files.index') }}"
                                   class="absolute left-2 top-1/2 -translate-y-1/2 text-red-600 font-bold">
                                    ✖
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- ✅ Buttons --}}
<div class="flex gap-3">

    {{-- ✅ زر PDF --}}
    <a href="{{ route('admin.files.export.pdf') }}"
       class="px-6 py-2 rounded-xl bg-red-600 text-black font-bold shadow hover:bg-red-700 transition flex items-center gap-2">
        🧾 PDF
    </a>

    {{-- ✅ زر Excel --}}
    <a href="{{ route('admin.files.export.excel') }}"
       class="px-6 py-2 rounded-xl bg-emerald-600 text-black font-bold shadow hover:bg-emerald-700 transition flex items-center gap-2">
        📄 XLSX
    </a>

    {{-- ✅ زر تتبع ملف --}}
    <a href="{{ route('tracking.form') }}"
       class="px-6 py-2 rounded-xl bg-green-600 text-black font-bold shadow hover:bg-green-700 transition flex items-center gap-2">
        🔍 تتبع ملف
    </a>

    {{-- ✅ زر إضافة طالب جديد --}}
    <a href="{{ route('admin.files.create') }}"
       class="px-6 py-2 rounded-xl bg-blue-600 text-black font-bold shadow hover:bg-blue-700 transition flex items-center gap-2">
        ➕ إضافة طالب جديد
    </a>

</div>


            {{-- ✅ Success message --}}
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Table --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200">

                <div class="overflow-x-auto">
                    <table dir="rtl" class="min-w-full text-sm text-center">

                        {{-- ✅ Head --}}
                        <thead class="bg-sky-200 text-black font-bold">
                            <tr>
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">اللقب</th>
                                <th class="px-6 py-4">الاسم</th>
                                <th class="px-6 py-4">نوع الشهادة</th>
                                <th class="px-6 py-4">تاريخ الإيداع</th>
                                <th class="px-6 py-4">رقم التتبع</th>
                                <th class="px-6 py-4">الحالة</th>
                                <th class="px-6 py-4">إجراءات</th>
                            </tr>
                        </thead>

                        {{-- ✅ Body --}}
                        <tbody class="divide-y divide-gray-200">

                            @forelse($files as $file)
                                <tr class="hover:bg-sky-50 transition">

                                    {{-- ✅ ID --}}
                                    <<td class="px-6 py-4 font-bold text-gray-800">
    {{ $files->firstItem() + $loop->index }}
</td>


                                    {{-- ✅ Last / First --}}
                                    <td class="px-6 py-4">{{ $file->last_name }}</td>
                                    <td class="px-6 py-4">{{ $file->first_name }}</td>

                                    {{-- ✅ Diploma / Date --}}
                                    <td class="px-6 py-4">{{ $file->diploma_type }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $file->submitted_at }}</td>

                                    {{-- ✅ Tracking --}}
                                    <td class="px-6 py-4 font-bold text-blue-700">
                                        {{ $file->tracking_id }}
                                    </td>

                                    {{-- ✅ Status --}}
                                    <td class="px-6 py-4">
                                        @if($file->status == 'pending')
                                            <span class="px-5 py-2 rounded-full bg-yellow-200 text-black font-bold">
                                                ⏳ انتظار
                                            </span>
                                        @elseif($file->status == 'processed')
                                            <span class="px-5 py-2 rounded-full bg-green-200 text-black font-bold">
                                                ✅ تمت معالجته
                                            </span>
                                        @else
                                            <span class="px-5 py-2 rounded-full bg-red-200 text-black font-bold">
                                                ❌ مرفوض
                                            </span>
                                        @endif
                                    </td>

                                    {{-- ✅ Actions --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-3">

                                            {{-- ✅ Edit --}}
                                            <a href="{{ route('admin.files.edit', $file->id) }}"
                                               class="px-5 py-2 rounded-xl bg-sky-200 text-black font-bold hover:bg-sky-300 transition">
                                                ✏ تعديل
                                            </a>

                                            {{-- ✅ Delete --}}
                                            <form id="deleteForm{{ $file->id }}" action="{{ route('admin.files.destroy', $file->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        onclick="confirmDelete('deleteForm{{ $file->id }}')"
                                                        class="px-5 py-2 rounded-xl bg-red-200 text-black font-bold hover:bg-red-300 transition">
                                                    🗑 حذف
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-gray-600 font-semibold">
                                        لا توجد طلبات بعد 📭
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
<div class="mt-6 px-4 pb-6">
    {{ $files->links() }}
</div>

        </div>
    </div>

    {{-- ✅ SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(formId) {
            Swal.fire({
                title: "هل أنت متأكد؟",
                text: "لن يمكنك استرجاع الملف بعد الحذف!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#0ea5e9",
                confirmButtonText: "✅ نعم احذف",
                cancelButtonText: "❌ إلغاء",
                background: "#fff",
                width: "400px",
                padding: "20px",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

</x-app-layout>
