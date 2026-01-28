<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // 1. تحقق من وجود الملف
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // 2. حفظ الصورة
        $path = $request->file('image')->store('uploads', 'public');

        // 3. إرجاع المسار (للتجربة)
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $path,
            'url' => asset('storage/' . $path),
        ]);
    }
}
