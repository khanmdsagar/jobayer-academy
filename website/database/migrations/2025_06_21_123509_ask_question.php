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
        Schema::create('ask_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->text('answer');

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('course_id')
                ->references('id')->on('course')->onDelete('cascade');
            $table->foreign('topic_id')
                ->references('id')->on('chapter_topic')->onDelete('cascade');
            $table->foreign('student_id')
                ->references('id')->on('student')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ask_question', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('ask_question');
    }
};
