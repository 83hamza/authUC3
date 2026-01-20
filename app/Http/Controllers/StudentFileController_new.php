<?php

namespace App\Http\Controllers;

use App\Models\StudentFile;
use Illuminate\Http\Request;

class StudentFileController extends Controller
{
    public function index()
    {
        $files = StudentFile::latest()->get();
        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        return view('admin.files.create');
    }

    // ✅ حفظ طالب جديد
    public function store(Request $request)
    {
        $request->validate([
            'last_name'    => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'diploma_type' => 'required|string|max:255',
            'submitted_at' => 'required|date',
        ]);

        StudentFile::create([
            'last_name'    => $request->last_name,
            'first_name'   => $request->first_name,
            'diploma_type' => $request->diploma_type,
            'submitted_at' => $request->submitted_at,
            'status'       => 'pending', // ⏳ افتراضي
        ]);

        return redirect()->route('admin.files.index')
            ->with('success', 'تمت إضافة بيانات الطالب بنجاح ✅');
    }

    // ✅ صفحة التعديل
    public function edit(StudentFile $file)
    {
        return view('admin.files.edit', compact('file'));
    }

    // ✅ تحديث البيانات
    public function update(Request $request, StudentFile $file)
    {
        $request->validate([
            'last_name'    => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'diploma_type' => 'required|string|max:255',
            'submitted_at' => 'required|date',
        ]);

        $file->update($request->only([
            'last_name',
            'first_name',
            'diploma_type',
            'submitted_at',
        ]));

        return redirect()->route('admin.files.index')
            ->with('success', 'تم تحديث بيانات الطالب ✅');
    }

    // ✅ حذف
    public function destroy(StudentFile $file)
    {
        $file->delete();

        return redirect()->route('admin.files.index')
            ->with('success', 'تم حذف الطالب ✅');
    }

    // ✅ تحديث الحالة
    public function updateStatus(Request $request, StudentFile $file)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,rejected',
        ]);

        $file->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.files.index')
            ->with('success', 'تم تحديث حالة الملف ✅');
    }
}

