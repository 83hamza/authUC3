<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">تعديل مستخدم</h2>
    </x-slot>
<div class="flex justify-center mb-6">
    <a href="{{ route('admin.users.index') }}"
       class="flex items-center gap-2 px-5 py-2 rounded-xl
              bg-gradient-to-r from-sky-500 to-blue-600
              text-gray-700 font-bold shadow-md
              hover:scale-105 transition">
        ⬅️ الرجوع إلى إدارة المستخدمين
    </a>
</div>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6 space-y-6">

                @if(session('success'))
                    <div class="p-3 rounded bg-green-100 text-green-800 font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3 rounded bg-red-100 text-red-800 font-bold">
                        {{ session('error') }}
                    </div>
                @endif
                          
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-gray-700 font-bold mb-1 text-sm">الاسم</label>
        <input type="text" name="name" value="{{ $user->name }}"
               class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
    </div>

    <div>
        <label class="block text-gray-700 font-bold mb-1 text-sm">الإيميل</label>
        <input type="email" name="email" value="{{ $user->email }}"
               class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
    </div>

    <div>
        <label class="block text-gray-700 font-bold mb-1 text-sm">Role</label>
        <select name="role" class="w-full rounded-lg border-gray-300">
            <option value="user" @selected($user->role=='user')>User</option>
            <option value="admin" @selected($user->role=='admin')>Admin</option>
            <option value="super_admin" @selected($user->role=='super_admin')>Super Admin</option>
        </select>
    </div>

   <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-1 text-sm">كلمة المرور</label>

    <div class="relative">
        <input
            type="password"
            id="password"
            name="password"
            class="w-full px-4 py-2 pr-12 rounded-xl border
                   focus:ring-2 focus:ring-blue-400"
            placeholder="********">

        <button type="button"
                onclick="togglePassword()"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       text-gray-500 hover:text-blue-600">
            👁️
        </button>
    </div>

    <p class="text-sm text-gray-500 mt-1">
        اتركه فارغًا إذا لا تريد تغييره
    </p>
</div>

   <div class="flex justify-end mt-6">
    <button type="submit"
       class="px-8 py-2 rounded-lg bg-sky-500 text-black font-extrabold text-sm shadow hover:bg-sky-600 transition flex items-center gap-2">
        ✅ حفظ التعديلات
    </button>
</div>

</form>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>


                <hr>

                <form method="POST" action="{{ route('admin.users.reset', $user) }}" class="space-y-3">
                    @csrf
                    <div class="font-bold text-gray-700">Reset Password سريع</div>
                    <input name="password" type="password"
                           placeholder="اكتب كلمة مرور جديدة"
                          class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none" required>
                    <button class="px-4 py-2 rounded-xl bg-amber-500 text-white font-bold hover:bg-amber-600">
                        Reset Password
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

