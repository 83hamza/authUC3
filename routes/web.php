<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentFileController;
use App\Http\Controllers\TrackingController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentFile;
use App\Http\Controllers\Admin\UserController;





// صفحة إدخال رقم التتبع (للطلاب)
Route::get('/track', [TrackingController::class, 'form'])->name('track.form');

// معالجة رقم التتبع
Route::post('/track', [TrackingController::class, 'check'])->name('track.check');
Route::post('/track', [TrackingController::class, 'check'])
    ->middleware('throttle:5,1') // 5 محاولات في الدقيقة
    ->name('track.check');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/login'));

// ✅ تتبع ملف (للطلاب)
Route::get('/tracking', [TrackingController::class, 'showForm'])->name('tracking.form');
Route::post('/tracking', [TrackingController::class, 'track'])->name('tracking.check');
Route::get('/track/{tracking_id}', [TrackingController::class, 'direct'])
    ->name('track.direct');


// ✅ dashboard بعد الدخول
Route::get('/dashboard', function () {
    return redirect()->route('admin.files.index');
})->middleware(['auth'])->name('dashboard');


// ✅ Admin Area
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // ===== ملفات الطلبة =====
    Route::get('/files', [StudentFileController::class, 'index'])->name('files.index');
    Route::get('/files/create', [StudentFileController::class, 'create'])->name('files.create');
    Route::post('/files', [StudentFileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}/edit', [StudentFileController::class, 'edit'])->name('files.edit');
    Route::put('/files/{file}', [StudentFileController::class, 'update'])->name('files.update');
    Route::delete('/files/{file}', [StudentFileController::class, 'destroy'])->name('files.destroy');
    Route::patch('/files/{file}/status', [StudentFileController::class, 'updateStatus'])->name('files.status');

    Route::get('/files/{file}/receipt', [StudentFileController::class, 'receipt'])->name('files.receipt');
    Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        // كل Routes الإدارة
    });

    // Export PDF
    Route::get('/files/export/pdf', function () {
        $files = StudentFile::orderBy('id', 'asc')->get();
        $pdf = Pdf::loadView('admin.files.export_pdf', compact('files'))->setPaper('a4', 'landscape');
        return $pdf->download('student_files.pdf');
    })->name('files.export.pdf');

    // Export Excel
    Route::get('/files/export/excel', [StudentFileController::class, 'exportExcel'])->name('files.export.excel');


    // ===== إدارة المستخدمين (Admin فقط) =====
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset');
    });

});

require __DIR__.'/auth.php';
