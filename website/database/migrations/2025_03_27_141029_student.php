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
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_name')->nullable();
            $table->text('student_photo')->nullable();
            $table->text('student_address')->nullable();
            $table->text('student_note')->nullable();
            $table->string('student_division')->nullable();
            $table->string('student_district')->nullable();
            $table->string('student_email')->nullable();
            $table->string('student_number')->unique();
            $table->string('student_birthday')->nullable();
            $table->string('student_profession')->nullable();
            $table->string('student_page_url')->nullable();
            $table->string('student_profile_url')->nullable();
            $table->integer('student_enrolled_course')->default(0);
            $table->longText('student_password')->nullable();
            $table->integer('student_paid_amount')->default(0);
            $table->string('student_interest')->nullable();
            $table->string('student_comment')->nullable();
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
