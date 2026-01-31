<?php

namespace App\Http\Controllers;
dd('STUDENT FILE CONTROLLER LOADED');

use App\Models\StudentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\StudentFilesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

  




class StudentFileController extends Controller
{
    // ✅ Export Excel
    public function exportExcel()
    {
        return Excel::download(new StudentFilesExport, 'student_files.xlsx');
    }

    // ✅ عرض الملفات + بحث + Pagination
    public function index(Request $request)
    {

    


        $search = $request->search;

        $files = StudentFile::when($search, function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('tracking_id', 'like', "%{$search}%");
        })
        ->orderBy('id', 'asc')
        ->paginate(20)
        ->withQueryString();

        return view('admin.files.index', compact('files'));
    }

    // ✅ صفحة إضافة طالب جديد
    public function create()
    {
        return view('admin.files.create');
    }

    // ✅ حفظ الطالب الجديد
    public function store(Request $request)
{
    $request->validate([
        'last_name'    => 'required|string|max:255',
        'first_name'   => 'required|string|max:255',
        'diploma_type' => 'required|string|max:255',
        'submitted_at' => 'required|date',
        'received_at'  => 'nullable|date', // ✅ جديد
    ]);

    StudentFile::create([
        'last_name'    => $request->last_name,
        'first_name'   => $request->first_name,
        'diploma_type' => $request->diploma_type,
        'submitted_at' => $request->submitted_at,
        'received_at'  => $request->received_at, // ✅ جديد
        'tracking_id'  => strtoupper(Str::random(10)),
        'status'       => 'pending',
    ]);

    return redirect()->route('admin.files.index')
        ->with('success', '✅ تم إضافة الطالب بنجاح');
}

    // ✅ صفحة تعديل ملف
    public function edit($id)
    {
        $file = StudentFile::findOrFail($id);
        return view('admin.files.edit', compact('file'));
    }

    // ✅ حفظ التعديل
    public function update(Request $request, $id)
{
    $file = StudentFile::findOrFail($id);

    $request->validate([
        'last_name'    => 'required|string|max:255',
        'first_name'   => 'required|string|max:255',
        'diploma_type' => 'required|string|max:255',
        'submitted_at' => 'required|date',
        'received_at'  => 'nullable|date', // ✅ جديد
        'status'       => 'required|in:pending,processed,rejected',
    ]);

    $file->update([
        'last_name'    => $request->last_name,
        'first_name'   => $request->first_name,
        'diploma_type' => $request->diploma_type,
        'submitted_at' => $request->submitted_at,
        'received_at'  => $request->received_at, // ✅ جديد
        'status'       => $request->status,
    ]);

    return redirect()->route('admin.files.index')
        ->with('success', '✅ تم تحديث الملف بنجاح');
}


    // ✅ حذف ملف
    public function destroy($id)
    {
        $file = StudentFile::findOrFail($id);
        $file->delete();

        return redirect()->route('admin.files.index')
            ->with('success', '🗑 تم حذف الملف بنجاح');
    }

    // ✅ وصل PDF + QR (English Version)
  public function receipt($id)
{
    $file = StudentFile::findOrFail($id);

    $trackUrl = route('track.direct', [
        'tracking_id' => $file->tracking_id
    ], true);

    $qrCode = base64_encode(
        QrCode::format('svg')
            ->size(130)
            ->generate($trackUrl)
    );

    $receiptNumber = sprintf(
        'UC3-%s-%06d',
        now()->year,
        $file->id
    );

    return Pdf::loadView(
    'admin.files.receipt_pdf_v2',
    compact('file', 'trackUrl', 'qrCode', 'receiptNumber')
);

}



}
