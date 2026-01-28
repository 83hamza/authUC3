<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentFileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Admin\UserController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentFile;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Upload (اختياري)
Route::get('/upload', fn () => view('upload'));
Route::post('/upload', [UploadController::class, 'upload']);

// الصفحة الرئيسية
Route::get('/', fn () => redirect('/login'));

// تتبع ملف الطالب (بدون تسجيل)
Route::get('/tracking', [TrackingController::class, 'showForm'])->name('tracking.form');
Route::post(
    '/tracking',
    [TrackingController::class, 'track']
)->middleware('throttle:5,1')->name('tracking.check');

Route::get('/track/{tracking_id}', [TrackingController::class, 'direct'])
    ->name('track.direct');

/*
|--------------------------------------------------------------------------
| Dashboard (بعد تسجيل الدخول)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.files.index');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Area (محمي بـ auth + admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |-------------------------
        | ملفات الطلبة
        |-------------------------
        */

        Route::get('/files', [StudentFileController::class, 'index'])->name('files.index');
        Route::get('/files/create', [StudentFileController::class, 'create'])->name('files.create');
        Route::post('/files', [StudentFileController::class, 'store'])->name('files.store');
        Route::get('/files/{file}/edit', [StudentFileController::class, 'edit'])->name('files.edit');
        Route::put('/files/{file}', [StudentFileController::class, 'update'])->name('files.update');
        Route::delete('/files/{file}', [StudentFileController::class, 'destroy'])->name('files.destroy');

        Route::patch('/files/{file}/status', [StudentFileController::class, 'updateStatus'])
            ->name('files.status');

        Route::get('/files/{file}/receipt', [StudentFileController::class, 'receipt'])
            ->name('files.receipt');

        /*
        |-------------------------
        | Export
        |-------------------------
        */

        Route::get('/files/export/pdf', function () {
            $files = StudentFile::orderBy('id')->get();
            $pdf = Pdf::loadView('admin.files.export_pdf', compact('files'))
                ->setPaper('a4', 'landscape');

            return $pdf->download('student_files.pdf');
        })->name('files.export.pdf');

        Route::get('/files/export/excel', [StudentFileController::class, 'exportExcel'])
            ->name('files.export.excel');

        /*
        |-------------------------
        | إدارة المستخدمين (Admin)
        |-------------------------
        */

        Route::resource('users', UserController::class);
        Route::post(
            'users/{user}/reset-password',
            [UserController::class, 'resetPassword']
        )->name('users.reset');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze / UI)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

