<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentFile;
use App\Models\TrackingVisit;

class TrackingController extends Controller
{
    // ✅ عرض فورم التتبع
    public function showForm()
    {
        return view('tracking.form');
    }

    // ✅ معالجة التتبع عبر POST
    public function track(Request $request)
    {
        $request->validate([
            'tracking_id' => 'required|string'
        ]);

        $file = StudentFile::where('tracking_id', $request->tracking_id)->first();

        if (!$file) {
            return back()->withErrors([
                'tracking_id' => 'رقم التتبع غير صحيح'
            ]);
        }

        // ✅ تسجيل زيارة
        TrackingVisit::create([
            'tracking_id' => $file->tracking_id,
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ]);

        return view('tracking.result', compact('file'));
    }

    // ✅ تتبع مباشر عبر الرابط
  public function direct(string $tracking_id)
{
    $file = StudentFile::where('tracking_id', $tracking_id)->first();

    if (! $file) {
        return view('tracking.form', [
            'error' => 'رقم التتبع غير موجود'
        ]);
    }

    // تسجيل زيارة جديدة
    TrackingVisit::create([
        'tracking_id' => $tracking_id,
        'ip' => request()->ip(),
        'user_agent' => request()->userAgent(),
    ]);

    return view('tracking.result', compact('file'));
}

}
