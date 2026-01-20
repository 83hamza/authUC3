<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true, // ✅ نجعله مدير
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', '✅ تم إضافة مدير جديد بنجاح');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', '🗑 تم حذف المستخدم بنجاح');
    }
}
