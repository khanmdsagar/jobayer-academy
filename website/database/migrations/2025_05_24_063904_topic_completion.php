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
         Schema::create('topic_completion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('topic_ids')->nullable();

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('topic_completion', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('topic_completion');
    }
};
