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
    Schema::create('student_files', function (Blueprint $table) {
        $table->id();
        $table->string('student_name');
        $table->string('tracking_number')->unique();
        $table->date('deposit_date');
        $table->enum('status', ['pending', 'done'])->default('pending');
        $table->timestamps();
    });
}

};
