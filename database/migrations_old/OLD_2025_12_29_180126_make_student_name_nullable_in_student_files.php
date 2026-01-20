<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ⚠️ SQLite لا يدعم change مباشرة
        // لذلك نضيف قيمة افتراضية بدل NOT NULL
        Schema::table('student_files', function (Blueprint $table) {
            $table->string('student_name')->nullable()->default(null);
        });
    }

    public function down(): void
    {
        // لا نرجع NOT NULL لتفادي المشاكل
    }
};
