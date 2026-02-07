<x-app-layout>

    <div class="py-10 bg-sky-100 min-h-screen">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-10">

            {{-- ================= Header ================= --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

                {{-- Title + Search --}}
                
                    <p class="text-gray-600 mt-1">
                        إدارة ملفات الطلبة وتتبع حالتهم بسهولة
                    </p>

                    {{-- Search --}}
                    <form method="GET" action="{{ route('admin.files.index') }}" class="mt-4">
                        <div class="relative w-full max-w-md">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="🔍 الاسم أو اللقب أو رقم التتبع"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm
                                       focus:ring-2 focus:ring-sky-500 focus:outline-none"
                            >

                            @if(request('search'))
                                <a href="{{ route('admin.files.index') }}"
                                   class="absolute left-3 top-1/2 -translate-y-1/2 text-red-600 font-bold">
                                    ✖
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Buttons --}}
                <div class="w-full lg:w-auto">
                    <div class="flex justify-end">
                        <div class="flex gap-3 overflow-x-auto whitespace-nowrap pb-2 px-2 py-2
                                    bg-white/40 rounded-xl border border-white/60 shadow-sm">

                            {{-- PDF --}}
                            <a href="{{ route('admin.files.export.pdf') }}"
                               class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-bold
                                      shadow hover:bg-red-700 transition flex items-center gap-2">
                                🧾 PDF
                            </a>

                            {{-- Excel --}}
                            <a href="{{ route('admin.files.export.excel') }}"
                               class="px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-bold
                                      shadow hover:bg-green-700 transition flex items-center gap-2">
                                📄 XLSX
                            </a>

                            {{-- Create --}}
                            <a href="{{ route('admin.files.create') }}"
                               class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-bold
                                      shadow hover:bg-blue-700 transition flex items-center gap-2">
                                ➕ إضافة طالب جديد
                            </a>

                        </div>
                    </div>
                </div>

            </div>

            {{-- ================= Success Message ================= --}}
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ================= Table ================= --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200 w-full">
                <div class="overflow-x-auto">


                    <table dir="rtl" class="min-w-full text-[13px] text-center">

                        <thead class="bg-sky-200 text-black font-bold text-[13px]">
                            <tr>
                                <th class="px-2 py-3 w-[45px]">#</th>
                                <th class="px-2 py-3 w-[120px]">اللقب</th>
                                <th class="px-2 py-3 w-[120px]">الاسم</th>
                                <th class="px-2 py-3 w-[150px]">نوع الشهادة</th>
                                <th class="px-2 py-3 w-[110px]">تاريخ الإيداع</th>
                                <th class="px-2 py-3 w-[150px]">رقم التتبع</th>
                                <th class="px-2 py-3 w-[110px]">الحالة</th>
                                <th class="px-2 py-3 w-[110px]">تاريخ الاستلام</th>
                                <th class="px-2 py-3 w-[170px]">إجراءات</th>
                                

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($files as $file)
                            <tr class="hover:bg-sky-50 transition duration-200">

                                <td class="px-2 py-2 font-bold text-gray-800">
                                    {{ $files->firstItem() + $loop->index }}
                                </td>

                                <td class="px-2 py-2 font-semibold text-gray-700">
                                    {{ $file->last_name }}
                                </td>

                                <td class="px-2 py-2 font-semibold text-gray-700">
                                    {{ $file->first_name }}
                                </td>

                                <td class="px-2 py-2 text-gray-700">
                                    {{ $file->diploma_type }}
                                </td>



                                <td class="px-2 py-2 text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($file->submitted_at)->format('Y-m-d') }}
                                </td>


                                {{-- ✅ Tracking Link --}}
                                <td class="px-2 py-2 font-bold text-blue-700 whitespace-nowrap">
                                    <a href="{{ route('track.direct', $file->tracking_id) }}"
                                       target="_blank"
                                       class="underline hover:text-blue-900 transition">
                                       <div class="flex flex-col items-center gap-1">
    <span class="font-bold text-blue-700">
        {{ $file->tracking_id }}
    </span>

    <span class="px-2 py-1 rounded bg-gray-200 text-xs font-bold text-gray-800">
        👁 {{ \App\Models\TrackingVisit::where('tracking_id', $file->tracking_id)->count() }}
    </span>
</div>

                                    </a>
                                </td>

                                <td class="px-2 py-2">
                                    @if($file->status === 'pending')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-bold text-xs">
                                            ⏳ انتظار
                                        </span>
                                    @elseif($file->status === 'processed')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-bold text-xs">
                                            ✅ تم توثيقه
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 font-bold text-xs">
                                            ❌ مرفوض
                                        </span>
                                    @endif
                                </td>

                                <td class="px-2 py-2 text-gray-600 whitespace-nowrap">
                                    {{ $file->received_at
                                        ? \Carbon\Carbon::parse($file->received_at)->format('Y-m-d')
                                        : '-' }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-2 py-2">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.files.edit', $file->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-sky-100 hover:bg-sky-200">
                                            ✏
                                        </a>

                                        <a href="{{ route('admin.files.receipt', $file->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200">
                                            🧾
                                        </a>

                                        <form id="deleteForm{{ $file->id }}"
                                              action="{{ route('admin.files.destroy', $file->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    onclick="confirmDelete('deleteForm{{ $file->id }}')"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200">
                                                🗑
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-10 text-center text-gray-600 font-semibold">
    لا توجد طلبات بعد 📭
</td>

                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center">
                {{ $files->links() }}
            </div>

        </div>
    </div>

    {{-- SweetAlert --}}
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
                confirmButtonText: "نعم احذف",
                cancelButtonText: "إلغاء"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

</x-app-layout>
