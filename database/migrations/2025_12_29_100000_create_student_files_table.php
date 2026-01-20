<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_files', function (Blueprint $table) {
            $table->id();

            // بيانات الطالب
            $table->string('last_name');
            $table->string('first_name');
            $table->string('diploma_type');

            // تاريخ الإيداع
            $table->date('submitted_at');

            // ✅ تاريخ الاستلام (جديد)
            $table->date('received_at')->nullable();

            // رقم التتبع
            $table->string('tracking_id')->unique();

            // حالة الملف
            $table->enum('status', [
                'pending',
                'processed',
                'rejected'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_files');
    }
};
