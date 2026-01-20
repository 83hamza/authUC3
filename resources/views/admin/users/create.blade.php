<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">إضافة مستخدم</h2>
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
            <div class="bg-white shadow rounded-xl p-6">
                         
             <div class="flex justify-end mb-4">
    
</div>

               <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
    @csrf


    <div>
        <label class="block text-gray-700 font-bold mb-1 text-sm">الاسم</label>
        <input type="text" name="name" required
               class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
    </div>

    <div>
        <label class="font-bold" >الإيميل</label>
        <input type="email" name="email" required
               class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
    </div>

    <div>
    <label class="block font-bold mb-1">
        كلمة المرور
        <span class="text-sm text-gray-400">(اختياري)</span>
    </label>

    <div class="relative">
        <input type="password" name="password" id="password"
              class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none" >

        <button type="button"
                onclick="togglePassword()"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       text-gray-500 hover:text-blue-600" >
            👁
        </button>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>



    <div>
        <label class="font-bold">Role</label>
        <select name="role" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none" >
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="super_admin">Super Admin</option>
        </select>
    </div>

    
<div class="flex justify-center pt-4">
    <button type="submit"
        class="px-8 py-2 rounded-lg bg-sky-500 text-black font-extrabold text-sm shadow hover:bg-sky-600 transition flex items-center gap-2">
        💾 {{ isset($user) ? 'حفظ التعديلات' : 'حفظ المستخدم' }}
    </button>
</div>

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
