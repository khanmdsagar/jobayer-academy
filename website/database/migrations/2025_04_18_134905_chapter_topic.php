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
        Schema::create('chapter_topic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic_name');
            $table->string('topic_video');
            $table->boolean('topic_is_free')->default(false);
            $table->integer('topic_priority')->default(0);

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
            $table->foreign('chapter_id')->references('id')->on('course_chapter')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapter_topic', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['chapter_id']);
        });
        Schema::dropIfExists('course_topic');
    }
};
