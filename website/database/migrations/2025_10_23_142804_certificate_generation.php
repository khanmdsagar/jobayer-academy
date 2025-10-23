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
        Schema::create('certificate_generation', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('certificate_code');
            $table->string('issue_date');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
            ->references('id')
            ->on('course')
            ->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
            ->references('id')
            ->on('student')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_generation', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('certificate_generation');
    }
};
