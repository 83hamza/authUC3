<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('student_files', function (Blueprint $table) {
        $table->string('first_name')->after('id');
        $table->string('last_name')->after('first_name');
        $table->string('diploma_type')->after('last_name');
        $table->date('submitted_at')->after('diploma_type');
        
        // (اختياري) لو كان عندك student_name سابقًا وتحب تحذفو:
        // $table->dropColumn('student_name');
    });
}

public function down(): void
{
    Schema::table('student_files', function (Blueprint $table) {
        $table->dropColumn(['first_name', 'last_name', 'diploma_type', 'submitted_at']);
        // (اختياري) ترجع student_name:
        // $table->string('student_name')->nullable();
    });
}

};
