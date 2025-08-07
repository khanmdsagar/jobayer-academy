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
        Schema::create('course_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('review');
            $table->integer('review_rating');
            $table->date('review_date');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
            ->references('id')->on('student')->onDelete('cascade');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                  ->references('id')->on('course')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_review', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('course_review');
    }
};
