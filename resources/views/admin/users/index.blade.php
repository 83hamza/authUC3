<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mb-6">

            {{-- العنوان --}}
            <h1 class="text-2xl font-bold text-gray-800">
                إدارة المستخدمين
            </h1>

            {{-- زر الرجوع --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2
                      px-4 py-2 rounded-xl
                      bg-blue-600 text-white
                      text-sm font-semibold
                      hover:bg-blue-700 transition shadow">
                ⬅️ الرئيسية
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- رسائل --}}
            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 font-bold">
                    {{ session('error') }}
                </div>
            @endif

            {{-- العنوان + زر إضافة --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <p class="text-sm text-gray-500">
                    عدد المستخدمين: {{ $users->total() }}
                </p>

                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2 rounded-xl
                          bg-blue-600 text-white
                          text-sm font-semibold
                          hover:bg-blue-700 transition shadow">
                    ➕ إضافة مستخدم
                </a>
            </div>

            {{-- الجدول --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-right">
                            <th class="p-3">#</th>
                            <th class="p-3">الاسم</th>
                            <th class="p-3">الإيميل</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">إجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php
                        $currentUser = auth()->user();
                    @endphp

                    @foreach ($users as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $user->id }}</td>
                            <td class="p-3 font-semibold">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>

                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($user->role === 'super_admin') bg-red-100 text-red-700
                                    @elseif($user->role === 'admin') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td class="p-3 flex gap-2">

                                {{-- زر التعديل --}}
                                @if(
                                    !($user->role === 'super_admin'
                                    && $currentUser->role !== 'super_admin')
                                )
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="inline-flex items-center gap-1
                                              px-3 py-1.5 rounded-lg
                                              bg-blue-50 text-blue-700
                                              hover:bg-blue-100 hover:text-blue-800
                                              transition shadow-sm text-sm font-medium">
                                        ✏️ تعديل
                                    </a>
                                @else
                                    <span class="inline-flex items-center
                                                 px-3 py-1.5 rounded-lg
                                                 bg-gray-100 text-gray-400
                                                 text-sm cursor-not-allowed">
                                        🔒 محمي
                                    </span>
                                @endif

                                {{-- زر الحذف --}}
                                @if($user->role !== 'super_admin')
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-1
                                                       px-3 py-1.5 rounded-lg
                                                       bg-red-50 text-red-700
                                                       hover:bg-red-100 hover:text-red-800
                                                       transition shadow-sm text-sm font-medium">
                                            🗑️ حذف
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center
                                                 px-3 py-1.5 rounded-lg
                                                 bg-gray-100 text-gray-400
                                                 text-sm cursor-not-allowed">
                                        🔒 محمي
                                    </span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
