<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* =========================
     |  LIST USERS
     ========================= */
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /* =========================
     |  CREATE FORM
     ========================= */
    public function create()
    {
        return view('admin.users.create');
    }

    /* =========================
     |  STORE USER
     ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin,super_admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // cast hashed
            'role'     => $request->role,
            'is_admin' => in_array($request->role, ['admin','super_admin'], true),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    /* =========================
     |  EDIT FORM
     ========================= */
    public function edit(User $user)
    {
        $currentUser = auth()->user();

        // 🔐 Admin لا يعدل Super Admin
        if (
            $user->role === 'super_admin'
            && $currentUser->role !== 'super_admin'
        ) {
            abort(403, 'غير مصرح لك بتعديل Super Admin');
        }

        return view('admin.users.edit', compact('user'));
    }

    /* =========================
     |  UPDATE USER
     ========================= */
    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();

        // 🔐 حماية قوية
        if (
            $user->role === 'super_admin'
            && $currentUser->role !== 'super_admin'
        ) {
            abort(403, 'غير مصرح لك بتعديل Super Admin');
        }

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'role'     => 'required|in:user,admin,super_admin',
            'password' => 'nullable|min:6',
        ]);

        // تحديث الباسورد فقط إذا أُدخل
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // تحديث is_admin تلقائياً
        $data['is_admin'] = in_array($data['role'], ['admin','super_admin'], true);

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم تعديل المستخدم بنجاح');
    }

    /* =========================
     |  DELETE USER
     ========================= */
    public function destroy(User $user)
    {
        // ❌ منع حذف Super Admin
        if ($user->role === 'super_admin') {
            return back()->with('error', 'لا يمكن حذف Super Admin');
        }

        $user->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }

    /* =========================
     |  RESET PASSWORD
     ========================= */
    public function resetPassword(Request $request, User $user)
    {
        // ❌ منع Reset لـ Super Admin
        if ($user->role === 'super_admin') {
            return back()->with('error', 'لا يمكن تغيير كلمة مرور Super Admin');
        }

        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'تم إعادة تعيين كلمة المرور بنجاح');
    }
}
