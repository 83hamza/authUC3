<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('student_files', function (Blueprint $table) {
        $table->string('tracking_id')->nullable()->unique()->after('submitted_at');
    });
}

        
    

    public function down(): void
    {
        Schema::table('student_files', function (Blueprint $table) {
            $table->dropUnique(['tracking_id']);
            $table->dropColumn('tracking_id');
        });
    }
};
